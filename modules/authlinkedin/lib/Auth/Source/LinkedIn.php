<?php

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/oauth/libextinc/OAuth.php');

/**
 * Authenticate using LinkedIn.
 *
 * @author Brook Schofield, TERENA.
 * @package SimpleSAMLphp
 */
class sspmod_authlinkedin_Auth_Source_LinkedIn extends SimpleSAML_Auth_Source 
{

    /**
     * The string used to identify our states.
     */
    const STAGE_INIT = 'authlinkedin:init';

    /**
     * The key of the AuthId field in the state.
     */
    const AUTHID = 'authlinkedin:AuthId';

    private $key;
    private $secret;
    private $attributes;


    /**
     * Constructor for this authentication source.
     *
     * @param array $info  Information about this authentication source.
     * @param array $config  Configuration.
     */
    public function __construct($info, $config)
    {
        assert(is_array($info));
        assert(is_array($config));

        // Call the parent constructor first, as required by the interface
        parent::__construct($info, $config);

        if (!array_key_exists('key', $config))
            throw new Exception('LinkedIn authentication source is not properly configured: missing [key]');

        $this->key = $config['key'];

        if (!array_key_exists('secret', $config))
            throw new Exception('LinkedIn authentication source is not properly configured: missing [secret]');

        $this->secret = $config['secret'];

        if (array_key_exists('attributes', $config)) {
            $this->attributes = $config['attributes'];
        } else {
            // Default values if the attributes are not set in config (ref https://developer.linkedin.com/docs/fields)
            $this->attributes = 'id,first-name,last-name,headline,summary,specialties,picture-url,public-profile-url,location,email-address';
        }
    }


    /**
     * Log-in using LinkedIn platform
     * Documentation at: http://developer.linkedin.com/docs/DOC-1008
     *
     * @param array &$state  Information about the current authentication.
     */
    public function authenticate(&$state)
    {
        assert(is_array($state));

        // We are going to need the authId in order to retrieve this authentication source later
        $state[self::AUTHID] = $this->authId;

        $stateID = SimpleSAML_Auth_State::getStateId($state);
        SimpleSAML\Logger::debug('authlinkedin auth state id = ' . $stateID);

        $consumer = new sspmod_oauth_Consumer($this->key, $this->secret);

        // Update the state
        SimpleSAML_Auth_State::saveState($state, self::STAGE_INIT);
        
        $params = array('response_type' => 'code',
                        'client_id' => $this->key ,
                        'scope' => 'r_basicprofile r_emailaddress',
                        'state' => $stateID, // unique long string
                        'redirect_uri' => SimpleSAML\Module::getModuleUrl('authlinkedin') . '/linkback.php',
                  );        

        // Authentication request
        //$url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);
        $url = 'https://www.linkedin.com/oauth/v2/authorization?' . http_build_query($params);
        
        header("Location: $url");
        exit;
    }


    public function finalStep(&$state) 
    {
        $params = array('grant_type' => 'authorization_code',
                        'client_id' => $this->key,
                        'client_secret' => $this->secret,
                        'code' => $_GET['code'],
                        'redirect_uri' => SimpleSAML\Module::getModuleUrl('authlinkedin') . '/linkback.php',
                  );        
        // Access Token request
        //$url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
        $url = 'https://www.linkedin.com/oauth/v2/accessToken?' . http_build_query($params);
        
        try {
            $response_acc = \SimpleSAML\Utils\HTTP::fetch($url);
        } catch (\SimpleSAML_Error_Exception $e) {
            throw new Exception('Error contacting request_token endpoint on the OAuth Provider');
        }

        $token = json_decode($response_acc);
        $params = array('oauth2_access_token' => $token->access_token,
            'format' => 'json',
        );
        
        $resource = 'https://api.linkedin.com/v1/people/~:(' . $this->attributes . ')?';
        //$resource = 'https://api.linkedin.com/v2/people/~:(' . $this->attributes . ')?';
        //$resource = 'https://api.linkedin.com/v2/me?fields='.$this->attributes.'?';
        
        $resource .= http_build_query($params);
        try {
            $data = \SimpleSAML\Utils\HTTP::fetch($resource);
        } catch (\SimpleSAML_Error_Exception $e) {
            throw new Exception('Error contacting request_token endpoint on the OAuth Provider');
        }        
       
        $userdata = json_decode($data,true);

        // auto-follow LabLynx on LinkedIn
        self::follow($token->access_token, 2495437);
        self::follow($token->access_token, 209217);

        $attributes = $this->flatten($userdata, 'linkedin.');

        // TODO: pass accessToken: key, secret + expiry as attributes?

        if (array_key_exists('id', $userdata)) {
            $attributes['linkedin_targetedID'] = array('http://linkedin.com!' . $userdata['id']);
            $attributes['linkedin_user'] = array($userdata['id'] . '@linkedin.com');
        }

        $attributes['givenName'] = array($userdata['firstName'] . ' ' . $userdata['lastName']);

        SimpleSAML\Logger::debug('LinkedIn Returned Attributes: '. implode(", ",array_keys($attributes)));

        $state['Attributes'] = $attributes;
    }
	
	
    private static function follow($accessToken, $nCompanyID){
        $xml 		= "<?xml version='1.0' encoding='UTF-8' standalone='yes'?><company><id>$nCompanyID</id></company>";
        $params     = ["oauth2_access_token" => $accessToken]; 
        $url        = "https://api.linkedin.com/v1/people/~/following/companies?";
        $url       	.= http_build_query($params);

        $headers = array(
            "Content-type: text/xml",
            "Content-length: " . strlen($xml)
        );

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$xml);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($ch); 
        $info = curl_getinfo($ch);
        curl_close($ch);	
    }//follow	


    /**
     * takes an associative array, traverses it and returns the keys concatenated with a dot
     *
     * e.g.:
     *
     * [
     *   'linkedin' => [
     *     'location' =>  [
     *       'id' => '123456'
     *       'country' => [
     *          'code' => 'de'
     *       ]
     *   ]
     * ]
     *
     * become:
     *
     * [
     *   'linkedin.location.id' => [0 => '123456'],
     *   'linkedin.location.country.code' => [0 => 'de']
     * ]
     *
     * @param array $array
     * @param string $prefix
     *
     * @return array the array with the new concatenated keys
     */
    protected function flatten($array, $prefix = '')
    {
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = $result + $this->flatten($value, $prefix . $key . '.');
            } else {
                $result[$prefix . $key] = array($value);
            }
        }
        return $result;
    }
}
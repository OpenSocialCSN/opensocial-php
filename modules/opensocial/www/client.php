<?php

/**
 * This page shows a list of authentication sources. When the user selects
 * one of them if pass this information to the
 * sspmod_multiauth_Auth_Source_MultiAuth class and call the
 * delegateAuthentication method on it.
 *
 * @author Lorenzo Gil, Yaco Sistemas S.L.
 * @package SimpleSAMLphp
 */

// Retrieve the authentication state
if (!array_key_exists('AuthState', $_REQUEST)) {
	throw new SimpleSAML_Error_BadRequest('Missing AuthState parameter.');
}
$authStateId = $_REQUEST['AuthState'];
$state = SimpleSAML_Auth_State::loadState($authStateId, sspmod_opensocial_Auth_Source_OpenSocial::STAGEID);

if (array_key_exists("SimpleSAML_Auth_Source.id", $state)) {
	$authId = $state["SimpleSAML_Auth_Source.id"];
	$as = SimpleSAML_Auth_Source::getById($authId);
} else {
	$as = NULL;
}

$source = NULL;
if (array_key_exists('source', $_REQUEST)) {	
	$source = $_REQUEST['source'];
} else {
	foreach ($_REQUEST as $k => $v) {
		$k = explode('-', $k, 2);
		if (count($k) === 2 && $k[0] === 'src') {
			$source = base64_decode($k[1]);
		}
	}
}
if ($source !== NULL) {
	if ($as !== NULL) {
		$as->setPreviousSource($source);
	}
	sspmod_opensocial_Auth_Source_OpenSocial::delegateAuthentication($source, $state);
}

if (array_key_exists('opensocial:preselect', $state)) {
	$source = $state['opensocial:preselect'];
	sspmod_opensocial_Auth_Source_OpenSocial::delegateAuthentication($source, $state);
}

$globalConfig = SimpleSAML_Configuration::getInstance();
$t = new SimpleSAML_XHTML_Template($globalConfig, 'opensocial:client.php');
$t->data['authstate'] = $authStateId;
$t->data['sources'] = $state[sspmod_opensocial_Auth_Source_OpenSocial::SOURCESID];
if ($as !== NULL) {
	$t->data['preferred'] = $as->getPreviousSource();
} else {
	$t->data['preferred'] = NULL;
}
$t->show();
exit();

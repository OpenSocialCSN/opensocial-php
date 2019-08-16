<?php
/**
 * SAML 2.0 remote SP metadata for SimpleSAMLphp.
 *
 * See: https://simplesamlphp.org/docs/stable/simplesamlphp-reference-sp-remote
 */

/*
 * Example SimpleSAMLphp SAML 2.0 SP

$metadata['https://saml2sp.example.org'] = array(
	'AssertionConsumerService' => 'https://saml2sp.example.org/simplesaml/module.php/saml/sp/saml2-acs.php/default-sp',
	'SingleLogoutService' => 'https://saml2sp.example.org/simplesaml/module.php/saml/sp/saml2-logout.php/default-sp',
);
 */

$metadata['https://tsso1.scicloud.net'] = array(
	'AssertionConsumerService' => 'https://tsso1.scicloud.net/wp-login.php?saml_acs',
	'SingleLogoutService' => 'https://tsso1.scicloud.net/wp-login.php?saml_sls'
);

$metadata['php-saml2'] = array(
	'AssertionConsumerService' => 'https://tsso2.scicloud.net/wp-login.php?saml_acs',
	'SingleLogoutService' => 'https://tsso2.scicloud.net/wp-login.php?saml_sls'
);

$metadata['php-saml-ingroups-me'] = array(
	'AssertionConsumerService' => 'https://ingroups.me/wp-login.php?saml_acs',
	'SingleLogoutService' => 'https://ingroups.me/wp-login.php?saml_sls',
);

$metadata['https://chat.opensocial.me/_saml/metadata/ingroups'] = array(
	'AssertionConsumerService' => 'https://chat.opensocial.me/_saml/validate/ingroups',
	'SingleLogoutService' => 'https://chat.opensocial.me/_saml/logout/ingroups',
);

$metadata['jnote.app'] = array(
	'AssertionConsumerService' => 'https://www.jnote.app/wp-login.php?saml_acs',
	'SingleLogoutService' => 'https://www.jnote.app/wp-login.php?saml_sls',
);

$metadata['https://web1.lablynx.com'] = array(
	'AssertionConsumerService' => 'https://web1.lablynx.com/myclient/userinfo.php?saml_acs',
	'SingleLogoutService' => 'https://web1.lablynx.com/myclient/slo.php?saml_sls'
);

$metadata['nodejs-saml'] = array(
	'AssertionConsumerService' => 'https://jetos.io/login/callback',
	'SingleLogoutService' => 'https://sso.jetos.io/logout/callback',
);

$metadata['opensocial.me'] = array(
	'AssertionConsumerService' => 'https://www.opensocial.me/wp-login.php?saml_acs',
	'SingleLogoutService' => 'https://www.opensocial.me/wp-login.php?saml_sls',
);

$metadata['lablynx.net'] = array(
	'AssertionConsumerService' => 'https://www.lablynx.net/wp-login.php?saml_acs',
	'SingleLogoutService' => 'https://www.lablynx.net/wp-login.php?saml_sls',
);

$metadata['mylabcare.com'] = array(
	'AssertionConsumerService' => 'https://www.mylabcare.com/wp-login.php?saml_acs',
	'SingleLogoutService' => 'https://www.mylabcare.com/wp-login.php?saml_sls',
);

$metadata['custom'] = array(
	'AssertionConsumerService' => 'https://custom.umardraz.com/login.php?saml_acs',
	'SingleLogoutService' => 'https://custom.umardraz.com/login.php?saml_sls',
);

$metadata['https://www.labdrive.net/apps/user_saml/saml/metadata'] = array(
	'AssertionConsumerService' => 'https://www.labdrive.net/apps/user_saml/saml/acs',
	//'SingleLogoutService' => 'https://www.labdrive.net/apps/user_saml/saml/sls',
);

/*
 * This example shows an example config that works with G Suite (Google Apps) for education.
 * What is important is that you have an attribute in your IdP that maps to the local part of the email address
 * at G Suite. In example, if your Google account is foo.com, and you have a user that has an email john@foo.com, then you
 * must set the simplesaml.nameidattribute to be the name of an attribute that for this user has the value of 'john'.

$metadata['google.com'] = array(
	'AssertionConsumerService' => 'https://www.google.com/a/g.feide.no/acs',
	'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
	'simplesaml.nameidattribute' => 'uid',
	'simplesaml.attributes' => FALSE,
);
*/

$metadata['https://legacy.example.edu'] = array(
	'AssertionConsumerService' => 'https://legacy.example.edu/saml/acs',
        /*
         * Currently, SimpleSAMLphp defaults to the SHA-256 hashing algorithm.
	 * Uncomment the following option to use SHA-1 for signatures directed
	 * at this specific service provider if it does not support SHA-256 yet.
         *
         * WARNING: SHA-1 is disallowed starting January the 1st, 2014.
         * Please refer to the following document for more information:
         * http://csrc.nist.gov/publications/nistpubs/800-131A/sp800-131A.pdf
         */
        //'signature.algorithm' => 'http://www.w3.org/2000/09/xmldsig#rsa-sha1',
);
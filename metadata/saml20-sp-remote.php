<?php

foreach (glob("/var/www/html/opensocial/metadata/subscribers/*.php") as $filename)
{
	require $filename;
}

$metadata['studio-labvia'] = array(
	'AssertionConsumerService' => 'https://nstudio.labvia.com/saml/acs',
	'SingleLogoutService' => 'https://nstudio.labvia.com/saml/sls',
);

$metadata['https://studio.labvia.com'] = array(
	'AssertionConsumerService' => 'https://studio.labvia.com/server/saml/acs',
	'SingleLogoutService' => 'https://studio.labvia.com/server/saml/sls',
);

$metadata['https://bsci.scicloud.net/apps/user_saml/saml/metadata'] = array(
	'AssertionConsumerService' => 'https://bsci.scicloud.net/apps/user_saml/saml/acs',
	'SingleLogoutService' => 'https://bsci.scicloud.net/apps/user_saml/saml/sls',
);

$metadata['https://afl.labdrive.net/apps/user_saml/saml/metadata'] = array(
	'AssertionConsumerService' => 'https://afl.labdrive.net/apps/user_saml/saml/acs',
	'SingleLogoutService' => 'https://afl.labdrive.net/apps/user_saml/saml/sls',
);

?>

<?php

foreach (glob("/var/opensocial/metadata/subscribers/*.php") as $filename)
{
	require $filename;
}

$metadata['nodejs.scicloud.net'] = array(
	'AssertionConsumerService' => 'https://nodejs.scicloud.net/login/callback',
	//'SingleLogoutService' => 'https://nodejs.scicloud.net/logout/callback',
);

?>
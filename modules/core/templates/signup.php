<?php

$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJsYWJseW54IjoiMjQwMEBMYWJMeW54In0.tahMvNMP-9XtYDu0_87AZuAjUz8ZUQ7loXZkY5CWN-g';

$ch = curl_init();   
$options = array(CURLOPT_URL => 'https://signup.opensocial.me/api/settings',
  CURLOPT_HTTPHEADER => array('Authorization: Bearer ' . $token, 'Content-Type: application/json'),
  CURLOPT_RETURNTRANSFER => true,
  CURLINFO_HEADER_OUT => true,
  CURLOPT_HEADER => false,
  CURLOPT_SSL_VERIFYPEER => false
);

curl_setopt_array($ch, $options);
$result = curl_exec($ch);
curl_close($ch);

$settings = json_decode($result, true);

/* Get Client info */
$path = urldecode(parse_url($_GET['AuthState'], PHP_URL_QUERY));
parse_str($path, $output);
$identity = $output['spentityid'];
$domain = parse_url($identity, PHP_URL_HOST);

$ch = curl_init();   
$options = array(CURLOPT_URL => 'https://signup.opensocial.me/api/clientinfo',
  CURLOPT_HTTPHEADER => array('Authorization: Bearer ' . $token, 'Content-Type: application/json'),
  CURLOPT_RETURNTRANSFER => true,
  CURLINFO_HEADER_OUT => true,
  CURLOPT_HEADER => false,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => json_encode(array('identity' =>  $identity ))
);

curl_setopt_array($ch, $options);
$result = curl_exec($ch);
curl_close($ch);

$client = json_decode($result, true);

?>
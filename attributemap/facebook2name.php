<?php
$attributemap = array(

    // Generated Facebook Attributes
    'facebook_user'        => 'eduPersonPrincipalName', // username OR uid @ facebook.com
    'facebook_targetedID'  => 'eduPersonTargetedID', // http://facebook.com!uid
    'facebook_cn'          => 'cn', // duplicate of displayName

    // Attributes Returned by Facebook
    'facebook.first_name'  => 'firstname',
    'facebook.last_name'   => 'lastname',
    'facebook.name'        => 'displayName', // or 'cn'
    'facebook.email'       => 'email',
    'facebook.user'          => 'uid',
    'facebook.username'    => 'uid', // facebook username (maybe blank)
    'facebook.profile_url' => 'labeledURI',
    'facebook.locale'      => 'preferredLanguage',
    'facebook.about_me'    => 'description',
);
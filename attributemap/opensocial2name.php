<?php
$attributemap = array(

    // Attributes Returned by Linkedin
    'linkedin.emailAddress'     => 'email',
    'linkedin.pictureUrl'       => 'picture',
    'linkedin.firstName'        => 'firstname',
    'linkedin.lastName'         => 'lastname',
    //'linkedin.id'               => 'li_uid',
    'linkedin_user'             => 'eduPersonPrincipalName',
    'linkedin.publicProfileUrl' => 'profile_url',
    'linkedin.location.name'    => 'location',

    // Attributes Returned by facebook
    'facebook.email'            => 'email',
    'picture.data.url'          => 'picture',
    'facebook.first_name'       => 'firstname',
    'facebook.last_name'        => 'lastname',
    'first_name'                => 'firstname',
    'last_name'                 => 'lastname',
    'id'                        => 'fbook.id',
    'facebook_cn'               => 'eduPersonPrincipalName',
    'facebook.name'             => 'givenName',

    // Attributes Returned by google
    'given_name'                => 'firstname',
    'family_name'               => 'lastname',
    'sub'                       => 'google.id',
    'name'                      => 'givenName',

    // Attributes Returned by github
    'avatar_url'                => 'picture',
    'html_url'                  => 'profile',
    'node_id'                   => 'github.id',
    
    // Attributes Return by twitter
    'twitter_screen_n_realm'    => 'email',
    'twitter.id_str'            => 'twitter.id',
    'twitter.name'              => 'givenName',
    'twitter.profile_background_image_url_https'                   => 'picture',
    'twitter.profile_image_url_https'   => 'profile',

    // Attributes Return by slack
    'user.name'                 => 'givenName',
    'user.id'                   => 'slack.id',
    'user.email'                => 'email',
    'user.image_48'             => 'picture'

);
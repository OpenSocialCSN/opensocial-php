<?php

require_once('opensocial-config.php');

$config = array(

    // This is a authentication source which handles admin authentication.
    'admin' => array(
        // The default is to use core:AdminPassword, but it can be replaced with
        // any authentication source.

        'core:AdminPassword',
    ),

    'opensocial-sql' => array(
        'sqlauth:SQL',
        'dsn' => 'mysql:host=localhost;dbname=auth',
        'username' => $op_config['mysql']['user'],
        'password' => $op_config['mysql']['passwd'],
        'query' => 'SELECT uid, firstname, lastname, givenName, email, eduPersonPrincipalName FROM users WHERE uid = :username AND AES_DECRYPT(password,"txjueumsdzkmt8jdehv4hflu24atfnh8") = :password AND status="Confirmed"'
    ),

    'linkedin' => array(
        'authoauth2:LinkedInV2Auth',
        'clientId' => $op_config['linkedin']['clientId'],
        'clientSecret' => $op_config['linkedin']['clientSecret'],
        'scopes' => [
            'r_liteprofile',
            'r_emailaddress'
        ],
    ),
    
    'google' => array(
        'authoauth2:OAuth2',
        'urlAuthorize' => 'https://accounts.google.com/o/oauth2/auth',
        'urlAccessToken' => 'https://accounts.google.com/o/oauth2/token',
        'urlResourceOwnerDetails' => 'https://www.googleapis.com/plus/v1/people/me/openIdConnect',
        'clientId' => $op_config['google']['clientId'],
        'clientSecret' => $op_config['google']['clientSecret'],
        'scopes' =>  array(
            'openid',
            'email',
            'profile'
        ),
        'scopeSeparator' => ' ',
    ),

    'facebook' => array(
        'authoauth2:OAuth2',
        'urlAuthorize' => 'https://www.facebook.com/dialog/oauth',
        'urlAccessToken' => 'https://graph.facebook.com/oauth/access_token',
        'urlResourceOwnerDetails' => 'https://graph.facebook.com/me?fields=id,name,first_name,last_name,email,picture',
        'clientId' => $op_config['facebook']['clientId'],
        'clientSecret' => $op_config['facebook']['clientSecret'],
        'scopes' => 'email',
    ),

    'github' => array(
        'authoauth2:OAuth2',
        'urlAuthorize' => 'https://github.com/login/oauth/authorize',
        'urlAccessToken' => 'https://github.com/login/oauth/access_token',
        'urlResourceOwnerDetails' => 'https://api.github.com/user',
        'clientId' => $op_config['github']['clientId'],
        'clientSecret' => $op_config['github']['clientSecret'],
    ),

    'twitter' => array(
        'authtwitter:Twitter',
        'key' => $op_config['twitter']['clientId'],
        'secret' => $op_config['twitter']['clientSecret'],
        'force_login' => FALSE,
        'include_email' => TRUE
    ),

    'slack' => array(
        'authoauth2:OAuth2',
        'urlAuthorize' => 'https://slack.com/oauth/authorize',
        'urlAccessToken' => 'https://slack.com/api/oauth.access',
        'urlResourceOwnerDetails' => 'https://slack.com/api/users.identity',
        'clientId' => $op_config['slack']['clientId'],
        'clientSecret' => $op_config['slack']['clientSecret'],
        'scopes' => 'identity.basic',
    ),

    'opensocial-multi' => array(
        'opensocial:OpenSocial',
        'sources' => array(
            'linkedin' => array(
                'text' => array(
                    'en' => 'Log in with LinkedIn'
                )
            ),
            'facebook' => array(
                'text' => array(
                    'en' => 'Log in with Facebook'
                )
            ),
            'google' => array(
                'text' => array(
                    'en' => 'Log in with Google'
                )
            ),
            'github' => array(
                'text' => array(
                    'en' => 'Log in with GitHub'
                )
            ),
            'twitter' => array(
                'text' => array(
                    'en' => 'Log in with Twitter'
                )
            )    
        ),
    )

);
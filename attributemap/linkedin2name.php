<?php
$attributemap = array(

    // See http://developer.linkedin.com/docs/DOC-1061 for LinkedIn Profile fields.
    // NB: JSON response requires the conversion of field names from hyphened to camelCase.
    // For instance, first-name becomes firstName.

    // Generated LinkedIn Attributes
    'linkedin_user'       => 'eduPersonPrincipalName', // id  @ linkedin.com
    'linkedin.emailAddress' => 'email',
    'linkedin_targetedID' => 'eduPersonTargetedID', // http://linkedin.com!id

    // Attributes Returned by LinkedIn
    'linkedin.firstName'  => 'firstname',
    'linkedin.lastName'   => 'lastname',
    'linkedin.id'         => 'uid', // alpha + mixed case user id
    'linkedin.headline'   => 'title',
    'linkedin.summary'    => 'description',
    'linkedin.pictureUrl' => 'picture'
);

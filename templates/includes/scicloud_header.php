<?php

/**
 * Support the htmlinject hook, which allows modules to change header, pre and post body on all pages.
 */
$this->data['htmlinject'] = [
    'htmlContentPre' => [],
    'htmlContentPost' => [],
    'htmlContentHead' => [],
];

$jquery = [];
if (array_key_exists('jquery', $this->data)) {
    $jquery = $this->data['jquery'];
}

if (array_key_exists('pageid', $this->data)) {
    $hookinfo = [
        'pre' => &$this->data['htmlinject']['htmlContentPre'],
        'post' => &$this->data['htmlinject']['htmlContentPost'],
        'head' => &$this->data['htmlinject']['htmlContentHead'],
        'jquery' => &$jquery,
        'page' => $this->data['pageid']
    ];
        
    SimpleSAML\Module::callHooks('htmlinject', $hookinfo);
}
// - o - o - o - o - o - o - o - o - o - o - o - o -

/**
 * Do not allow to frame SimpleSAMLphp pages from another location.
 * This prevents clickjacking attacks in modern browsers.
 *
 * If you don't want any framing at all you can even change this to
 * 'DENY', or comment it out if you actually want to allow foreign
 * sites to put SimpleSAMLphp in a frame. The latter is however
 * probably not a good security practice.
 */
header('X-Frame-Options: SAMEORIGIN');

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="initial-scale=1.0" />
<script type="text/javascript" src="/<?php echo $this->data['baseurlpath']; ?>resources/script.js"></script>
<title><?php
/*
if (array_key_exists('header', $this->data)) {
    echo $this->data['header'];
} else {
    echo 'SimpleSAMLphp';
}
*/
echo 'OpenSocial.me';
?></title>

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,500,400,600,700,800">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/<?php echo $this->data['baseurlpath']; ?>resources/bootstrap-social/assets/css/docs.css">
    <link rel="stylesheet" type="text/css" href="/<?php echo $this->data['baseurlpath']; ?>resources/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" type="text/css" href="/<?php echo $this->data['baseurlpath']; ?>resources/new_scicloud.css" />
    <link rel="icon" type="image/icon" href="/<?php echo $this->data['baseurlpath']; ?>resources/icons/opensocial.ico" />
    <script type="text/javascript" src="/<?php echo $this->data['baseurlpath']; ?>resources/script.js"></script>
<?php

if (isset($this->data['clipboard.js'])) {
    echo '<script type="text/javascript" src="/' . $this->data['baseurlpath'] .
         'resources/clipboard.min.js"></script>' . "\n";
}

if (!empty($this->data['htmlinject']['htmlContentHead'])) {
    foreach ($this->data['htmlinject']['htmlContentHead'] as $c) {
        echo $c;
    }
}

if ($this->isLanguageRTL()) {
    ?>
    <link rel="stylesheet" type="text/css" href="/<?php echo $this->data['baseurlpath']; ?>resources/default-rtl.css" />
<?php
}
?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="/<?php echo $this->data['baseurlpath']; ?>resources/bootstrap-social/assets/js/docs.js"></script>

<meta name="robots" content="noindex, nofollow" />

<?php
if (array_key_exists('head', $this->data)) {
    echo '<!-- head -->' . $this->data['head'] . '<!-- /head -->';
}
?>
</head>

<?php
$onLoad = '';
if (array_key_exists('autofocus', $this->data)) {
    $onLoad .= 'SimpleSAML_focus(\'' . $this->data['autofocus'] . '\');';
}
if (isset($this->data['onLoad'])) {
    $onLoad .= $this->data['onLoad'];
}

if ($onLoad !== '') {
    $onLoad = ' onload="' . $onLoad . '"';
}
?>
<body<?php echo $onLoad; ?> class="home-page">

</body>
</html>

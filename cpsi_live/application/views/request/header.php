<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php

if (base_url("auth/request")) {
	$title = "AA-SchoolHealth | Request";
}
if (base_url("auth/request/password_reset")) {
	$title = "AA-SchoolHealth | Forgot Password";
}

// <!-- Core CSS - Include with every page -->
$style = array (
		'href' => base_url ("assets/css/styles.css"),
		'rel' => 'stylesheet',
		'type' => 'text/css' 
);

$style_google = array (
		'href' => 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800',
		'rel' => 'stylesheet',
		'type' => 'text/css'
);

echo link_tag($style);
echo link_tag($style_google);

?>
    <title><?= $title; ?></title>

</head>

<body class="log-in">
	<div class="wrapper">
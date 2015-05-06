<!DOCTYPE html> 
<html lang="en">
<head> 

<title><?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?></title>

<meta name="description" content="<?php echo $site->description()->html() ?>">
<meta name="keywords" content="<?php echo $site->keywords()->html() ?>">
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1" media="(device-height: 568px)">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="True"> 
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="icon" type="image/png" href="<?php echo $site->favicon() ?>" sizes="32x32" />

<!-- Style Sheets --> 
<?php echo css('assets/css/reset.css') ?>
<?php echo css('assets/css/grid.css') ?>
<?php echo css('assets/css/trunk.css') ?> 

<!-- Scripts --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<?php echo js('assets/js/trunk.js') ?>
<!--[if lt IE 9]>
<?php echo js('assets/js/html5shiv.js') ?>
<![endif]-->
<script src="//use.typekit.net/ufr8mxd.js"></script>
<script>try{Typekit.load();}catch(e){}</script>


</head> 
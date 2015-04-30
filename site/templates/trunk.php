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

<!-- Style Sheets --> 
<?php echo css('assets/css/trunk.css') ?>


<!-- Scripts --> 
<script type="text/javascript">
	if (typeof jQuery == 'undefined')
		document.write(unescape("%3Cscript src='js/jquery-1.9.js'" + 
															"type='text/javascript'%3E%3C/script%3E"))
</script>
<?php echo js('assets/js/trunk.js') ?>
<!--[if lt IE 9]>
<?php echo js('assets/js/html5shiv.js') ?>
<![endif]-->


</head> 
 
<body> 

<div class="container">

	<header class="slide">     <!--	Add "slideRight" class to items that move right when viewing Nav Drawer  -->
		<ul id="navToggle" class="burger slide">    <!--	Add "slideRight" class to items that move right when viewing Nav Drawer  -->
			<li></li><li></li><li></li>
		</ul>
		<h1>Trunk.js</h1>
	</header>

	<nav class="slide">
		<ul>
			<li><a href="../trunk.html" class="active">HOME</a></li>
			<li><a href="#">LINK TWO</a></li>
			<li><a href="#">LINK THREE</a></li>
			<li><a href="#">LINK FOUR</a></li>
			<li><a href="#">LINK FIVE</a></li>
			<li><a href="#">LINK SIX</a></li>
			<li><a href="#">LINK SEVEN</a></li>
		</ul>
	</nav>
	
	<div class="content slide">     <!--	Add "slideRight" class to items that move right when viewing Nav Drawer  -->
		<ul class="responsive">
			<li class="header-section">
				<p class="placefiller">HEADER</p>
			</li>
			<li class="body-section">
				<p class="placefiller">BODY</p>
			</li>
			<li class="footer-section">
				<p class="placefiller">FOOTER</p>
			</li>
		</ul>
	</div>
	
</div>

	
</body> 
</html>








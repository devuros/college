<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Forums</title>
		<meta name="author" content="Uroš Jovanović">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
		<link rel="shortcut icon" href="images/prava.ico">
		
		<script type="text/javascript" src="script/jquery-3.0.0.js"></script>
		<script type="text/javascript" src="script/script.js"></script>
	</head>
	<body>
		<div id="header-client-wrapper">
			<?php include("header-client.php"); ?>
		</div>
		<header>
			<?php include("header.php"); ?>
		</header>
		<nav>
			<?php include("nav.php"); ?>
		</nav>
		<div id="location">
			<?php include("location.php"); ?>
		</div>
		<div id="slider">
			<?php include("slider.php"); ?>
		</div>
		<div id="content-wrapper">
			<?php include("main.php"); ?>
		</div>
		<div class="clear"></div>
		<footer>
			<?php include("footer.php"); ?>
		</footer>
	</body>
</html>
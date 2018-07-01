<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Author - the Maker</title>
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
		<div id="author-wrapper">
			<div id="author-img">
				<img src="images/ai3.png" alt="the maker" />
			</div>
			<div id="author-desc">
				<p>
					<span style="color: teal;">Uroš B Jovanović, the maker of Forums;</span> Bicycle and PHP: hypertext preprocessor entusiast<br/>
					Email: <b>urosjovanovic0704@gmail.com</b><br/>
					Made with love, as a stand alone project.<br/>
					Next goal: family tree...
				</p>
			</div>
		</div>
		<div class="clear"></div>
		<footer>
			<?php include("footer.php"); ?>
		</footer>
	</body>
</html>
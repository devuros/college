<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>New Site | Author</title>
		<meta charset="utf-8">
		<meta name="author" content="Uroš Jovanović">
		<link rel="shortcut icon" href="slike/icon/prava.ico">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
		
		<script type="text/javascript" src="jquery-1.9.0.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
	</head>
	<body>
		<header>
			<?php
				include("header.php");
			?>
		</header>
		<div id="main-author-wrapper">
			<div id="main-author">
				<div id="author-desc">
					<p>
						Uroš Jovanović <b>(11/13)</b> was born in Belgrade on April 7, 1994. He grew up in Smederevo
						where he finished elementary school, after that he enrolled in high school.
						After graduating from high school in 2012/13 he enrolled in ICT College of Vocational studies.
						<br/><br/>
						Currenly he is inspired by the emense possibilities of <i>PHP: Hypertext Preprocessor</i>
						and looking for inspiration to make a forum!
					</p>
				</div>
				<div id="author-image">
					<img src="slike/autor.png" alt="autor" title="Uroš B Jovanović" />
				</div>
			</div>
		</div>
		<footer>
			<?php
				include("footer.php");
			?>
		</footer>
	</body>
</html>
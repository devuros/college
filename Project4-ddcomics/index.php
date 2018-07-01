<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>New Site</title>
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
		<div id="slider-wrapper">
			<div id="image" title="WELCOME"></div>
		</div>
		<main>
			<div id="welcome">
				<h2>Welcome dear visitor!</h2>
				<p>
					You have travelled great distance, come rest. Here you can find what every your thirsty soul may desire.
					Don't hesitate see us, join us, register and then login to see more of our great services.
					We honor our customers and guests as well don't be shy come, explore.<br/>
					Choose from our divine categories!
				</p>
			</div>
			<div class="row-wrapper">
				<div class="row">
					<?php
						include("konekcija.php");
					
						$upit_kategorije="select * from kategorije";
						$rez_kategorije=mysql_query($upit_kategorije, $konekcija) or die("Greska upit kategorije! ".mysql_error());
						
						while($red=mysql_fetch_array($rez_kategorije))
						{
							echo "<div class='item'>";
							echo "<a href='prikaz.php?id_kategorije=".$red["id_kategorija"]."'>";
							echo "<img src='".$red["slika"]."' alt='' /></a>";
							echo "<a href='prikaz.php?id_kategorije=".$red["id_kategorija"]."'><h4>".$red["naziv_kategorija"]."</h4></a>";
							echo "<p>".$red["opis"]."</p>";
							echo "</div>";
						}
						mysql_close($konekcija);
					?>
				</div>
			</div>
		</main>
		<footer>
			<?php
				include("footer.php");
			?>
		</footer>
	</body>
</html>
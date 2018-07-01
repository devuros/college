<?php
	session_start();
	if(isset($_REQUEST["id_kategorije"]))
	{
		$idKategorija=$_REQUEST["id_kategorije"];
		include("konekcija.php");
		
		if(isset($_GET["skriveno"]))
		{
			$skriveno=$_GET["skriveno"];
		}
		else
		{
			$skriveno=0;
		}
		$str=6;
		
		$upit_artikli="select * from artikli a inner join kategorije k
		on a.id_kategorija=k.id_kategorija
		where a.id_kategorija=$idKategorija limit $str offset $skriveno";
		$rez_artikli=mysql_query($upit_artikli, $konekcija) or die("Greska upit artikli! ".mysql_error());
		$rez_kate=mysql_query($upit_artikli, $konekcija) or die("Greska upit artikli! ".mysql_error());
		
		$nazivKategorija=mysql_fetch_array($rez_kate)["naziv_kategorija"];
		
		$upit_broj="select count(id_artikl) as uk from artikli where id_kategorija=$idKategorija";
		$rez_broj=mysql_query($upit_broj, $konekcija) or die("Greska upit broj! ".mysql_error());
		$red_broj=mysql_fetch_array($rez_broj);
		
		$uk=$red_broj["uk"];
		$levo=$skriveno-$str;
		$desno=$skriveno+$str;
		
		mysql_close($konekcija);
	}
	else
	{
		header("location: index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>New Site | Products</title>
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
		<div id="main-artikli-wrapper">
			<div id="main-artikli">
				<div id="artikli-lista">
					<?php
						if(mysql_num_rows($rez_artikli)>0)
						{
							echo "<h2>".$nazivKategorija."</h2>";
							echo "<div class='prikaz-row'>";
							echo "<div class='pagination'>";
							if($levo<0)
							{
								if($desno>$uk)
								{
									echo "<div class='center'><a href='#' class='curs'><i class='fa fa-hashtag'></i></a>
									<a href='#' class='curs'><i class='fa fa-hashtag'></i></a></div>";
								}
								else
								{
									echo "<div class='center'><a href='#' class='curs'><i class='fa fa-hashtag'></i></a>
									<a href='prikaz.php?id_kategorije=$idKategorija&skriveno=$desno'><i class='fa fa-angle-double-right'></i></a></div>";
								}
							}
							else if($desno>$uk)
							{
								echo "<div class='center'><a href='prikaz.php?id_kategorije=$idKategorija&skriveno=$levo'><i class='fa fa-angle-double-left'></i></a>";
								echo "<a href='#' class='curs'><i class='fa fa-hashtag'></i></a></div>";
							}
							else
							{
								echo "<div class='center'><a href='prikaz.php?id_kategorije=$idKategorija&skriveno=$levo'><i class='fa fa-angle-double-left'></i></a>";
								echo "<a href='prikaz.php?id_kategorije=$idKategorija&skriveno=$desno'><i class='fa fa-angle-double-right'></i></a></div>";
							}
							echo "</div>";
							
							while($red=mysql_fetch_array($rez_artikli))
							{
								echo "<div class='prikaz-item-wrapper'>";
								echo "<div class='prikaz-item'>";
								echo "<a href='".$red["id_artikl"]."'><img src='".$red["slika_artikl"]."'/></a>";
								echo "<a href='".$red["id_artikl"]."'><h4>".$red["naziv_artikl"]."</h4></a>";
								echo "</div>";
								echo "<div class='prikaz-cart'>";
								echo "<p class='center'>Price: ".$red["cena"]."</p>";
								if(isset($_SESSION["id_user"]))
								{
									echo "<p class='right'><a href='".$red["id_artikl"]."'>Add to cart</a></p>";
								}
								else
								{
									echo "<p class='right'>Login to buy</p>";
								}
								echo "</div>";
								echo "</div>";
							}
							echo "</div>";
						}
						else
						{
							echo "<h2>Sorry,</h2>";
							echo "<div class='prikaz-row'>";
							echo "<b>This category has no products at the moment.</b>";
							echo "</div>";
						}
					?>
				</div>
				<div id="artikli-desc">
					<h3>Details</h3>
					<div id="desc-prikaz">
						Click on a product to see more details
					</div>
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
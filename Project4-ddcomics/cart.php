<?php
	session_start();

	if(!isset($_SESSION["id_uloga"]))
	{
		header("location: index.php");
	}
	else
	{
		if(isset($_GET["brisi"]))
		{
			$id_user=$_SESSION["id_user"];
			$id_brisi=$_GET["brisi"];
			
			include("konekcija.php");
			
			$upit_brisi="delete from korpa
			where id_user=$id_user and id_artikl=$id_brisi";
			$rez_brisi=mysql_query($upit_brisi, $konekcija) or die("Greska upit BRISI! ".mysql_error());
			
			mysql_close($konekcija);
		}
		if(isset($_POST["purchase"]))
		{
			$id_user=$_SESSION["id_user"];
			
			include("konekcija.php");
			
			$upit_purchase="delete from korpa where id_user=$id_user";
			$rez_purchase=mysql_query($upit_purchase, $konekcija) or die("Greska upit PURCHASE! ".mysql_error());
			if($rez_purchase)
			{
				$uspeh="Your purchase was successful!";
			}
			mysql_close($konekcija);
		}
		
		include("konekcija.php");
		$id_user=$_SESSION["id_user"];
		
		$upit_sub="select sum(cena) as sub from artikli a inner join korpa k on k.id_artikl=a.id_artikl
		where k.id_user=$id_user";
		$rez_sub=mysql_query($upit_sub, $konekcija) or die("Greska upit SUMA korpa! ".mysql_error());
		
		if(mysql_num_rows($rez_sub)>0)
		{
			$red_sub=mysql_fetch_array($rez_sub);
			if($red_sub["sub"]==NULL)
			{
				$subtotal="0,--$";
				$empty="Is empty.";
				$prazna=true;
			}
			else
			{
				$subtotal=$red_sub["sub"].",00 $";
			}
		}
		else
		{
			$subtotal="0, --$";
		}
		mysql_close($konekcija);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>New Site | Cart</title>
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
		<div id="main-cart-wrapper">
			<div id="main-cart">
				<div id="cart-left">
					<div id="left-product-wrapper">
						<h2>Your shopping cart</h2>
						<?php
							include("konekcija.php");
						
							$upit_svi="select * from korpa k inner join artikli a on k.id_artikl=a.id_artikl inner join kategorije ka
							on a.id_kategorija=ka.id_kategorija
							where k.id_user=$id_user";
							$rez_svi=mysql_query($upit_svi, $konekcija) or die("Greska upit KORPA! ".mysql_error());
							
							if(mysql_num_rows($rez_svi)>0)
							{
								while($red_svi=mysql_fetch_array($rez_svi))
								{
									echo "<div class='row-product'>";
									echo "<div class='product-image'><img src='".$red_svi["slika_artikl"]."' /></div>";
									echo "<div class='product-name'><p>".$red_svi["naziv_artikl"]."</p></div>";
									echo "<div class='product-category'><p>".$red_svi["naziv_kategorija"]."</p></div>";
									echo "<div class='product-price'><p>".$red_svi["cena"].",00$<br/><a href='cart.php?brisi=".$red_svi["id_artikl"]."'>Remove</a></p></div>";
									echo "</div>";
								}
							}
							mysql_close($konekcija);
							
							if(isset($uspeh))
							{
								echo "<div id=''>";
								echo $uspeh;
								echo "</div>";
							}
							if(isset($empty))
							{
								echo $empty;
							}
						?>
					</div>
					<div id="left-subtotal">
						<div id="subtotal-left"><p>Subtotal: </p></div>
						<div id="subtotal-right">
							<p><?php echo $subtotal; ?></p>
						</div>
						<hr/>
						<?php
							echo "<form action='cart.php' method='POST'>";
							if(isset($prazna))
							{
								echo "<input type='submit' name='purchase' id='btnBuy' value='Purchase' disabled style='opacity: 0.3;' />";
							}
							else 
							{
								echo "<input type='submit' name='purchase' id='btnBuy' value='Purchase' />";
							}
							echo "</form>";
						?>
					</div>
					<div id="continue-shopping">
						<a href="index.php">Continue shopping</a>
					</div>
				</div>
				<div id="cart-right">
					
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
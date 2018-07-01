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
		<div id="main-gallery-wrapper">
			<div id="main-gallery">
				<div id="gallery-left">
					<h3>Large</h3>
					<div id="image-one">
						<?php
							include("konekcija.php");
							
							$upit_slika="select count(id_slika) as brslika, s.* from slike s order by id_slika limit 1";
							$rez_slika=mysql_query($upit_slika, $konekcija) or die("Greska upit slikA! ".mysql_error());
							
							$red=mysql_fetch_array($rez_slika);
							$brslika=$red["brslika"];
							$id1=$red["id_slika"];
							$src1=$red["src_slika"];
							$alt1=$red["alt_slika"];
							
							echo "<img src='".$src1."' alt='".$alt1."' title='".$id1."' />";
							
							mysql_close($konekcija);
						?>
					</div>
					<div id="image-comment">
						<?php
							if(isset($_SESSION["id_user"]))
							{
						?>
						<input type="text" id="tbComment" class="input-comment" name="input-comment" placeholder="Write a comment..." />
						<input type="button" id="btnComment" class="" name="comment" value="Comment" />
						<?php
							}
							else
							{
								echo "<a href='login.php'>Login to comment</a>";
							}
						?>
					</div>
					<h3>Comments: </h3>
					<div id="comments-wrapper">
						<?php
							include("konekcija.php");
							
							$upit_koment="select * from comments c inner join users u on c.id_user=u.id_user
							where c.id_slika=$id1";
							$rez_koment=mysql_query($upit_koment, $konekcija) or die("Greska upit KOMENT! ".mysql_error());
							while($red=mysql_fetch_array($rez_koment))
							{
								echo "<div class='comment-wrapper'>";
								echo "<div class='comment-username'><i>".$red["username"]."</i></div>";
								echo "<div class='comment-text'>".$red["text"]."</div>";
								echo "</div>";
							}
						?>
					</div>
				</div>
				<div id="gallery-right">
					<h3>Small (<?php echo $brslika; ?>)</h3>
					<div id="image-many">
						<?php
							include("konekcija.php");
							
							$upit_slike="select * from slike order by id_slika";
							$rez_slike=mysql_query($upit_slike, $konekcija) or die("Greska upit SLIKE! ".mysql_error());
							
							echo "<div class='many-row'>";
							while($red=mysql_fetch_array($rez_slike))
							{
								echo "<div class='many-img'>";
								echo "<a href='".$red["id_slika"]."'><img src='".$red["src_slika"]."' alt='".$red["alt_slika"]."' /></a>";
								echo "</div>";
							}
							echo "</div>";
						?>
					</div>
					<div id="poll-wrapper">
						<?php
							include("konekcija.php");
							
							$upit_anketa="select * from ankete a inner join odgovori o on
							a.id_anketa=o.id_anketa where a.id_anketa=1";
							$rez_anketa=mysql_query($upit_anketa, $konekcija) or die("Greska upit dohvatanje ankete! ".mysql_error());
							
							if(mysql_num_rows($rez_anketa)>0)
							{
								echo "<form name='' id='' action='anketa.php' method='POST'>";
								echo "<h5>What is your favorite product?</h5>";
								while($red_a=mysql_fetch_array($rez_anketa))
								{
									echo "<div class='space'>";
									echo "<input type='radio' name='glasanje' id='".$red_a["id_odgovor"]."' value='".$red_a["id_odgovor"]."' />
									<label for='".$red_a["id_odgovor"]."'>".$red_a["odgovor"]."</label><br/>";
									echo "</div>";
								}
								echo "<div class='space'><input type='submit' name='vote' id='btnVote' value='Vote' /></div>";
								echo "</form>";
							}
							mysql_close($konekcija);
							
							if(isset($_GET["za"]))
							{
								$za=$_GET["za"];
								$svi=$_GET["svi"];
								echo "<p>".$za." out of ".$svi." people have voted for the same answer.</p>";
							}
						?>
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
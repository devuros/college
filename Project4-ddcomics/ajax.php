<?php
	session_start();
	
	if(isset($_REQUEST["idartikl"]))
	{
		$idartikl=$_REQUEST["idartikl"];
		
		include("konekcija.php");
		
		$upit="select * from artikli where id_artikl=$idartikl";
		$rez=mysql_query($upit, $konekcija) or die("Greska upit ajax dohvatanje");
		
		$red=mysql_fetch_array($rez);
		$da="<img src='".$red["slika_artikl"]."'/><h4>".$red["naziv_artikl"]."</h4><p>".$red["details"]."</p><p><br/>Author: ".$red["autor"]."</p>";
		mysql_close($konekcija);
		echo json_encode($da);
	}
	if(isset($_REQUEST["idkate"]))
	{
		$idkate=$_REQUEST["idkate"];
		
		include("konekcija.php");
		
		$upit="select * from artikli where id_kategorija=$idkate";
		$rez=mysql_query($upit, $konekcija) or die("Greska upit idkate! ".mysql_error());
		
		$dad="<option value='0'>Izaberi...</option>";
		while($red=mysql_fetch_array($rez))
		{
			$dad.="<option value='".$red["id_artikl"]."'>".$red["naziv_artikl"]."</option>";
		}
		mysql_close($konekcija);
		echo json_encode($dad);
	}
	if(isset($_REQUEST["idartiklizmena"]))
	{
		$idartizmena=$_REQUEST["idartiklizmena"];
		include("konekcija.php");
		
		$upit="select * from artikli where id_artikl=$idartizmena";
		$rez=mysql_query($upit, $konekcija) or die("Greska upit izmena artikl! ".mysql_error());
		
		if(mysql_num_rows($rez)==1)
		{
			$red=mysql_fetch_array($rez);
			$vrati="";
			
			$vrati="<b>Naziv:</b><br/><input type='text' id='' class='' name='naziv-izmena' placeholder='naziv_artikl' value='".$red["naziv_artikl"]."' /><br/>";
			$vrati.="<b>Autor:</b><br/><input type='text' id='' class='' name='autor-izmena' placeholder='autor' value='".$red["autor"]."' /><br/>";
			$vrati.="<b>Cena:</b><br/><input type='text' id='' class='' name='cena-izmena' placeholder='cena' value='".$red["cena"]."' /><br/>";
			$vrati.="<b>Detalji:</b><br/><textarea name='detalji-izmena' id='taDetalji' cols='22' rows='15'>".$red["details"]."</textarea><br/>";
			$vrati.="<input type='submit' name='dugme-izmena' id='btnIzmena' class='dugme' value='Izmeni' />";
			$vrati.=" <input type='submit' name='dugme-brisanje' id='btnBrisi' class='dugme' value='Brisi' />";
		}
		mysql_close($konekcija);
		echo json_encode($vrati);
	}
	if(isset($_POST["idslika"]))
	{
		$id_slika=$_POST["idslika"];
		include("konekcija.php");
		
		$upit_slika="select * from slike where id_slika=$id_slika";
		$rez_slika=mysql_query($upit_slika, $konekcija) or die("Greska upit VELIKA slika! ".mysql_error());
		
		$red=mysql_fetch_array($rez_slika);
		$reply1="<img src='".$red["src_slika"]."' alt='".$red["alt_slika"]."' title='".$red["id_slika"]."' />";
		
		$upit_komentar="select * from comments c inner join users u on c.id_user=u.id_user
		where c.id_slika=$id_slika";
		$rez_komentar=mysql_query($upit_komentar, $konekcija) or die("Greska upit KOMENTAR! ".mysql_error());
		
		$reply2="";
		if(mysql_num_rows($rez_komentar)>0)
		{
			while($red2=mysql_fetch_array($rez_komentar))
			{
				$reply2.="<div class='comment-wrapper'>";
				$reply2.="<div class='comment-username'><i>".$red2["username"]."</i></div>";
				$reply2.="<div class='comment-text'>".$red2["text"]."</div>";
				$reply2.="</div>";
			}
		}
		else
		{
			$reply2.="<div class='comment-wrapper'>";
			$reply2.="<div class='comment-username'></div>";
			$reply2.="<div class='comment-text'>There are no comments for this photo.</div>";
			$reply2.="</div>";
		}
		
		$reply=$reply1."$".$reply2;
		mysql_close($konekcija);
		echo json_encode($reply);
	}
	//
	if(isset($_POST["vote"]))
	{
		include("konekcija.php");
		$iduser=$_SESSION["id_user"];
		$idslikakom=$_POST["idslikakom"];
		$comment=$_POST["comment"];
		
		$upit_km="insert into comments values ('', $idslikakom, $iduser, '$comment')";
		$rez_km=mysql_query($upit_km, $konekcija) or die("Greska upit upis KOMENTARA! ".mysql_error());
		
		$upit_update_komentari="select * from comments c inner join users u on c.id_user=u.id_user
		where c.id_slika=$idslikakom";
		$rez_update_komentari=mysql_query($upit_update_komentari, $konekcija) or die("greska prikaz update KOMENTARI! ".mysql_error());
		
		if(mysql_num_rows($rez_update_komentari)>0)
		{
			$reply3="";
			while($red3=mysql_fetch_array($rez_update_komentari))
			{
				$reply3.="<div class='comment-wrapper'>";
				$reply3.="<div class='comment-username'><i>".$red3["username"]."</i></div>";
				$reply3.="<div class='comment-text'>".$red3["text"]."</div>";
				$reply3.="</div>";
			}
			echo json_encode($reply3);
		}
		mysql_close($konekcija);
	}
	if(isset($_POST["dodajukorpu"]))
	{
		$iduser=$_SESSION["id_user"];
		$id_dodaj=$_POST["dodajukorpu"];
		$datum=mktime();
		
		include("konekcija.php");
		
		$upit_dodaj="insert into korpa values ('', $id_dodaj, 1, $iduser, $datum)";
		$rez_dodaj=mysql_query($upit_dodaj, $konekcija) or die("Greska dodaj U KORPU! ".mysql_error());
		
		$str_odg="";
		if($rez_dodaj)
		{
			$str_odg="<p style='color: lime;'>Product added to cart.</p>";
		}
		else
		{
			$str_odg="<p style='color: red;'>Error product was not added!</p>";
		}
		echo json_encode($str_odg);
		
		mysql_close($konekcija);
	}
?>
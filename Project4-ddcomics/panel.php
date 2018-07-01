<?php
	session_start();
	
	if(!isset($_SESSION["id_user"]) or $_SESSION["id_uloga"]!=1)
	{
		header("location: index.php");
	}
	
	if(isset($_POST["dugme-dodavanje"]))
	{
		$id_kategorija=$_POST["select-dodavanje"];
		$naziv=$_POST["naziv-dodavanje"];
		
		$slika=$_FILES["slika-dodavanje"]["name"];
		$tmp=$_FILES["slika-dodavanje"]["tmp_name"];
		$error=$_FILES["slika-dodavanje"]["error"];
		
		$autor=$_POST["autor-dodavanje"];
		$cena=$_POST["cena-dodavanje"];
		$detalji=$_POST["detalji-dodavanje"];
		
		$regNaziv="/^([A-z\s]{4,50})+$/";
		$regAutor="/^([A-z\s]{4,50})+$/";
		$regCena="/^[0-9]{3,5}$/";
		$regDetalji="/^[A-z\s\.\,\d]{10,400}$/";
		
		$greske=array();
		
		if($id_kategorija=="0")
		{
			$greske[]="Greska kategorija!";
		}
		if(!preg_match($regNaziv, $naziv))
		{
			$greske[]="Greska naziv!";
		}
		if(!preg_match($regAutor, $autor))
		{
			$greske[]="Greska autor!";
		}
		if(!preg_match($regCena, $cena))
		{
			$greske[]="Greska cena!";
		}
		if(!preg_match($regDetalji, $detalji))
		{
			$greske[]="Greska detalji!";
		}
		if($error>0)
		{
			$greske[]="Greska slika!";
		}
		else
		{
			if(isset($greske) and count($greske)==0)
			{
				$putanja="slike/".$slika;
				if(move_uploaded_file($tmp, $putanja))
				{
					include("konekcija.php");
				
					$upit="insert into artikli values ('', $id_kategorija, '$naziv', '$putanja', '$autor', $cena, '$detalji')";
					$rez=mysql_query($upit, $konekcija) or die("Greska upit insert into! ".mysql_error());
				}
			}
		}
	}
	if(isset($_POST["dugme-brisanje"]))
	{
		$brisanje_artikl=$_POST["select-izmena-artikli"];
		
		if($brisanje_artikl=="0")
		{
			$lose="Greska artikl!";
		}
		else
		{
			include("konekcija.php");
			$upit_delete="delete from artikli where id_artikl=$brisanje_artikl";
			$rez_delete=mysql_query($upit_delete, $konekcija) or die("Greska brisanje upit.. ! ".mysql_error());
		}
	}
	if(isset($_POST["dugme-izmena"]))
	{
		$id_art=$_POST["select-izmena-artikli"];
		$naziv_izmena=$_POST["naziv-izmena"];
		$autor_izmena=$_POST["autor-izmena"];
		$cena_izmena=$_POST["cena-izmena"];
		$detalji_izmena=$_POST["detalji-izmena"];
		
		$regNaziv="/^([A-z\s]{4,50})+$/";
		$regAutor="/^([A-z\s]{4,50})+$/";
		$regCena="/^[0-9]{3,5}$/";
		$regDetalji="/^[A-z\s\.\,\d]{10,400}$/";
		
		$ne=array();
		
		if($id_art=="0")
		{
			$ne[]="Greska kategorija!";
		}
		if(!preg_match($regNaziv, $naziv_izmena))
		{
			$ne[]="Greska naziv!";
		}
		if(!preg_match($regAutor, $autor_izmena))
		{
			$ne[]="Greska autor!";
		}
		if(!preg_match($regCena, $cena_izmena))
		{
			$ne[]="Greska cena!";
		}
		if(!preg_match($regDetalji, $detalji_izmena))
		{
			$ne[]="Greska detalji!";
		}
		if(isset($ne) and count($ne)==0)
		{
			include("konekcija.php");
			
			$upit_update="update artikli
			set naziv_artikl='$naziv_izmena', autor='$autor_izmena', cena=$cena_izmena, details='$detalji_izmena'
			where id_artikl=$id_art";
			$rez_update=mysql_query($upit_update, $konekcija) or die("Greska upit update.. ! ".mysql_error());
		}
	}
	if(isset($_POST["brisi-kor"]))
	{
		$zabrisanje=$_POST["brisanje"];
		include("konekcija.php");
		
		foreach($zabrisanje as $brisi)
		{
			$upit_brisi="delete from users where id_user=$brisi";
			$rez_brisi=mysql_query($upit_brisi, $konekcija) or die("Greska BRISI korisnika! ".mysql_error());
		}
		
		mysql_close($konekcija);
	}
	if(isset($_POST["edit-kor"]))
	{
		$id_save_edited=$_POST["ideditsave"];
		$novo_ime=$_POST["novo_ime"];
		$novo_prezime=$_POST["novo_prezime"];
		$novo_email=$_POST["novo_email"];
		$novo_username=$_POST["novo_username"];
		$novo_pass=$_POST["novo_pass"];
		$novo_uloga=$_POST["novo_uloga"];
		
		include("konekcija.php");
		if(empty($novo_pass))
		{
			$upit_edit="update users set ime='$novo_ime', prezime='$novo_prezime', email='$novo_email',
			username='$novo_username', id_uloga=$novo_uloga
			where id_user=$id_save_edited";
			$rez_edit=mysql_query($upit_edit, $konekcija) or die("greska upit EDIT SAVE! ".mysql_error());
		}
		else
		{
			$novo_pass=md5($novo_pass);
			$upit_edit="update users set ime='$novo_ime', prezime='$novo_prezime', email='$novo_email',
			username='$novo_username', password='$novo_pass', id_uloga=$novo_uloga
			where id_user=$id_save_edited";
			$rez_edit=mysql_query($upit_edit, $konekcija) or die("greska upit EDIT SAVE! ".mysql_error());
		}
		if($rez_edit)
		{
			$dada="Successful change on user!";
		}
		mysql_close($konekcija);
	}
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
		<div id="main-panel-wrapper">
			<div id="main-panel">
				<div id="panel-proizvodi">
					<h2>Proizvodi</h2>
					<div id="panel-dodavanje" class="panel-3">
						<h3>Dodavanje</h3>
						<form name="form-dodavanje" class="form-3" action="panel.php" method="POST" enctype="multipart/form-data">
							<select name="select-dodavanje" class="">
								<option value="0">Izaberi kategoriju...</option>
								<?php
									include("konekcija.php");
								
									$upit="select * from kategorije";
									$rez=mysql_query($upit, $konekcija) or die("Greska upit kategorije! ".mysql_error());
									while($red=mysql_fetch_array($rez))
									{
										echo "<option value='".$red["id_kategorija"]."'>".$red["naziv_kategorija"]."</option>";
									}
								?>
							</select>
							<br/><br/>
							<input type="text" name="naziv-dodavanje" placeholder="naziv_artikl" />
							<br/><br/>
							<input type="file" name="slika-dodavanje" />
							<br/><br/>
							<input type="text" name="autor-dodavanje" placeholder="autor" />
							<br/><br/>
							<input type="text" name="cena-dodavanje" placeholder="cena" />
							<br/><br/>
							<textarea name="detalji-dodavanje" id="taDetalji" placeholder="detalji..." cols="22" rows="15" ></textarea>
							<br/><br/>
							<input type="submit" name="dugme-dodavanje" id="btnDodavanje" class="dugme" value="Dodaj" />
						</form>
						<div class="error left">
							<?php
								if(isset($greske))
								{
									foreach($greske as $g)
									{
										echo $g."<br/>";
									}
								}	
							?>
					</div>
					</div>
					<div id="panel-izmena" class="panel-3">
						<h3>Izmena/Brisanje</h3>
						<form name="form-izmena" class="form-3" action="panel.php" method="POST">
							<select name="select-izmena" class="" id="select-izmena">
								<option value="0">Izaberi kategoriju...</option>
								<?php
									include("konekcija.php");
								
									$upit="select * from kategorije";
									$rez2=mysql_query($upit, $konekcija) or die("Greska upit kategorije! ".mysql_error());
									while($red2=mysql_fetch_array($rez2))
									{
										echo "<option value='".$red2["id_kategorija"]."'>".$red2["naziv_kategorija"]."</option>";
									}
								?>
							</select>
							<br/><br/>
							<select name="select-izmena-artikli" id="select-izmena-artikli">
								<option value="0">Izaberi proizvod</option>
							</select>
							<div id="izmena-div"></div>
						</form>
						<div class="error left">
							<?php
								//greske brisanje
								if(isset($lose))
								{
									echo $lose;
								}
								//greske izmena
								if(isset($ne))
								{
									foreach($ne as $na)
									{
										echo $na."<br/>";
									}
								}	
							?>
					</div>
					</div>
				</div>
				<div id="panel-korisnici">
					<h2>Korisnici</h2>
					<div id="korisnici-izmena">
						<?php
							include("konekcija.php");
							
							$upit_korisnici="select * from users us inner join uloge ul on us.id_uloga=ul.id_uloga order by id_user";
							$rez_korisnici=mysql_query($upit_korisnici, $konekcija) or die("Greska upit KORISNICI! ".mysql_error());
							if(mysql_num_rows($rez_korisnici)>0)
							{
								echo "<form action='panel.php' method='POST'>";
								echo "<table><tr><th>Prezime</th><th>Email</th><th>Username</th><th>Uloga</th><th>Delete</th><th>Edit</th></tr>";
								while($redk=mysql_fetch_array($rez_korisnici))
								{
									echo "<tr><td>".$redk["prezime"]."</td>
									<td>".$redk["email"]."</td>
									<td>".$redk["username"]."</td>
									<td>".$redk["naziv_uloga"]."</td>
									<td><input type='checkbox' name='brisanje[]' value='".$redk["id_user"]."'></td>
									<td><a href='panel.php?idedit=".$redk["id_user"]."'>Change</a></td></tr>";
								}
								echo "<tr><td colspan='2' align='center'><input type='submit' name='brisi-kor' value='Delete' id='btnDelete' /></td></tr>";
								echo "</table></form>";
							}
							else
							{
								echo "No users...";
							}
							mysql_close($konekcija);
						?>
					</div>
					<div id="korisnik-edit">
						<?php
							if(isset($_GET["idedit"]))
							{
								$id_edit=$_GET["idedit"];
								include("konekcija.php");
								
								$upit_kor_pod="select * from users u inner join uloge ul on u.id_uloga=ul.id_uloga
								where id_user=$id_edit";
								$rez_kor_pod=mysql_query($upit_kor_pod, $konekcija) or die("Greska upit PODACI korisnik! ".mysql_error());
								if(mysql_num_rows($rez_kor_pod)>0)
								{
									$rede=mysql_fetch_array($rez_kor_pod);
									echo "<form action='panel.php' method='POST'>";
									echo "<input type='hidden' name='ideditsave' value='".$id_edit."'>";
									echo "Ime: <input type='text' name='novo_ime' value='".$rede["ime"]."' /><br/>";
									echo "Prezime: <input type='text' name='novo_prezime' value='".$rede["prezime"]."' /><br/>";
									echo "Email: <input type='text' name='novo_email' value='".$rede["email"]."' /><br/>";
									echo "Username: <input type='text' name='novo_username' value='".$rede["username"]."'><br/>";
									echo "Password: <input type='password' name='novo_pass' value='' placeholder='Enter new...' /><br/>";
									echo "Uloga: <input type='text' name='novo_uloga' value='".$rede["id_uloga"]."' /><br/>";
									echo "Naziv uloga: <input type='text' value='".$rede["naziv_uloga"]."' disabled /><br/>";
									echo "<input type='submit' name='edit-kor' value='Edit' id='btnEdit' />";
									echo "</form>";
								}
								else
								{
									echo "Korisnik ne postoji!?";
								}
								mysql_close($konekcija);
							}
							if(isset($dada))
							{
								echo $dada;
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
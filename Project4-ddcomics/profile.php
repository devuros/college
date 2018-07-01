<?php
	session_start();
	if(!isset($_SESSION["id_user"]))
	{
		header("location: index.php");
	}
	if(isset($_POST["update"]))
	{	
		if($_FILES["avatar"]["error"]>0)
		{
			$greske[]="Error with avatar image!";
		}
		else
		{
			$slika=$_FILES["avatar"]["name"];
			$tmp=$_FILES["avatar"]["tmp_name"];
			$type=$_FILES["avatar"]["type"];
			
			if($type=="image/pjpeg" or $type=="image/jpeg")
			{
				include("konekcija.php");
				$putanja="slike/avatar/".$slika;
				
				if(move_uploaded_file($tmp, $putanja))
				{
					$id=$_SESSION["id_user"];
					
					$upit="update users set avatar='$putanja'
					where id_user=$id";
					$rez=mysql_query($upit, $konekcija) or die("Greska upit AVATAR! ".mysql_error());
					if($rez)
					{
						$uspeh="You have set your avatar image!";
					}
				}
				mysql_close($konekcija);
			}
			else
			{
				$greske[]="Image must be in jpg format!";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>New Site | Profile</title>
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
		<div id="main-profile-wrapper">
			<div id="main-profile">
				<div id="profile-data">
					<h2>Account details</h2>
					<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
						<div class="row-input-large"><h3>Peronal information</h3></div>
						<div class="row-input-small">First name</div>
						<div class="row-input-small">Last name</div>
						<?php
							include("konekcija.php");
			
							$id=$_SESSION["id_user"];
							$upit_pod="select * from users where id_user=$id";
							$rez_pod=mysql_query($upit_pod, $konekcija) or die("Greska upit ISPIS PODATATAK! ".mysql_error());
							if(mysql_num_rows($rez_pod)==1)
							{
								$red_pod=mysql_fetch_array($rez_pod);
								echo "
								<div class='row-input-small'>
									<input type='text' name='ime' class='input-small' value='".$red_pod["ime"]."' disabled />
								</div>
								<div class='row-input-small'>
									<input type='text' name='prezime' class='input-small' value='".$red_pod["prezime"]."' disabled />
								</div>
								<div class='row-input-large'>Email</div>
								<div class='row-input-large'>
									<input type='text' name='email' class='input-large' value='".$red_pod["email"]."' disabled />
								</div>
								<div class='row-input-large'>Username</div>
								<div class='row-input-small'>
									<input type='text' name='username' class='input-small' value='".$red_pod["username"]."' disabled />
								</div>
								<div class='row-input-large'><h3>Set an avatar image</h3></div>
								<div class='row-input-large'>Avatar</div>
								<div class='row-input-large'>
									<input type='file' name='avatar' class='input-small' />
								</div>
								<div class='row-input-small'>
									<input type='submit' name='update' value='Update' id='btnUpdate' />
								</div>";
							}
							mysql_close($konekcija);
						?>
					</form>
				</div>
				<div id="profile-error" class="error left">
					<?php
						if(isset($greske))
						{
							foreach($greske as $g)
							{
								echo $g."<br/>";
							}
						}
						if(isset($uspeh))
						{
							echo $uspeh;
						}
					?>
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
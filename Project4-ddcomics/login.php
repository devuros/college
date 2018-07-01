<?php
	session_start();
	
	if(isset($_SESSION["id_user"]))
	{
		header("location: index.php");
	}
	
	if(isset($_REQUEST["login"]))
	{
		$username=$_REQUEST["log_username"];
		$password=md5($_REQUEST["log_password"]);
		if(empty($username) or empty($password))
		{
			$greske[]="Unesi podatke!";
		}
		else
		{
			include("konekcija.php");
			
			$upit_login="select * from users where username='$username' and password='$password'";
			$rez_login=mysql_query($upit_login, $konekcija) or die("Greska upit login! ".mysql_error());
			
			mysql_close($konekcija);
			
			if(mysql_num_rows($rez_login)==1)
			{
				$red=mysql_fetch_array($rez_login);
				$_SESSION["id_user"]=$red["id_user"];
				$_SESSION["email"]=$red["email"];
				$_SESSION["username"]=$red["username"];
				$_SESSION["id_uloga"]=$red["id_uloga"];
				
				if($red["avatar"]!="")
				{
					$_SESSION["avatar"]=$red["avatar"];
				}
				
				if($_SESSION["id_uloga"]==1)
				{
					header("location: panel.php");
				}
				if($_SESSION["id_uloga"]==2)
				{
					header("location: index.php");
				}
			}
			else
			{
				$greske[]="Wrong credentials!";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>New Site | Login</title>
		<meta charset="utf-8">
		<meta name="author" content="Uroš Jovanović">
		<link rel="shortcut icon" href="slike/icon/prava.ico">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
		
		<script type="text/javascript" src="jquery-1.9.0.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
	</head>
	<body>
		<main id="main-login">
			<form action="login.php" method="POST" name="form-login" id="form-login">
				<h1 id="logo" style="font-style: normal; color: orange; font-size: 2.5em; padding-bottom: 20px;"><i class="fa  fa-laptop"></i> New Site</h1>
				<input type="text" name="log_username" id="" class="tbInput" placeholder="Username" autofocus="autofocus" /><br/>
				<input type="password" name="log_password" id="" class="tbInput" placeholder="Password"  /><br/>
				<input type="submit" id="btnLogin" name="login" value="Log in to New site" />
				<div id="login-new">
					<a href="register.php">Create a New Site account!</a>
				</div>
				<?php
					if(isset($greske))
					{
						foreach($greske as $g)
						{
							echo "<div class='error'>";
							echo $g;
							echo "</div>";
						}
					}
				?>
			</form>
		</main>
	</body>
</html>
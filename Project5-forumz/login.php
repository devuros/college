<?php
	session_start();
	
	if(isset($_SESSION["id_user"]))
	{
		header("location: index.php");
	}
	
	if(isset($_POST["login"]))
	{
		$user=$_POST["username"];
		$pass=$_POST["password"];
		
		if(empty($user) or empty($pass))
		{
			
		}
		else
		{
			include("konekcija.php");
			
			$pass=md5($pass);
			
			$q_login="select * from users where username='$user' and password='$pass'";
			$rez_login=mysql_query($q_login, $konekcija) or die("GRESKA!");
			
			if(mysql_num_rows($rez_login)==1)
			{
				$red_login=mysql_fetch_array($rez_login);
				
				if($red_login["state"]=="active")
				{
					$_SESSION["id_user"]=$red_login["id_user"];
					$_SESSION["username"]=$red_login["username"];
					$_SESSION["uloga"]=$red_login["id_uloga"];
				
					if(isset($_SESSION["id_user"]))
					{
						//za povratak na stranicu odakle je inicijalizovano logovanje
						if(isset($_POST["hiddenSubcat"]))
						{
							$hiddenSubcat = $_POST["hiddenSubcat"];
							header("location: subcat.php?subcat=$hiddenSubcat");
						}
						else
						{
							if(!isset($_POST["thread"]))
							{
								header("location: index.php");
							}
							else
							{
								$id_thread=$_POST["thread"];
								header("location: thread.php?thread=$id_thread");
							}
						}
					}
				}
				else
				{
					$deactive = "Your account is deactivated!";
				}
			}
			else
			{
				//wrong credentials
			}
			mysql_close($konekcija);
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Forum</title>
		<meta name="author" content="Uroš Jovanović">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
		<link rel="shortcut icon" href="images/prava.ico">
		
		<script type="text/javascript" src="script/jquery-3.0.0.js"></script>
		<script type="text/javascript" src="script/script.js"></script>
	</head>
	<body>
		<div id="login-wrapper">
			<form action="login.php" method="POST">
				<h2><a href="index.php"><i class="fa fa-database"></i> Forums</a></h2>
				<?php
					if(isset($_GET["thread"]))
					{
						$id_thread=$_GET["thread"];
						echo "<input type='hidden' name='thread' value='".$id_thread."' />";
					}
					if(isset($_GET["subcat"]))
					{
						$idSubcat=$_GET["subcat"];
						echo "<input type='hidden' name='hiddenSubcat' value='".$idSubcat."' />";
					}
				?>
				<input type="text" name="username" id="tbUsername" class="tbInput" placeholder="Username" autofocus autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
				<input type="password" name="password" id="tbPassword" class="tbInput" placeholder="Password" />
				<input type="submit" name="login" value="Login" id="btnLogin" />
			</form>
			<?php
				if(isset($deactive))
				{
					echo $deactive;
				}
			?>
		</div>
	</body>
</html>
<?php
	session_start();
	
	if(!isset($_SESSION["id_user"]))
	{
		if(isset($_GET["username"]))
		{
			$username = $_GET["username"];
			
			include("konekcija.php");
			
			$q_ParseUsername = "select u.id_user from users u
			where u.username = '$username'";
			$res_ParseUsername = mysql_query($q_ParseUsername, $konekcija) or die("Greska ParseUsername!");
			$parsedIdUser = mysql_result($res_ParseUsername, 0);
			
			if($parsedIdUser == false)
			{
				header("location: index.php");
			}
			else
			{
				$q_User = "select * from users where id_user = $parsedIdUser";
				$res_User = mysql_query($q_User, $konekcija) or die("Greska upit ParsedUser!");
				$userDetails = mysql_fetch_array($res_User);
				
				$q_Threads = "SELECT COUNT(t.id_thread)
				from threads t
				where t.autor = $parsedIdUser";
				$res_Threads = mysql_query($q_Threads, $konekcija) or die("Greska upit ParsedThreads!");
				$totalTreads = mysql_result($res_Threads, 0);
				
				$q_Posts = "select count(p.id_post)
				from posts p
				where p.author = $parsedIdUser";
				$res_Posts = mysql_query($q_Posts, $konekcija) or die("Greska upit ParsedPosts!");
				$totalPosts = mysql_result($res_Posts, 0);
				
				$q_Likes = "select sum(likes) as likes
				from posts p
				where p.author = $parsedIdUser";
				$res_Likes = mysql_query($q_Likes, $konekcija) or die("Greska upit ParsedLikes!");
				$totalLikes = mysql_result($res_Likes, 0);
				
				$q_ListOfThreads = "select * from threads t
				where t.autor = $parsedIdUser";
				$res_ListOfThreads = mysql_query($q_ListOfThreads, $konekcija) or die("Greska ParsedListaThread-ova!");
			}
			mysql_close($konekcija);
		}
		else
		{
			header("location: index.php");
		}
	}
	else
	{
		if(isset($_POST["update"]))
		{
			$newPassword = $_POST["newPassword"];
			$id=$_SESSION["id_user"];
			$taAbout = $_POST["about"];
			
			if(!empty($newPassword))
			{
				$newPassword = md5($newPassword);
				include("konekcija.php");
				$q_Password="update users set password='$newPassword' where id_user=$id";
				$res_Password = mysql_query($q_Password, $konekcija) or die("Greska update Password!");
				mysql_close($konekcija);
			}
			
			if(strlen($taAbout) > 2)
			{
				include("konekcija.php");
				$q_About="update users set about='$taAbout' where id_user=$id";
				$res_About = mysql_query($q_About, $konekcija) or die("Greska update About!");
				mysql_close($konekcija);
			}
			
			if($_FILES["avatar"]["error"]>0)
			{
				//$greske[]="Error with avatar image!";
			}
			else
			{
				$slika=$_FILES["avatar"]["name"];
				$tmp=$_FILES["avatar"]["tmp_name"];
				$type=$_FILES["avatar"]["type"];
				
				if($type=="image/pjpeg" or $type=="image/jpeg" or $type =="image/png")
				{
					include("konekcija.php");
					$putanja="images/avatar/".$slika;
					
					if(move_uploaded_file($tmp, $putanja))
					{	
						$upit="update users set slika='$putanja' where id_user=$id";
						$rez=mysql_query($upit, $konekcija) or die("Greska upit Avatar!");
						if($rez)
						{
							//$uspeh="You have set your avatar image!";
						}
					}
					mysql_close($konekcija);
				}
				else
				{
					//$greske[]="Image must be in jpg format!";
				}
			}
		}
		
		if(isset($_GET["username"]))
		{
			$username = $_GET["username"];
			
			include("konekcija.php");
			
			$q_ParseUsername = "select u.id_user from users u
			where u.username = '$username'";
			$res_ParseUsername = mysql_query($q_ParseUsername, $konekcija) or die("Greska ParseUsername!");
			$parsedIdUser = mysql_result($res_ParseUsername, 0);
			
			if($parsedIdUser == false)
			{
				header("location: index.php");
			}
			else
			{
				$q_User = "select * from users where id_user = $parsedIdUser";
				$res_User = mysql_query($q_User, $konekcija) or die("Greska upit ParsedUser!");
				$userDetails = mysql_fetch_array($res_User);
				
				$q_Threads = "SELECT COUNT(t.id_thread)
				from threads t
				where t.autor = $parsedIdUser";
				$res_Threads = mysql_query($q_Threads, $konekcija) or die("Greska upit ParsedThreads!");
				$totalTreads = mysql_result($res_Threads, 0);
				
				$q_Posts = "select count(p.id_post)
				from posts p
				where p.author = $parsedIdUser";
				$res_Posts = mysql_query($q_Posts, $konekcija) or die("Greska upit ParsedPosts!");
				$totalPosts = mysql_result($res_Posts, 0);
				
				$q_Likes = "select sum(likes) as likes
				from posts p
				where p.author = $parsedIdUser";
				$res_Likes = mysql_query($q_Likes, $konekcija) or die("Greska upit ParsedLikes!");
				$totalLikes = mysql_result($res_Likes, 0);
				
				$q_ListOfThreads = "select *
				from threads t
				where t.autor = $parsedIdUser";
				$res_ListOfThreads = mysql_query($q_ListOfThreads, $konekcija) or die("Greska ParsedListaThread-ova!");
			}
			mysql_close($konekcija);
		}
		else
		{
			$idUser = $_SESSION["id_user"];
			
			include("konekcija.php");
			
			$q_User = "select * from users where id_user = $idUser";
			$res_User = mysql_query($q_User, $konekcija) or die("Greska upit USER!");
			$userDetails = mysql_fetch_array($res_User);
			
			$q_Threads = "SELECT COUNT(t.id_thread)
			from threads t
			where t.autor = $idUser";
			$res_Threads = mysql_query($q_Threads, $konekcija) or die("Greska upit Threads!");
			$totalTreads = mysql_result($res_Threads, 0);
			
			$q_Posts = "select count(p.id_post)
			from posts p
			where p.author = $idUser";
			$res_Posts = mysql_query($q_Posts, $konekcija) or die("Greska upit Posts!");
			$totalPosts = mysql_result($res_Posts, 0);
			
			$q_Likes = "select sum(likes) as likes
			from posts p
			where p.author = $idUser";
			$res_Likes = mysql_query($q_Likes, $konekcija) or die("Greska upit Likes!");
			$totalLikes = mysql_result($res_Likes, 0);
			
			$q_ListOfThreads = "select *
			from threads t
			where t.autor = $idUser";
			$res_ListOfThreads = mysql_query($q_ListOfThreads, $konekcija) or die("Greska ListaThread-ova!");
			
			mysql_close($konekcija);
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Forum - Account Settings</title>
		<meta name="author" content="Uroš Jovanović">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
		<link rel="shortcut icon" href="images/prava.ico">
		
		<script type="text/javascript" src="script/jquery-3.0.0.js"></script>
		<script type="text/javascript" src="script/script.js"></script>
	</head>
	<body>
		<div id="header-client-wrapper">
			<?php include("header-client.php"); ?>
		</div>
		<header>
			<?php include("header.php"); ?>
		</header>
		<nav>
			<?php include("nav.php"); ?>
		</nav>
		<div id="content-wrapper">
			<div id="main-profile">
				<div id="profile-image">
					<?php echo "<img src='".$userDetails["slika"]."' width='200px' height='200px' />"; ?>
				</div>
				<div id="profile-user">
					<?php echo "<h1>".ucfirst($userDetails["username"])."</h1>"; ?>
					<div class="separator-line"></div>
					<p>Member since <?php echo date("M d, Y", $userDetails["time"]); ?></p>
				</div>
			</div>
			<div id="main-details">
				<?php
					if(isset($idUser))
					{
				?>
						<div class="details-wrapper" style="margin-right: 50px;">
							<div id="details-about-me">
								<h2>Account details</h2>
								<div class="separator-line"></div>
								<form action="profile.php" method="POST" enctype="multipart/form-data">
									<span class="wide spacing-large">Email</span>
									<span class="wide"><input type="text" class="input-wide" value="<?php echo $userDetails["mail"]; ?>" disabled /></span>
									<span class="wide spacing-large">New Password</span>
									<span class="wide"><input type="password" name="newPassword" class="input-wide" /></span>
									<span class="wide spacing-large">Avatar</span>
									<span class="wide"><input type="file" name="avatar" class="input-wide" /></span>
									<span class="wide spacing-large">About me</span>
									<span class="wide"><textarea id="taAbout" name="about" maxlength="250"><?php echo $userDetails["about"]; ?></textarea></span>
									<span class="wide spacing-large"></span>
									<span class="wide"><input type="submit" id="btnUpdate" name="update" value="Save changes" /></span>
								</form>
							</div>
						</div>
				<?php
					}
					if(isset($_GET["username"]))
					{
						echo "<div class='details-wrapper' style='margin-right: 50px;'>";
						echo "<div id='details-about-me'>";
						echo "<h2>About</h2>";
						echo "<div class='separator-line'></div>";
						echo "<span class='wide'>";
						
						if(strlen($userDetails["about"]) > 2)
						{
							echo "<p style='margin-top: 20px;'>".$userDetails["about"]."</p>";
						}
						else
						{
							echo "<p style='margin-top: 20px;>This user hasn't shared any information yet.</p>";
						}
						echo "</span>";
						echo "</div>";
						echo "</div>";
					}
				?>
				<div class="details-wrapper">
					<div id="details-statistics">
						<h2>Statistics</h2>
						<div class="separator-line"></div>
						<div class="stat-div spacing-large">
							<span style="float: left;">Threads created</span>
							<span style="float: right;"><?php echo $totalTreads; ?></span>
						</div>
						<div class="stat-div spacing-large">
							<span style="float: left;">Replies posted</span>
							<span style="float: right;"><?php echo $totalPosts; ?></span>
						</div>
						<div class="stat-div spacing-large">
							<span style="float: left; color: #00a4ef">Likes received</span>
							<span style="float: right; color: #00a4ef"><?php echo $totalLikes; ?></span>
						</div>
					</div>
				</div>
				<div id="details-wrapper-wide">
					<div id="details-activity">
						<h2>My activity</h2>
						<div class="separator-line-wide"></div>
						<?php
								if(mysql_num_rows($res_ListOfThreads)>0)
								{
									while($oneThread = mysql_fetch_array($res_ListOfThreads))
									{
										echo "<div class='one-thread'>";
										echo "<a href='thread.php?thread=".$oneThread["id_thread"]."'><p class='title'>".$oneThread["naziv_thread"]."</p>";
										echo "<p class='det'>Created ".date("M d, Y", $oneThread["vreme"])." | ".$oneThread["postova"]." replies</p></a>";
										echo "</div>";
									}
								}
								else
								{
									echo "<div class='one-thread'>";
									echo "<p class='title'>There aren't any threads yet! </p>";
									echo "</div>";
								}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<footer>
			<?php include("footer.php"); ?>
		</footer>
	</body>
</html>
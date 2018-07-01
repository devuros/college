<?php
	session_start();
	
	$exitCode = 0;
	
	if(isset($_POST["qcomsubmit"]))
	{
		if(isset($_POST["qcom"]))
		{
			$qcom = $_POST["qcom"];
			$regSearch = "/^[A-z0-9\s]{2,50}$/";
			
			if(preg_match($regSearch, $qcom))
			{
				if(strlen($qcom) < 2 or strlen(trim($qcom)) < 2)
				{
					$exitCode = 2;
				}
				else
				{
					$qcom = trim($_POST["qcom"]);
					include("konekcija.php");
					
					$q_Users = "select * from users u where u.username like '%$qcom%'";
					$res_Users = mysql_query($q_Users, $konekcija) or die("Greska upit Users!");
					
					mysql_close($konekcija);
					if(isset($res_Users) and mysql_num_rows($res_Users) > 0)
					{
						$exitCode = 400;
					}
					else
					{
						$exitCode = 3;
					}
				}
			}
			else
			{
				$exitCode = 1;
			}
		}
	}
	else		
	{
		$exitCode = 0;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Community - Forums</title>
		<meta name="author" content="Uroš Jovanović">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
		<link rel="shortcut icon" href="images/prava.ico">
		
		<script type="text/javascript" src="script/jquery-3.0.0.js"></script>
		<script type="text/javascript" src="script/scriptSearch.js"></script>
	</head>
	<body>
		<div id="header-client-wrapper">
			<?php include("header-client.php"); ?>
		</div>
		<div id="location">
			<?php include("location.php"); ?>
		</div>
		<div id="search-wrapper">
			<div id="search-header">
				<?php
					if(isset($qcom))
					{
						echo "<h1>Search results for user &quot;".trim($qcom)."&quot;</h1>";
					}
					else
					{
						echo "<h1>Search results for user &quot;&quot;</h1>";
					}
				?>
				<div id="move-me">
					<form action="community.php" method="POST">
						<input type="text" name="qcom" id="tbSearch" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
						<button type="submit" title="Search" id="btnSearch" name="qcomsubmit" value="search">
							<i class="fa fa-search"></i>
						</button>
					</form>
				</div>
			</div>
			<?php
				switch($exitCode)
				{
					//case 0: echo "<div id='broj-rez'>nije kliknuto dugme!</div>"; break;
					case 1: echo "<div id='broj-rez'>No results could be found.</div>"; break;
					case 2: echo "<div id='broj-rez'>No results could be found.</div>"; break;
					case 3: echo "<div id='broj-rez'>No users could be found.</div>"; break;
					case 400: echo "<div id='broj-rez'>1 user found</div>";
				}
				if($exitCode == 400)
				{
					echo "<div id='search-results'>";
					while($oneUser = mysql_fetch_array($res_Users))
					{
						echo "<a href='profile.php?username=".$oneUser["username"]."'>";
						echo "<div class='search-user'>";
						
						echo "<div class='user-img'>";
						echo "<img src='".$oneUser["slika"]."' height='100px' width='100px' />";
						echo "</div>";
						echo "<div class='det-wrap'>";
						echo "<div class='user-name'>";
						echo "<h3>".ucfirst($oneUser["username"])."</h3>";
						echo "</div>";
						echo "<div class='user-member-since'>";
						echo "Member since ".date("d M Y", $oneUser["time"]);
						echo "</div>";
						echo "<div class='user-posts-counter'>";
						echo $oneUser["postovi"]. " posts";
						echo "</div>";
						echo "<div class='user-about'>";
						echo "<h4>About</h4>";
						
						if(strlen($oneUser["about"]) < 2)
						{
							echo "<p>This user hasn't shared any information yet.</p>";
						}
						else
						{
							echo "<p>".$oneUser["about"]."</p>";
						}
						
						echo "</div>";
						echo "</div>";
						
						echo "</div>";
						echo "</a>";
					}
					echo "</div>";
				}
			?>
			<div id="search-paging" class="vh">
			</div>
		</div>
		<div class="clear"></div>
		<footer>
			<?php include("footer.php"); ?>
		</footer>
	</body>
</html>
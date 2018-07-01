<?php
	session_start();
	
	$exitCode = 0;
	
	if(isset($_POST["qsubmit"]))
	{
		if(isset($_POST["q"]))
		{
			$q = $_POST["q"];
			$regSearch = "/^[A-z0-9\s\!\?]{2,100}$/";
			
			if(preg_match($regSearch, $q))
			{
				if(strlen($q) < 2 or strlen(trim($q)) < 2)
				{
					$exitCode = 2;
				}
				else
				{
					$q = trim($_POST["q"]);
					include("konekcija.php");
					
					$q_Upit = "select p.likes, p.id_post, p.tekst, p.vreme, p.author, t.naziv_thread, t.id_thread, u.postovi, u.username, u.slika, pk.naziv_podkategorija
					from posts p inner join threads t on p.id_thread = t.id_thread
					inner join users u on p.author = u.id_user
					inner join podkategorije pk on t.id_podkategorija = pk.id_podkategorija
					where (p.tekst like '%$q%' or t.naziv_thread like '%$q%') and pk.id_podkategorija != 10";
					$res_Upit = mysql_query($q_Upit, $konekcija) or die("Greska upit Search!");
					
					$q_BrojRezultata = "select count(id_post) as zbir
					from posts p inner join threads t on p.id_thread = t.id_thread
					inner join users u on p.author = u.id_user
					inner join podkategorije pk on t.id_podkategorija = pk.id_podkategorija
					where (p.tekst like '%$q%' or t.naziv_thread like '%$q%') and pk.id_podkategorija != 10";
					$res_BrojRezultata = mysql_query($q_BrojRezultata, $konekcija) or die("Greska upit BrojRezultata!");
					$brojRezulata = mysql_result($res_BrojRezultata, 0);
					
					mysql_close($konekcija);
					
					if(isset($res_Upit) and mysql_num_rows($res_Upit) > 0)
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
		<title>Search - Forums</title>
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
					if(isset($q))
					{
						echo "<h1>Search results for &quot;".trim($q)."&quot;</h1>";
					}
					else
					{
						echo "<h1>Search results for &quot;  &quot;</h1>";
					}
				?>
				<div id="move-me">
					<form action="search.php" method="POST">
						<input type="text" name="q" id="tbSearch" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
						<button type="submit" title="Search" id="btnSearch" name="qsubmit" value="search">
							<i class="fa fa-search"></i>
						</button>
					</form>
				</div>
			</div>
			<?php
				switch($exitCode)
				{
					case 0: echo "<div id='broj-rez'>No results could be found.</div>"; break;
					case 1: echo "<div id='broj-rez'>No results could be found.</div>"; break;
					case 2: echo "<div id='broj-rez'>No results could be found.</div>"; break;
					case 3: echo "<div id='broj-rez'>No results could be found. Check your spelling or try different keywords.</div>"; break;
					case 400: echo "<div id='broj-rez'>".$brojRezulata." posts</div>";
				}
				if($exitCode == 400)
				{
					echo "<div id='search-results'>";
					include("konekcija.php");
					while($onePost = mysql_fetch_array($res_Upit))
					{
						$pstTID = $onePost["id_thread"];
						$pstPID = $onePost["id_post"];
						
						$set = "set @num = 0;";
						$res_set = mysql_query($set, $konekcija) or die("Greska Set!");
						$pst = "select p.id_post, @num := @num + 1 as rank
						from posts p inner join threads t on p.id_thread = t.id_thread
						where t.id_thread = $pstTID and t.id_podkategorija != 10
						order by p.vreme ASC";
						$res_pst = mysql_query($pst, $konekcija) or die("Greska PST!".mysql_error());
						$total = mysql_num_rows($res_pst);
						while($onePst = mysql_fetch_array($res_pst))
						{
							if($onePst["id_post"] == $pstPID)
							{
								$rank = $onePst["rank"];
								$perPage = 10;
								$ordinalOnPage = $rank%$perPage;
								if($rank <= 10)
								{
									$skriveno = 0;
								}
								else
								{
									$skriveno = $rank - $ordinalOnPage;
								}
							}
						}
						echo "<a href='thread.php?thread=".$onePost["id_thread"]."&current=".$skriveno."#pid".$rank."'><div class='search-post'>";
						
						echo "<div class='post-author'>";
						echo "<div class='author-img'>";
						echo "<img src='".$onePost["slika"]."' alt='' />";
						echo "</div>";
						echo "<div class='author-name'>".ucfirst($onePost["username"])."</div>";
						echo "<div class='author-posts'>".$onePost["postovi"]." posts</div>";
						echo "</div>";
						
						echo "<div class='search-text'>";
						echo "<h3>".$onePost["naziv_thread"]."</h3>";
						echo "<h5 style='font-weight: normal;'>".strtoupper($onePost["naziv_podkategorija"])."</h5>";
						echo "<h5 style='font-weight: normal;'>";
						echo date("d M Y", $onePost["vreme"])." &nbsp;&nbsp;";
						if($onePost["likes"] > 0)
						{
							echo "<span class='span-color'><i class='fa fa-thumbs-o-up'></i> ".$onePost["likes"]."</span>";
						}
						echo "</h5>";
						echo "<span>".$onePost["tekst"]."</span>";
						echo "</div>";
						
						echo "</div></a>";
					}
					mysql_close($konekcija);
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
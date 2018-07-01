<?php
	session_start();
	
	if(isset($_GET["thread"]))
	{
		$id_thread=$_GET["thread"];
	}
	else
	{
		if(!isset($_POST["post"]))
		{
			header("location: index.php");
		}
	}
	
	if(isset($_POST["post"]))
	{
		$hidden_thread = $_POST["hidden_thread"];
		$vreme = mktime();
		$id_autor = $_SESSION["id_user"];
		$tekst = $_POST["taInput"];
		
		$regTekst = "/^[A-z0-9\.\,\-\_\<\>\/\!\?\s\;\&]{5,500}$/";
		
		if(!preg_match($regTekst, $tekst))
		{
			
		}
		else
		{
			include("konekcija.php");
			$id_thread = $hidden_thread;
			
			$q_insert="insert into posts values ('', $id_autor, $vreme, '$tekst', 0, $id_thread)";
			$rez_insert=mysql_query($q_insert, $konekcija) or die("GRESKA!");
			$aiPost = mysql_insert_id($konekcija);
			
			$q_update = "update threads set postova = postova + 1 where id_thread = $id_thread";
			$res_update = mysql_query($q_update, $konekcija) or die("Greska update reply number..");
			
			if($rez_insert)
			{
				$q_PostNumber = "update users set postovi = postovi + 1 where id_user = $id_autor";
				$res_PostNumber = mysql_query($q_PostNumber, $konekcija) or die("Greska update Post number!");
				
				$q_lastPost = "update threads set last_post = $aiPost where id_thread = $id_thread";
				$res_lastPost = mysql_query($q_lastPost, $konekcija) or die("Greska upate LastPost!");
			}
			mysql_close($konekcija);
		}
		header("location: thread.php?thread=$id_thread");
	}
	
	if(isset($_GET["thread"]))
	{
		$q_thread_name="select t.id_thread, t.naziv_thread, t.status, t.sticky, t.id_podkategorija, pk.naziv_podkategorija
		from threads t inner join podkategorije pk on t.id_podkategorija = pk.id_podkategorija
		where id_thread=$id_thread";
	}
	else
	{
		$q_thread_name="select t.id_thread, t.naziv_thread, t.status, t.sticky, t.id_podkategorija, pk.naziv_podkategorija 
		from threads t inner join podkategorije pk on t.id_podkategorija = pk.id_podkategorija
		where id_thread=$hidden_thread";
	}
	include("konekcija.php");
	$rez_thread_name=mysql_query($q_thread_name, $konekcija)  or die("GRESKA!");
	$red_thread_name=mysql_fetch_array($rez_thread_name);
	mysql_close($konekcija);
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $red_thread_name["naziv_thread"]. " - Forums"; ?> </title>
		<meta name="author" content="Uroš Jovanović">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
		<link rel="shortcut icon" href="images/prava.ico">
		
		<script src="script/tinymce/tinymce.min.js"></script>
		<script>
			tinymce.init({
				selector: '#taInput',
				width: 600,
				min_height: 220,
				max_height: 300,
				resize: true,
				// content_css: 'tinymce.css', custom css
				toolbar: 'bold italic underline bullist edit code blockquote', //sta se prikazuje u toolbaru
				statusbar: false, //bar stuck to the bottom
				menubar: false, //dropdown meniji
				plugin: 'a_tinymce_plugin',
				a_plugin_option: true,
				a_configuration_option: 400
			});
		</script>
		
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
		<div id="location">
			<?php include("location.php"); ?>
		</div>
		<div id="content-wrapper">
			<div id="main-thread-wrapper">
				<div id="thread-header">
					<?php
						include("konekcija.php");
						
						if(isset($_GET["current"]))
						{
							$current=$_GET["current"];
						}
						else
						{
							if(isset($_POST["hidden_current"]))
							{
								$current = $_POST["hidden_current"];
							}
							else
							{
								$current=0;
							}
						}
						
						if(isset($_GET["thread"]))
						{
							$q_page="select count(*) from posts p inner join users u on p.author=u.id_user
							where id_thread=$id_thread";
						}
						else
						{
							$q_page="select count(*) from posts p inner join users u on p.author=u.id_user
							where id_thread=$hidden_thread";
						}
						$res_page=mysql_query($q_page, $konekcija) or die("Greska page number!");
						
						$perPage = 10;
						$total = mysql_result($res_page, 0);
						$next = $current + $perPage;
						$prev = $current - $perPage;
						
						$currentPage = $current/$perPage +1;
						$totalPages = ceil($total /$perPage);
						$lastPage = $totalPages*$perPage;
						
						if(isset($_GET["thread"]))
						{
							$q_posts="select * from posts p inner join users u on p.author=u.id_user
							where id_thread=$id_thread
							order by vreme ASC
							limit $perPage offset $current";
						}
						else
						{
							$q_posts="select * from posts p inner join users u on p.author=u.id_user
							where id_thread=$hidden_thread
							order by vreme ASC
							limit $perPage offset $current";
						}
						$rez_posts=mysql_query($q_posts, $konekcija) or die("Greska!");
						mysql_close($konekcija);
					?>
					<div id="header-header-top">
						<?php
							include("konekcija.php");
							
							echo "<h2>".$red_thread_name["naziv_thread"];
							if($red_thread_name["status"] == "locked")
							{
								echo "<span style='color: #f25022;'> [Locked] </span>";
							}
							if($red_thread_name["sticky"] == 1)
							{
								echo "<span style='color: #ffb900;'> [Sticky] </span>";
							}
							echo "</h2>";
							
							$q_Autor = "select * from threads t inner join users u
							on t.autor = u.id_user
							where t.id_thread = $id_thread";
							$res_Autor = mysql_query($q_Autor, $konekcija) or die("Greska dohvati autora!");
							$resultAutor = mysql_fetch_array($res_Autor);
							
							if(isset($_SESSION["id_user"]))
							{
								echo "<span id='header-header-report'>";
								if($resultAutor["sticky"] == 0)
								{
									echo "<button id='btnSticky' value='".$id_thread."' title='request sticky'>Request Sticky</button>";
								}
								if($resultAutor["id_uloga"] == 1)
								{
									echo " <button id='btnReport' value='".$id_thread."' title='report thread'>
									<i class='fa fa-exclamation-circle'></i> REPORT THREAD</button>";
								}
								echo "</span>";
							}
							mysql_close($konekcija);
						?>
					</div>
					<div id="header-header-bottom">
						<?php
							if($red_thread_name["status"] != "locked")
							{
								echo "<input type='button' name='thread' value='add a reply' class='btnPost' />";
							}
							else
							{
								if(isset($_SESSION["uloga"]) and $_SESSION["uloga"] == 3)
								{
									echo "<input type='button' name='thread' value='add a reply' class='btnPost' />";
								}
							}
						?>
					</div>
					<div id="pagination-wrapper">
						<?php
							if($prev < 0)
							{
								if($next >= $total)
								{
									//prva strana nema next.. log nema ni prev
								}
								else
								{
									echo "<a href='thread.php?thread=$id_thread&current=$next' class='btnPagination'>NEXT <i class='fa fa-angle-right'></i></a>";
								}
							}
							else if($next >= $total)
							{
								echo "<a href='thread.php?thread=$id_thread&current=$prev' class='btnPagination'><i class='fa fa-angle-left'></i> PREVIOUS</a>";
								echo "<span class='span-current-page'>PAGE $currentPage</span>";
							}
							else
							{
								echo "<a href='thread.php?thread=$id_thread&current=$prev' class='btnPagination'><i class='fa fa-angle-left'></i> PREVIOUS</a>";
								echo "<span class='span-current-page'>PAGE $currentPage</span>";
								echo "<a href='thread.php?thread=$id_thread&current=$next' class='btnPagination'>NEXT <i class='fa fa-angle-right'></i></a>";
							}
						?>
					</div>
				</div>
				<div id="thread-posts-wrapper">
					<?php
						$number = $current + 1;
						
						while($red_posts=mysql_fetch_array($rez_posts))
						{	
							echo "<div class='thread-post'>";
							echo "<div class='post-author'>";
							echo "<div class='author-img'>";
							echo "<img src='".$red_posts["slika"]."' alt='' />";
							echo "</div>";
							echo "<div class='author-name'>";
							echo "<a href='profile.php?username=".$red_posts["username"]."'>".ucfirst($red_posts["username"])."</a>";
							echo "</div>";
							echo "<div class='author-posts'>".$red_posts["postovi"]." posts</div>";
							echo "</div>";
							echo "<div class='post-text'>";
							echo $red_posts["tekst"];
							echo "</div>";
							echo "<div class='post-time'>";
							echo "<div id='pid".$number."'>#".$number."</div>";
							
							$dtVreme = date_create();
							date_timestamp_set($dtVreme, $red_posts["vreme"]);
							$dtSada = date_create();
							date_timestamp_set($dtSada, mktime());
							$terval = date_diff($dtSada, $dtVreme);
							
							echo "<div class='div-post-time'>";
							if(($terval->m) >= 1)
							{
								echo date("d M Y", $red_posts["vreme"]);
							}
							if(($terval->m) < 1 and (($terval->d) >= 8 and ($terval->d) < 32))
							{
								echo date("d M Y", $red_posts["vreme"]);
							}
							if(($terval->m) < 1 and (($terval->d) >= 1 and ($terval->d) < 8))
							{
								echo $terval->d." days ago";
							}
							if(($terval->m) < 1 and ($terval->d) < 1 and ($terval->h) >= 1)
							{
								echo $terval->h." hours ago";
							}
							if(($terval->m) < 1 and ($terval->d) < 1 and ($terval->h) < 1)
							{
								echo $terval->i." minutes ago";
							}
							echo "</div>";
							
							if($red_posts["likes"]>0)
							{
								echo "<div class='div-post-like'>+".$red_posts["likes"]."</div>";
							}
							else
							{
								echo "<div class='div-post-like'></div>";
							}
							if(isset($_SESSION["id_user"]))
							{
								echo "<div class='div-post-hover' style='display: none;'>";
								echo "<button class='like' name='like' value='".$red_posts["id_post"]."'><i class='fa fa-thumbs-o-up'></i></button>";
								echo "<button class='quote' name='quote' value='".$red_posts["id_post"]."' title='quote'><i class='fa fa-quote-right'></i></button>";
								
								if($red_posts["id_uloga"]==1)
								{	
									echo "<button class='report' name='report' value='".$red_posts["id_post"]."' title='report post'><i class='fa fa-exclamation-circle'></i></button>";
								}
								echo "</div>";
							}
							echo "</div>";
							echo "</div>";
							$number++;
						}
					?>
				</div>
				<?php
					if($prev < 0)
					{
						if($next >= $total)
						{
							//prva strana nema next.. log nema ni prev
						}
						else
						{
							echo "<div id='thread-page'>";
							echo "<a href='thread.php?thread=$id_thread&current=$next' class='btnPagination'>NEXT <i class='fa fa-angle-right'></i></a>";
							echo "</div>";
						}
					}
					else if($next >= $total)
					{
						echo "<div id='thread-page'>";
						echo "<a href='thread.php?thread=$id_thread&current=$prev' class='btnPagination'><i class='fa fa-angle-left'></i> PREVIOUS</a>";
						echo "<span class='span-current-page'>PAGE $currentPage</span>";
						echo "</div>";
					}
					else
					{
						echo "<div id='thread-page'>";
						echo "<a href='thread.php?thread=$id_thread&current=$prev' class='btnPagination'><i class='fa fa-angle-left'></i> PREVIOUS</a>";
						echo "<span class='span-current-page'>PAGE $currentPage</span>";
						echo "<a href='thread.php?thread=$id_thread&current=$next' class='btnPagination'>NEXT <i class='fa fa-angle-right'></i></a>";
						echo "</div>";
					}
				?>
				<?php
					if(isset($_SESSION["id_user"]))
					{
						include("konekcija.php");
						$id_self=$_SESSION["id_user"];
		
						$q_self="select * from users where id_user=$id_self";
						$rez_self=mysql_query($q_self, $konekcija) or die("Greska!");
						
						if(mysql_num_rows($rez_self)==1)
						{
							if($red_thread_name["status"] != "locked")
							{
								while($red_self=mysql_fetch_array($rez_self))
								{
									echo "<div id='thread-new-post'>";
									echo "<div id='thread-Title'><h2>Reply to Thread</h2></div>";
									echo "<div id='new-post-left-wrapper'>";
									echo "<div class='post-author'>";
									echo "<div class='author-img'> <img src='".$red_self["slika"]."' alt='avatar' /> </div>";
									echo "<div class='author-name'><a href='profile.php'>".ucfirst($red_self["username"])."</a></div>";
									echo "</div>";
									echo "</div>";
									echo "<div id='new-post-right-wrapper'>";
									echo "<div id='spacing-div'></div>";
									echo "<form action='thread.php' method='POST'>";
									echo "<div id='new-post-input'>";
									if(isset($_GET["thread"]))
									{
										echo "<input type='hidden' name='hidden_thread' value='".$id_thread."'>";
										echo "<input type='hidden' name='hidden_current' value='".$current."'>";
									}
									echo "<textarea id='taInput' name='taInput'></textarea>";
									echo "</div>";
									echo "<div id='new-post-submit'>";
									echo "<input type='submit' name='post' value='SUBMIT' id='btnPost' />";
									echo "</div>";
									echo "</form>";
									echo "</div>";
									
									echo "</div>";
								}
								mysql_close($konekcija);
							}
							else
							{
								if($_SESSION["uloga"] == 3)
								{
									while($red_self=mysql_fetch_array($rez_self))
									{
										echo "<div id='thread-new-post'>";
										echo "<div id='thread-Title'><h2>Reply to Thread</h2></div>";
										echo "<div id='new-post-left-wrapper'>";
										echo "<div class='post-author'>";
										echo "<div class='author-img'> <img src='".$red_self["slika"]."' alt='' /> </div>";
										echo "<div class='author-name'>".ucfirst($red_self["username"])."</div>";
										echo "</div>";
										echo "</div>";
										echo "<div id='new-post-right-wrapper'>";
										echo "<div id='spacing-div'></div>";
										echo "<form action='thread.php' method='POST'>";
										echo "<div id='new-post-input'>";
										if(isset($_GET["thread"]))
										{
											echo "<input type='hidden' name='hidden_thread' value='".$id_thread."'>";
											echo "<input type='hidden' name='hidden_current' value='".$current."'>";
										}
										echo "<textarea id='taInput' name='taInput'></textarea>";
										echo "</div>";
										echo "<div id='new-post-submit'>";
										echo "<input type='submit' name='post' value='SUBMIT' id='btnPost' />";
										echo "</div>";
										echo "</form>";
										echo "</div>";
										
										echo "</div>";
									}
									mysql_close($konekcija);
								}
							}
						}
					}
				?>
				<?php
					if(!isset($_SESSION["id_user"]))
					{
						if($red_thread_name["status"] != "locked")
						{
							echo "<div id='thread-footer'>";
							echo "<input type='button' name='thread' value='add a reply' class='btnPost' />";
							echo "</div>";
						}
					}
				?>
			</div>
		</div>
		<div class="clear"></div>
		<footer>
			<?php include("footer.php"); ?>
		</footer>
	</body>
</html>
<?php
	session_start();
	
	if(isset($_GET["subcat"]))
	{
		$subcat=$_GET["subcat"];
		
		include("konekcija.php");
		
		$q_ime="select naziv_podkategorija, id_podkategorija from podkategorije where id_podkategorija=$subcat";
		$rez_ime=mysql_query($q_ime, $konekcija) or die("Greska!");
		
		while($red_ime=mysql_fetch_array($rez_ime))
		{
			$ime=ucwords($red_ime["naziv_podkategorija"]);
			$imefull=ucwords($red_ime["naziv_podkategorija"]);
			$podk = $red_ime["id_podkategorija"];
		}
		mysql_close($konekcija);
	}
	else
	{
		if(isset($_POST["createThread"]))
		{
			$title = $_POST["threadTitle"];
			$text = $_POST["taInput"];
			$idSubcat = $_POST["hiddenSubcat"];
			$author = $_SESSION["id_user"];
			$time = mktime();
			
			$regTekst = "/^[A-z0-9\.\,\-\_\<\>\/\!\?\s]{4,500}$/";
		
			if(!preg_match($regTekst, $text) or !preg_match($regTekst, $title))
			{
				//nije dobro popunjeno
			}
			else
			{
				include("konekcija.php");
				
				if(!isset($_POST["lock"]))
				{
					$q_newThread = "insert into threads values ('', '$title', $author, 0, $time, 'active' , 0, 0, 0, $idSubcat)";
					$res_newThread = mysql_query($q_newThread, $konekcija) or die("Greska insert Thread!");
					$autoIncrement = mysql_insert_id($konekcija);
				
					$q_newPost = "insert into posts values ('', $author, $time, '$text', 0, $autoIncrement)";
					$res_newPost = mysql_query($q_newPost, $konekcija) or die("Greska insert Post-a");
					$aiPost = mysql_insert_id($konekcija);
					
					if($res_newPost)
					{
						$q_PostNumber = "update users set postovi = postovi + 1 where id_user = $author";
						$res_PostNumber = mysql_query($q_PostNumber, $konekcija) or die("Greska update Post number!");
						
						$q_lastPost = "update threads set last_post = $aiPost where id_thread = $autoIncrement";
						$res_lastPost = mysql_query($q_lastPost, $konekcija) or die("Greska upate LastPost!");
					}
				}
				else
				{
					$q_newThread = "insert into threads values ('', '$title', $author, 0, $time, 'locked', 0, 0, 0, $idSubcat)";
					$res_newThread = mysql_query($q_newThread, $konekcija) or die("Greska insert LockedThread!");
					$autoIncrement = mysql_insert_id($konekcija);
				
					$q_newPost = "insert into posts values ('', $author, $time, '$text', 0, $autoIncrement)";
					$res_newPost = mysql_query($q_newPost, $konekcija) or die("Greska insert Post-a");
					$aiPost = mysql_insert_id($konekcija);
					
					if($res_newPost)
					{
						$q_PostNumber = "update users set postovi = postovi + 1 where id_user = $author";
						$res_PostNumber = mysql_query($q_PostNumber, $konekcija) or die("Greska update Post number!");
						
						$q_lastPost = "update threads set last_post = $aiPost where id_thread = $autoIncrement";
						$res_lastPost = mysql_query($q_lastPost, $konekcija) or die("Greska upate LastPost!");
					}
				}
				$subcat = $idSubcat;
				mysql_close($konekcija);
			}
			header("location: subcat.php?subcat=$idSubcat");
		}
		else
		{
			header("location: index.php");
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $imefull ." - Forums"; ?></title>
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
				toolbar: 'bold italic underline bullist edit', //sta se prikazuje u toolbaru
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
			<div id="main-subcat-wrapper">
				<div id="subcat-header">
					<div id="header-top"><?php echo "<h2>".$ime."</h2>"; ?></div>
					<div id="header-bottom">
						<input type="button" name="thread" value="create thread" class="btnThread" />
					</div>
					<?php
						if(isset($_GET["current"]))
						{
							$current = $_GET["current"];
						}
						else
						{
							$current = 0;
						}
						
						include("konekcija.php");
						
						$qTotalThreads="select count(*) 
						from threads t inner join users u on t.autor=u.id_user
						where t.id_podkategorija=$subcat and t.status != 'deleted'";
						$resultTotalThreads = mysql_query($qTotalThreads, $konekcija) or die("Greska total number of Threads!");
						
						$totalThreads = mysql_result($resultTotalThreads, 0);
						$perPage = 10;
						$next = $current + $perPage;
						$prev = $current - $perPage;
						$currentPage = $current/$perPage +1;
						
						$q_threads="select *
						from threads t inner join users u on t.autor=u.id_user
						inner join posts p on t.last_post = p.id_post
						where t.id_podkategorija = $subcat and t.status != 'deleted'
						order by t.sticky DESC, p.vreme desc
						limit $perPage offset $current";
						
						$rez_threads=mysql_query($q_threads, $konekcija) or die("greska!");
						
						mysql_close($konekcija);
					?>
					<div id="header-pagination">
						<?php
							if($prev < 0)
							{
								if($next >= $totalThreads)
								{
									//prva strana nema next.. log nema ni prev
								}
								else
								{
									echo "<a href='subcat.php?subcat=$subcat&current=$next' class='btnPagination'>NEXT <i class='fa fa-angle-right'></i></a>";
								}
							}
							else if($next >= $totalThreads)
							{
								echo "<a href='subcat.php?subcat=$subcat&current=$prev' class='btnPagination'><i class='fa fa-angle-left'></i> PREVIOUS</a>";
								echo "<span class='span-current-page'>PAGE $currentPage</span>";
							}
							else
							{
								echo "<a href='subcat.php?subcat=$subcat&current=$prev' class='btnPagination'><i class='fa fa-angle-left'></i> PREVIOUS</a>";
								echo "<span class='span-current-page'>PAGE $currentPage</span>";
								echo "<a href='subcat.php?subcat=$subcat&current=$next' class='btnPagination'>NEXT <i class='fa fa-angle-right'></i></a>";
							}
						?>
					</div>
				</div>
				<div id="subcat-new-thread" style="display: none;">
					<?php
						if(isset($_SESSION["id_user"]))
						{
							include("konekcija.php");
							$id_self=$_SESSION["id_user"];
			
							$q_self="select * from users where id_user=$id_self";
							$rez_self=mysql_query($q_self, $konekcija) or die("Greska!");
							
							if(mysql_num_rows($rez_self)==1)
							{
								while($red_self=mysql_fetch_array($rez_self))
								{
									echo "<div id='thread-new-post'>";
									echo "<div id='thread-Title'><h1>New Topic</h1><i class='fa fa-close' id='icon-close'></i></div>";
									echo "<div id='new-post-left-wrapper'>";
									echo "<div class='post-author'>";
									echo "<div class='author-img'> <img src='".$red_self["slika"]."' alt='' /> </div>";
									echo "<div class='author-name'>".$red_self["username"]."</div>";
									echo "</div>";
									echo "</div>";
									echo "<div id='new-post-right-wrapper'>";
									echo "<form action='subcat.php' method='POST'>";
									echo "<div id='new-post-title'>";
									echo "<input type='text' id='tbThreadTitle' name='threadTitle' placeholder='Topic Title' spellcheck='false' autocomplete='off'></div>";
									echo "<div id='new-post-input'>";
									if(isset($_GET["subcat"]))
									{
										echo "<input type='hidden' name='hiddenSubcat' value='".$subcat."'>";
									}
									echo "<textarea id='taInput' name='taInput'></textarea>";
									if($red_self["id_uloga"] == 3)
									{
										echo "<div id='cb-wrapper'><input type='checkbox' id='cbLock' name='lock' value='yes' /> <label for='cbLock'> Lock this thread</label></div>";
									}
									echo "</div>";
									echo "<div id='new-post-submit'>";
									echo "<input type='submit' name='createThread' value='CREATE TOPIC' id='btnPost' />";
									echo "</div>";
									echo "</form>";
									echo "</div>";
									
									echo "</div>";
								}
								mysql_close($konekcija);
							}
						}
					?>
				</div>
				<div id="subcat-topics">
					<div class="one-row-head">
						<div class="icon-div weight" style="visibility: hidden;">Icon</div>
						<div class="subject-div weight" style="color: #000;">Subject</div>
						<div class="author-div weight">Author</div>
						<div class="replies-div weight">Replies</div>
						<div class="last-div weight">Last poster</div>
						<div class="last-time-div weight">Last post</div>
					</div>
					<?php
						if(mysql_num_rows($rez_threads)>0)
						{	
							include("konekcija.php");
							while($red_threads=mysql_fetch_array($rez_threads))
							{
								$id_thread=$red_threads["id_thread"];
								
								echo "<a href='thread.php?thread=".$id_thread."'>";
								if($red_threads["sticky"] == 1)
								{
									echo "<div class='one-row sticky'>";
								}
								else
								{
									echo "<div class='one-row'>";
								}
								echo "<div class='icon-div'>";
								if($red_threads["id_uloga"] == 3)
								{
									echo " <i class='fa fa-foursquare'></i>";
								}
								echo "<i class='fa fa-envelope'></i></div>";
								echo "<div class='subject-div fsize'>".$red_threads["naziv_thread"];
								
								if($red_threads["status"] == "locked")
								{
									echo " <i class='fa fa-lock'></i>";
								}
								if($red_threads["sticky"] == 1)
								{
									echo "<span> [Sticky] </span>";
								}
								echo "</div>";
								if($red_threads["id_uloga"] == 3)
								{
									echo "<div class='author-div accent-color fsize'>".$red_threads["username"]."</div>";
								}
								else
								{
									echo "<div class='author-div reg-color fsize'>".$red_threads["username"]."</div>";
								}
								echo "<div class='replies-div fsize'><i class='fa fa-comment-o'></i> ".$red_threads["postova"]."</div>";
								
								if($red_threads["id_uloga"] == 3)
								{
									echo "<div class='last-div accent-color fsize'>".ucfirst($red_threads["username"])."</div>";
								}
								else
								{
									echo "<div class='last-div reg-color fsize'>".ucfirst($red_threads["username"])."</div>";
								}
								$dtVreme = date_create();
								date_timestamp_set($dtVreme, $red_threads["vreme"]);
								$dtSada = date_create();
								date_timestamp_set($dtSada, mktime());
								
								$terval = date_diff($dtSada, $dtVreme);
								
								echo "<div class='last-time-div fsize'>";
								if(($terval->m) >= 1)
								{
									echo date("d M Y", $red_threads["vreme"]);
								}
								if(($terval->m) < 1 and (($terval->d) >= 8 and ($terval->d) < 32))
								{
									echo date("d M Y", $red_threads["vreme"]);
								}
								if(($terval->m) < 1 and (($terval->d) >= 1 and ($terval->d) < 8))
								{
									echo $terval->d."d";
								}
								if(($terval->m) < 1 and ($terval->d) < 1 and ($terval->h) >= 1)
								{
									echo $terval->h."h";
								}
								if(($terval->m) < 1 and ($terval->d) < 1 and ($terval->h) < 1 and ($terval->i) >= 1)
								{
									echo $terval->i."m";
								}
								if(($terval->m) < 1 and ($terval->d) < 1 and ($terval->h) < 1 and ($terval->i) < 1)
								{
									echo $terval->s."s";
								}
								echo "</div></div></a>";
							}
							mysql_close($konekcija);
						}
						else
						{
							echo "There are no threads";
						}
					?>
				</div>
				<div id="subcat-pagination">
					<?php
						if($prev < 0)
						{
							if($next >= $totalThreads)
							{
								//prva strana nema next.. log nema ni prev
							}
							else
							{
								echo "<a href='subcat.php?subcat=$subcat&current=$next' class='btnPagination'>NEXT <i class='fa fa-angle-right'></i></a>";
							}
						}
						else if($next >= $totalThreads)
						{
							echo "<a href='subcat.php?subcat=$subcat&current=$prev' class='btnPagination'><i class='fa fa-angle-left'></i> PREVIOUS</a>";
							echo "<span class='span-current-page'>PAGE $currentPage</span>";
						}
						else
						{
							echo "<a href='subcat.php?subcat=$subcat&current=$prev' class='btnPagination'><i class='fa fa-angle-left'></i> PREVIOUS</a>";
							echo "<span class='span-current-page'>PAGE $currentPage</span>";
							echo "<a href='subcat.php?subcat=$subcat&current=$next' class='btnPagination'>NEXT <i class='fa fa-angle-right'></i></a>";
						}
					?>
				</div>
				<div id="subcat-footer">
					<input type="button" name="thread" value="create thread" class="btnThread" />
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<footer>
			<?php include("footer.php"); ?>
		</footer>
	</body>
</html>
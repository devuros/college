<?php
	session_start();
	
	if(!isset($_SESSION["id_user"]) or $_SESSION["uloga"] != 3)
	{
		header("location: index.php");
	}
	else
	{
		if(isset($_POST["change"]))
		{
			if(isset($_POST["feat"]))
			{
				$allFeat = $_POST["feat"];
				$outputFeat = "";
				foreach($allFeat as $feat)
				{
					$outputFeat .= $feat.",";
				}
				$outputFeat = substr($outputFeat, 0, strlen($outputFeat)-1);
				
				include("konekcija.php");
				
				$q_UpdateFeatured = "update threads t set t.featured = 1 where t.id_thread in ($outputFeat)";
				$res_UpdateFeatured = mysql_query($q_UpdateFeatured, $konekcija) or die("Greska upit UpdateFeatured!");
				
				mysql_close($konekcija);
			}
			if(isset($_POST["unfeat"]))
			{
				$allUnFeat = $_POST["unfeat"];
				$outputUnFeat = "";
				foreach($allUnFeat as $unFeat)
				{
					$outputUnFeat .= $unFeat.",";
				}
				$outputUnFeat = substr($outputUnFeat, 0, strlen($outputUnFeat)-1);
				
				include("konekcija.php");
				
				$q_UpdateUnFeatured = "update threads t set t.featured = 0 where t.id_thread in ($outputUnFeat)";
				$res_UpdateUnFeatured = mysql_query($q_UpdateUnFeatured, $konekcija) or die("Greska upit UpdateUnFeatured!");
				
				mysql_close($konekcija);
			}
		}
		include("konekcija.php");
		
		$q_Users = "select u.id_user,u.username, u.state, ul.naziv_uloga from users u inner join uloge ul on u.id_uloga = ul.id_uloga order by ul.naziv_uloga ASC";
		$res_Users = mysql_query($q_Users, $konekcija) or die("Greska upit Users!");
		
		$time = mktime();
		$beginOfDay = strtotime("midnight", $time);
		$endOfDay   = strtotime("tomorrow", $beginOfDay) - 1;
		$q_ThreadsToday = "select * from threads t inner join users u on t.autor = u.id_user where t.vreme > $beginOfDay and t.vreme < $endOfDay order by t.vreme ASC";
		$res_ThreadsToday = mysql_query($q_ThreadsToday, $konekcija) or die("Greska upit ThreadsToday!");
		
		$q_PostsToday = "select * from posts p inner join users u on p.author = u.id_user
		where p.vreme > $beginOfDay and p.vreme < $endOfDay order by p.vreme ASC";
		$res_PostsToday = mysql_query($q_PostsToday, $konekcija) or die("Greska upit PostsToday!");
		
		$q_ReportedThreads = "select rt.id_report, t.id_thread, t.naziv_thread, rt.time, u.username, t.status
		from reported_threads rt inner join threads t on rt.id_thread = t.id_thread
		inner join users u on rt.by_who = u.id_user
		where rt.status = 'issued'";
		$res_ReportedThreads = mysql_query($q_ReportedThreads, $konekcija) or die("Greska upit ReportedThreads!");
		
		$q_ReportedPosts = "select rp.id_report, rp.id_post, rp.time, p.tekst, p.id_thread, p.author,u.username
		from reported_posts rp inner join posts p on rp.id_post = p.id_post
		inner join users u on rp.by_who = u.id_user
		where rp.status = 'issued'";
		$res_ReportedPosts = mysql_query($q_ReportedPosts, $konekcija) or die("Greska upit ReportedPosts!");
		
		$q_Sticky = "select rs.id_sticky, rs.status as state, t.naziv_thread, t.id_thread from request_sticky rs inner join threads t on rs.id_thread = t.id_thread
		where rs.status = 'requested'";
		$res_Sticky = mysql_query($q_Sticky, $konekcija) or die("Greska upit RequestSticky!");
		
		$q_Featured = "select t.naziv_thread, t.featured, t.id_thread
		from threads t inner join users u on t.autor = u.id_user
		inner join podkategorije podk on t.id_podkategorija = podk.id_podkategorija
		where u.id_uloga = 3 and podk.id_podkategorija != 10
		order by t.featured DESC";
		$res_Featued = mysql_query($q_Featured, $konekcija) or die("Greska upit Featured!");
		
		mysql_close($konekcija);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Forum - Panel</title>
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
			<div id="main-nav">
				<h1>Navigation</h1>
				<div class="separator-line"></div>
				<div id="nav-wrapper">
					<div class="nav-one"><a href="panel.php#allUsers"><i class="fa fa-users"></i> Users</a></div>
					<div class="nav-one"><a href="panel.php#threadsCreated"><i class="fa fa-pencil-square"></i> Created Threads </a></div>
					<div class="nav-one"><a href="panel.php#postsCreated"><i class="fa fa-pencil"></i> Created Posts </a></div>
					<div class="nav-one"><a href="panel.php#reportedThreads"><i class="fa fa-files-o"></i> Reported Threads</a></div>
					<div class="nav-one"><a href="panel.php#reportedPosts"><i class="fa fa-file-text-o"></i> Reported Posts</a></div>
					<div class="nav-one"><a href="panel.php#requestSticky"><i class="fa fa-sticky-note-o"></i> Request Sticky</a></div>
					<div class="nav-one"><a href="panel.php#featured"><i class="fa fa-foursquare"></i> Featured</a></div>
				</div>
			</div>
			<div id="main-posts">
				<div id="dashboard" class="details-wrapper-wide">
					<h1>Dashboard</h1>
					<div class="separator-line-wide"></div>
				</div>
				<div id="allUsers" class="details-wrapper-wide dashboard-item">
					<h2>All Users</h2>
					<div class="separator-line-wide"></div>
					<table>
						<thead>
							<tr><td>Name</td><td>State</td><td>Role</td><td>Action</td></tr>
						</thead>
						<tbody>
							<?php
								while($oneUser = mysql_fetch_array($res_Users))
								{
									echo "<tr>";
									echo "<td class='col-name'><a href='profile.php?username=".$oneUser["username"]."'>".$oneUser["username"]."</a></td>";
									echo "<td class='col-state'>".$oneUser["state"]."</td>";
									echo "<td class='col-role'>".$oneUser["naziv_uloga"]."</td>";
									echo "<td class='col-action'>
									<button name='disable' class='btnDisable disableUser' value='".$oneUser["id_user"]."'>Disable</button></td>";
									echo "</tr>";
								}
							?>
						</tbody>
					</table>
				</div>
				<div id="threadsCreated" class="details-wrapper-wide dashboard-item">
					<h2>Threads Created Today</h2>
					<div class="separator-line-wide"></div>
					<table>
						<thead>
							<tr><td>Title</td><td>Author</td><td>Status</td><td>Time</td><td>Action</td></tr>
						</thead>
						<tbody>
					<?php
						if(mysql_num_rows($res_ThreadsToday)>0)
						{
							while($oneThreadToday = mysql_fetch_array($res_ThreadsToday))
							{
								echo "<tr>";
								echo "<td class='col-name'><a href='thread.php?thread=".$oneThreadToday["id_thread"]."'>".substr($oneThreadToday["naziv_thread"], 0, 20)."</a></td>";
								echo "<td class='col-state'>".$oneThreadToday["username"]."</td>";
								echo "<td class=''>".$oneThreadToday["status"]."</td>";
								echo "<td class='col-role'>".date("H:i", $oneThreadToday["vreme"])."</td>";
								echo "<td class='col-action'>
								<button name='lock' class='btnDisable btnAction' value='".$oneThreadToday["id_thread"]."' data-item-type='thread'>Lock</button>
								<button name='delete' class='btnDisable btnAction' value='".$oneThreadToday["id_thread"]."' data-item-type='thread'>Delete</button>
								</td>";
								echo "</tr>";
							}
						}
						else
						{
							echo "<tr><td>No threads created today.</td><td></td><td></td><td></td><td></td></tr>";
						}
					?>
						</tbody>
					</table>
				</div>
				<div id="postsCreated" class="details-wrapper-wide dashboard-item">
					<h2>Posts Created Today</h2>
					<div class="separator-line-wide"></div>
					<table>
						<thead>
							<tr><td>Message</td><td>Author</td><td>Time</td><td>Action</td></tr>
						</thead>
						<tbody>
					<?php
						if(mysql_num_rows($res_PostsToday)>0)
						{
							while($onePostToday = mysql_fetch_array($res_PostsToday))
							{
								//jako bitno da skine sve html tagove!
								$tekst = substr(strip_tags($onePostToday["tekst"]), 0, 20);
								
								echo "<tr>";
								echo "<td class='col-name'><a href='thread.php?thread=".$onePostToday["id_thread"]."'>".$tekst."</a></td>";
								echo "<td class='col-state'>".$onePostToday["username"]."</td>";
								echo "<td class='col-role'>".date("H:i", $onePostToday["vreme"])."</td>";
								echo "<td class='col-action'>";
								echo "<button name='empty' class='btnDisable btnAction' value='".$onePostToday["id_post"]."' data-item-type='post'>Empty</button>
								<button name='delete' class='btnDisable btnAction' value='".$onePostToday["id_post"]."' data-item-type='post'>Delete</button></td>";
								echo "</tr>";
							}
						}
						else
						{
							echo "<tr><td>No posts created today.</td><td></td><td></td><td></td></tr>";
						}
					?>
						</tbody>
					</table>
				</div>
				<div id="reportedThreads" class="details-wrapper-wide dashboard-item">
					<h2>Reported Threads</h2>
					<div class="separator-line-wide"></div>
					<table>
						<thead>
							<tr><td>Title</td><td>Reported by</td><td>Status</td><td>Time</td><td>Action</td></tr>
						</thead>
						<tbody>
					<?php
						if(mysql_num_rows($res_ReportedThreads)>0)
						{
							while($oneReportedThread = mysql_fetch_array($res_ReportedThreads))
							{
								
								echo "<tr>";
								echo "<td class='col-name'><a href='thread.php?thread=".$oneReportedThread["id_thread"]."'>".$oneReportedThread["naziv_thread"]."</a></td>";
								echo "<td class='col-state'>".$oneReportedThread["username"]."</td>";
								echo "<td class=''>".$oneReportedThread["status"]."</td>";
								echo "<td class='col-role'>".date("d. M H:i", $oneReportedThread["time"])."</td>";
								echo "<td class='col-action'>
								<button name='lock' class='btnDisable btnAction' value='".$oneReportedThread["id_thread"]."' data-item-type='thread' data-item-reportid='".$oneReportedThread["id_report"]."'>Lock</button>
								<button name='delete' class='btnDisable btnAction' value='".$oneReportedThread["id_thread"]."' data-item-type='thread' data-item-reportid='".$oneReportedThread["id_report"]."'>Delete</button>
								<button name='dismiss' class='btnDismiss btnAction' value='".$oneReportedThread["id_thread"]."' data-item-type='thread' data-item-reportid='".$oneReportedThread["id_report"]."'>Dismiss</button></td>";
								echo "</tr>";
							}
						}
						else
						{
							echo "<tr><td>No reported threads.</td><td></td><td></td><td></td><td></td></tr>";
						}
					?>
						</tbody>
					</table>
				</div>
				<div id="reportedPosts" class="details-wrapper-wide dashboard-item">
					<h2>Reported Posts</h2>
					<div class="separator-line-wide"></div>
					<table>
						<thead>
							<tr><td>Message</td><td>Reported by</td><td>Time</td><td>Action</td></tr>
						</thead>
						<tbody>
					<?php
						if(mysql_num_rows($res_ReportedPosts)>0)
						{
							while($oneReportedPost = mysql_fetch_array($res_ReportedPosts))
							{
								//jako bitno da skine sve html tagove!
								$tekstReported = substr(strip_tags($oneReportedPost["tekst"]), 0, 20);
								
								echo "<tr>";
								echo "<td class='col-name'><a href='thread.php?thread=".$oneReportedPost["id_thread"]."'>".$tekstReported."</a></td>";
								echo "<td class='col-state'>".$oneReportedPost["username"]."</td>";
								echo "<td class='col-role'>".date("d. M H:i", $oneReportedPost["time"])."</td>";
								echo "<td class='col-action'>";
								echo "<button name='empty' class='btnDisable btnAction' value='".$oneReportedPost["id_post"]."' data-item-type='post' data-item-reportid='".$oneReportedPost["id_report"]."'>Empty</button>
								<button name='delete' class='btnDisable btnAction' value='".$oneReportedPost["id_post"]."' data-item-type='post' data-item-reportid='".$oneReportedPost["id_report"]."'>Delete</button>
								<button name='dismiss' class='btnDismiss btnAction' value='".$oneReportedPost["id_post"]."' data-item-type='post' data-item-reportid='".$oneReportedPost["id_report"]."'>Dismiss</button></td>";
								echo "</tr>";
							}
						}
						else
						{
							echo "<tr><td>No reported posts.</td><td></td><td></td><td></td></tr>";
						}
					?>
						</tbody>
					</table>
				</div>
				<div id="requestSticky" class="details-wrapper-wide dashboard-item">
					<h2>Request Sticky</h2>
					<div class="separator-line-wide"></div>
					<table>
						<thead>
							<tr><td>Title</td><td>State</td><td>Action</td></tr>
						</thead>
						<tbody>
					<?php
						if(mysql_num_rows($res_Sticky)>0)
						{
							while($oneSticky = mysql_fetch_array($res_Sticky))
							{
								echo "<tr>";
								echo "<td class='col-name'><a href='thread.php?thread=".$oneSticky["id_thread"]."'>".$oneSticky["naziv_thread"]."</a></td>";
								echo "<td class='col-name'>".$oneSticky["state"]."</td>";
								echo "<td class='col-action'>";
								echo "<button name='no' class='btnDisable btnRequest' value='".$oneSticky["id_sticky"]."'>Dont allow</button>";
								echo "<button name='allow' class='btnDismiss btnRequest' value='".$oneSticky["id_sticky"]."' data-threadid='".$oneSticky["id_thread"]."'>Allow</button>";
								echo "</td>";
								echo "</tr>";
							}
						}
						else
						{
							echo "<tr><td>No Sticky Requests</td><td></td><td></td></tr>";
						}
					?>
						</tbody>
					</table>
				</div>
				<div id="featured" class="details-wrapper-wide dashboard-item">
					<h2>Featured</h2>
					<div class="separator-line-wide"></div>
					<form action="panel.php" method="POST">
					<table>
						<thead>
							<tr><td>Title</td><td>Featured</td><td>Action</td></tr>
						</thead>
						<tbody>
					<?php
						if(mysql_num_rows($res_Featued)>0)
						{
							while($oneFeatured = mysql_fetch_array($res_Featued))
							{
								$isFeatured = $oneFeatured["featured"];
								
								echo "<tr>";
								echo "<td class='col-name'><a href='thread.php?thread=".$oneFeatured["id_thread"]."'>".$oneFeatured["naziv_thread"]."</a></td>";
								echo "<td class='col-name'>";
								if($isFeatured == 1)
								{
									echo "Yes";
								}
								else
								{
									echo "No";
								}
								echo "</td>";
								echo "<td class='col-action'>";
								if($isFeatured == 1)
								{
									echo "<input type='checkbox' id='cb".$oneFeatured["id_thread"]."' name='unfeat[]' value='".$oneFeatured["id_thread"]."' />
									<label for='cb".$oneFeatured["id_thread"]."'>Unfeat<label>";
								}
								else
								{
									echo "<input type='checkbox' id='cb".$oneFeatured["id_thread"]."' name='feat[]' value='".$oneFeatured["id_thread"]."' />
									<label for='cb".$oneFeatured["id_thread"]."'>Feat<label>";
								}
								echo "</td>";
								echo "</tr>";
							}
						}
						else
						{
							echo "<tr><td>No Featured threads!</td><td></td><td></td></tr>";
						}
					?>
						</tbody>
					</table>
					<div style="text-align: center; padding: 5px;"><input type="submit" name="change" value="change" /></div>
					</form>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<footer>
			<?php include("footer.php"); ?>
		</footer>
	</body>
</html>
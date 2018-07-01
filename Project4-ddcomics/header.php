<?php
	include("konekcija.php");
	$upit_links="select * from links order by weight";
	$rez_links=mysql_query($upit_links, $konekcija) or die("Greska upit linkovi! ".mysql_error());
?>
<div id="header">
	<div id="header-logo">
		<a href="index.php">
			<h1 id="logo">NwS <i class="fa  fa-laptop"></i></h1>
		</a>
	</div>
	<nav>
		<?php
			while($red=mysql_fetch_array($rez_links))
			{
				$id_link=$red["id_link"];
				
				echo "<div class='nav-link'>";
				echo "<a href='".$red["link_src"]."'>".$red["link_sadrzaj"]."</a>";
				
				$upit_sub="select * from sublinks s inner join links l on
				s.id_parent=l.id_link where s.id_parent=$id_link";
				$rez_sub=mysql_query($upit_sub, $konekcija) or die("Greska upit sublinks! ".mysql_error());
				
				if(mysql_num_rows($rez_sub)>0)
				{
					echo "<ul>";
					while($red2=mysql_fetch_array($rez_sub))
					{
						echo "<li>";
						echo "<a href='".$red2["sub_src"]."'>".$red2["sub_sadrzaj"]."</a>";
						echo "</li>";
					}
					echo "</ul>";
				}
				echo "</div>";
			}
			mysql_close($konekcija);
		?>
	</nav>
	<div id="header-login">
		<?php
			if(isset($_SESSION["id_user"]))
			{
				echo "<div class='login-link cart'>";
				echo "<a href='cart.php' title='Cart'>";
				echo "<i class='fa fa-shopping-cart'></i>";
				echo "</a>";
				echo "</div>";
				echo "<div class='login-link'>";
				if(isset($_SESSION["avatar"]))
				{
					echo "<div class='login-link-avatar'>";
					echo "<img src='".$_SESSION["avatar"]."' />";
					echo "</div>";
				}
				echo "<div class='login-link-username'>";
				echo "<a href='profile.php' title='Username'>".$_SESSION["username"]."</a>";
				echo "</div>";
				echo "</div>";
				echo "<div class='login-link'>";
				echo "<a href='logout.php'>Logout</a>";
				echo "</div>";
			}
			else
			{
				echo "<div class='login-link'>";
				echo "<a href='login.php'>Login</a>";
				echo "</div>";
			}
		?>
	</div>
	<div id="header-search">
		<form action="" method="" name="form-search" id="form-search">
			<input type="search" id="tbSearch" name="q" placeholder="Search New site" />
			<button type="submit" title="search" id="btnSearch" name="qsubmit" value="search">
				<i class="fa fa-search"></i>
			</button>
			<!--  <input type="submit" value="Search" id="btnSearch" name="qsubmit" /> -->
		</form>
	</div>
</div>
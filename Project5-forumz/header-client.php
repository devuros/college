<div id="header-client">
	<div id="client-logo">
		<a href="index.php"><i class="fa fa-database"></i> Forums</a>
	</div>
	<div id="client-links-wrapper">
		<div class="client-link">
			<?php
				if(!isset($_SESSION["id_user"]))
				{
					echo "<a href='login.php'><i class='fa fa-sign-in'></i> Sign in</a>";
				}
				else
				{
					echo "<a href='javascript:;'>".$_SESSION["username"]." <i class='fa fa-angle-down'></i></a>";
					echo "<div id='account' style='display: none;'>";
					
					if($_SESSION["uloga"]==3)
					{
						echo "<div class='acount-link'>";
						echo "<a href='panel.php'><i class='fa fa-edit'></i> Panel</a>";
						echo "</div>";
					}
					echo "<div class='acount-link'>";
					echo "<a href='profile.php'><i class='fa fa-cogs'></i> Account Setttings</a>";
					echo "</div>";
					echo "<div class='acount-link'>";
					echo "<a href='logout.php'><i class='fa fa-sign-out'></i> Log Out</a>";
					echo "</div>";
					echo "</div>";
				}
			?>
		</div>
	</div>
</div>
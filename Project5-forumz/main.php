<main>
	<div id="content-body">
		<?php
			include("konekcija.php");
			
			if(isset($_SESSION["id_user"]) and $_SESSION["uloga"]==3)
			{
				$q_agent="select * from kategorije where red=1";
				$rez_agent=mysql_query($q_agent, $konekcija) or die("Greska!");
			
				while($red_agent=mysql_fetch_array($rez_agent))
				{
					$id_kategorija=$red_agent["id_kategorija"];
					
					echo "<div class='category-wrapper'>";
					echo "<div class='category-title'>";
					echo "<i class='fa fa-minus-square-o'></i> ".$red_agent["naziv_kategorija"];
					echo "</div>";
					echo "<div class='category-toggle'>";
					
					$q_agent_podk="select * from podkategorije podk inner join kategorije k on podk.id_kategorija=k.id_kategorija
					where podk.id_kategorija=$id_kategorija";
					$rez_agent_podk=mysql_query($q_agent_podk, $konekcija) or die("Greska");
					
					while($red_agent_podk=mysql_fetch_array($rez_agent_podk))
					{
						$id_podkategorija=$red_agent_podk["id_podkategorija"];
						
						echo "<a href='subcat.php?subcat=".$id_podkategorija."'>";
						echo "<div class='category-sub'>";
						echo "<div class='sub-icon'>".$red_agent_podk["icon"]."</div>";
						echo "<div class='sub-title'>".ucwords($red_agent_podk["naziv_podkategorija"])."</div>";
						echo "<div class='sub-desc'>".$red_agent_podk["desc"]."</div>";
						echo "</div>";
						echo "</a>";
						
						echo "</div>";
						echo "</div>";
					}
				}
			}
			
			$q_kategorije="select * from kategorije where red!=1 order by red";
			$rez_kategorije=mysql_query($q_kategorije, $konekcija) or die("Greska");
			
			if(mysql_num_rows($rez_kategorije)>0)
			{
				while($red_kategorije=mysql_fetch_array($rez_kategorije))
				{
					$id_kategorija=$red_kategorije["id_kategorija"];
					
					echo "<div class='category-wrapper'>";
					echo "<div class='category-title'>";
					echo "<i class='fa fa-minus-square-o'></i> ".$red_kategorije["naziv_kategorija"];
					echo "</div>";
					echo "<div class='category-toggle'>";
					
					$q_podkategorije="select * from podkategorije podk inner join kategorije k on podk.id_kategorija=k.id_kategorija
					where podk.id_kategorija=$id_kategorija";
					$rez_podkategorije=mysql_query($q_podkategorije, $konekcija) or die("Greska");
					
					if(mysql_num_rows($rez_podkategorije)>0)
					{
						while($red_podkategorije=mysql_fetch_array($rez_podkategorije))
						{
							$id_podkategorija=$red_podkategorije["id_podkategorija"];
							
							echo "<a href='subcat.php?subcat=".$id_podkategorija."'>";
							echo "<div class='category-sub'>";
							echo "<div class='sub-icon'>".$red_podkategorije["icon"]."</div>";
							echo "<div class='sub-title'>".ucwords($red_podkategorije["naziv_podkategorija"])."</div>";
							echo "<div class='sub-desc'>".$red_podkategorije["desc"]."</div>";
							echo "</div>";
							echo "</a>";
						}
					}
					else
					{
						echo "No subcategories to show!";
					}
					echo "</div>";
					echo "</div>";
				}
			}
			mysql_close($konekcija);
		?>
	</div>
</main>
<aside>
	<div id="aside-content-wrapper">
		<div id="aside-title"><h5>POPULAR TOPICS</h5></div>
		<div id="aside-posts">
			<?php
				include("konekcija.php");
				
				$q_PopularTopics = "select * from threads t inner join podkategorije podk on
				t.id_podkategorija = podk.id_podkategorija order by postova DESC limit 10";
				$res_PopularTopics = mysql_query($q_PopularTopics, $konekcija) or die("Greksa popular topics!");
				
				while($oneTopic = mysql_fetch_array($res_PopularTopics))
				{
					echo "<a href='thread.php?thread=".$oneTopic["id_thread"]."'>";
					echo "<div class='aside-posts'>";
					echo "<span class='posts-name'>".$oneTopic["naziv_thread"]."</span><br/>";
					echo "<span class='posts-details'>".ucwords($oneTopic["naziv_podkategorija"])."</span>";
					echo "<span class='posts-time'> ".date("d/m/Y H:i", $oneTopic["vreme"])."</span>";
					echo "</div></a>";
				}
				mysql_close($konekcija);
			?>
		</div>
	</div>
</aside>
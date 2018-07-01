<div id="posts-title">
	<h6>FEATURED POSTS</h6>
</div>
<div id="mask-wrapper">
	<div id="mask">
		<div id="holder">
			<?php
				include("konekcija.php");
				
				//traze se samo THREAD-ovi koje je napisao admin i koji nisu u kategoriji samo za ADMINE.
				//i spaja te thread-ove sa prvim postom tj. TEKSTOM tog thread-a!
				$q_LatestPosts = "select t.id_thread, t.naziv_thread, t.vreme, podk.naziv_podkategorija, u.username, pp.tekst
				from threads t inner join podkategorije podk on t.id_podkategorija = podk.id_podkategorija
				inner join users u on t.autor = u.id_user
				inner join (select p.id_post, p.vreme, p.id_thread, p.tekst
				from posts p
				group by p.id_thread
				order by p.vreme ASC) pp on t.id_thread = pp.id_thread
				where u.id_uloga = 3 and podk.id_podkategorija != 10 and t.featured = 1
				order by t.vreme DESC
				limit 9";
				$res_LatestPosts = mysql_query($q_LatestPosts, $konekcija) or die("Greska latest Posts!");
				
				mysql_close($konekcija);
				
				$counter = 1;
				while($latestPost = mysql_fetch_array($res_LatestPosts))
				{
					$tekst = substr(strip_tags($latestPost["tekst"]), 0, 100);
					if($counter == 1)
					{
						echo "<div class='set'>";
					}
					echo "<a href='thread.php?thread=".$latestPost["id_thread"]."'>";
					echo "<div class='article-latest shadow'>";
					echo "<div class='article-latest-text'>".$tekst."</div>";
					echo "<div class='article-latest-desc'>".ucfirst($latestPost["username"])." ".date("d/m/Y", $latestPost["vreme"])." in <b>".$latestPost["naziv_podkategorija"]."</b>: ".$latestPost["naziv_thread"]."</div>";
					echo "</div>";
					echo "</a>";
					
					if($counter%3 == 0)
					{
						echo "</div>";
						$counter = 0;
					}
					$counter++;
				}
				if($counter != 1)
				{
					echo "</div>";
				}
			?>
		</div>
	</div>
	<div id="mask-left">
		<div id="left-arrow-div" style="display: none;">
			<i class="fa fa-caret-left"></i>
		</div>
	</div>
	<div id="mask-right">
		<div id="right-arrow-div" style="display: none;">
			<i class="fa fa-caret-right"></i>
		</div>
	</div>
</div>
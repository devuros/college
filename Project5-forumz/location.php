<span> <a href="index.php">Forums</a>
	<?php
		$putanja = $_SERVER["PHP_SELF"];
		$sve = explode("/", $putanja);
		$format = $sve[count($sve)-1];
		
		if($format == "subcat.php")
		{
			echo "<i class='fa fa-chevron-right'></i>";
			echo  " <a href='subcat.php?subcat=".$podk."'>".$imefull."</a>";
		}
		if($format == "thread.php")
		{
			$pkat = ucwords($red_thread_name["naziv_podkategorija"]);
			$idpkat = $red_thread_name["id_podkategorija"];
			$nziv = $red_thread_name["naziv_thread"];
			$tid = $red_thread_name["id_thread"];
			
			echo "<i class='fa fa-chevron-right'></i>";
			echo  " <a href='subcat.php?subcat=".$idpkat."'>".$pkat." </a>";
			echo "<i class='fa fa-chevron-right'></i>";
			echo  " <a href='thread.php?thread=".$tid."'>".$nziv."</a>";
		}
		if($format == "search.php")
		{
			echo "<i class='fa fa-chevron-right'></i>";
			echo  " <a href='search.php'>Search Results</a>";
		}
		if($format == "community.php")
		{
			echo "<i class='fa fa-chevron-right'></i>";
			echo  " <a href='community.php'>Community</a>";
		}
	?>
</span>
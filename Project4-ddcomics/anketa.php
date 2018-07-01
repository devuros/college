<?php
	if(isset($_POST["vote"]))
	{
		$glasanje=$_POST["glasanje"];
		
		include("konekcija.php");
		
		$upit_insert="insert into ankete_odgovori values ('', 1, $glasanje)";
		$rez_insert=mysql_query($upit_insert, $konekcija) or die("Greska upit INSERT! ".mysql_error());
		
		$upit_broj="select count(*) as za from ankete_odgovori where id_odgovor=$glasanje";
		$rez_broj=mysql_query($upit_broj, $konekcija) or die("greska upit ODGOVORI! ".mysql_error());
		$red_broj=mysql_fetch_array($rez_broj);
		
		$upit_svi="select count(ao.id_odgovor) as svi from ankete_odgovori ao inner join odgovori o on ao.id_odgovor=o.id_odgovor";
		$rez_svi=mysql_query($upit_svi, $konekcija) or die("greska upit SVI! ".mysql_error());
		$red_svi=mysql_fetch_array($rez_svi);
		
		$vrati1=$red_broj["za"];
		$vrati2=$red_svi["svi"];
		
		header("location: gallery.php?za=$vrati1&svi=$vrati2");
	}
?>
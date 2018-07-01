<!DOCTYPE html>
<html>
    <head>
        <?php
            echo "<title>".$title."</title>";
            
            echo meta("Content-type", "text/html; charset=utf-8", "equiv");
            echo meta("description", "Plantae is a site about Plants.");
            echo meta("keywords", "Alagae, flowers, trees, kingdom, species, phylum");
            echo meta("author", "Uroš Jovanović");
            
            echo link_tag("css/style.css");
            echo link_tag("font-awesome-4.5.0/css/font-awesome.css");
            echo link_tag("images/prava.ico", "shortcut icon", "image/ico");
        ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>script/jquery-3.0.0.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>script/myscript.js"></script>
    </head>
    <body>
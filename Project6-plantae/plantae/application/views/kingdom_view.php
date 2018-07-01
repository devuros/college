<?php
    $this->load->view("slider_view");
?>
<div id="main-kingdom" class="total-width left">
    <div id="class-div" class="site-width center">
        <div class="class-row site-width center">
            <div id="" class="kingdom-div-center center">
                <h2>Meaning</h2>
                <p>
                    In biology, kingdom (Latin: regnum, plural regna) is the second highest 
                    taxonomic rank below domain. Kingdoms are divided into smaller groups called 
                    phyla. Traditionally, textbooks from the United States used a system of six 
                    kingdoms (Animalia, Plantae, Fungi, Protista, Archaea/Archaeabacteria, and 
                    Bacteria/Eubacteria) while textbooks in Great Britain, India, Australia, 
                    Latin America and other countries used five kingdoms (Animalia, Plantae, Fungi, 
                    Protista and Monera). Some recent classifications based on modern cladistics 
                    have explicitly abandoned the term "kingdom", noting that the traditional 
                    kingdoms are not monophyletic, i.e., do not consist of all the descendants of a 
                    common ancestor.
                </p>
                <p>
                   When Carl Linnaeus introduced the rank-based system of nomenclature into biology 
                   in 1735, the highest rank was given the name "kingdom" and was followed by four 
                   other main or principal ranks: class, order, genus and species. Later two further 
                   main ranks were introduced, making the sequence kingdom, phylum or division, class, 
                   order, family, genus and species.
                </p>
            </div>
        </div>
    </div>
    <div id="pick-wrapper" class="total-width left">
        <div id="pick" class="site-width center">
            <?php
                echo "<div id='pick-heading' class='site-width'>";
                echo heading("<i class='fa fa-bookmark'></i> ".$image_first_title, 2);
                echo "</div>";
                
                echo "<div id='pick-content' class='site-width left'>";
                echo "<div id='pick-picture' class='left'>";
                echo img($image_first_src);
                echo "</div>";
                
                echo "<div id='pick-latest' class='right'>";
                echo "<div id='latest-heading'>Gallery list</div>";
                
                $cnt = 1;
                foreach($galleries as $gallery)
                {
                    echo "<div class='latest-item'>";
                    echo "<a href='#' class='gallery-link' data-gallery-id='".$gallery["gallery_id"]."'>";
                    echo "<div class='circle'>".$cnt."</div>";
                    echo $gallery["gallery_name"]."</a>";
                    echo "</div>";
                    $cnt++;
                }
                echo "</div>";
                echo "</div>";
                
                echo "<div id='pick-page' class='left'>";
                echo "<input type='hidden' id='image_data' "
                . "data-image-id='".$image_first_id."' "
                . "data-image-parent='".$image_first_parent."'"
                . "data-image-cur='".$cur."' />";
                echo "<p>";
                echo "<span class='rotate' id='prev' name='prev'>Previous</span>";
                echo "<span class='rotate' id='next' name='next'>Next</span>";
                echo "</p>";
                echo "</div>";
            ?>
        </div>
    </div>
    <div style="clear:both"></div>
    <div id="class-div" class="site-width center">
        <div class="class-row site-width center">
            <div id="" class="kingdom-div-center center">
                <h2>Current definitions of Plantae</h2>
                <p style="text-align: left; font-size: 14px;">
                   When the name Plantae or plant is applied to a specific group of organisms or 
                   taxon, it usually refers to one of four concepts. From least to most inclusive, 
                   these three groupings are:
                </p>
                <p style="font-size: 14px;">
                   <b>Plants in the strictest sense</b> include the liverworts, hornworts, mosses, 
                   and vascular plants, as well as fossil plants similar to these surviving groups 
                   (e.g., Metaphyta Whittaker, 1969, Plantae Margulis, 1971).
                </p>
                <p style="font-size: 14px;">
                   <b>Plants in a strict sense</b> include the green algae, and land plants that 
                   emerged within them, including stoneworts.   Viridiplantae encompass a group of
                   organisms that have cellulose in their cell walls, possess chlorophylls a and b
                   and have plastids that are bound by only two membranes that are capable of 
                   storing starch.
                </p>
                <p style="font-size: 14px;">
                   <b>Plants in a broad sense</b> comprise the green plants listed above plus 
                   Rhodophyta (red algae) and Glaucophyta (glaucophyte algae). This clade 
                   includes the organisms that eons ago acquired their chloroplasts directly by 
                   engulfing cyanobacteria.
                </p>
            </div>
        </div>
    </div>
</div>
<?php
    $this->load->view("slider_view");
?>
<div id="class-wrapper" class="total-width left">
    <div id="class-div" class="site-width center">
        <div class="class-row site-width center">
            <div id="" class="class-row-left left">
                <h2>About Flowers</h2>
                <p>
                    A flower, sometimes known as a bloom or blossom, is the reproductive structure 
                    found in plants that are floral (plants of the division Magnoliophyta, also 
                    called angiosperms). The biological function of a flower is to effect reproduction, 
                    usually by providing a mechanism for the union of sperm with eggs. Flowers may 
                    facilitate outcrossing (fusion of sperm and eggs from different individuals in a 
                    population) or allow selfing (fusion of sperm and egg from the same flower). Some 
                    flowers produce diaspores without fertilization (parthenocarpy).
                </p>
                <p>
                    Flowers contain sporangia and are the site where gametophytes develop. Many flowers 
                    have evolved to be attractive to animals, so as to cause them to be vectors for the transfer 
                    of pollen. After fertilization, the ovary of the flower develops into fruit 
                    containing seeds
                </p>
            </div>
            <div id="" class="class-row-right right">
                <img src="<?php echo base_url(); ?>/images/fla.jpg" style="height: 150px; float: right;" />
                <p style="margin-left: 50px; float: right; font-size: 12px;">Crateva religiosa - the sacred garlic pear</p>
            </div>
        </div>
    </div>
    <div id="class-div" class="site-width center">
        <div class="class-row site-width center">
            <div id="" class="class-row-left left">
                <h2>Pollination</h2>
                <p>
                    The primary purpose of a flower is reproduction. Since the flowers are the 
                    reproductive organs of plant, they mediate the joining of the sperm, contained 
                    within pollen, to the ovules - contained in the ovary. Pollination is the movement
                    of pollen from the anthers to the stigma. The joining of the sperm to the ovules 
                    is called fertilization. Normally pollen is moved from one plant to another, but 
                    many plants are able to self pollinate. The fertilized ovules produce seeds that 
                    are the next generation. Sexual reproduction produces genetically unique offspring,
                    allowing for adaptation. Flowers have specific designs which encourages the 
                    transfer of pollen from one plant to another of the same species. Many plants are 
                    dependent upon external factors for pollination, including: wind and animals, and 
                    especially insects. 
                </p>
            </div>
            <div id="" class="class-row-right right">
                <?php
                    $this->load->view("poll_view");
                ?>
            </div>
        </div>
    </div>
</div>
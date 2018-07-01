<?php
    $this->load->view("slider_view");
?>
<main class="total-width left">
    <!-- Category wrapper  -->
    <div id="category-wrapper" class="center">
        <?php
            foreach($klase as $klasa)
            {
                echo "<div class='category'>";
                echo "<a href='klass/index/".$klasa["class_id"]."'>";
                echo img($klasa["class_img"]);
                echo heading($klasa["class_name"], 3);
                echo "<p>".$klasa["class_text"]."</p>";
                echo "<div class='span'><span>find out more</span> &nbsp;<i class='fa fa-angle-right'></i></div>";
                echo "</a>";
                echo "</div>";
            }
        ?>
    </div>
    <div id="pick-wrapper" class="total-width left">
        <div id="pick" class="site-width center">
            <div id="pick-heading" class="site-width">
                <?php
                    echo heading("<i class='fa fa-bookmark'></i> Editor's Pick - Featured news", 2);
                ?>
            </div>
            <div id="pick-picture" class="left">
                <?php
                    echo "<a href='news/one/".$feat->news_id."' title='Read featured news'>";
                    echo "<div class='pic-icon'><i class='fa fa-camera'></i></div>";
                    echo "<div class='pic-title'>";
                    echo heading($feat->news_title, 2);
                    echo "</div>";
                    echo img($feat->class_img);
                    echo "</a>";
                ?>
            </div>
            <div id="pick-latest" class="right">
                <div id="latest-heading">Latest news</div>
                <?php
                    $cnt = 0;
                    foreach($top_five as $top)
                    {
                        $cnt++;
                        
                        echo "<div class='latest-item'>";
                        echo "<a href='news/one/".$top["news_id"]."'>";
                        echo "<div class='circle'>".$cnt."</div>".$top["news_title"];
                        echo "</a>";
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
    </div>
    <div id="thanks-wrapper" class="total-width left">
        <div id="thanks" class="site-width center">
            <p>Thanks for visiting the <?php echo anchor("", "Plantae") ?>.</p>
        </div>
    </div>
</main>
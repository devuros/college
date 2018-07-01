<?php
    $this->load->view("slider_view");
?>
<div id="main-news" class="total-width left">
    <div id="news-wrapper" class="site-width center">
        <?php
            foreach($klase as $klasa)
            {
                echo "<div class='news-class-wrapper left'>";
                
                echo "<div class='news-heading left'>";
                echo heading("&ndash; ".$klasa["class_name"], 1);
                echo "</div>";
                
                //stampanje svih vesti iz te klase/kategorije
                $class_id = $klasa["class_id"];
                echo "<div class='news-content left'>";
                foreach($news as $n)
                {
                    $news_class = $n["news_class"];
                    
                    if($news_class == $class_id)
                    {
                        echo "<a href='".base_url()."news/one/".$n["news_id"]."' title='Click me'>";
                        echo "<div class='news-one-wrapper'>";
                        
                        echo "<div class='no-left'>";
                        echo "<p>".date("d/M/Y ", $n["news_time"])."</p>";
                        echo "</div>";
                        
                        echo "<div class='no-right'>";
                        echo "<div class='one-title'>".$n["news_title"]."</div>";
                        echo "<div class='one-text'><p>".$n["news_text"]."</p></div>";
                        echo "</div>";
                        
                        echo "</div>";
                        echo "</a>";
                    }
                }
                echo "</div>";
                
                echo "<div class='news-page left'>";
                echo "</div>";
                
                echo "</div>";
            }
        ?>
    </div>
</div>
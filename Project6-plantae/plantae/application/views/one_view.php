<?php
    $this->load->view("slider_view");
?>
<div id="main-one" class="total-width left">
    <div id="picked-wrapper" class="total-width left">
        <div id="picked" class="site-width center">
            <div id="single-news-left" class="left">
                <div id="snl-class" class="left">
                    <?php
                        echo "<a href='".base_url()."news'>";
                        echo heading("In ".$news_class, 1);
                        echo "</a>";
                    ?>
                </div>
                <div id="snl-time" class="left">
                    <?php
                        echo $news_time;
                    ?>
                </div>
                <div id="snl-author" class="left">
                    <?php
                        echo "by ".ucfirst($news_author);
                    ?>
                </div>
            </div>
            <div id="single-news-right" class="right">
                <div id="snr-title" class="left">
                    <?php
                        echo heading($news_title, 1);
                    ?>
                </div>
                <div id="snr-text" class="left">
                    <p>
                    <?php
                        echo $news_text;
                    ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="comments-wrapper" class="total-width left">
        <div id="comments" class="site-width center">
            <?php
                $log = $this->session->userdata("cactus_log");
                if($log)
                {
                    echo form_open("news/comment");
                    echo form_hidden("tbId", $news_id);
                    echo "<div class='comment site-width left'>";
                    echo "<div class='comment-left right'>";
                    echo form_submit(array("name"=>"btnComment", "value"=>"Comment", "id"=>"btnComment"));
                    echo "</div>";

                    echo "<div class='comment-right left'>";
                    echo form_input(array("name"=>"tbComment", "class"=>"input-large", "placeholder"=>"Enter ...", "id"=>"tbComment"));
                    echo "</div>";
                    echo "</div>";
                    echo form_close();
                }
                
                
                if(isset($no))
                {
                    echo "<div class='comment site-width left'>";
                    
                    echo "<div class='comment-left left'>";
                    echo "<p>".$no."</p>";
                    echo "</div>";
                    
                    echo "<div class='comment-right right'><p>Be the first to post a comment</p></div>";
                    
                    echo "</div>";
                }
                if(isset($comments))
                {
                    foreach($comments as $comment)
                    {
                        echo "<div class='comment site-width left'>";
                    
                        echo "<div class='comment-left left'>";
                        echo "<p><span class='spanclr'>".$comment["user_nickname"]."</span><br/>".date("d/M/Y.", $comment["comment_time"])."<b> ".date("H:i", $comment["comment_time"])."</b></p>";
                        echo "</div>";

                        echo "<div class='comment-right right'>";
                        echo "<p>".$comment["comment_text"]."</p>";
                        echo "</div>";
                        
                        echo "</div>";
                    }
                }
            ?>
        </div>
    </div>
</div>
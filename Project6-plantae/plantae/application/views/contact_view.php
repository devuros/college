<?php
    $this->load->view("slider_view");
?>
<div id="main-contact" class="total-width left">
    <div id="contact-wrapper" class="site-width center">
        <div id="contact-left" class="left">
            <h4>We appreciate your opinion, tell us what you think</h4>
            <img src="<?php echo base_url(); ?>images/love.jpg" />
        </div>
        <div id="contact-right" class="right">
            <?php
                echo form_open("land/feedback");
                
                echo "<div class='row-large'>";
                echo heading("Contact us", 1);
                echo "</div>";
                echo "<div class='row-error'>";
                if(isset($mail))
                {
                    echo $mail;
                }
                echo "</div>";
                
                echo "<div class='row-large'>";
                echo form_input(array("name"=>"tbName", "class"=>"input-large", "placeholder"=>"Your name"));
                echo "</div>";
                echo "<div class='row-error'>".form_error("tbName")."</div>";
                
                echo "<div class='row-large'>";
                echo form_input(array("name"=>"tbEmail", "class"=>"input-large", "placeholder"=>"Email"));
                echo "</div>";
                echo "<div class='row-error'>".form_error("tbEmail")."</div>";
                
                echo "<div class='row-large'>";
                echo form_input(array("name"=>"tbSubject", "class"=>"input-large", "placeholder"=>"Subject"));
                echo "</div>";
                echo "<div class='row-error'>".form_error("tbSubject")."</div>";
                
                echo "<div class='row-large-ta'>";
                echo form_textarea(array("name"=>"taMessage", "id"=>"taMessage"));
                echo "</div>";
                echo "<div class='row-error'>".form_error("taMessage")."</div>";
                
                echo "<div class='row-large'>";
                echo form_submit(array("name"=>"btnSend", "value"=>"Send", "id"=>"btnLogin", "class"=>"input-large"));
                echo "</div>";
                
                echo form_close();
            ?>
        </div>
    </div>
</div>
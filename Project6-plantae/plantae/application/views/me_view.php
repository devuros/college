<div id="me-wrapper" class="total-width left">
    <div class="site-width center">
        <div id="me-pic">
            <img src="<?php echo base_url().$thumb; ?>" style="width: 200px; height: 200px;" />
        </div>
        <div id="me-email">
            <?php
                echo heading($email, 1);
            ?>
        </div>
        <div id="me-slider" class="site-width center"></div>
        <div id="me-nav" class="center"></div>
    </div>
    <div id="me-content" class="site-width center">
        <div id="me-content-left" class="left">
            <p>Change any of the information:</p><br/>
            <p>- Nickname</p>
            <p>- Password</p>
            <p>- Picture</p>
        </div>
        <div id="me-content-right" class="right">
            <?php
                echo form_open_multipart("me/audit");
                echo form_hidden("tbId", $id);
                
                echo "<div class='row-large'>";
                echo heading("Edit", 1);
                echo "</div>";
                echo "<div class='row-error'>";
                if(isset($update))
                {
                    echo $update;
                }
                echo "</div>";
                
                echo "<div class='row-large'>";
                echo form_input(array("name"=>"tbNickname", "class"=>"input-large", "placeholder"=>"Nickname", "title"=>"Please fill out this field."));
                echo "</div>";
                echo "<div class='row-error'>".form_error("tbNickname")."</div>";
                
                echo "<div class='row-large'>";
                echo form_password(array("name"=>"tbPassword", "class"=>"input-large", "placeholder"=>"Password", "title"=>"Please fill out this field."));
                echo "</div>";
                echo "<div class='row-error'>".form_error("tbPassword")."</div>";
                
                echo "<div class='row-large'>";
                echo form_password(array("name"=>"tbRePassword", "class"=>"input-large", "placeholder"=>"Confirm Password", "title"=>"Please fill out this field."));
                echo "</div>";
                echo "<div class='row-error'>".form_error("tbRePassword")."</div>";
                
                echo "<div class='row-large'>";
                echo form_upload(array("name"=>"tbImage", "class"=>"input-large", "id"=>"tbImage"));
                echo "</div>";
                echo "<div class='row-error'>";
                if(isset($image_error))
                {
                    echo $image_error;
                }
                echo "</div>";
                
                echo "<div class='row-large'>";
                echo form_submit(array("name"=>"btnEdit","value"=>"Change", "id"=>"btnLogin", "class"=>"input-large"));
                echo "</div>";
                
                echo form_close();
            ?>
        </div>
    </div>
</div>
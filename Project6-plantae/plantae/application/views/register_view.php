<div id="login-main" class="total-width left">
    <div id="login-wrapper" class="site-width center">
        <div id="register-content">
            <?php
                echo form_open("register/audit");
                
                echo "<div class='row-large' id='login-logo'>";
                echo anchor("", "<i class='fa fa-leaf'></i> Plantae", array("title"=>"Flora"));
                echo "</div>";
                
                echo "<div class='row-large'>";
                echo heading("Register with Plantae", 1);
                echo "</div>";
                echo "<div class='row-large'>";
                if(isset($reply))
                {
                    echo $reply;
                }
                echo "</div>";
                
                echo "<div class='row-large'>";
                echo form_input(array("name"=>"tbNickname", "class"=>"input-large", "placeholder"=>"Nickname", "title"=>"Please fill out this field."));
                echo "</div>";
                echo "<div class='row-error'>".form_error("tbNickname")."</div>";
                
                echo "<div class='row-large'>";
                echo form_input(array("name"=>"tbEmail", "class"=>"input-large", "placeholder"=>"Email", "title"=>"Please fill out this field."));
                echo "</div>";
                echo "<div class='row-error'>".form_error("tbEmail")."</div>";
                
                echo "<div class='row-large'>";
                echo form_password(array("name"=>"tbPassword", "class"=>"input-large", "placeholder"=>"Password", "title"=>"Please fill out this field."));
                echo "</div>";
                echo "<div class='row-error'>".form_error("tbPassword")."</div>";
                
                echo "<div class='row-large' id='terms'>By clicking Register you're accepting our Terms of Use, Privacy Policy, and Cookie Policy.</div>";
                
                echo "<div class='row-large'>";
                echo form_submit(array("name"=>"btnLogin","value"=>"Register", "id"=>"btnLogin", "class"=>"input-large"));
                echo "</div>";
                
                echo form_close();
            ?>
        </div>
    </div>
</div>
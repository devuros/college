<div id="login-main" class="total-width left">
    <div id="login-wrapper" class="site-width center">
        <div id="login-content">
            <?php
                echo form_open("login/audit");
                
                echo "<div class='row-large' id='login-logo'>";
                echo anchor("", "<i class='fa fa-leaf'></i> Plantae", array("title"=>"Flora"));
                echo "</div>";
                
                echo "<div class='row-large'>";
                echo heading("Sign in", 1);
                echo "</div>";
                echo "<div class='row-large'>";
                if(isset($missmatch))
                {
                    echo "<span style='color: darkred;'>".$missmatch."</span>";
                }
                echo "</div>";
                
                echo "<div class='row-large'>";
                echo form_input(array("name"=>"tbEmail", "class"=>"input-large", "placeholder"=>"Email", "title"=>"Please fill out this field."));
                echo "</div>";
                echo "<div class='row-error'>".form_error("tbEmail")."</div>";
                
                echo "<div class='row-large'>";
                echo form_password(array("name"=>"tbPassword", "class"=>"input-large", "placeholder"=>"Password", "title"=>"Please fill out this field."));
                echo "</div>";
                echo "<div class='row-error'>".form_error("tbPassword")."</div>";
                
                echo "<div class='row-large'>";
                echo form_submit(array("name"=>"btnLogin","value"=>"Sign in", "id"=>"btnLogin", "class"=>"input-large"));
                echo "</div>";

                echo form_close();
            ?>
        </div>
        <div id="login-extra">
            <div class="row-large">
                <?php
                    echo heading("Don't have an account yet?", 3);
                    echo "<p>".anchor("register/index", "Register now")."</p>";
                ?>
            </div>
        </div>
    </div>
</div>
<header class="total-width left">
    <div id="header" class="site-width center">
        <div id="header-logo" class="left">
            <?php
                echo anchor("", "<i class='fa fa-leaf'></i> Plantae", array("title"=>"Flora"));
            ?>
        </div>
        <div id="header-nav" class="left">
            <?php
                echo $meni;
            ?>
        </div>
        <div id="header-login" class="header-nav-box right">
            <?php
                $log = $this->session->userdata("cactus_log");
                if($log)
                {
                    $role = $this->session->userdata("cactus_role");
                    $nick = $this->session->userdata("cactus_nick");
                    
                    echo "<div id='header-login' class='header-nav-box right'>";
                    echo anchor("logout", "Sign out");
                    echo "</div>";
                    if($role == "editor")
                    {
                        echo "<div id='header-login' class='header-nav-box right'>";
                        echo anchor("editor", "Panel");
                        echo "</div>";
                    }
                    echo "<div id='header-login' class='header-nav-box right'>";
                    echo anchor("me/profile", ucfirst($nick));
                    echo "</div>";
                }
                else
                {
                    echo "<div id='header-login' class='header-nav-box right'>";
                    echo anchor("login", "Login");
                    echo "</div>";
                }
            ?>
        </div>
    </div>
</header>
    <footer class="total-width left">
        <div id="footer-top" class="site-width center">
            <div class="ul-wrapper left">
                <div class="ul-title">Site</div>
                <?php
                    $attr = array("class"=> "underline-hover");
                    $list_first = array(
                        anchor("land/kingdom", "Kingdom", $attr),
                        anchor("klass/index/1", "Class", $attr),
                        anchor("news/index", "News", $attr),
                    );
                    echo ul($list_first);
                ?>
            </div>
            <div class="ul-wrapper left">
                <div class="ul-title">Other</div>
                <?php
                    $list_second = array(
                        anchor("land/contact", "Contact", $attr),
                        anchor("land/creator", "Author", $attr),
                        anchor("land/doc", "Documentation", $attr)
                    );
                    echo ul($list_second);
                ?>
            </div>
        </div>
        <div id="footer-bottom" class="site-width center">
            <ul class="right">
                <li class="left pad-right-25"> <?php echo anchor("login", "Login", $attr); ?> </li>
                <li class="left pad-right-25"> <?php echo anchor("register", "Register", $attr); ?> </li>
                <li class="left pad-right-25"> <?php echo anchor("me/profile", "Edit profile", $attr); ?> </li>
                <li class="left">&copy; 2017 <?php echo anchor("land/creator", "Uroš Jovanović"); ?> </li>
            </ul>
        </div>
    </footer>
</body>
</html>
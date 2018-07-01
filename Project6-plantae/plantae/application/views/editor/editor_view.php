<div id="main-editor" class="total-width left">
    <div id="editor-wrapper" class="site-width center">
        <div id="editor-left" class="left">
            <?php
                $attr = "class='hedit'";
                $attribute = "class='htedit'";
                
                echo anchor("editor/users", heading("Users", 2, $attr));
                
                echo anchor("editor/classes", heading("Classes", 2, $attr));
                
                echo anchor("editor/news", heading("News", 2, $attr));
                
                echo anchor("editor/comments", heading("Comments", 2, $attr));
                
                echo heading("Galleries", 2, $attribute);
                echo anchor("editor/gallery", heading("&ndash; Gallery", 3, $attr));
                echo anchor("editor/gallery_images", heading("&ndash; Gallery images", 3, $attr));
                
                echo heading("Polls", 2, $attribute);
                echo anchor("editor/poll", heading("&ndash; poll", 3, $attr));
                echo anchor("editor/poll_options", heading("&ndash; poll options", 3, $attr));
                
                echo heading("Menus", 2, $attribute);
                echo anchor("editor/menu", heading("&ndash; menu", 3, $attr));
                echo anchor("editor/submenu", heading("&ndash; submenu", 3, $attr));
            ?>
        </div>
        <div id="editor-right" class="right">
            <p>Click the link in the side navigation</p>
        </div>
    </div>
</div>
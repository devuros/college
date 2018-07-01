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
            <?php
                //select
                echo heading("All menus", 2);
                $this->table->set_heading("Name", "Source", "Change", "Remove");
                foreach($all_menu as $menu)
                {
                    $id = $menu["menu_id"];
                    $name = $menu["menu_name"];
                    $src = $menu["menu_src"];
                    $edit_link = anchor("editor/menu/edit/".$id, "Edit");
                    $delete_link = anchor("editor/menu/delete/".$id, "Delete");
                    
                    $this->table->add_row($name, $src, $edit_link, $delete_link);
                }
                echo $this->table->generate();
                //insert
                echo heading("Insert", 2);
                echo form_open("editor/menu");
                
                echo form_label("Name: ");
                echo form_input("tbName").br(1);
                
                echo form_label("Source: ");
                echo form_input("tbSrc").br(1);
                
                echo form_submit("btnInsert", "Insert");
                echo form_close();
                echo validation_errors();
                
                //update
                if(isset($edit))
                {
                    echo heading("Update", 2);
                    echo form_open("editor/menu");
                    
                    echo form_hidden("tbId", $edit->menu_id);
                    
                    echo form_label("Name: ");
                    echo form_input("tbName", $edit->menu_name).br(1);
                    
                    echo form_label("Source: ");
                    echo form_input("tbSrc", $edit->menu_src).br(1);
                    
                    echo form_submit("btnUpdate", "Update");
                    echo form_close();
                    echo validation_errors();
                }
            ?>
        </div>
    </div>
</div>
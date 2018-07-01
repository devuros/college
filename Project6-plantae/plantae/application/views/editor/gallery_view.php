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
                echo heading("All galleries", 2);
                $this->table->set_heading("Name", "Change", "Remove");
                foreach($all_galleries as $gallery)
                {
                    $id = $gallery["gallery_id"];
                    $name = $gallery["gallery_name"];
                    $edit_link = anchor("editor/gallery/edit/".$id, "Edit");
                    $delete_link = anchor("editor/gallery/delete/".$id, "Delete");
                    
                    $this->table->add_row($name, $edit_link, $delete_link);
                }
                echo $this->table->generate();
                //insert
                echo heading("Insert", 2);
                echo form_open("editor/gallery");
                
                echo form_label("Name: ");
                echo form_input("tbName").br(1);
                
                echo form_submit("btnInsert", "Insert");
                echo form_close();
                echo validation_errors();
                
                //update
                if(isset($edit))
                {
                    echo heading("Update", 2);
                    echo form_open("editor/gallery");
                    
                    echo form_hidden("tbId", $edit->gallery_id);
                    
                    echo form_label("Name: ");
                    echo form_input("tbName", $edit->gallery_name).br(1);
                    
                    echo form_submit("btnUpdate", "Update");
                    echo form_close();
                    echo validation_errors();
                }
            ?>
        </div>
    </div>
</div>
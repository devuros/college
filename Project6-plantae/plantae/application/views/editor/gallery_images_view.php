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
                echo heading("All images", 2);
                $this->table->set_heading("Source", "Alt", "Title", "Parent(Gallery)", "Change", "Remove");
                foreach($all_images as $one_image)
                {
                    $id = $one_image["image_id"];
                    $src = $one_image["image_src"];
                    $alt = $one_image["image_alt"];
                    $title = $one_image["image_title"];
                    $parent = $one_image["gallery_name"];
                    
                    $edit_link = anchor("editor/gallery_images/edit/".$id, "Edit");
                    $delete_link = anchor("editor/gallery_images/delete/".$id, "Delete");
                    
                    $this->table->add_row($src, $alt, $title, $parent, $edit_link, $delete_link);
                }
                echo $this->table->generate();
                //insert
                echo heading("Insert", 2);
                echo form_open_multipart("editor/gallery_images");
                
                echo form_label("Image: ");
                echo form_upload("tbImage").br(1);
                if(isset($image_error))
                {
                    echo "<span style='color: red;'>".$image_error."</span>";
                }
                
                echo form_label("Alt: ");
                echo form_input("tbAlt").br(1);
                
                echo form_label("Title: ");
                echo form_input("tbTitle").br(1);
                
                echo form_label("Parent(Gallery): ");
                echo form_dropdown("ddlParent", $dll_parents).br(1);
                
                echo form_submit("btnInsert", "Insert");
                echo form_close();
                echo validation_errors();
                
                //update
                if(isset($edit))
                {
                    echo heading("Update", 2);
                    echo form_open_multipart("editor/gallery_images");
                    
                    echo form_hidden("tbId", $edit->image_id);
                    
                    echo form_label("Image: ");
                    echo form_upload("tbImage").br(1);

                    echo form_label("Alt: ");
                    echo form_input("tbAlt", $edit->image_alt).br(1);

                    echo form_label("Title: ");
                    echo form_input("tbTitle", $edit->image_title).br(1);

                    echo form_label("Parent(Gallery): ");
                    echo form_dropdown("ddlParent", $dll_parents).br(1);
                    
                    
                    echo form_submit("btnUpdate", "Update");
                    echo form_close();
                    echo validation_errors();
                }
            ?>
        </div>
    </div>
</div>
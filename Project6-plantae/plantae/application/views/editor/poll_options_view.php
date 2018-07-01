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
                echo heading("All poll options", 2);
                $this->table->set_heading("Text", "Parent(Poll)","Change", "Remove");
                foreach($all_options as $option)
                {
                    $id = $option["option_id"];
                    $text = $option["option_text"];
                    $parent = $option["poll_name"];
                    $edit_link = anchor("editor/poll_options/edit/".$id, "Edit");
                    $delete_link = anchor("editor/poll_options/delete/".$id, "Delete");
                    
                    $this->table->add_row($text, $parent, $edit_link, $delete_link);
                }
                echo $this->table->generate();
                //insert
                echo heading("Insert", 2);
                echo form_open("editor/poll_options");
                
                echo form_label("Text: ");
                echo form_input("tbText").br(1);
                
                echo form_label("Parent: ");
                echo form_dropdown("ddlParent", $ddlParent).br(1);
                
                echo form_submit("btnInsert", "Insert");
                echo form_close();
                echo validation_errors();
                
                //update
                if(isset($edit))
                {
                    echo heading("Update", 2);
                    echo form_open("editor/poll_options");
                    
                    echo form_hidden("tbId", $edit->option_id);
                    
                    echo form_label("Text: ");
                    echo form_input("tbText", $edit->option_text).br(1);

                    echo form_label("Parent: ");
                    echo form_dropdown("ddlParent", $ddlParent).br(1);
                    
                    echo form_submit("btnUpdate", "Update");
                    echo form_close();
                    echo validation_errors();
                }
            ?>
        </div>
    </div>
</div>
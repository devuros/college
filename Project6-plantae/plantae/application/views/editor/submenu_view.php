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
                echo heading("All submenus", 2);
                $this->table->set_heading("Name", "Source", "Parent(menu_Link)", "Class", "Change", "Remove");
                foreach($all_submenu as $submenu)
                {
                    $id = $submenu["submenu_id"];
                    $name = $submenu["submenu_name"];
                    $src = $submenu["submenu_src"];
                    $parent = $submenu["menu_name"];
                    $class = $submenu["class_name"];
                    if($class==null)
                    {
                        $class = "none";
                    }
                    
                    $edit_link = anchor("editor/submenu/edit/".$id, "Edit");
                    $delete_link = anchor("editor/submenu/delete/".$id, "Delete");
                    
                    $this->table->add_row($name, $src, $parent, $class, $edit_link, $delete_link);
                }
                echo $this->table->generate();
                //insert
                echo heading("Insert", 2);
                echo form_open("editor/submenu");
                
                echo form_label("Name: ");
                echo form_input("tbName").br(1);
                
                echo form_label("Source: ");
                echo form_input("tbSrc").br(1);
                
                echo form_label("Parent: ");
                echo form_dropdown("ddlParent", $ddlParent).br(1);
                
                echo form_label("Class (if any): ");
                echo form_dropdown("ddlClass", $ddlClass).br(1);
                
                echo form_submit("btnInsert", "Insert");
                echo form_close();
                echo validation_errors();
                
                //update
                if(isset($edit))
                {
                    echo heading("Update", 2);
                    echo form_open("editor/submenu");
                    
                    echo form_hidden("tbId", $edit->submenu_id);
                    
                    echo form_label("Name: ");
                    echo form_input("tbName", $edit->submenu_name).br(1);

                    echo form_label("Source: ");
                    echo form_input("tbSrc", $edit->submenu_src).br(1);

                    echo form_label("Parent: ");
                    echo form_dropdown("ddlParent", $ddlParent).br(1);

                    echo form_label("Class (if any): ");
                    echo form_dropdown("ddlClass", $ddlClass).br(1);
                    
                    echo form_submit("btnUpdate", "Update");
                    echo form_close();
                    echo validation_errors();
                }
            ?>
        </div>
    </div>
</div>
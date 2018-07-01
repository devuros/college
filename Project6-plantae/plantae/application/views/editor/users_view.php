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
                echo heading("All users", 2);
                $this->table->set_heading("Nick", "Email", "Role", "Change", "Remove");
                foreach($all_users as $user)
                {
                    $id = $user["user_id"];
                    $nick = $user["user_nickname"];
                    $email = $user["user_email"];
                    $role = $user["user_role"];
                    $edit_link = anchor("editor/users/edit/".$id, "Edit");
                    $delete_link = anchor("editor/users/delete/".$id, "Delete");
                    
                    $this->table->add_row($nick, $email, $role, $edit_link, $delete_link);
                }
                echo $this->table->generate();
                //insert
                echo heading("Insert", 2);
                echo form_open("editor/users");
                
                echo form_label("Nick");
                echo form_input("tbNick", "").br(1);
                
                echo form_label("Email");
                echo form_input("tbEmail", "").br(1);
                
                echo form_label("Password");
                echo form_password("tbPassword", "").br(1);
                
                echo form_label("Role");
                echo form_dropdown("ddlRole", $all_roles).br(1);
                
                echo form_submit("btnInsert", "Insert");
                echo form_close();
                echo validation_errors();
                
                //update
                if(isset($edit))
                {
                    echo heading("Update", 2);
                    echo form_open("editor/users");
                    
                    echo form_hidden("tbId", $edit->user_id);
                    
                    echo form_label("Nick");
                    echo form_input("tbNick", $edit->user_nickname).br(1);

                    echo form_label("Email");
                    echo form_input("tbEmail", $edit->user_email).br(1);

                    echo form_label("Password");
                    echo form_password("tbPassword", "").br(1);

                    echo form_label("Role");
                    echo form_dropdown("ddlRole", $all_roles).br(1);
                    
                    echo form_submit("btnUpdate", "Update");
                    echo form_close();
                    echo validation_errors();
                }
            ?>
        </div>
    </div>
</div>
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
                echo heading("All comments", 2);
                $this->table->set_heading("Text", "Author", "Time", "Parent", "Change", "Remove");
                foreach($all_comments as $comment)
                {
                    $id = $comment["comment_id"];
                    $text = substr($comment["comment_text"], 0, 10);
                    $author = $comment["user_nickname"];
                    $time = date("d/M", $comment["comment_time"]);
                    $parent = $comment["news_title"];
                    $edit_link = anchor("editor/comments/edit/".$id, "Edit");
                    $delete_link = anchor("editor/comments/delete/".$id, "Delete");
                    
                    $this->table->add_row($text, $author, $time, $parent, $edit_link, $delete_link);
                }
                echo $this->table->generate();
                //insert
                echo heading("Insert", 2);
                echo form_open("editor/comments");
                
                echo form_label("Parent (news)");
                echo form_dropdown("ddlParent", $ddlParent).br(1);
                echo form_textarea("taComment", "").br(1);
                
                echo form_submit("btnInsert", "Insert");
                echo form_close();
                echo validation_errors();
                
                //update
                if(isset($edit))
                {
                    echo heading("Update", 2);
                    echo form_open("editor/comments");
                    
                    echo form_hidden("tbId", $edit->comment_id);

                    echo form_textarea("taComment", $edit->comment_text).br(1);
                    
                    echo form_submit("btnUpdate", "Update");
                    echo form_close();
                    echo validation_errors();
                }
            ?>
        </div>
    </div>
</div>
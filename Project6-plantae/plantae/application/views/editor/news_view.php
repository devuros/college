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
                echo heading("All news", 2);
                $this->table->set_heading("Title", "Text", "Author", "Time", "Class", "Feat", "Change", "Remove");
                foreach($all_news as $news)
                {
                    $id = $news["news_id"];
                    $title = $news["news_title"];
                    $text = substr($news["news_text"], 0, 10);
                    $author = $news["user_nickname"];
                    $time = date("d/M", $news["news_time"]);
                    $class= $news["class_name"];
                    $feat = $news["news_feat"];
                    if($feat == 1)
                    {
                        $feat = "<a href='".base_url()."editor/news/feat/".$id."' title='Click to FEAT'>Yes</a>";
                    }
                    else
                    {
                        $feat = "<a href='".base_url()."editor/news/feat/".$id."' title='Click to FEAT'>No</a>";
                    }
                    $edit_link = anchor("editor/news/edit/".$id, "Edit");
                    $delete_link = anchor("editor/news/delete/".$id, "Delete");
                    
                    $this->table->add_row($title, $text, $author, $time, $class, $feat, $edit_link, $delete_link);
                }
                echo $this->table->generate();
                //insert
                echo heading("Insert", 2);
                echo form_open("editor/news");
                
                echo form_label("Title");
                echo form_input("tbTitle", "").br(1);
                
                echo form_textarea("taText", "").br(1);
                
                echo form_label("Class");
                echo form_dropdown("ddlClass", $ddl).br(1);
                
                echo form_submit("btnInsert", "Insert");
                echo form_close();
                echo validation_errors();
                
                //update
                if(isset($edit))
                {
                    echo heading("Update", 2);
                    echo form_open("editor/news");
                    
                    echo form_hidden("tbId", $edit->news_id);
                    
                    echo form_label("Title");
                    echo form_input("tbTitle", $edit->news_title).br(1);

                    echo form_textarea("taText", $edit->news_text).br(1);

                    echo form_label("Class");
                    echo form_dropdown("ddlClass", $ddl).br(1);
                    
                    echo form_submit("btnUpdate", "Update");
                    echo form_close();
                    echo validation_errors();
                }
            ?>
        </div>
    </div>
</div>
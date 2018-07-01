<?php

class editor extends prime {
    
    public function __construct()
    {
        parent::__construct();
        
        $log = $this->session->userdata("cactus_log");
        $role = $this->session->userdata("cactus_role");
        if($log != true || $role!="editor")
        {
            redirect();
        }
        $this->load->library("table");
        
        $this->load->model("user_model");
        $this->load->model("class_model");
        $this->load->model("news_model");
        $this->load->model("comment_model");
        $this->load->model("gallery_model");
        $this->load->model("poll_model");
        $this->load->model("menu_model");
    }
    
    public function index()
    {
        $input["title"] = "Editor panel - start";
        $this->set_view("editor/editor_view", $input);
    }
    
    public function users($action = null, $id = null)
    {
        $btnInsert = $this->input->post("btnInsert");
        $btnUpdate = $this->input->post("btnUpdate");
        
        if($btnInsert == "Insert")
        {
            $this->form_validation->set_rules("tbNick", "Nickname", "required|trim|min_length[4]");
            $this->form_validation->set_rules("tbEmail", "Email", "required|trim|valid_email");
            $this->form_validation->set_rules("tbPassword", "Password", "required|trim|min_length[4]");
            
            if($this->form_validation->run() == false)
            {
                $input["title"] = "Editor panel - users";
                $all_users = $this->user_model->all_users();
                $input["all_users"] = $all_users;
                $niz_roles = array("user"=>"user", "editor"=>"editor");
                $input["all_roles"] = $niz_roles;

                $this->set_view("editor/users_view", $input);
            }
            else 
            {
                $insert_id = null;
                $insert_nick = $this->input->post("tbNick");
                $insert_email = $this->input->post("tbEmail");
                $insert_pass = md5($this->input->post("tbPassword"));
                $insert_role = $this->input->post("ddlRole");
                
                $niz_insert_user = array(
                    "user_id"=> $insert_id,
                    "user_nickname"=> $insert_nick,
                    "user_email"=> $insert_email,
                    "user_password"=> $insert_pass,
                    "user_role"=> $insert_role
                );
                $this->user_model->register($niz_insert_user);
            }
        }
        if($btnUpdate == "Update")
        {
            $this->form_validation->set_rules("tbNick", "Nickname", "required|trim|min_length[4]");
            $this->form_validation->set_rules("tbEmail", "Email", "required|trim|valid_email");
            $this->form_validation->set_rules("tbPassword", "Password", "trim|min_length[4]");
            
            $update_id = $this->input->post("tbId");
            
            if($this->form_validation->run() == false)
            {
                $niz_user = array("user_id"=> $update_id);
                $user = $this->user_model->profile($niz_user);

                $input["title"] = "Editor panel - users";

                $all_users = $this->user_model->all_users();
                $input["all_users"] = $all_users;

                $niz_roles = array("user"=>"user", "editor"=>"editor");
                $input["all_roles"] = $niz_roles;

                $input["edit"] = $user;
                $this->set_view("editor/users_view", $input);
            }
            else 
            {
                $update_nick = $this->input->post("tbNick");
                $update_email = $this->input->post("tbEmail");
                $update_pass = $this->input->post("tbPassword");
                $update_role = $this->input->post("ddlRole");
                
                $niz_update_user = array(
                    "user_nickname"=> $update_nick,
                    "user_email"=> $update_email,
                    "user_role"=> $update_role
                );
                if(!empty($update_pass))
                {
                    $update_pass = md5($update_pass);
                    $niz_update_user["user_pass"] = $update_pass;
                }
                $this->user_model->edit($niz_update_user, $update_id);
            }
        }
        
        if($action==null && $id==null)
        {
            $input["title"] = "Editor panel - users";

            $all_users = $this->user_model->all_users();
            $input["all_users"] = $all_users;

            $niz_roles = array("user"=>"user", "editor"=>"editor");
            $input["all_roles"] = $niz_roles;

            $this->set_view("editor/users_view", $input);
        }
        if($action=="delete" && $id!=null)
        {
            $niz_user = array("user_id"=> $id);
            $this->user_model->remove_user($niz_user);
            
            redirect("editor/users");
        }
        if($action=="edit" && $id!=null)
        {
            $niz_user = array("user_id"=> $id);
            $user = $this->user_model->profile($niz_user);
            
            $input["title"] = "Editor panel - users";

            $all_users = $this->user_model->all_users();
            $input["all_users"] = $all_users;

            $niz_roles = array("user"=>"user", "editor"=>"editor");
            $input["all_roles"] = $niz_roles;
            
            $input["edit"] = $user;
            $this->set_view("editor/users_view", $input);
        }
    }
    
    public function classes($action = null, $id = null)
    {
        $btnInsert = $this->input->post("btnInsert");
        $btnUpdate = $this->input->post("btnUpdate");
        $fajl = "tbImage";
        
        if($btnInsert == "Insert")
        {
            $this->form_validation->set_rules("tbName", "Name", "required|trim|min_length[4]");
            $this->form_validation->set_rules("tbText", "Text", "required|trim|min)length[3]");
            $this->form_validation->set_rules("tbView", "View", "required|trim|min)length[3]");
            
            if($this->form_validation->run() == false)
            {
                $input["title"] = "Editor panel - Classes";

                $all_classes = $this->class_model->klase();
                $input["all_classes"] = $all_classes;

                $this->set_view("editor/classes_view", $input);
            }
            else
            {
                $insert_id = null;
                $insert_name = $this->input->post("tbName");
                $insert_text = $this->input->post("tbText");
                $insert_view = $this->input->post("tbView");
                
                $config["upload_path"] = "./images";
                $config["allowed_types"] = "jpg|png|jpeg";
                $this->load->library("upload", $config);
            
                if(!$this->upload->do_upload($fajl))
                {
                    $input["image_error"] = $this->upload->display_errors();
                    $input["title"] = "Editor panel - Classes";

                    $all_classes = $this->class_model->klase();
                    $input["all_classes"] = $all_classes;

                    $this->set_view("editor/classes_view", $input);
                }
                else
                {
                    $data = array("upload_image"=>$this->upload->data());
                    $image_path = "images/".$data["upload_image"]["file_name"];
                    
                    $niz_insert_class = array(
                        "class_id"=> $insert_id,
                        "class_name"=> $insert_name,
                        "class_img"=> $image_path,
                        "class_text"=> $insert_text,
                        "class_view"=> $insert_view
                    );
                    $this->class_model->unos($niz_insert_class);
                }
            }
        }
        if($btnUpdate == "Update")
        {
            $this->form_validation->set_rules("tbName", "Name", "required|trim|min_length[3]");
            $this->form_validation->set_rules("tbText", "Text", "required|trim|min_length[5]");
            $this->form_validation->set_rules("tbPassword", "Password", "trim|min_length[4]");
            
            $update_id = $this->input->post("tbId");
            
            if($this->form_validation->run() == false)
            {
                $jedna_klasa = $this->class_model->klasa($update_id);
                $input["title"] = "Editor panel - Classes";

                $all_classes = $this->class_model->klase();
                $input["all_classes"] = $all_classes;

                $input["edit"] = $jedna_klasa;
                $this->set_view("editor/classes_view", $input);
            }
            else 
            {
                $update_name = $this->input->post("tbName");
                $update_text = $this->input->post("tbText");
                $update_view = $this->input->post("tbView");
                
                $niz_update_class = array(
                    "class_name"=> $update_name,
                    "class_text"=> $update_text,
                    "class_view"=> $update_view
                );
                
                $config["upload_path"] = "./images";
                $config["allowed_types"] = "jpg|png|jpeg";
                $this->load->library("upload", $config);
            
                if(!$this->upload->do_upload($fajl))
                {
                    
                }
                else
                {
                    $data = array("upload_image"=>$this->upload->data());
                    $image_path = "images/".$data["upload_image"]["file_name"];
                    $niz_update_class["class_img"] = $update_name;
                }
                $this->class_model->edit($niz_update_class, $update_id);
            }
        }
        if($action==null && $id==null)
        {
            $input["title"] = "Editor panel - Classes";

            $all_classes = $this->class_model->klase();
            $input["all_classes"] = $all_classes;

            $this->set_view("editor/classes_view", $input);
        }
        if($action=="edit" && $id!=null)
        {
            $jedna_klasa = $this->class_model->klasa($id);
            $input["title"] = "Editor panel - Classes";
            
            $all_classes = $this->class_model->klase();
            $input["all_classes"] = $all_classes;
            
            $input["edit"] = $jedna_klasa;
            $this->set_view("editor/classes_view", $input);
        }
        if($action=="delete" && $id!=null)
        {
            $niz_delete_class = array("class_id"=> $id);
            $this->class_model->remove_class($niz_delete_class);
            
            redirect("editor/classes");
        }
        
    }
    
    
    public function news($action = null, $id = null)
    {
        $btnInsert = $this->input->post("btnInsert");
        $btnUpdate = $this->input->post("btnUpdate");
        
        if($btnInsert == "Insert")
        {
            $this->form_validation->set_rules("tbTitle", "Title", "required|trim|min_length[4]");
            $this->form_validation->set_rules("taText", "Text", "required|trim|min)length[5]");
            
            if($this->form_validation->run() == false)
            {
                $input["title"] = "Editor panel - News";

                $all_news = $this->news_model->all_news();
                $input["all_news"] = $all_news;

                $klasses = $this->class_model->klase();
                $klasse_niz = array();
                foreach($klasses as $klass)
                {
                    $klass_id = $klass["class_id"];
                    $klass_name = $klass["class_name"];
                    $klasse_niz[$klass_id] = $klass_name;
                }
                $input["ddl"] = $klasse_niz;

                $this->set_view("editor/news_view", $input);
            }
            else 
            {
                $insert_id = null;
                $insert_title = $this->input->post("tbTitle");
                $insert_text = $this->input->post("taText");
                $insert_author = $this->session->userdata("cactus_id");
                $insert_time = time();
                $insert_class = $this->input->post("ddlClass");
                $insert_feat = 0;
                
                $niz_insert_news = array(
                    "news_id"=> $insert_id,
                    "news_title"=> $insert_title,
                    "news_text"=> $insert_text,
                    "news_author"=> $insert_author,
                    "news_time"=> $insert_time,
                    "news_class"=> $insert_class,
                    "news_feat"=> $insert_feat 
                );
                $this->news_model->unos($niz_insert_news);
            }
        }
        if($btnUpdate == "Update")
        {
            $this->form_validation->set_rules("tbTitle", "Title", "required|trim|min_length[4]");
            $this->form_validation->set_rules("taText", "Text", "required|trim|min)length[5]");
            
            $update_id = $this->input->post("tbId");
            
            if($this->form_validation->run() == false)
            {
                $input["title"] = "Editor panel - News";

                $all_news = $this->news_model->all_news();
                $input["all_news"] = $all_news;

                $klasses = $this->class_model->klase();
                $klasse_niz = array();
                foreach($klasses as $klass)
                {
                    $klass_id = $klass["class_id"];
                    $klass_name = $klass["class_name"];
                    $klasse_niz[$klass_id] = $klass_name;
                }
                $input["ddl"] = $klasse_niz;

                $this->set_view("editor/news_view", $input);
            }
            else 
            {
                $update_title = $this->input->post("tbTitle");
                $update_text = $this->input->post("taText");
                $update_class = $this->input->post("ddlClass");
                
                $niz_update_news = array(
                    "news_title"=> $update_title,
                    "news_text"=> $update_text,
                    "news_class"=> $update_class
                );
                $this->news_model->update_news($niz_update_news, $update_id);
            }
        }
        if($action=="feat" && $id!=null)
        {
            $this->news_model->remove_feat();
            $this->news_model->set_feat($id);
            
            $input["title"] = "Editor panel - News";

            $all_news = $this->news_model->all_news();
            $input["all_news"] = $all_news;
            
            $klasses = $this->class_model->klase();
            $klasse_niz = array();
            foreach($klasses as $klass)
            {
                $klass_id = $klass["class_id"];
                $klass_name = $klass["class_name"];
                $klasse_niz[$klass_id] = $klass_name;
            }
            $input["ddl"] = $klasse_niz;

            $this->set_view("editor/news_view", $input);
        }
        if($action==null && $id==null)
        {
            $input["title"] = "Editor panel - News";

            $all_news = $this->news_model->all_news();
            $input["all_news"] = $all_news;
            
            $klasses = $this->class_model->klase();
            $klasse_niz = array();
            foreach($klasses as $klass)
            {
                $klass_id = $klass["class_id"];
                $klass_name = $klass["class_name"];
                $klasse_niz[$klass_id] = $klass_name;
            }
            $input["ddl"] = $klasse_niz;

            $this->set_view("editor/news_view", $input);
        }
        if($action=="delete" && $id!=null)
        {
            $niz_remove_news = array("news_id"=> $id);
            $this->news_model->remove_news($niz_remove_news);
            
            redirect("editor/news");
        }
        if($action=="edit" && $id!=null)
        {
            $niz_edit_news = array("news_id"=> $id);
            $news = $this->news_model->single_news($niz_edit_news);
            
            $input["title"] = "Editor panel - News";

            $all_news = $this->news_model->all_news();
            $input["all_news"] = $all_news;
            
            $klasses = $this->class_model->klase();
            $klasse_niz = array();
            foreach($klasses as $klass)
            {
                $klass_id = $klass["class_id"];
                $klass_name = $klass["class_name"];
                $klasse_niz[$klass_id] = $klass_name;
            }
            $input["ddl"] = $klasse_niz;
            
            $input["edit"] = $news;
            $this->set_view("editor/news_view", $input);
        }
    }
    
    public function comments($action = null, $id = null)
    {
        $btnInsert = $this->input->post("btnInsert");
        $btnUpdate = $this->input->post("btnUpdate");
        
        if($btnInsert == "Insert")
        {
            $this->form_validation->set_rules("taComment", "Comment", "required|trim|min_length[5]");
            
            if($this->form_validation->run() == false)
            {
                $input["title"] = "Editor panel - Comments";

                $all_comments = $this->comment_model->all_comments();
                $input["all_comments"] = $all_comments;
                
                $adns = $this->news_model->news();
                $ddlParent = array();
                foreach($adns as $adn)
                {
                    $value = $adn["news_id"];
                    $txt = $adn["news_title"];
                    $ddlParent[$value] = $txt;
                }
                $input["ddlParent"] = $ddlParent;

                $this->set_view("editor/comments_view", $input);
            }
            else 
            {
                $insert_id = null;
                $insert_text = $this->input->post("taComment");
                $insert_author = $this->session->userdata("cactus_id");
                $insert_time = time();
                $insert_parent = $this->input->post("ddlParent");
                
                $niz_insert_comment = array(
                    "comment_id"=> $insert_id,
                    "comment_text"=> $insert_text,
                    "comment_author"=> $insert_author,
                    "comment_time"=> $insert_time,
                    "comment_parent"=> $insert_parent
                );
                $this->comment_model->comment($niz_insert_comment);
            }
        }
        if($btnUpdate == "Update")
        {
            $this->form_validation->set_rules("taComment", "Comment", "required|trim|min_length[5]");
            
            $update_id = $this->input->post("tbId");
            
            if($this->form_validation->run() == false)
            {
                $niz_comment = array("comment_id"=> $update_id);
                $single_comment = $this->comment_model->single_comment($niz_comment);
                $input["edit"] = $single_comment;

                $input["title"] = "Editor panel - Comments";

                $all_comments = $this->comment_model->all_comments();
                $input["all_comments"] = $all_comments;

                $adns = $this->news_model->news();
                $ddlParent = array();
                foreach($adns as $adn)
                {
                    $value = $adn["news_id"];
                    $txt = $adn["news_title"];
                    $ddlParent[$value] = $txt;
                }
                $input["ddlParent"] = $ddlParent;

                $this->set_view("editor/comments_view", $input);
            }
            else 
            {
                $update_text = $this->input->post("taComment");
                
                $niz_update_comment = array(
                    "comment_text"=> $update_text
                );
                $this->comment_model->edit_comment($niz_update_comment, $update_id);
            }
        }
        
        if($action==null && $id==null)
        {
            $input["title"] = "Editor panel - Comments";

            $all_comments = $this->comment_model->all_comments();
            $input["all_comments"] = $all_comments;
            
            $adns = $this->news_model->news();
            $ddlParent = array();
            foreach($adns as $adn)
            {
                $value = $adn["news_id"];
                $txt = $adn["news_title"];
                $ddlParent[$value] = $txt;
            }
            $input["ddlParent"] = $ddlParent;

            $this->set_view("editor/comments_view", $input);
        }
        if($action=="edit" && $id!=null)
        {
            $niz_comment = array("comment_id"=> $id);
            $single_comment = $this->comment_model->single_comment($niz_comment);
            $input["edit"] = $single_comment;
            
            $input["title"] = "Editor panel - Comments";

            $all_comments = $this->comment_model->all_comments();
            $input["all_comments"] = $all_comments;
            
            $adns = $this->news_model->news();
            $ddlParent = array();
            foreach($adns as $adn)
            {
                $value = $adn["news_id"];
                $txt = $adn["news_title"];
                $ddlParent[$value] = $txt;
            }
            $input["ddlParent"] = $ddlParent;

            $this->set_view("editor/comments_view", $input); 
        }
        if($action=="delete" && $id!=null)
        {
            $niz_delete_comment = array("comment_id"=> $id);
            $this->comment_model->remove_comment($niz_delete_comment);
            
            redirect("editor/comments");
        }
    }
    
    public function gallery($action = null, $id = null)
    {
        $btnInsert = $this->input->post("btnInsert");
        $btnUpdate = $this->input->post("btnUpdate");
        
        if($btnInsert == "Insert")
        {
            $this->form_validation->set_rules("tbName", "Name", "required|trim|min_length[3]");
            
            if($this->form_validation->run() == false)
            {
                $input["title"] = "Editor panel - Galleries";

                $all_galleries = $this->gallery_model->galleries();
                $input["all_galleries"] = $all_galleries;

                $this->set_view("editor/gallery_view", $input);
            }
            else 
            {
                $insert_id = null;
                $insert_name = $this->input->post("tbName");
                
                $niz_insert_gallery = array(
                    "gallery_id"=> $insert_id,
                    "gallery_name"=>$insert_name
                );
                $this->gallery_model->insert_gallery($niz_insert_gallery);
            }
        }
        if($btnUpdate == "Update")
        {
            $this->form_validation->set_rules("tbName", "Name", "required|trim|min_length[3]");
            
            $update_id = $this->input->post("tbId");
            
            if($this->form_validation->run() == false)
            {
                $niz_gallery = array("gallery_id"=> $update_id);
                $single_gallery = $this->gallery_model->single_gallery($niz_gallery);

                $input["title"] = "Editor panel - Galleries";

                $all_galleries = $this->gallery_model->galleries();
                $input["all_galleries"] = $all_galleries;

                $input["edit"] = $single_gallery;
                $this->set_view("editor/gallery_view", $input);
            }
            else 
            {
                $update_name = $this->input->post("tbName");
                $niz_update_gallery = array(
                    "gallery_name "=> $update_name
                );
                $this->gallery_model->edit_gallery($niz_update_gallery, $update_id);
            }
        }
        if($action==null && $id==null)
        {
            $input["title"] = "Editor panel - Galleries";

            $all_galleries = $this->gallery_model->galleries();
            $input["all_galleries"] = $all_galleries;

            $this->set_view("editor/gallery_view", $input);
        }
        if($action=="edit" && $id!=null)
        {
            $niz_gallery = array("gallery_id"=> $id);
            $single_gallery = $this->gallery_model->single_gallery($niz_gallery);
            
            $input["title"] = "Editor panel - Galleries";

            $all_galleries = $this->gallery_model->galleries();
            $input["all_galleries"] = $all_galleries;
            
            $input["edit"] = $single_gallery;
            $this->set_view("editor/gallery_view", $input);
        }
        if($action=="delete" && $id!=null)
        {
            $niz_delete_gallery = array("gallery_id"=> $id);
            $this->gallery_model->remove_gallery($niz_delete_gallery);
            
            redirect("editor/gallery");
        }
    }
    
    public function gallery_images($action = null, $id = null)
    {
        $btnInsert = $this->input->post("btnInsert");
        $btnUpdate = $this->input->post("btnUpdate");
        
        $fajl = "tbImage";
        
        if($btnInsert == "Insert")
        {
            $this->form_validation->set_rules("tbAlt", "Alt", "required|trim|min_length[3]");
            $this->form_validation->set_rules("tbTitle", "Title", "required|trim|min_length[4]");
            
            if($this->form_validation->run() == false)
            {
                
            }
            else 
            {
                $insert_id = null;
                $insert_alt = $this->input->post("tbAlt");
                $insert_title = $this->input->post("tbTitle");
                $insert_ddl = $this->input->post("ddlParent");
                
                $config["upload_path"] = "./images";
                $config["allowed_types"] = "jpg|png|jpeg";
                $this->load->library("upload", $config);
            
                if(!$this->upload->do_upload($fajl))
                {
                    $input["image_error"] = $this->upload->display_errors();
                    $input["title"] = "Editor panel - Gallery images";

                    $all_images = $this->gallery_model->all_images();
                    $input["all_images"] = $all_images;

                    $image_parents = $this->gallery_model->galleries();
                    $all_parents = array();
                    foreach($image_parents as $imgp)
                    {
                        $valju = $imgp["gallery_id"];
                        $tekst = $imgp["gallery_name"];

                        $all_parents[$valju] = $tekst;
                    }
                    $input["dll_parents"] = $all_parents;

                    $this->set_view("editor/gallery_images_view", $input);
                }
                else
                {
                    $data = array("upload_image"=>$this->upload->data());
                    $image_p = "images/".$data["upload_image"]["file_name"];
                    
                    $niz_insert_image = array(
                    "image_id"=> $insert_id,
                    "image_src"=> $image_p,
                    "image_alt"=> $insert_alt,
                    "image_title"=> $insert_title,
                    "image_parent"=> $insert_ddl
                    );
                    $this->gallery_model->insert_image($niz_insert_image);
                }
            }
        }
        if($btnUpdate == "Update")
        {
            $this->form_validation->set_rules("tbAlt", "Alt", "required|trim|min_length[4]");
            $this->form_validation->set_rules("tbTitle", "Title", "required|trim|min_length[3]");
            
            $update_id = $this->input->post("tbId");
            
            if($this->form_validation->run() == false)
            {
                $niz_edit_image = array("image_id"=> $update_id);
                $edit_image = $this->gallery_model->get_image($niz_edit_image);

                $input["title"] = "Editor panel - Gallery images";

                $all_images = $this->gallery_model->all_images();
                $input["all_images"] = $all_images;

                $image_parents = $this->gallery_model->galleries();
                $all_parents = array();
                foreach($image_parents as $imgp)
                {
                    $valju = $imgp["gallery_id"];
                    $tekst = $imgp["gallery_name"];

                    $all_parents[$valju] = $tekst;
                }
                $input["dll_parents"] = $all_parents;

                $input["edit"] = $edit_image;
                $this->set_view("editor/gallery_images_view", $input);
            }
            else 
            {
                $update_alt = $this->input->post("tbAlt");
                $update_title = $this->input->post("tbTitle");
                $update_ddl = $this->input->post("ddlParent");
                
                $niz_update_image = array(
                    "image_alt"=> $update_alt,
                    "image_title"=> $update_title,
                    "image_parent"=> $update_ddl
                    );
                
                $config["upload_path"] = "./images";
                $config["allowed_types"] = "jpg|png|jpeg";
                $this->load->library("upload", $config);
            
                if(!$this->upload->do_upload($fajl))
                {
                    //nije neophodno postaviti sliku
                }
                else
                {
                    $data = array("upload_image"=>$this->upload->data());
                    $image_p = "images/".$data["upload_image"]["file_name"];      
                    $niz_update_image["image_src"] = $image_p;
                }
                $this->gallery_model->update_image($niz_update_image, $update_id);
            }
        }
        if($action==null && $id==null)
        {
            $input["title"] = "Editor panel - Gallery images";

            $all_images = $this->gallery_model->all_images();
            $input["all_images"] = $all_images;
            
            $image_parents = $this->gallery_model->galleries();
            $all_parents = array();
            foreach($image_parents as $imgp)
            {
                $valju = $imgp["gallery_id"];
                $tekst = $imgp["gallery_name"];
                
                $all_parents[$valju] = $tekst;
            }
            $input["dll_parents"] = $all_parents;

            $this->set_view("editor/gallery_images_view", $input);
        }
        if($action=="edit" && $id!=null)
        {
            $niz_edit_image = array("image_id"=> $id);
            $edit_image = $this->gallery_model->get_image($niz_edit_image);
            
            $input["title"] = "Editor panel - Gallery images";
            
            $all_images = $this->gallery_model->all_images();
            $input["all_images"] = $all_images;
            
            $image_parents = $this->gallery_model->galleries();
            $all_parents = array();
            foreach($image_parents as $imgp)
            {
                $valju = $imgp["gallery_id"];
                $tekst = $imgp["gallery_name"];
                
                $all_parents[$valju] = $tekst;
            }
            $input["dll_parents"] = $all_parents;
            
            $input["edit"] = $edit_image;
            $this->set_view("editor/gallery_images_view", $input);
        }
        if($action=="delete" && $id!=null)
        {
            $niz_delete_image = array("image_id"=> $id);
            $this->gallery_model->remove_image($niz_delete_image);
            
            redirect("editor/gallery_images");
        }
    }
    
    public function poll($action = null, $id = null)
    {
        $btnInsert = $this->input->post("btnInsert");
        $btnUpdate = $this->input->post("btnUpdate");
        
        if($btnInsert == "Insert")
        {
            $this->form_validation->set_rules("tbName", "Name", "required|trim|min_length[4]");
            
            if($this->form_validation->run() == false)
            {
                
            }
            else 
            {
                $insert_id = null;
                $insert_name = $this->input->post("tbName");
                
                $niz_insert_poll = array(
                    "poll_id"=> $insert_id,
                    "poll_name"=> $insert_name
                );
                $this->poll_model->insert_poll($niz_insert_poll);
            }
        }
        if($btnUpdate == "Update")
        {
            $this->form_validation->set_rules("tbName", "Name", "required|trim|min_length[3]");
            
            $update_id = $this->input->post("tbId");
            
            if($this->form_validation->run() == false)
            {
                $niz_edit_poll = array("poll_id"=> $update_id);
                $edit_image = $this->poll_model->one_poll($niz_edit_poll);

                $input["title"] = "Editor panel - Poll";

                $all_polls = $this->poll_model->all_polls();
                $input["all_polls"] = $all_polls;

                $input["edit"] = $edit_image;
                $this->set_view("editor/poll_view", $input);
            }
            else 
            {
                $update_name = $this->input->post("tbName");
                $niz_update_poll = array(
                    "poll_name "=> $update_name
                );
                $this->poll_model->edit_poll($niz_update_poll, $update_id);
            }
        }
        if($action==null && $id==null)
        {
            $input["title"] = "Editor panel - Poll";

            $all_polls = $this->poll_model->all_polls();
            $input["all_polls"] = $all_polls;
            
            $this->set_view("editor/poll_view", $input);
        }
        if($action=="edit" && $id!=null)
        {
            $niz_edit_poll = array("poll_id"=> $id);
            $edit_image = $this->poll_model->one_poll($niz_edit_poll);
            
            $input["title"] = "Editor panel - Poll";
            
            $all_polls = $this->poll_model->all_polls();
            $input["all_polls"] = $all_polls;
            
            $input["edit"] = $edit_image;
            $this->set_view("editor/poll_view", $input);
        }
        if($action=="delete" && $id!=null)
        {
            $niz_delete_poll = array("poll_id"=> $id);
            $this->poll_model->remove_poll($niz_delete_poll);
            
            redirect("editor/poll");
        }
    }
    
    public function poll_options($action = null, $id = null)
    {
        $btnInsert = $this->input->post("btnInsert");
        $btnUpdate = $this->input->post("btnUpdate");
        
        if($btnInsert == "Insert")
        {
            $this->form_validation->set_rules("tbText", "Text", "required|trim|min_length[2]");
            
            if($this->form_validation->run() == false)
            {
                
            }
            else 
            {
                $insert_id = null;
                $insert_text = $this->input->post("tbText");
                $insert_parent = $this->input->post("ddlParent");
                
                $niz_insert_option = array(
                    "option_id"=> $insert_id,
                    "option_text"=> $insert_text,
                    "option_parent"=> $insert_parent
                );
                $this->poll_model->insert_option($niz_insert_option);
            }
        }
        if($btnUpdate == "Update")
        {
            $this->form_validation->set_rules("tbText", "Text", "required|trim|min_length[2]");
            
            $update_id = $this->input->post("tbId");
            
            if($this->form_validation->run() == false)
            {
                $niz_edit_option = array("option_id"=> $update_id);
                $one_option = $this->poll_model->one_option($niz_edit_option);

                $input["title"] = "Editor panel - Poll options";

                $all_options = $this->poll_model->all_options();
                $input["all_options"] = $all_options;

                $ddlParent = array();
                $all_parents = $this->poll_model->all_polls();
                foreach($all_parents as $pare)
                {
                    $valiju = $pare["poll_id"];
                    $tkst = $pare["poll_name"];
                    $ddlParent[$valiju] = $tkst;
                }
                $input["ddlParent"] = $ddlParent;

                $input["edit"] = $one_option;
                $this->set_view("editor/poll_options_view", $input);
            }
            else 
            {
                $update_text = $this->input->post("tbText");
                $update_parent = $this->input->post("ddlParent");
                $niz_update_option = array(
                    "option_text "=> $update_text,
                    "option_parent"=> $update_parent
                );
                $this->poll_model->edit_option($niz_update_option, $update_id);
            }
        }
        if($action==null && $id==null)
        {
            $input["title"] = "Editor panel - Poll options";

            $all_options = $this->poll_model->all_options();
            $input["all_options"] = $all_options;
            
            $ddlParent = array();
            $all_parents = $this->poll_model->all_polls();
            foreach($all_parents as $pare)
            {
                $valiju = $pare["poll_id"];
                $tkst = $pare["poll_name"];
                $ddlParent[$valiju] = $tkst;
            }
            $input["ddlParent"] = $ddlParent;
            
            $this->set_view("editor/poll_options_view", $input);
        }
        if($action=="edit" && $id!=null)
        {
            $niz_edit_option = array("option_id"=> $id);
            $one_option = $this->poll_model->one_option($niz_edit_option);
            
            $input["title"] = "Editor panel - Poll options";
            
            $all_options = $this->poll_model->all_options();
            $input["all_options"] = $all_options;
            
            $ddlParent = array();
            $all_parents = $this->poll_model->all_polls();
            foreach($all_parents as $pare)
            {
                $valiju = $pare["poll_id"];
                $tkst = $pare["poll_name"];
                $ddlParent[$valiju] = $tkst;
            }
            $input["ddlParent"] = $ddlParent;
            
            $input["edit"] = $one_option;
            $this->set_view("editor/poll_options_view", $input);
        }
        if($action=="delete" && $id!=null)
        {
            $niz_delete_option = array("option_id"=> $id);
            $this->poll_model->remove_option($niz_delete_option);
            
            redirect("editor/poll_options");
        }
    }
    
    public function menu($action = null, $id = null)
    {
        $btnInsert = $this->input->post("btnInsert");
        $btnUpdate = $this->input->post("btnUpdate");
        
        if($btnInsert == "Insert")
        {
            $this->form_validation->set_rules("tbName", "Name", "required|trim|min_length[4]");
            $this->form_validation->set_rules("tbSrc", "Source", "required|trim|min_length[4]");
            
            if($this->form_validation->run() == false)
            {
                
            }
            else 
            {
                $insert_id = null;
                $insert_name = $this->input->post("tbName");
                $insert_src = $this->input->post("tbSrc");
                
                $niz_insert_menu = array(
                    "menu_id"=> $insert_id,
                    "menu_name"=> $insert_name,
                    "menu_src"=> $insert_src
                );
                $this->menu_model->insert_menu($niz_insert_menu);
            }
        }
        if($btnUpdate == "Update")
        {
            $this->form_validation->set_rules("tbName", "Name", "required|trim|min_length[3]");
            $this->form_validation->set_rules("tbSrc", "Source", "required|trim|min_length[4]");
            
            $update_id = $this->input->post("tbId");
            
            if($this->form_validation->run() == false)
            {
                $niz_edit_menu = array("menu_id"=> $update_id);
                $one_menu = $this->menu_model->one_menu($niz_edit_menu);

                $input["title"] = "Editor panel - Menu";

                $all_menu = $this->menu_model->all_menu();
                $input["all_menu"] = $all_menu;

                $input["edit"] = $one_menu;
                $this->set_view("editor/menu_view", $input);
            }
            else 
            {
                $update_name = $this->input->post("tbName");
                $update_src = $this->input->post("tbSrc");
                $niz_update_menu = array(
                    "menu_name "=> $update_name,
                    "menu_src"=> $update_src
                );
                $this->menu_model->edit_menu($niz_update_menu, $update_id);
            }
        }
        if($action==null && $id==null)
        {
            $input["title"] = "Editor panel - Menu";

            $all_menu = $this->menu_model->all_menu();
            $input["all_menu"] = $all_menu;
            
            $this->set_view("editor/menu_view", $input);
        }
        if($action=="edit" && $id!=null)
        {
            $niz_edit_menu = array("menu_id"=> $id);
            $one_menu = $this->menu_model->one_menu($niz_edit_menu);
            
            $input["title"] = "Editor panel - Menu";
            
            $all_menu = $this->menu_model->all_menu();
            $input["all_menu"] = $all_menu;
            
            $input["edit"] = $one_menu;
            $this->set_view("editor/menu_view", $input);
        }
        if($action=="delete" && $id!=null)
        {
            $niz_delete_menu = array("menu_id"=> $id);
            $this->menu_model->remove_menu($niz_delete_menu);
            
            redirect("editor/menu");
        }
    }
    
    public function submenu($action = null, $id = null)
    {
        $btnInsert = $this->input->post("btnInsert");
        $btnUpdate = $this->input->post("btnUpdate");
        
        if($btnInsert == "Insert")
        {
            $this->form_validation->set_rules("tbName", "Name", "required|trim|min_length[4]");
            $this->form_validation->set_rules("tbSrc", "Source", "required|trim|min_length[4]");
            
            if($this->form_validation->run() == false)
            {
                
            }
            else 
            {
                $insert_id = null;
                $insert_name = $this->input->post("tbName");
                $insert_src = $this->input->post("tbSrc");
                $insert_parent = $this->input->post("ddlParent");
                $insert_class = $this->input->post("ddlClass");
                
                $niz_insert_submenu = array(
                    "submenu_id"=> $insert_id,
                    "submenu_name"=> $insert_name,
                    "submenu_src"=> $insert_src,
                    "submenu_parent"=> $insert_parent,
                    "submenu_class"=> $insert_class
                );
                $this->menu_model->insert_submenu($niz_insert_submenu);
            }
        }
        if($btnUpdate == "Update")
        {
            $this->form_validation->set_rules("tbName", "Name", "required|trim|min_length[3]");
            $this->form_validation->set_rules("tbSrc", "Source", "required|trim|min_length[4]");
            
            $update_id = $this->input->post("tbId");
            
            if($this->form_validation->run() == false)
            {
                $niz_one_submenu = array("submenu_id"=> $id);
                $one_submenu = $this->menu_model->one_submenu($niz_one_submenu);

                $input["title"] = "Editor panel - Submenu";

                $all_submenu = $this->menu_model->all_submenu();
                $input["all_submenu"] = $all_submenu;

                $aps = $this->menu_model->all_menu();
                $niz_parents = array();
                foreach($aps as $ap)
                {
                    $val = $ap["menu_id"];
                    $tek = $ap["menu_name"];
                    $niz_parents[$val] = $tek;
                }
                $input["ddlParent"] = $niz_parents;

                $acs = $this->class_model->klase();
                $niz_class = array("0"=>"none");
                foreach($acs as $ac)
                {
                    $valc = $ac["class_id"];
                    $tekc = $ac["class_name"];
                    $niz_class[$valc] = $tekc;
                }
                $input["ddlClass"] = $niz_class;

                $input["edit"] = $one_submenu;
                $this->set_view("editor/submenu_view", $input);
            }
            else 
            {
                $update_name = $this->input->post("tbName");
                $update_src = $this->input->post("tbSrc");
                $update_parent = $this->input->post("ddlParent");
                $update_class = $this->input->post("ddlParent");
                $niz_update_submenu = array(
                    "submenu_name "=> $update_name,
                    "submenu_src"=> $update_src,
                    "submenu_parent"=> $update_parent,
                    "submenu_class"=> $update_class
                );
                $this->menu_model->edit_submenu($niz_update_submenu, $update_id);
            }
        }
        if($action==null && $id==null)
        {
            $input["title"] = "Editor panel - Submenu";

            $all_submenu = $this->menu_model->all_submenu();
            $input["all_submenu"] = $all_submenu;
            
            $aps = $this->menu_model->all_menu();
            $niz_parents = array();
            foreach($aps as $ap)
            {
                $val = $ap["menu_id"];
                $tek = $ap["menu_name"];
                $niz_parents[$val] = $tek;
            }
            $input["ddlParent"] = $niz_parents;
            
            $acs = $this->class_model->klase();
            $niz_class = array("0"=>"none");
            foreach($acs as $ac)
            {
                $valc = $ac["class_id"];
                $tekc = $ac["class_name"];
                $niz_class[$valc] = $tekc;
            }
            $input["ddlClass"] = $niz_class;
            
            $this->set_view("editor/submenu_view", $input);
        }
        if($action=="edit" && $id!=null)
        {
            $niz_one_submenu = array("submenu_id"=> $id);
            $one_submenu = $this->menu_model->one_submenu($niz_one_submenu);
            
            $input["title"] = "Editor panel - Submenu";
            
            $all_submenu = $this->menu_model->all_submenu();
            $input["all_submenu"] = $all_submenu;
            
            $aps = $this->menu_model->all_menu();
            $niz_parents = array();
            foreach($aps as $ap)
            {
                $val = $ap["menu_id"];
                $tek = $ap["menu_name"];
                $niz_parents[$val] = $tek;
            }
            $input["ddlParent"] = $niz_parents;
            
            $acs = $this->class_model->klase();
            $niz_class = array("0"=>"none");
            foreach($acs as $ac)
            {
                $valc = $ac["class_id"];
                $tekc = $ac["class_name"];
                $niz_class[$valc] = $tekc;
            }
            $input["ddlClass"] = $niz_class;
            
            $input["edit"] = $one_submenu;
            $this->set_view("editor/submenu_view", $input);
        }
        if($action=="delete" && $id!=null)
        {
            $niz_delete_submenu = array("submenu_id"=> $id);
            $this->menu_model->remove_submenu($niz_delete_submenu);
            
            redirect("editor/submenu");
        }
        
    }
    
}
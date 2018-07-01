<?php

class me extends prime {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model("user_model");
    }
    
    public function profile()
    {
        $log = $this->session->userdata("cactus_log");
        if($log == false)
        {
            redirect("login");
        }
        else
        {
            $id = $this->session->userdata("cactus_id");
            $niz_profile = array("user_id"=> $id);
            $result_user = $this->user_model->profile($niz_profile);
            
            $user_nick = $result_user->user_nickname;
            $user_email = $result_user->user_email;
            $user_thumb = $result_user->user_thumb;
            
            $input["title"] = $user_email." - ".ucfirst($user_nick);
            $input["email"] = $user_email;
            $input["thumb"] = $user_thumb;
            $input["id"] = $id;
            $this->set_view("me_view", $input);
        } 
    }
    
    public function audit()
    {
        $this->form_validation->set_rules("tbNickname", "Nickname", "trim|min_length[4]");
        $this->form_validation->set_rules("tbPassword", "Password", "trim|min_length[4]|matches[tbRePassword]");
        $this->form_validation->set_rules("tbRePassword", "RePassword", "trim|min_length[4]");
        
        $id = $this->input->post("tbId");
        
        if($this->form_validation->run() == FALSE)
        {
            
        }
        else
        {
            $nick_new = $this->input->post("tbNickname");
            $pass_new = $this->input->post("tbPassword");
            
            $niz_user = array();
            if(!empty($nick_new))
            {
                $niz_user["user_nickname"] = $nick_new;
            }
            if(!empty($pass_new))
            {
                $niz_user["user_pass"] = md5($pass_new);
            }
            
            $fajl = "tbImage";
            $config["upload_path"] = "./images/uploads";
            $config["allowed_types"] = "jpg|png|jpeg";
            $this->load->library("upload", $config);
            
            if(!$this->upload->do_upload($fajl))
            {
                //$input["image_error"] = $this->upload->display_errors();
            }
            else
            {
                $data = array("upload_image"=>$this->upload->data());
                $image_path = "./images/uploads".$data["upload_image"]["file_name"];
                
                $this->resize($data["upload_image"]["full_path"], $data["upload_image"]["file_name"]);
                
                if(!$this->image_lib->resize())
                {
                    echo $this->image_lib->display_errors();
                }
                $resized_image = "images/resize/".$data["upload_image"]["file_name"];
                $niz_user["user_thumb"] = $resized_image;
            }
            if(!empty($niz_user))
            {
                $upis = $this->user_model->edit($niz_user, $id);
            }
            if(isset($upis))
            {
                $input["update"] = "Successfully update";
            }
        }
        $id = $this->session->userdata("cactus_id");
        $niz_profile = array("user_id"=> $id);
        $result_user = $this->user_model->profile($niz_profile);

        $user_nick = $result_user->user_nickname;
        $user_email = $result_user->user_email;
        $user_thumb = $result_user->user_thumb;

        $input["title"] = ucfirst($user_nick);
        $input["email"] = $user_email;
        $input["thumb"] = $user_thumb;
        $input["id"] = $id;
        $this->set_view("me_view", $input);
    }
    
    public function resize($path, $file)
    {
        $config_resize = array();
        $config_resize["image_library"] = "gd2";
        $config_resize["source_image"] = $path;
        $config_resize["create_thumb"] = false;
        $config_resize["manipulation_ratio"] = true;
        $config_resize["width"] = 250;
        $config_resize["height"] = 250;
        $config_resize["new_image"] = "./images/resize/".$file;
        
        $this->load->library("image_lib", $config_resize);
        $this->image_lib->resize();
    }
    
}

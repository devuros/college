<?php

class login extends prime {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $log = $this->session->userdata("cactus_log");
        if($log == false)
        {
            $input["title"] = "Plantae - Login";

            $this->load->view("head_view", $input);
            $this->load->view("login_view", $input);
            $this->load->view("footer_view", $input);
        }
        else
        {
            redirect();
        }
    }
    
    public function audit()
    {
        $input["title"] = "Plantae - Login";
        $this->form_validation->set_rules("tbEmail", "Email", "required|trim|valid_email");
        $this->form_validation->set_rules("tbPassword", "Password", "required|trim|min_length[4]");
        
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view("head_view", $input);
            $this->load->view("login_view", $input);
            $this->load->view("footer_view", $input);
        }
        else
        {
            $email = $this->input->post("tbEmail");
            $password = md5($this->input->post("tbPassword"));
            $niz_login = array("user_email"=> $email, "user_password"=> $password);
            
            $this->load->model("user_model");
            $result_login = $this->user_model->login($niz_login);
            
            if($result_login == false)
            {
                $input["missmatch"] = "Wrong credentials.";
                
                $this->load->view("head_view", $input);
                $this->load->view("login_view", $input);
                $this->load->view("footer_view", $input);
            }
            else
            {
                $user_id = $result_login->user_id;
                $user_nickname = $result_login->user_nickname;
                $user_email = $result_login->user_email;
                $user_role = $result_login->user_role;
                
                $this->session->set_userdata("cactus_id", $user_id);
                $this->session->set_userdata("cactus_nick", $user_nickname);
                $this->session->set_userdata("cactus_email", $user_email);
                $this->session->set_userdata("cactus_role", $user_role);
                $this->session->set_userdata("cactus_log", true);
                
                if($user_role == "editor")
                {
                    redirect("editor/index");
                }
                else
                {
                    redirect();
                }
            }
        }
        
        
    }
}

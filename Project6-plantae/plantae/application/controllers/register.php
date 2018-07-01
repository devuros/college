<?php

class register extends prime {
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        $input["title"] = "Plantae - Register";
        
        $this->load->view("head_view", $input);
        $this->load->view("register_view", $input);
        $this->load->view("footer_view", $input);
    }
    
    public function audit()
    {
        $input["title"] = "Plantae - Register";
        $this->form_validation->set_rules("tbNickname", "Nickname", "required|trim|min_lenght[4]");
        $this->form_validation->set_rules("tbEmail", "Email", "required|trim|valid_email");
        $this->form_validation->set_rules("tbPassword", "Password", "required|trim|min_length[4]");
        
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view("head_view", $input);
            $this->load->view("register_view", $input);
            $this->load->view("footer_view", $input);
        }
        else
        {
            $id = null;
            $role = "user";
            $nickname = $this->input->post("tbNickname");
            $email = $this->input->post("tbEmail");
            $password = md5($this->input->post("tbPassword"));
            $niz_register = array(
                "user_id"=> $id,
                "user_nickname"=> $nickname,
                "user_email"=> $email,
                "user_password"=> $password,
                "user_role"=> $role
            );
            
            $this->load->model("user_model");
            $result_register = $this->user_model->register($niz_register);
            
            if($result_register == true)
            {
                $input["reply"] = "You have successfully registered";
            }
            else
            {
                $input["reply"] = "Woops, something went wrong!";
            }
            $this->load->view("head_view", $input);
            $this->load->view("register_view", $input);
            $this->load->view("footer_view", $input);
        }
        
    }
}
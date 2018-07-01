<?php

class logout extends prime {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->session->unset_userdata("cactus_id");
        $this->session->unset_userdata("cactus_nick");
        $this->session->unset_userdata("cactus_email");
        $this->session->unset_userdata("cactus_role");
        $this->session->unset_userdata("cactus_log");
        
        $this->session->sess_destroy();
        redirect();
    }
    
}

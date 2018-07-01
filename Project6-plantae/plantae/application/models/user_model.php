<?php

class user_model extends CI_Model {
    
    public function __construct() 
    {
        parent::__construct();
        
        $this->load->database();
    }
    
    public function login($niz_login)
    {
        $upit_login = $this->db->get_where("user", $niz_login);
        
        if($upit_login->num_rows() == 1)
        {
            return $upit_login->row();
        }
        else
        {
            return false;
        }
    }
    
    public function register($niz_register)
    {
        $upit_register = $this->db->insert("user", $niz_register);
        return $upit_register;
    }
    
    public function profile($niz_profile)
    {
        $upit_profile = $this->db->get_where("user", $niz_profile);
        return $upit_profile->row();
    }
    
    public function edit($niz_user, $id)
    {
        $this->db->where("user_id", $id);
        $upis = $this->db->update("user", $niz_user);
        return $upis;
    }
    
    public function all_users()
    {
        $all_users = $this->db->get("user");
        return $all_users->result_array();
    }
    
    public function remove_user($niz_user)
    {
        $this->db->where($niz_user);
        $this->db->delete("user");
    }
    
}

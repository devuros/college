<?php

class prime_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->database();
    }
    
    public function menu()
    {
        $menu = $this->db->get("menu");
        return $menu->result_array();
    }
    
    public function submenu($menu_item_id)
    {
        $niz = array("submenu_parent" => $menu_item_id);
        $submenu = $this->db->get_where("submenu", $niz);
        
        if($submenu->num_rows() > 0)
        {
            return $submenu->result_array();
        }
        else
        {
            return false;
        }
    }
    
}
<?php

class menu_model extends CI_Model {
    
    public function __construct() 
    {
        parent::__construct();
        
        $this->load->database();
    }
    
    public function all_menu()
    {
        $all_menu = $this->db->get("menu");
        return $all_menu->result_array();
    }
    
    public function insert_menu($niz_insert_menu)
    {
        $this->db->insert("menu", $niz_insert_menu);
    }
    
    public function one_menu($niz_edit_menu)
    {
        $one_menu = $this->db->get_where("menu", $niz_edit_menu);
        return $one_menu->row();
    }
    
    public function edit_menu($niz_update_menu, $update_id)
    {
        $this->db->where("menu_id", $update_id);
        $this->db->update("menu", $niz_update_menu);
    }
    
    public function remove_menu($niz_delete_menu)
    {
        $this->db->where($niz_delete_menu);
        $this->db->delete("menu");
    }
    
    public function all_submenu()
    {
        $this->db->select("*");
        $this->db->from("submenu");
        $this->db->join("menu", "submenu.submenu_parent = menu.menu_id");
        $this->db->join("class", "submenu.submenu_class = class.class_id", "left");
        $all_submenu = $this->db->get();
        return $all_submenu->result_array();
    }
    
    public function one_submenu($niz_one_submenu)
    {
        $one = $this->db->get_where("submenu", $niz_one_submenu);
        return $one->row();
    }
    
    public function insert_submenu($niz_insert_submenu)
    {
        $this->db->insert("submenu", $niz_insert_submenu);
    }

    public function edit_submenu($niz_update_submenu, $update_id)
    {
        $this->db->where("submenu_id", $update_id);
        $this->db->update("submenu", $niz_update_submenu);
    }
    
    public function remove_submenu($niz_delete_submenu)
    {
        $this->db->where($niz_delete_submenu);
        $this->db->delete("submenu");
    }
    
}

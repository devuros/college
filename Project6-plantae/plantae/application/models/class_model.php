<?php

class class_model extends CI_Model {
    
    public function __construct() 
    {
        parent::__construct();
        
        $this->load->database();
    }
    
    public function klase()
    {
        $class = $this->db->get("class");
        return $class->result_array();
    }
    
    public function klasa($idClass)
    {
        $niz = array("class_id"=> $idClass);
        $klasa = $this->db->get_where("class", $niz);
        
        if($klasa->num_rows() > 0)
        {
            return $klasa->row();
        }
        else 
        {
            return false;
        }
    }
    
    public function unos($niz_insert_class)
    {
        $this->db->insert("class", $niz_insert_class);
    }
    
    public function edit($niz_update_class, $update_id)
    {
        $this->db->where("class_id", $update_id);
        $this->db->update("class", $niz_update_class);
    }
    
    public function remove_class($niz_delete_class)
    {
        $this->db->where($niz_delete_class);
        $this->db->delete("class");
    }
    
}

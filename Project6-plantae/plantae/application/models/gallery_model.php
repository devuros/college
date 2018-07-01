<?php

class gallery_model extends CI_Model {
    
    public function __construct() 
    {
        parent::__construct();
        
        $this->load->database();
    }
    
    public function galleries()
    {
        $galleries = $this->db->get("gallery");
        return $galleries->result_array();
    }
    
    public function gallery_first()
    {
        $this->db->order_by("gallery_id", "asc");
        $this->db->limit(1);
        $gallery_first = $this->db->get("gallery");
        return $gallery_first->row();
    }
    
    public function image_first($niz_first)
    {
        $this->db->order_by("image_id", "asc");
        $this->db->limit(1);
        $image_first = $this->db->get_where("gallery_image", $niz_first);
        return $image_first->row();
    }
    
    public function gallery_click($niz_gallery)
    {
        $this->db->order_by("image_id", "asc");
        $this->db->limit(1);
        $gallery_click = $this->db->get_where("gallery_image", $niz_gallery);
        return $gallery_click->row();
    }
    
    public function count_all($niz_image)
    {
        $this->db->where($niz_image);
        $this->db->from("gallery_image");
        $count_all = $this->db->count_all_results();
        return $count_all;
    }
    
    public function image_get($image_parent, $cur)
    {
        $niz = array("image_parent"=> $image_parent);
        
        $this->db->order_by("image_id", "asc");
        $this->db->limit(1);
        $this->db->offset($cur);
        $upit = $this->db->get_where("gallery_image", $niz);
        return $upit->row();
    }
    
    public function insert_gallery($niz_insert_gallery)
    {
        $this->db->insert("gallery", $niz_insert_gallery);
    }
    
    public function single_gallery($niz_gallery)
    {
        $single_gallery = $this->db->get_where("gallery", $niz_gallery);
        return $single_gallery->row();
    }
    
    public function edit_gallery($niz_update_gallery, $update_id)
    {
        $this->db->where("gallery_id", $update_id);
        $this->db->update("gallery", $niz_update_gallery);
    }
    
    public function remove_gallery($niz_delete_gallery)
    {
        $this->db->where($niz_delete_gallery);
        $this->db->delete("gallery");
    }
    
    public function all_images()
    {
        $this->db->select("*");
        $this->db->from("gallery_image");
        $this->db->join("gallery", "gallery_image.image_parent = gallery.gallery_id");
        $all_images = $this->db->get();
        return $all_images->result_array();
    }
    
    public function insert_image($niz_insert_image)
    {
        $this->db->insert("gallery_image", $niz_insert_image);
    }
    
    public function get_image($niz_edit_image)
    {
        $img_one = $this->db->get_where("gallery_image", $niz_edit_image);
        return $img_one->row();
    }
    
    public function update_image($niz_update_image, $update_id)
    {
        $this->db->where("image_id", $update_id);
        $this->db->update("gallery_image", $niz_update_image);
    }
    
    public function remove_image($niz_delete_image)
    {
        $this->db->where($niz_delete_image);
        $this->db->delete("gallery_image");
    }
    
}

<?php

class news_model extends CI_Model {
    
    public function __construct() 
    {
        parent::__construct();
        
        $this->load->database();
    }
    
    public function news()
    {
        $all_news = $this->db->get("news");
        return $all_news->result_array();
    }
    
    public function single_news($niz_one)
    {
        $this->db->select("*");
        $this->db->from("news");
        $this->db->where($niz_one);
        $this->db->join("class", "news.news_class = class.class_id");
        $this->db->join("user", "news.news_author = user.user_id");
        
        $single_news = $this->db->get();
        if($single_news->num_rows() == 1)
        {
            return $single_news->row();
        }
        else
        {
            return false;
        }
        
    }
    
    public function latest_news()
    {
        $this->db->order_by("news_time", "asc");
        $this->db->limit(5);
        $latest_news = $this->db->get("news");
        return $latest_news->result_array();
    }
    
    public function feat_news()
    {
        $niz_feat = array("news_feat"=> 1);
        
        $this->db->select("*");
        $this->db->from("news");
        $this->db->where($niz_feat);
        $this->db->join("class", "news.news_class = class.class_id");
        $feat = $this->db->get();
        return $feat->row();
    }
    
    public function all_news()
    {
        $this->db->select("*");
        $this->db->from("news");
        $this->db->join("class", "news.news_class = class.class_id");
        $this->db->join("user", "news.news_author = user.user_id");
        $feat = $this->db->get();
        return $feat->result_array();
        
    }
    
    public function unos($niz_insert_news)
    {
        $this->db->insert("news", $niz_insert_news);
    }
    
    public function remove_news($niz_remove_news)
    {
        $this->db->where($niz_remove_news);
        $this->db->delete("news");
    }
    
    public function update_news($niz_update_news, $update_id)
    {
        $this->db->where("news_id", $update_id);
        $this->db->update("news", $niz_update_news);
    }
    
    public function remove_feat()
    {
        $niz_remove = array("news_feat" => 0);
        $this->db->where("news_feat", 1);
        $this->db->update("news", $niz_remove);
    }
    
    public function set_feat($id)
    {
        $niz_set = array("news_feat" => 1);
        $this->db->where("news_id", $id);
        $this->db->update("news", $niz_set);
    }
    
}

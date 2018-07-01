<?php

class comment_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->database();
    }
    
    public function comment($niz_insert)
    {
        $this->db->insert("comment", $niz_insert);
    }
    
    public function comments($niz_comments)
    {
        $this->db->select("*");
        $this->db->from("comment");
        $this->db->join("user", "comment.comment_author = user.user_id");
        $this->db->where($niz_comments);
        $comments = $this->db->get();
        
        if($comments->num_rows() > 0)
        {
            return $comments->result_array();
        }
        else
        {
            return false;
        }
    }
    
    public function all_comments()
    {
        $this->db->select("*");
        $this->db->from("comment");
        $this->db->join("user", "comment.comment_author = user.user_id");
        $this->db->join("news", "comment.comment_parent = news.news_id");
        $all_comments = $this->db->get();
        return $all_comments->result_array();
    }
    
    public function single_comment($niz_comment)
    {
        $this->db->where($niz_comment);
        $single_comment = $this->db->get("comment");
        return $single_comment->row();
    }
    
    public function edit_comment($niz_update_comment, $update_id)
    {
        $this->db->where("comment_id", $update_id);
        $this->db->update("comment", $niz_update_comment);
    }
    
    public function remove_comment($niz_delete_comment)
    {
        $this->db->where($niz_delete_comment);
        $this->db->delete("comment");
    }
    
}

<?php

class poll_model extends CI_Model {
    
    public function __construct() 
    {
        parent::__construct();
        
        $this->load->database();
    }
    
    public function poll_random()
    {
        $this->db->order_by("poll_id", 'RANDOM');
        $this->db->limit(1);
        $poll_show = $this->db->get("poll");
        return $poll_show->row();
    }
    
    public function poll_show($niz_poll)
    {
        $poll_options = $this->db->get_where("poll_option", $niz_poll);
        return $poll_options->result_array();
    }
    
    public function poll_vote($niz_vote)
    {
        $vote_insert = $this->db->insert("poll_answer", $niz_vote);
        return $vote_insert;
    }
    
    public function all_polls()
    {
        $all_polls = $this->db->get("poll");
        return $all_polls->result_array();
    }
    
    public function insert_poll($niz_insert_poll)
    {
        $this->db->insert("poll", $niz_insert_poll);
    }
    
    public function one_poll($niz_edit_poll)
    {
        $one_poll = $this->db->get_where("poll", $niz_edit_poll);
        return $one_poll->row();
    }
    
    public function edit_poll($niz_update_poll, $update_id)
    {
        $this->db->where("poll_id", $update_id);
        $this->db->update("poll", $niz_update_poll);
    }
    
    public function remove_poll($niz_delete_poll)
    {
        $this->db->where($niz_delete_poll);
        $this->db->delete("poll");
    }
    
    public function all_options()
    {
        $this->db->select("*");
        $this->db->from("poll_option");
        $this->db->join("poll", "poll_option.option_parent = poll.poll_id");
        $all_options = $this->db->get();
        return $all_options->result_array();
    }
    
    public function insert_option($niz_insert_option)
    {
        $this->db->insert("poll_option", $niz_insert_option);
    }
    
    public function one_option($niz_edit_option)
    {
        $one_option = $this->db->get_where("poll_option", $niz_edit_option);
        return $one_option->row();
    }
    
    public function edit_option($niz_update_option, $update_id)
    {
        $this->db->where("option_id", $update_id);
        $this->db->update("poll_option", $niz_update_option);
    }
    
    public function remove_option($niz_delete_option)
    {
        $this->db->where($niz_delete_option);
        $this->db->delete("poll_option");
    }
    
}

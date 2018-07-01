<?php
    
class news extends prime {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model("class_model");
        $this->load->model("news_model");
        $this->load->model("comment_model");
    }
    
    public function index()
    {
        $input["title"] = "Plantae - News";
        
        $input["klase"] = $this->class_model->klase();
        $input["news"] = $this->news_model->news();
        
        $this->set_view("news_view", $input);
    }
    
    public function one($one)
    {
        $niz_one = array("news_id"=> $one);
        $single_news = $this->news_model->single_news($niz_one);
        
        if($single_news == false)
        {
            redirect("news");
        }
       
        $news_id = $single_news->news_id;
        $news_title = $single_news->news_title;
        $news_text = $single_news->news_text;
        $news_author = $single_news->user_nickname;
        $news_time = date("d/M/Y", $single_news->news_time);
        $news_class = $single_news->class_name;
        
        $niz_comments = array("comment_parent"=> $one);
        $comments = $this->comment_model->comments($niz_comments);
        
        if($comments == false)
        {
            $input["no"] = "No comments yet.";
        }
        else
        {
            $input["comments"] = $comments;
        }
        
        $input["title"] = "Plantae - ".$news_title;
        $input["news_id"] = $news_id;
        $input["news_title"] = $news_title;
        $input["news_text"] = $news_text;
        $input["news_author"] = $news_author;
        $input["news_time"] = $news_time;
        $input["news_class"] = $news_class;
        
        $this->set_view("one_view", $input);
    }
    
    public function comment()
    {
        $this->form_validation->set_rules("tbComment", "Comment", "trim|min_length[4]");
        
        $id = $this->input->post("tbId");
        
        if($this->form_validation->run() == false)
        {
            $niz_one = array("news_id"=> $id);
            $single_news = $this->news_model->single_news($niz_one);
            
            $news_id = $single_news->news_id;
            $news_title = $single_news->news_title;
            $news_text = $single_news->news_text;
            $news_author = $single_news->user_nickname;
            $news_time = date("d/M/Y", $single_news->news_time);
            $news_class = $single_news->class_name;
            
            $input["title"] = "Plantae - ".$news_title;
            $input["news_id"] = $news_id;
            $input["news_title"] = $news_title;
            $input["news_text"] = $news_text;
            $input["news_author"] = $news_author;
            $input["news_time"] = $news_time;
            $input["news_class"] = $news_class;

            $this->set_view("one_view", $input);
        }
        else
        {
            $comment_id = null;
            $comment = $this->input->post("tbComment");
            $author = $this->session->userdata("cactus_id");
            $time = time();
            
            $niz_insert = array(
                "comment_id"=> $comment_id,
                "comment_text"=> $comment,
                "comment_author"=> $author,
                "comment_time"=> $time,
                "comment_parent"=> $id
            );
            $this->comment_model->comment($niz_insert);
            redirect("news/one/".$id);
        }
    }
    
}

<?php

class klass extends prime {
    
    public function __construct() 
    {
        parent::__construct();
        
        $this->load->model("class_model");
        $this->load->model("poll_model");
    }
    
    public function index($idClass = null)
    {
        if($idClass == null)
        {
            redirect();
        }
        else
        {
            $klasa = $this->class_model->klasa($idClass);
            if($klasa == false)
            {
                redirect();
            }
            
            $class_name = $klasa->class_name;
            $class_img = $klasa->class_img;
            $class_text = $klasa->class_text;
            $class_view = $klasa->class_view;
            
            $poll_random = $this->poll_model->poll_random();
            $poll_id = $poll_random->poll_id;
            $poll_name = $poll_random->poll_name;
            
            $niz_poll = array("option_parent"=> $poll_id);
            $poll_options = $this->poll_model->poll_show($niz_poll);
            
            $input["title"] = "Plantae - ".$class_name;
            $input["text"] = $class_text;
            $input["image"] = $class_img;
            $input["poll_id"] = $poll_id;
            $input["poll_name"] = $poll_name;
            $input["poll_options"] = $poll_options;
                    
            $this->set_view($class_view, $input);
        }
        
    }
    
    public function vote()
    {
        $poll_id = $this->input->post("poll_id");
        $poll_option = $this->input->post("poll_option");
        
        $niz_vote = array("answer_parent" =>$poll_id, "answer_id" =>$poll_option);
        $vote_result = $this->poll_model->poll_vote($niz_vote);
        
        if($vote_result == true)
        {
            echo json_encode("You have successfully voted");
        }
        else
        {
            echo json_encode("Ups, something went wrong!");
        }
    }
    
}

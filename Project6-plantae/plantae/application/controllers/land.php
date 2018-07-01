<?php

class land extends prime {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model("class_model");
        $this->load->model("gallery_model");
        $this->load->model("news_model");
    }
    
    public function index()
    {
        $input["title"] = "Plantae - Home";
        $input["klase"] = $this->class_model->klase();
        
        $latest_news = $this->news_model->latest_news();
        $input["top_five"] = $latest_news;
        
        $feat_news = $this->news_model->feat_news();
        $input["feat"] = $feat_news;
        
        $this->set_view("land_view", $input);
    }
    
    public function creator()
    {
        $input["title"] = "Creator - Uroš Jovanović 11/13";
        
        $this->set_view("author_view", $input);
    }
    
    public function contact()
    {
        $input["title"] = "Plantae - Contact us";
        
        $this->set_view("contact_view", $input);
    }
    
    public function feedback()
    {
        $this->form_validation->set_rules("tbName", "Name", "required|trim");
        $this->form_validation->set_rules("tbEmail", "Email", "required|trim|valid_email");
        $this->form_validation->set_rules("tbSubject", "Subject", "required|trim");
        $this->form_validation->set_rules("taMessage", "Message", "required|trim|callback_audit_message|min_lenght[5]");
        
        if($this->form_validation->run() == false)
        {
            
        }
        else
        {
            $name = $this->input->post("tbName");
            $email = $this->input->post("tbEmail");
            $subject = $this->input->post("tbSubject");
            $message = $this->input->post("taMessage");
            
            $this->load->library('email');

            $this->email->from($email, $name);
            $this->email->to('uros.jovanovic.11.13@ict.edu.rs');
            $this->email->subject($subject);
            $this->email->message($message);
            
            if($this->email->send())
            {
                $input["mail"] = "Thank you for Feedback!";
            }
            else
            {
                $input["mail"] = "Ups, something went wrong";
            }
        }
        $input["title"] = "Plantae - Contact us";
        
        $this->set_view("contact_view", $input);
    }
    
    public function kingdom()
    {
        $galleries = $this->gallery_model->galleries();
        $gallery_first = $this->gallery_model->gallery_first();
        $gallery_first_id = $gallery_first->gallery_id;
        $niz_first = array("image_parent"=> $gallery_first_id);
        
        $image_first = $this->gallery_model->image_first($niz_first);
        $image_first_id = $image_first->image_id;
        $image_first_src = $image_first->image_src;
        $image_first_title = $image_first->image_title;
        $image_first_parent = $image_first->image_parent;
        
        
        $input["title"] = "Plantae - Kingdom";
        $input["galleries"] = $galleries;
        $input["image_first_id"] = $image_first_id;
        $input["image_first_src"] = $image_first_src;
        $input["image_first_title"] = $image_first_title;
        $input["image_first_parent"] = $image_first_parent;
        $input["cur"] = 0;
        
        $this->set_view("kingdom_view", $input);
    }
    
    public function gallery_ajax()
    {
        $gallery_id = $this->input->post("gallery_id");
        $niz_gallery = array("image_parent"=> $gallery_id);
        $gallery_click = $this->gallery_model->gallery_click($niz_gallery);
        
        $image_first_id = $gallery_click->image_id;
        $image_first_src = img($gallery_click->image_src);
        $image_first_title = heading("<i class='fa fa-bookmark'></i> ".$gallery_click->image_title, 2);
        $image_first_parent = $gallery_click->image_parent;
        $cur = 0;
        $para = $image_first_src."$".$image_first_title."$".$image_first_id."$".$image_first_parent."$".$cur;
        
        echo json_encode($para);
    }
    
    public function image_ajax()
    {
        $image_id = $this->input->post("image_id");
        $image_parent = $this->input->post("image_parent");
        $way = $this->input->post("way");
        $cur = $this->input->post("cur");
        if($way == "next")
        {
            $cur = $cur + 1;
        }
        else
        {
            $cur = $cur - 1;
        }
        $niz_image = array("image_parent"=> $image_parent);
        $total_images = $this->gallery_model->count_all($niz_image);
        $next = $cur + 1;
        $prev = $cur - 1;
        
        $nova_slika = $this->gallery_model->image_get($image_parent, $cur);
        $slika_id = $nova_slika->image_id;
        $slika_src = img($nova_slika->image_src);
        $slika_title = heading("<i class='fa fa-bookmark'></i> ".$nova_slika->image_title, 2);
        $slika_parent = $nova_slika->image_parent;
        $para = $slika_src."$".$slika_title."$".$slika_id."$".$slika_parent."$".$cur."$".$next."$".$prev."$".$total_images;
        
        echo json_encode($para);
    }
    
    public function audit_message($msg)
    {
        if (preg_match("/^[A-z0-9\,\.\s]{5,}$/", $msg))
        {
            return TRUE;
        } 
        else
        {
            $this->form_validation->set_message('audit_message', 'The %s field can not have special characters!');
            return FALSE;
        }
    }
    
    public function doc()
    {
        $this->load->helper('download');
        $this->load->helper('file');
        $data = file_get_contents("images/doc.pdf");
        $name = "php2_11_13.pdf";
        force_download($name, $data);
    }
    
}
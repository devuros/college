<?php

class prime extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model("prime_model");
    }
    
    public function set_view($view, $input)
    {
        $menu = $this->prime_model->menu();
        $html = "";
        
        foreach($menu as $menu_item)
        {
            $menu_item_id = $menu_item["menu_id"];
            $submenu = $this->prime_model->submenu($menu_item_id);
            
            $html .= "<div class='header-nav-box left'>";
            $html .= anchor($menu_item["menu_src"], $menu_item["menu_name"]);
            
            if($submenu != false)
            {
                $html .= "<ul class='submenu'>";
                foreach($submenu as $submenu_item)
                {
                    $html .= "<li>";
                    $html .= anchor($submenu_item["submenu_src"]."/".$submenu_item["submenu_class"], $submenu_item["submenu_name"]);
                    $html .= "</li>";
                }
                $html .= "</ul>";
            }
            $html .= "</div>";
        }
        $input["meni"] = $html;
                
        $this->load->view("head_view", $input);
        $this->load->view("header_view", $input);
        $this->load->view($view, $input);
        $this->load->view("footer_view", $input);
    }
}

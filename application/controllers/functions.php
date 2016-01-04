<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Functions extends CI_Controller
{
    private $use;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib(SYSTEM.'/'.HTTP.'/'.class_request);

    }

    public function items_food()
    {
        if(class_request::is_ajax()){

            $this->use->use_lib('functions/render_functions');

            $page = new render_functions();

            $page->items_food();

        }else{

           die();

        }
    }

    public function add_item_cart(){

        if(class_request::is_ajax()){

        $this->use->use_lib('site/food/class_cart');

        $class = new class_cart();

        $class->add();

        }else{

            die();
        }

    }

    public function cart(){

        $this->use->use_lib('site/sessions_customer');

        $session = new sessions_customer();

        print_r($session->cart());
    }

    public function remove_cart(){

        $this->use->use_lib('site/sessions_customer');

        $session = new sessions_customer();

        $session->remove_all_cart();
    }

    public function remove_item_cart(){

        if(class_request::is_ajax()){

            $this->use->use_lib('site/food/class_cart');

            $class = new class_cart();

            $class->remove();

        }else{

            die();

        }

    }

}

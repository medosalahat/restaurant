<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller
{
    private $use;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

    }

    public function index()
    {

        $this->use->use_lib('site/render_pages');

        $page = new render_pages();

        $page->page_home();

    }

    public function food(){

        $this->use->use_lib('site/render_pages');

        $page = new render_pages();

        $page->page_food();

    }

    public function check_out(){


        $this->use->use_lib('site/sessions_customer');

        $session = new sessions_customer();

        if ($session->get_login()) {

            $this->use->use_lib('site/render_pages');

            $page = new render_pages();

            $page->page_check_out();

        } else {

                $this->use->use_lib('site/render_pages');

                $page = new render_pages();

                $page->page_register();
        }


    }

    public function check_out_final(){

        $this->use->use_lib('system/post_get/class_post');

        $this->use->use_lib('site/customer/class_customer');

        $this->use->use_lib('db/tpl_customer');

            $class = new class_customer();

            $class->set(tpl_order_customer::order_customer() . tpl_order_customer::date_delivery(), 'post');

            $class->set( tpl_order_customer::order_customer() . tpl_order_customer::time_delivery(), 'post');

            $class->set( tpl_order_customer::order_customer().tpl_order_customer::id_shipping(), 'post');

            $class->check_out_final();
    }

    public function cart(){

        $this->use->use_lib('site/render_pages');

        $page = new render_pages();

        $page->page_cart();

    }

    public function services(){

        $this->use->use_lib('site/render_pages');

        $this->use->use_lib('system/post_get/class_get');

        $page = new render_pages();

        $id = new class_get('id');

        if($id->validation()){

            $page->page_post_services();

        }else{

            $page->page_services();

        }
    }

    public function post(){

        $this->use->use_lib('site/render_pages');

        $this->use->use_lib('system/post_get/class_get');

        $page = new render_pages();

        $id = new class_get('id');

        if($id->validation()){

            $page->page_post_id();

        }else{

            $page->page_post();

        }

    }

    public function login(){

        $this->use->use_lib('site/sessions_customer');

        $session = new sessions_customer();

        if ($session->get_login()) {

            redirect('site');

        } else {

            $this->use->use_lib('system/post_get/class_post');

            $this->use->use_lib('site/customer/class_customer');

            $this->use->use_lib('db/tpl_customer');

            $username = new class_post(tpl_customer::customer() . tpl_customer::username());


            if ($username->is_post()) {

                $class = new class_customer();

                $class->set(tpl_customer::customer() . tpl_customer::username(), 'post');

                $class->set(tpl_customer::customer() . tpl_customer::password(), 'post');

                $class->login();

            } else {
                $this->use->use_lib('site/render_pages');

                $page = new render_pages();

                $page->page_login();

            }
        }

    }

    public function register()
    {

        $this->use->use_lib('site/sessions_customer');

        $session = new sessions_customer();

        if ($session->get_login()) {

            redirect('site');

        } else {


            $this->use->use_lib('system/post_get/class_post');

            $this->use->use_lib('site/customer/class_customer');

            $this->use->use_lib('db/tpl_customer');

            $username = new class_post(tpl_customer::customer() . tpl_customer::username());


            if ($username->is_post()) {

                $class = new class_customer();

                $class->set(tpl_customer::customer() . tpl_customer::username(), 'post');

                $class->set(tpl_customer::customer() . tpl_customer::email(), 'post');

                $class->set(tpl_customer::customer() . tpl_customer::f_name(), 'post');

                $class->set(tpl_customer::customer() . tpl_customer::l_name(), 'post');

                $class->set(tpl_customer::customer() . tpl_customer::phone(), 'post');

                $class->set(tpl_customer::customer() . tpl_customer::mobile(), 'post');

                $class->set(tpl_customer::customer() . tpl_customer::address(), 'post');

                $class->set(tpl_customer::customer() . tpl_customer::full_address(), 'post');

                $class->set(tpl_customer::customer() . tpl_customer::password(), 'post');

                $class->register();

            } else {
                $this->use->use_lib('site/render_pages');

                $page = new render_pages();

                $page->page_register();

            }
        }

    }

    public function customer_check_username()
    {

        $this->use->use_lib('site/sessions_customer');

        $session = new sessions_customer();

        if (!$session->get_login()) {

            $this->use->use_lib('site/customer/class_customer');

            $this->use->use_lib('db/tpl_customer');

            $class = new class_customer();

            $class->set(tpl_customer::customer() . tpl_customer::username(), 'post');

            $class->customer_check_username();
        }
    }

    public function customer_check_email()
    {
        $this->use->use_lib('site/sessions_customer');

        $session = new sessions_customer();

        if (!$session->get_login()) {


            $this->use->use_lib('site/customer/class_customer');

            $this->use->use_lib('db/tpl_customer');

            $class = new class_customer();

            $class->set(tpl_customer::customer() . tpl_customer::email(), 'post');

            $class->customer_check_email();
        }
    }

    public function logout()
    {

        $this->use->use_lib('site/sessions_customer');

        $session = new sessions_customer();

        if ($session->get_login()) {

            $session->remove_login();
        }

        redirect('site');
    }


}
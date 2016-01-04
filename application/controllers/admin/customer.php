<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller
{
    private $use;

    private $class;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/customer_lib_ad');

        $this->use->use_lib('db/tpl_customer');

        $this->class = new customer_lib_ad();

        $this->use->use_lib('admin/sys/class_sessions_admin');

        $session = new class_sessions_admin();

        if(!$session->get_login_admin_in()){
            redirect('admin/home');
        }
    }

    public function index()
    {



        $session = new class_sessions_admin();

        if($session->get_login_admin_in()){

            $this->use->use_lib('admin/sys/render_admin');

            $page= new render_admin();

            $page->page_customer();
        }else{

            redirect('admin/home');
        }

    }



    public function find_all_ajax()
    {

        $this->class->find_all_ajax();
    }

    public function remove()
    {

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::id(),'post');

        $this->class->remove();

    }

    public function update()
    {
        $this->class->set(tpl_customer::customer().'_'.tpl_customer::id().'_update','post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::f_name().'_update','post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::l_name().'_update','post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::email().'_update','post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::username().'_update','post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::password().'_update','post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::phone().'_update','post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::mobile().'_update','post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::address().'_update','post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::full_address().'_update','post');

        $this->class->update();

    }

    public function update_status()
    {

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::id(),'post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::status(),'post');

        $this->class->update_status();

    }

    public function update_password()
    {

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::id().'_update_password','post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::password().'_update_password','post');

        $this->class->update_password();

    }

    public function insert()
    {

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::f_name(),'post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::l_name(),'post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::email(),'post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::username(),'post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::password(),'post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::phone(),'post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::mobile(),'post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::address(),'post');

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::full_address(),'post');

        $this->class->insert();


    }

    public function update_image(){

        $this->class->set(tpl_customer::customer().'_'.tpl_customer::id().'_update_image','post');

        $this->class->update_image();
    }


}
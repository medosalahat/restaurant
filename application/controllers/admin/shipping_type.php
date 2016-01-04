<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping_type extends CI_Controller
{
    private $use;

    private $class;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/shipping_type_lib_ad');

        $this->use->use_lib('db/tpl_shipping_type');

        $this->class = new shipping_type_lib_ad();

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

            $page->page_shipping_type();
        }else{

            redirect('admin/home');
        }

    }

    public function show(){

    }

    public function find_all_ajax()
    {

        $this->class->find_all_ajax();
    }

    public function remove()
    {

        $this->class->set(tpl_shipping_type::shipping_type().'_'.tpl_shipping_type::id(),'post');

        $this->class->remove();

    }

    public function update()
    {
        $this->class->set(tpl_shipping_type::shipping_type().'_'.tpl_shipping_type::name().'_update','post');

        $this->class->set(tpl_shipping_type::shipping_type().'_'.tpl_shipping_type::id().'_update','post');
        $this->class->set(tpl_shipping_type::shipping_type().'_'.tpl_shipping_type::price().'_update','post');

        $this->class->update();

    }

    public function update_status()
    {

        $this->class->set(tpl_shipping_type::shipping_type().'_'.tpl_shipping_type::id(),'post');

        $this->class->set(tpl_shipping_type::shipping_type().'_'.tpl_shipping_type::status(),'post');

        $this->class->update_status();

    }

    public function insert()
    {

        $this->class->set(tpl_shipping_type::shipping_type().'_'.tpl_shipping_type::name(),'post');
        $this->class->set(tpl_shipping_type::shipping_type().'_'.tpl_shipping_type::price(),'post');

        $this->class->insert();


    }


}
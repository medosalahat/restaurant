<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_order extends CI_Controller
{
    private $use;

    private $class;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/status_order_lib_ad');

        $this->use->use_lib('db/tpl_status_order');

        $this->class = new status_order_lib_ad();

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

            $page->page_status_order();
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

        $this->class->set(tpl_status_order::status_order().'_'.tpl_status_order::id(),'post');

        $this->class->remove();

    }

    public function update()
    {
        $this->class->set(tpl_status_order::status_order().'_'.tpl_status_order::name().'_update','post');

        $this->class->set(tpl_status_order::status_order().'_'.tpl_status_order::id().'_update','post');

        $this->class->update();

    }

    public function update_status()
    {

        $this->class->set(tpl_status_order::status_order().'_'.tpl_status_order::id(),'post');

        $this->class->set(tpl_status_order::status_order().'_'.tpl_status_order::status(),'post');

        $this->class->update_status();

    }

    public function insert()
    {

        $this->class->set(tpl_status_order::status_order().'_'.tpl_status_order::name(),'post');

        $this->class->insert();


    }


}
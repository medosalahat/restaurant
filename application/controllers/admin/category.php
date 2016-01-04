<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{
    private $use;

    private $class;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/category_lib_ad');

        $this->use->use_lib('db/tpl_category');

        $this->class = new category_lib_ad();

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

            $page->page_category();
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

        $this->class->set(tpl_category::category().'_'.tpl_category::id(),'post');

        $this->class->remove();

    }

    public function update()
    {
        $this->class->set(tpl_category::category().'_'.tpl_category::name().'_update','post');

        $this->class->set(tpl_category::category().'_'.tpl_category::id().'_update','post');

        $this->class->update();

    }

    public function update_status()
    {

        $this->class->set(tpl_category::category().'_'.tpl_category::id(),'post');

        $this->class->set(tpl_category::category().'_'.tpl_category::status(),'post');

        $this->class->update_status();

    }

    public function insert()
    {

        $this->class->set(tpl_category::category().'_'.tpl_category::name(),'post');

        $this->class->insert();


    }


}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller
{
    private $use;

    private $class;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/post_lib_ad');

        $this->use->use_lib('db/tpl_post');

        $this->class = new post_lib_ad();
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

            $page->page_post();
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

        $this->class->set(tpl_post::post().'_'.tpl_post::id(),'post');

        $this->class->remove();

    }

    public function update()
    {
        $this->class->set(tpl_post::post().'_'.tpl_post::title().'_update','post');

        $this->class->set(tpl_post::post().'_'.tpl_post::description().'_update','post');

        $this->class->set(tpl_post::post().'_'.tpl_post::id_category().'_update','post');

        $this->class->set(tpl_post::post().'_'.tpl_post::id().'_update','post');

        $this->class->update();

    }

    public function update_status()
    {

        $this->class->set(tpl_post::post().'_'.tpl_post::id(),'post');

        $this->class->set(tpl_post::post().'_'.tpl_post::status(),'post');

        $this->class->update_status();

    }

    public function update_service()
    {

        $this->class->set(tpl_post::post().'_'.tpl_post::id(),'post');

        $this->class->set(tpl_post::post().'_'.tpl_post::service(),'post');

        $this->class->update_service();

    }

    public function insert()
    {

        $this->class->set(tpl_post::post().'_'.tpl_post::title(),'post');

        $this->class->set(tpl_post::post().'_'.tpl_post::description(),'post');

        $this->class->set(tpl_post::post().'_'.tpl_post::id_category(),'post');

        $this->class->insert();


    }

    public function update_image(){

        $this->class->set(tpl_post::post().'_'.tpl_post::id().'_update_image','post');

        $this->class->update_image();
    }



}
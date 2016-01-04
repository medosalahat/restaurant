<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image_food extends CI_Controller
{
    private $use;

    private $class;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/image_food_lib_ad');

        $this->use->use_lib('db/tpl_image_food');

        $this->class = new image_food_lib_ad();

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

            $page->page_image_food();
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

        $this->class->set(tpl_image_food::image_food().'_'.tpl_image_food::id(),'post');

        $this->class->remove();

    }

    public function update()
    {
        $this->class->set(tpl_image_food::image_food().'_'.tpl_image_food::title().'_update','post');

        $this->class->set(tpl_image_food::image_food().'_'.tpl_image_food::description().'_update','post');

        $this->class->set(tpl_image_food::image_food().'_'.tpl_image_food::id_food().'_update','post');

        $this->class->set(tpl_image_food::image_food().'_'.tpl_image_food::id().'_update','post');

        $this->class->update();

    }

    public function update_status()
    {

        $this->class->set(tpl_image_food::image_food().'_'.tpl_image_food::id(),'post');

        $this->class->set(tpl_image_food::image_food().'_'.tpl_image_food::status(),'post');

        $this->class->update_status();

    }

    public function insert()
    {

        $this->class->set(tpl_image_food::image_food().'_'.tpl_image_food::title(),'post');

        $this->class->set(tpl_image_food::image_food().'_'.tpl_image_food::id_food(),'post');

        $this->class->set(tpl_image_food::image_food().'_'.tpl_image_food::description(),'post');

        $this->class->insert();


    }

    public function update_image(){


        $this->class->set(tpl_image_food::image_food().'_'.tpl_image_food::id().'_update_image','post');

        $this->class->update_image();
    }


}
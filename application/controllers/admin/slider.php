<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller
{
    private $use;

    private $class;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/slider_lib_ad');

        $this->use->use_lib('db/tpl_slider');

        $this->class = new slider_lib_ad();

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

            $page->page_slider();
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

        $this->class->set(tpl_slider::slider().'_'.tpl_slider::id(),'post');

        $this->class->remove();

    }

    public function update()
    {
        $this->class->set(tpl_slider::slider().'_'.tpl_slider::title().'_update','post');
        $this->class->set(tpl_slider::slider().'_'.tpl_slider::description().'_update','post');

        $this->class->set(tpl_slider::slider().'_'.tpl_slider::id().'_update','post');

        $this->class->update();

    }

    public function update_status()
    {

        $this->class->set(tpl_slider::slider().'_'.tpl_slider::id(),'post');

        $this->class->set(tpl_slider::slider().'_'.tpl_slider::status(),'post');

        $this->class->update_status();

    }

    public function insert()
    {

        $this->class->set(tpl_slider::slider().'_'.tpl_slider::title(),'post');
        $this->class->set(tpl_slider::slider().'_'.tpl_slider::description(),'post');


        $this->class->insert();


    }

    public function update_image(){

        $this->class->set(tpl_slider::slider().'_'.tpl_slider::id().'_update_image','post');

        $this->class->update_image();
    }


}
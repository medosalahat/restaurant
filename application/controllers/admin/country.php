<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country extends CI_Controller
{
    private $use;

    private $class;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/country_lib_ad');

        $this->use->use_lib('db/tpl_country');

        $this->class = new country_lib_ad();

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

            $page->page_country();
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

        $this->class->set(tpl_country::country().'_'.tpl_country::id(),'post');

        $this->class->remove();

    }

    public function update()
    {
        $this->class->set(tpl_country::country().'_'.tpl_country::name().'_update','post');

        $this->class->set(tpl_country::country().'_'.tpl_country::id().'_update','post');

        $this->class->set(tpl_country::country().'_'.tpl_country::short_name().'_update','post');

        $this->class->set(tpl_country::country().'_'.tpl_country::description().'_update','post');

        $this->class->update();

    }

    public function update_status()
    {

        $this->class->set(tpl_country::country().'_'.tpl_country::id(),'post');

        $this->class->set(tpl_country::country().'_'.tpl_country::status(),'post');

        $this->class->update_status();

    }

    public function insert()
    {

        $this->class->set(tpl_country::country().'_'.tpl_country::name(),'post');

        $this->class->set(tpl_country::country().'_'.tpl_country::description(),'post');

        $this->class->set(tpl_country::country().'_'.tpl_country::short_name(),'post');

        $this->class->insert();


    }


}
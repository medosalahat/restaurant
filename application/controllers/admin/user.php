<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    private $use;

    private $class;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/user_lib_ad');

        $this->use->use_lib('db/tpl_user_site');

        $this->class = new user_lib_ad();

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

            $page->page_user_site();
        }else{

            redirect('admin/home');
        }

    }

    public function show(){

    }

    public function me(){

    }

    public function find_all_ajax()
    {

        $this->class->find_all_ajax();
    }

    public function remove()
    {

        $this->class->set(tpl_user_site::user_site().'_'.tpl_user_site::id(),'post');

        $this->class->remove();

    }

    public function update()
    {
        $this->class->set(tpl_user_site::user_site().'_'.tpl_user_site::username().'_update','post');

        $this->class->set(tpl_user_site::user_site().'_'.tpl_user_site::name().'_update','post');

        $this->class->set(tpl_user_site::user_site().'_'.tpl_user_site::id().'_update','post');

        $this->class->update();

    }

    public function update_status()
    {

        $this->class->set(tpl_user_site::user_site().'_'.tpl_user_site::id(),'post');

        $this->class->set(tpl_user_site::user_site().'_'.tpl_user_site::status(),'post');

        $this->class->update_status();

    }

    public function insert()
    {

        $this->class->set(tpl_user_site::user_site().'_'.tpl_user_site::name(),'post');
        $this->class->set(tpl_user_site::user_site().'_'.tpl_user_site::username(),'post');
        $this->class->set(tpl_user_site::user_site().'_'.tpl_user_site::password(),'post');

        $this->class->insert();


    }

    public function check_username(){

        if(isset($_GET['a'])){

        $this->class->set(tpl_user_site::user_site().'_'.tpl_user_site::username().'_update','post');

        $this->class->check_username();

        }else if(isset($_GET['s'])){

            $this->class->set(tpl_user_site::user_site().'_'.tpl_user_site::username(),'post');

            $this->class->check_username();

        }
    }

    public function update_password()
    {

        $this->class->set(tpl_user_site::user_site().'_'.tpl_user_site::id().'_update_password','post');

        $this->class->set(tpl_user_site::user_site().'_'.tpl_user_site::password().'_update_password','post');

        $this->class->update_password();

    }

    public function update_image(){

        $this->class->set(tpl_user_site::user_site().'_'.tpl_user_site::id().'_update_image','post');

        $this->class->update_image();
    }

}
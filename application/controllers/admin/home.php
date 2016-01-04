<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {


    private $use;

    public function __construct(){

        parent::__construct();

        $this->use = new class_loader();
        $this->use->use_lib('admin/sys/class_sessions_admin');

    }

    public function index(){



        $session = new class_sessions_admin();

        if($session->get_login_admin_in()){

            $this->use->use_lib('admin/sys/render_admin');

            $page= new render_admin();

            $page->page_index();
        }else{

            $this->login();
        }
    }

    public function login(){

            $this->use->use_lib('admin/sys/render_admin');

            $page= new render_admin();

           $page->page_login();

    }

    public function login_now(){


            $this->use->use_lib('admin/user_lib_ad');

            $this->use->use_lib('db/tpl_user_site');

            $this->use->use_lib('system/bootstrap/class_massage');

            $user = new user_lib_ad();

            if($user->set(tpl_user_site::user_site().'_'.tpl_user_site::username(),'post') &&

            $user->set(tpl_user_site::user_site().'_'.tpl_user_site::password(),'post')){

                echo  $user->find_users_login();

            }else{

                echo json_encode(array('valid'=>false,'massage'=>class_massage::danger('Oops !!','Check Input Now ')));
            }


    }

    public function logout(){


        $this->use->use_lib('admin/sys/class_sessions_admin');

        $session = new class_sessions_admin();


            $session->remove_login_admin();

            redirect(site_url('admin/home'));



    }



}
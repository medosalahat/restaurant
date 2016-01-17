<?php

class class_sessions_admin
{
    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_lib('session');

    }

    public function get_login_admin()
    {

        $data = $this->CI->session->userdata('login_admin');

        if ($data==1) {

            return false;
        }

        return true;
    }

    public function remove_login_admin()
    {

        $this->CI->session->set_userdata('login_admin', false);

        $this->CI->session->unset_userdata('login_admin');

        return true;

    }

    public function new_login_admin()
    {

        $this->CI->session->set_userdata('login_admin', true);

        return true;

    }

    public function set_id_user($id_user){

        $this->CI->session->set_userdata('id_user_admin',$id_user);

    }

    public function Get_id_user(){


       return $this->CI->session->userdata('id_user_admin');

    }

    public function get_login_admin_in()
    {

        $data = $this->CI->session->userdata('login_admin');

        if ($data==1) {

            return true;
        }

        return false;
    }

    public function test(){

        print_r($this->CI->session->userdata);
    }
}

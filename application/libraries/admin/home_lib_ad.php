<?php
class home_lib_ad
{
    private $CI;

    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_lib('site/sessions');

        $session = new sessions();

        if(!$session->get_login_admin()){

            exit();
        }

        $this->use->use_model('data_base');
    }

    public function find_all(){

    }

    public function find_all_ajax(){

    }

    public function remove(){

    }

    public function insert(){

    }

    public function update(){

    }
}
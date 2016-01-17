<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller
{
    private $use;

    public function __construct()
    {

        parent::__construct();
        $this->use = new class_loader();
    }
    public  function index(){

        echo '<pre>';
        $this->use->use_lib('session');

        print_r($this->session->userdata);

        $this->session->set_userdata('id_user_admin_2',false);

        echo '*********************';

        print_r($this->session->userdata);
        $this->session->unset_userdata('id_user_admin_2');
        echo '*********************';
        print_r($this->session->userdata);
    }

    public function sum($one ,$two){


        return $one+$two;
    }
}
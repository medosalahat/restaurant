<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class class_loader
{

    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function use_lib($index){

        $this->CI->load->library($index);
    }

    public function use_model($index){

        $this->CI->load->model($index);
    }

    public function use_lin($index,$type){

        $this->CI->lang->load($index, $type);
    }
}


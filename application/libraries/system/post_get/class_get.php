<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class class_get
{
    private $index;

    public function __construct($index = null)
    {
        $this->index = $index;
    }

    public function validation(){


        if(isset($_GET[$this->index]) || !empty($_GET[$this->index])){

            return true;
        }
        return false;

    }

    public function is_get(){

        if(isset($_GET[$this->index])){

            return true;

        }

        return false;
    }

    public function empty_get(){

        if(empty($_GET[$this->index])){

            return false;
        }

        return true;
    }

    public function get_value(){

        return $_GET[$this->index];

    }


}

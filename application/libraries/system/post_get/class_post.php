<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class class_post
{
    private $index;

    public function __construct($index = null)
    {
        $this->index = $index;
    }

    public function validation(){


        if(isset($_POST[$this->index]) && !empty($_POST[$this->index])){

            return true;
        }
        return false;

    }

    public function is_post(){

        if(isset($_POST[$this->index])){

            return true;

        }

        return false;
    }

    public function empty_post(){

        if(empty($_POST[$this->index])){

            return false;
        }

        return true;
    }

    public function get_value(){

        return $_POST[$this->index];

    }


}

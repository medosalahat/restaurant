<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class class_upload_image
{
    private $CI;

    private $index_file;

    private $path_file;


    public function __construct($index= null , $path_file = null){

        $this->CI = &get_instance();

        $this->index_file = $index;
        $this->path_file = $path_file;
    }

    public function get_type(){

        return $_FILES[$this->index_file]["type"];

    }

    public function get_error()
    {
        if ($_FILES[$this->index_file]["error"] > 0) {

            return $_FILES[$this->index_file]["error"];

        }

        return true;
    }

    public function get_name()
    {
        return $_FILES[$this->index_file]["name"];
    }


    public function get_temp()
    {
        return $_FILES[$this->index_file]["tmp_name"];
    }

    public function rename()
    {
        $temp = explode(".",$this->get_name());

        return "_".md5(rand(1,99999)) . '.' .end($temp);
    }

    public function get_path_file(){

        return $this->path_file;
    }

    public function move_file()
    {

        if (!file_exists($this->get_path_file())) {
            mkdir($this->get_path_file(), 0777, true);
        }

        $path = $this->get_path_file().'/'.$this->rename();

        if ( move_uploaded_file($this->get_temp(),$path)) {

            return $path;
        }

        return false;
    }


}
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class date_time{

    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

    }

    public static function Date_time()
    {

        return  date('Y-m-d h:i:s');
    }

    public static function Date_time_24()
    {

        return  date('Y-m-d H:i:s');
    }

    public static function Date(){


        return  date('Y-m-d');
    }

    public static function Time(){

        return  date('h:i:s');
    }

    public static function Time_24(){

        return  date('H:i:s');

    }
}
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class template_render_load
{
    private $CI ;

    private $DATA;

    private $__DIRECTORY;

    private $__FILE_HTML  = 'html';

    private $__REGION;

    public function __construct( $DIRECTORY = null , $REGION = null)
    {
        $this->CI = &get_instance();

        $this->__DIRECTORY = $DIRECTORY;

        $this->__REGION = $REGION;

    }

    public function render_page()
    {

        $this->CI->template_load->write_view($this->__GET_REGION(),$this->___GET_VIEW_HTML(),$this->get_data());

    }

    public function render(){

        $this->CI->template_load->render();
    }

    public function set_data($DATA,$INDEX){

        $this->DATA[$INDEX] = $DATA;
    }

    public function get_data(){

        return $this->DATA;
    }

    public function __GET_DIRECTORY(){

        return $this->__DIRECTORY;
    }

    public function __GET_REGION(){

        return $this->__REGION;
    }

    public function ___GET_VIEW_HTML(){

        return $this->__GET_DIRECTORY().'/'.$this->__FILE_HTML;
    }







}
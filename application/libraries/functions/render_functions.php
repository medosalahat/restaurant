<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class render_functions
{
    private $CI;

    private $temp;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function items_food(){

        $temp = new template_render_load('functions/food_items', 'content');

        $temp->render_page();

        $temp->render();
    }
}
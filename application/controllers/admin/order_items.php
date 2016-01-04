<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class order_items extends CI_Controller
{
    private $use;

    private $class;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/order_items_lib_ad');

        $this->use->use_lib('db/tpl_order_items');

        $this->class = new order_items_lib_ad();
        $this->use->use_lib('admin/sys/class_sessions_admin');

        $session = new class_sessions_admin();

        if(!$session->get_login_admin_in()){
            redirect('admin/home');
        }
    }

    public function index()
    {


        $session = new class_sessions_admin();

        if($session->get_login_admin_in()){

            $this->use->use_lib('admin/sys/render_admin');

            $page= new render_admin();

            $page->page_order_items();
        }else{

            redirect('admin/home');
        }

    }

    public function show(){

    }

    public function find_all_ajax()
    {

        $this->class->find_all_ajax();
    }

    public function remove()
    {

        $this->class->set(tpl_order_items::order_items().'_'.tpl_order_items::id(),'post');

        $this->class->remove();

    }

    public function update()
    {
        $this->class->set(tpl_order_items::order_items().'_'.tpl_order_items::id_food().'_update','post');

        $this->class->set(tpl_order_items::order_items().'_'.tpl_order_items::id_order().'_update','post');

        $this->class->set(tpl_order_items::order_items().'_'.tpl_order_items::qty().'_update','post');

        $this->class->set(tpl_order_items::order_items().'_'.tpl_order_items::id().'_update','post');

        $this->class->update();

    }



    public function insert()
    {

        $this->class->set(tpl_order_items::order_items().'_'.tpl_order_items::id_order(),'post');

        $this->class->set(tpl_order_items::order_items().'_'.tpl_order_items::id_food(),'post');

        $this->class->set(tpl_order_items::order_items().'_'.tpl_order_items::qty(),'post');

        $this->class->insert();

    }


}
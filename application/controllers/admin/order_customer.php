<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_customer extends CI_Controller
{
    private $use;

    private $class;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/order_customer_lib_ad');

        $this->use->use_lib('db/tpl_food');

        $this->use->use_lib('db/tpl_order_customer');

        $this->use->use_lib('db/tpl_status_order');

        $this->use->use_lib('db/tpl_shipping_type');

        $this->class = new order_customer_lib_ad();
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

            $page->page_order_customer();
        }else{

            redirect('admin/home');
        }

    }

    public function show(){

        $this->use->use_lib('admin/sys/render_admin');

        $page= new render_admin();

        $page->page_order_customer_show();

    }

    public function find_all_ajax()
    {

        $this->class->find_all_ajax();
    }

    public function remove()
    {

        $this->class->set(tpl_order_customer::order_customer().'_'.tpl_order_customer::id(),'post');

        $this->class->remove();

    }

    public function update()
    {

        $this->class->set(tpl_order_customer::order_customer().'_'.tpl_order_customer::id_customer().'_update','post');

        $this->class->set(tpl_order_customer::order_customer().'_'.tpl_order_customer::date_delivery().'_update','post');

        $this->class->set(tpl_order_customer::order_customer().'_'.tpl_order_customer::time_delivery().'_update','post');

        $this->class->set(tpl_order_customer::order_customer().'_'.tpl_order_customer::id_shipping().'_update','post');

        $this->class->set(tpl_order_customer::order_customer().'_'.tpl_order_customer::id_status_oder().'_update','post');

        $this->class->set(tpl_order_customer::order_customer().'_'.tpl_order_customer::id().'_update','post');

        $this->class->update();

    }

    public function update_status()
    {

        $this->class->set(tpl_order_customer::order_customer().'_'.tpl_order_customer::id(),'post');

        $this->class->set(tpl_order_customer::order_customer().'_'.tpl_order_customer::id_status_oder(),'post');

        $this->class->update_status();

    }

    public function insert()
    {

        $this->class->set(tpl_order_customer::order_customer().'_'.tpl_order_customer::id_customer(),'post');

        $this->class->set(tpl_order_customer::order_customer().'_'.tpl_order_customer::date_delivery(),'post');

        $this->class->set(tpl_order_customer::order_customer().'_'.tpl_order_customer::time_delivery(),'post');

        $this->class->set(tpl_order_customer::order_customer().'_'.tpl_order_customer::id_status_oder(),'post');

        $this->class->set(tpl_order_customer::order_customer().'_'.tpl_order_customer::id_shipping(),'post');

        $this->class->insert();


    }

    public function Find_all_status_order(){

        $this->class->find_all_status_order();
    }

    public function new_order_ajax(){

        $this->class->new_order_ajax();
    }


}
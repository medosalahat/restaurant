<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class render_admin
{
    private $CI;

    private $temp;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function page_index(){

        $this->temp = new template_render_ajax('admin/index','content');

        $this->temp->render_page();

        $this->temp->name_page('Welcome');

        $this->temp->render();

    }

    public function page_category(){

        $this->temp = new template_render_ajax('admin/category','content');

        $this->temp->render_page();

        $this->temp->name_page('Category');

        $this->temp->render();

    }

    public function page_country(){

        $this->temp = new template_render_ajax('admin/country','content');

        $this->temp->render_page();

        $this->temp->name_page('Country');

        $this->temp->render();

    }


    public function page_customer(){

        $this->temp = new template_render_ajax('admin/customer','content');

        $this->temp->render_page();

        $this->temp->name_page('Customer');

        $this->temp->render();

    }

    public function page_food(){

        $this->temp = new template_render_ajax('admin/food','content');

        $this->temp->render_page();

        $this->temp->name_page('Food');

        $this->temp->render();

    }

    public function page_order_customer(){

        $this->temp = new template_render_ajax('admin/order_customer','content');

        $this->temp->render_page();

        $this->temp->name_page('Order customer');

        $this->temp->render();

    }

    public function page_order_customer_show(){

        $this->temp = new template_render_ajax('admin/order_customer/show','content');

        $this->temp->render_page();

        $this->temp->name_page('Order customer');

        $this->temp->render();

    }

    public function page_section_food(){

        $this->temp = new template_render_ajax('admin/section_food','content');

        $this->temp->render_page();

        $this->temp->name_page('Section food');

        $this->temp->render();

    }

    public function page_section_food_show(){


        $this->temp = new template_render_ajax('admin/section_food/show','content');

        $this->temp->render_page();

        $this->temp->name_page('Section food');

        $this->temp->render();

    }

    public function page_order_items(){


        $this->temp = new template_render_ajax('admin/order_items','content');

        $this->temp->render_page();

        $this->temp->name_page('order items');

        $this->temp->render();

    }

    public function page_status_order(){


        $this->temp = new template_render_ajax('admin/status_order','content');

        $this->temp->render_page();

        $this->temp->name_page('status order');

        $this->temp->render();

    }

    public function page_shipping_type(){


        $this->temp = new template_render_ajax('admin/shipping_type','content');

        $this->temp->render_page();

        $this->temp->name_page('shipping type');

        $this->temp->render();

    }


    public function page_post(){

        $this->temp = new template_render_ajax('admin/post','content');

        $this->temp->render_page();

        $this->temp->name_page('post');

        $this->temp->render();

    }


    public function page_user_site(){

        $this->temp = new template_render_ajax('admin/user_site','content');

        $this->temp->render_page();

        $this->temp->name_page('user site');

        $this->temp->render();

    }

    public function page_image_food(){

        $this->temp = new template_render_ajax('admin/image_food','content');

        $this->temp->render_page();

        $this->temp->name_page('image food');

        $this->temp->render();

    }

    public function page_slider(){

        $this->temp = new template_render_ajax('admin/slider','content');

        $this->temp->render_page();

        $this->temp->name_page('slider');

        $this->temp->render();

    }




    public function page_login(){

        $this->temp = new template_render_ajax('admin/login','content');

        $this->temp->render_page();

        $this->temp->name_page('Login');

        $this->temp->render();

    }


}
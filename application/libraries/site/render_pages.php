<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class render_pages
{
    private $CI;

    private $temp;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function page_home()
    {

        $this->menu();

        $this->slider();

        $this->booking();

        $this->menu_items();

        $this->home_food();

        $this->services();

        $this->footer();

        $temp = new template_render('site/home', 'content');

        $temp->render_page();

        $temp->name_page('Home');

        $temp->render();

    }

    public function page_register()
    {

        $this->menu();

        $this->footer();

        $temp = new template_render('site/register', 'content');

        $temp->render_page();

        $temp->name_page('Register');

        $temp->render();

    }

    public function page_services(){

        $this->menu();

        $this->footer();

        $temp = new template_render('site/services/post', 'content');

        $temp->render_page();

        $temp->name_page('Services');

        $temp->render();


    }

    public function page_post(){

        $this->menu();

        $this->footer();

        $temp = new template_render('site/post/all', 'content');

        $temp->render_page();

        $temp->name_page('Posts');

        $temp->render();


    }

    public function page_check_out(){

        $this->menu();

        $this->footer();

        $temp = new template_render('site/check_out', 'content');

        $temp->render_page();

        $temp->name_page('Check out');

        $temp->render();

    }


    public function page_post_id(){

        $this->menu();

        $this->footer();

        $temp = new template_render('site/post/id', 'content');

        $temp->render_page();

        $temp->name_page('Posts');

        $temp->render();


    }

    public function page_post_services(){

        $this->menu();

        $this->footer();

        $temp = new template_render('site/services/id', 'content');

        $temp->render_page();

        $temp->name_page('Services');

        $temp->render();


    }

    public function page_login()
    {

        $this->menu();

        $this->footer();

        $temp = new template_render('site/login', 'content');

        $temp->render_page();

        $temp->name_page('Login');

        $temp->render();

    }

    public function page_food(){


        $this->menu();

        $this->footer();

        $temp = new template_render('site/food', 'content');

        $temp->render_page();

        $temp->name_page('Food');

        $temp->render();

    }

    public function page_cart(){


        $this->menu();

        $this->footer();

        $temp = new template_render('site/cart', 'content');

        $temp->render_page();

        $temp->name_page('Cart');

        $temp->render();

    }


    public function menu()
    {

        $temp = new template_render('site/menu', 'menu');

        $temp->render_page();

    }

    public function slider()
    {


        $temp = new template_render('site/slider', 'slider');

        $temp->render_page();

    }

    public function footer()
    {


        $temp = new template_render('site/footer', 'footer');

        $temp->render_page();
    }

    public function booking()
    {

        $temp = new template_render('site/booking', 'booking');

        $temp->render_page();

    }

    public function menu_items()
    {


        $temp = new template_render('site/menu_items', 'menu_items');

        $temp->render_page();

    }

    public function home_food()
    {

        $temp = new template_render('site/home_food', 'home_food');

        $temp->render_page();
    }

    public function services()
    {

        $temp = new template_render('site/services', 'services');

        $temp->render_page();

    }
}
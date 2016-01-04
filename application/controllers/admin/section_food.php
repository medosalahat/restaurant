<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section_food extends CI_Controller
{
    private $use;

    private $class;

    public function __construct()
    {

        parent::__construct();

        $this->use = new class_loader();

        $this->use->use_lib('admin/section_food_lib_ad');

        $this->use->use_lib('db/tpl_section_food');

        $this->class = new section_food_lib_ad();
        $this->use->use_lib('admin/sys/class_sessions_admin');

        $session = new class_sessions_admin();

        if(!$session->get_login_admin_in()){
            redirect('admin/home');
        }
    }

    public function index()
    {


        $session = new class_sessions_admin();

        if ($session->get_login_admin_in()) {

            $this->use->use_lib('admin/sys/render_admin');

            $page = new render_admin();

            $page->page_section_food();
        } else {

            redirect('admin/home');
        }

    }

    public function show()
    {

        $this->use->use_lib('admin/sys/class_sessions_admin');

        $session = new class_sessions_admin();

        if ($session->get_login_admin_in()) {

            $this->use->use_lib('admin/sys/render_admin');

            $page = new render_admin();

            $page->page_section_food_show();
        } else {

            redirect('admin/home');
        }

    }

    public function find_all_ajax()
    {

        $this->class->find_all_ajax();
    }

    public function remove()
    {

        $this->class->set(tpl_section_food::section_food() . '_' . tpl_section_food::id(), 'post');

        $this->class->remove();

    }

    public function update()
    {
        $this->class->set(tpl_section_food::section_food() . '_' . tpl_section_food::description() . '_update', 'post');

        $this->class->set(tpl_section_food::section_food() . '_' . tpl_section_food::short_name() . '_update', 'post');

        $this->class->set(tpl_section_food::section_food() . '_' . tpl_section_food::name() . '_update', 'post');

        $this->class->set(tpl_section_food::section_food() . '_' . tpl_section_food::id() . '_update', 'post');

        $this->class->set(tpl_section_food::section_food() . '_' . tpl_section_food::id_country() . '_update', 'post');

        $this->class->update();

    }

    public function update_status()
    {

        $this->class->set(tpl_section_food::section_food() . '_' . tpl_section_food::id(), 'post');

        $this->class->set(tpl_section_food::section_food() . '_' . tpl_section_food::status(), 'post');

        $this->class->update_status();

    }

    public function insert()
    {

        $this->class->set(tpl_section_food::section_food() . '_' . tpl_section_food::name(), 'post');
        $this->class->set(tpl_section_food::section_food() . '_' . tpl_section_food::description(), 'post');
        $this->class->set(tpl_section_food::section_food() . '_' . tpl_section_food::short_name(), 'post');
        $this->class->set(tpl_section_food::section_food() . '_' . tpl_section_food::id_country(), 'post');

        $this->class->insert();


    }

    public function update_image(){

        $this->class->set(tpl_section_food::section_food().'_'.tpl_section_food::id().'_update_image','post');

        $this->class->update_image();
    }


}
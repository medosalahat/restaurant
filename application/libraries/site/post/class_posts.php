<?php

class class_posts
{
    private $CI;

    private $use;

    private $name = 'post';


    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_model('data_base');

        $this->use->use_lib('db/tpl_' . $this->name);

    }

    public function find_active()
    {

        $db = new data_base(

            tpl_post::post(),
            array(

                tpl_post::id(),
                tpl_post::title(),
                tpl_post::description(),
                tpl_post::image_path(),

            ), array(
                tpl_post::status() => 1
            )
        );
        return $db->get_where();
    }

    public function find_service()
    {

        $db = new data_base(

            tpl_post::post(),
            array(

                tpl_post::id(),
                tpl_post::description(),
                tpl_post::icon(),
                tpl_post::title(),
                tpl_post::image_path()
            ), array(
                tpl_post::status() => 0,
                tpl_post::service() => 1,
            )
        );
        return $db->get_where();
    }

    public function find_by_id($id)
    {

        $db = new data_base(

            tpl_post::post(),
            array(

                tpl_post::id(),
                tpl_post::description(),
                tpl_post::icon(),
                tpl_post::title(),
                tpl_post::image_path()
            ), array(
               tpl_post::id()=>$id
            )
        );
        return $db->get_where();
    }

    public function search_by_id($id)
    {
        $db = new data_base(

            tpl_post::post(),
            array(
                tpl_post::id(),
            ), array(
                tpl_post::id()=>$id
            )
        );
        if (empty($db->get_where())) {

            return true;
        } else {

            return false;
        }
    }
}
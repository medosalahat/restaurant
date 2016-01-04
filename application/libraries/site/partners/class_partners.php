<?php
class class_partners
{
    private $CI;

    private $use;

    private $name = 'partners';


    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_model('data_base');

        $this->use->use_lib('db/tpl_'.$this->name);

    }

    public function find_active(){

        $db = new data_base(

            tpl_partners::partners(),
            array(

                tpl_partners::id(),
                tpl_partners::name(),
                tpl_partners::image_path(),
                tpl_partners::url(),
            ),array(
                tpl_partners::status()=>1
            )
        );
        return $db->get_where();
    }
}
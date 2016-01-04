<?php
class class_category
{
    private $CI;

    private $use;

    private $name = 'category';


    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_model('data_base');

        $this->use->use_lib('db/tpl_'.$this->name);

    }

    public function find_active(){

        $db = new data_base(

            tpl_category::category(),
            array(

                tpl_category::id(),

                tpl_category::name(),
            ),array(
                tpl_category::status()=>1
            )
        );
        return $db->get_where();
    }
}
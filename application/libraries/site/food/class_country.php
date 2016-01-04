<?php
class class_country
{
    private $CI;

    private $use;

    private $name = 'country';

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_model('data_base');

        $this->use->use_lib('db/tpl_'.$this->name);


    }

    public function find_active(){

        $db = new data_base(

            tpl_country::country(),
            array(

                tpl_country::id(),

                tpl_country::name(),

                tpl_country::description(),

                tpl_country::short_name(),

            ),array(
                tpl_country::status()=>1
            )
        );


        return $db->get_where();

    }

}
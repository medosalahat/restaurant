<?php
class class_section_food
{
    private $CI;

    private $use;

    private $name = 'section_food';

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_model('data_base');

        $this->use->use_lib('db/tpl_'.$this->name);


    }

    public function find_active($id_country){

        $db = new data_base(

            tpl_section_food::section_food(),
            array(

                tpl_section_food::id(),

                tpl_section_food::short_name(),


            ),array(
                tpl_section_food::status()=>1,
                tpl_section_food::id_country()=>$id_country,
            )
        );


        return $db->get_where();

    }

    public function check_section($id){

        $db = new data_base(
            tpl_section_food::section_food(),
            array(
                tpl_section_food::id()
            ),
            array(
                tpl_section_food::id()=>$id
            )
        );

        if(empty($db->get_where())){

            return true;
        }else{

            return false;
        }
    }
    public function get_name_section($id){
        $db = new data_base(
            tpl_section_food::section_food(),
            array(
                tpl_section_food::name(),
                tpl_section_food::description(),
            ),
            array(
                tpl_section_food::id()=>$id
            )
        );

        return array_shift($db->get_where());
    }

}
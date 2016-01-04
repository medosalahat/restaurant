<?php
class class_image_food
{
    private $CI;

    private $use;

    private $name = 'image_food';

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_model('data_base');

        $this->use->use_lib('db/tpl_'.$this->name);


    }

    public function find_Image($Id_food){

        $db = new data_base(

            tpl_image_food::image_food(),
            array(
               tpl_image_food::id(),
               tpl_image_food::path_image(),

            ),array(
                tpl_image_food::status()=>1,
                tpl_image_food::id_food()=>$Id_food,
            ),array(
                1
            )
        );
        return $db->get_where_limit();
    }

}
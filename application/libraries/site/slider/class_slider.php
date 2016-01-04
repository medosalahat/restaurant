<?php
class class_slider
{
    private $CI;

    private $use;

    private $name = 'slider';

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_model('data_base');

        $this->use->use_lib('db/tpl_'.$this->name);
    }


    public function find_active(){
        $db = new data_base(
            tpl_slider::slider(),
            array(
                tpl_slider::id(),
                tpl_slider::title(),
                tpl_slider::description(),
                tpl_slider::image_path(),

            ),array(
                tpl_slider::status()=>1,
            )
        );
        return $db->get_where();
    }

}
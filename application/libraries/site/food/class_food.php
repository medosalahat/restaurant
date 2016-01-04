<?php

class class_food
{
    private $CI;

    private $use;

    private $name = 'food';

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_model('data_base');

        $this->use->use_lib('db/tpl_' . $this->name);

        $this->use->use_lib('db/tpl_image_food');


    }

    public function find_home_page()
    {

        $db = new data_base(

            tpl_food::food(),
            array(
                tpl_food::id(),
                tpl_food::name(),
                tpl_food::price(),
                tpl_food::description(),
                tpl_food::short_name(),
            ), array(
                tpl_food::status() => 1,
                tpl_food::home_page() => 1,
            )
        );

        return $db->get_where();
    }

    public function find($id_section)
    {

        $db = new data_base(

            tpl_food::food(),
            array(
                tpl_food::id(),
                tpl_food::name(),
                tpl_food::price(),
                tpl_food::description(),
                tpl_food::short_name(),
                data_base::select_multiple_table(
                    tpl_image_food::image_food(),
                    tpl_image_food::image_food() . '.' . tpl_image_food::id_food(),
                    tpl_food::food() . '.' . tpl_food::id() . ' limit 1',
                    tpl_image_food::path_image(),
                    tpl_image_food::path_image()
                )
            ), array(
                tpl_food::status() => 1,
                tpl_food::id_section_food() => $id_section,
            )
        );

        return $db->get_where();
    }

    public function check_food($id)
    {

        $db = new data_base(
            tpl_food::food(),
            array(
                tpl_food::id()
            ),
            array(
                tpl_food::id() => $id
            )
        );

        if (empty($db->get_where())) {

            return false;
        } else {

            return true;
        }
    }

    public function find_items($ids)
    {

        if (!empty($ids)) {

            $where = '';

            $counter = count($ids);

            $cou = 1;


            foreach ($ids as $row) {

                if ($counter == $cou) {

                    $where .= '' . tpl_food::id() . ' = ' . $row['id'] . ' ';

                } else {

                    $where .= '' . tpl_food::id() . ' = ' . $row['id'] . ' or ';
                }


                $cou++;
            }

            $db = new data_base(
                tpl_food::food(),
                array(
                    tpl_food::id(),
                    tpl_food::name(),
                    tpl_food::price(),
                    data_base::select_multiple_table(
                        tpl_image_food::image_food(),
                        tpl_image_food::image_food() . '.' . tpl_image_food::id_food(),
                        tpl_food::food() . '.' . tpl_food::id() . ' limit 1',
                        tpl_image_food::path_image(),
                        tpl_image_food::path_image()
                    )
                ), $where
            );

            $data = $db->get_where();

            $counter = 0;

            foreach ($data as $row) {

                foreach ($ids as $se) {

                    if ($row[tpl_food::id()] == $se['id']) {

                        $data[$counter]['qty'] = $se['qty'];
                    }
                }
                $counter++;
            }
            return $data;

        } else {

            return false;
        }
    }


}
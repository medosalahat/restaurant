<?php

class class_cart
{
    private $CI;

    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_model('data_base');

        $this->use->use_lib('site/food/class_food');

        $this->use->use_lib(SYSTEM . '/post_get/class_post');

        $this->use->use_lib('site/sessions_customer');

    }

    public function add()
    {

        $id = new class_post('id_items');

        $qty = new class_post('qty');

        if ($id->validation() && $qty->validation()) {

            $class = new class_food();

            if ($class->check_food($id->get_value())) {

                $session = new sessions_customer();

                $session->add_cart($id->get_value(), $qty->get_value());

                echo json_encode(array('valid' => true, 'massage' => 'yes'));

            } else {
                echo json_encode(array('valid' => false, 'massage' => 'not'));
            }
        } else {

            echo json_encode(array('valid' => false, 'massage' => 'hak'));

        }
    }

    public function remove()
    {

        $id = new class_post('id_items');

        if ($id->validation()) {

            $class = new class_food();

            if ($class->check_food($id->get_value())) {

                $this->use->use_lib('site/sessions_customer');

                $session = new sessions_customer();

                $session->remove_item_cart($id->get_value());

            } else {
                echo json_encode(array('valid' => false, 'massage' => 'not'));
            }
        } else {

            echo json_encode(array('valid' => false, 'massage' => 'hak'));
        }

    }

    public function show()
    {

        $this->use->use_lib('site/sessions_customer');

        $this->use->use_lib('site/food/class_food');

        $session = new sessions_customer();

        $data = $session->cart();

        $class = new class_food();

        return $class->find_items($data);
    }

}
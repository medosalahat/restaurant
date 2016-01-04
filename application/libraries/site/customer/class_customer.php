<?php

class class_customer
{

    private $CI;

    private $use;

    private $name = 'customer';

    private $data;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_model('data_base');

        $this->use->use_lib('db/tpl_' . $this->name);

        $this->use->use_lib('db/tpl_order_customer');

        $this->use->use_lib('db/tpl_shipping_type');

        $this->use->use_lib('db/tpl_order_items');

        $this->use->use_lib('system/post_get/class_post');

        $this->use->use_lib('system/date_time/date_time');

        $this->use->use_lin('customer', 'arabic');

    }

    public function set($index = null, $type = null)
    {

        if ($type == 'post') {

            $post = new class_post($index);

            if ($post->validation()) {

                $this->data[$index] = $post->get_value();

            }
        } else if ($type == 'get') {

            $get = new class_get($index);

            if ($get->validation()) {

                $this->data[$index] = $get->get_value();

            }
        }
    }

    public function customer_check_username()
    {

        $db = new data_base(
            tpl_customer::customer(),
            array(
                tpl_customer::id()
            ), array(
                tpl_customer::username() => $this->data[tpl_customer::customer() . tpl_customer::username()]
            )
        );

        if (empty($db->get_where())) {
            echo json_encode(array('valid' => true));
        } else {
            echo json_encode(array('valid' => false));
        }
    }

    public function customer_check_email()
    {
        $db = new data_base(
            tpl_customer::customer(),
            array(
                tpl_customer::id()
            ), array(
                tpl_customer::email() => $this->data[tpl_customer::customer() . tpl_customer::email()]
            )
        );

        if (empty($db->get_where())) {
            echo json_encode(array('valid' => true));
        } else {
            echo json_encode(array('valid' => false));
        }
    }

    public function register()
    {

        $username = $this->data[tpl_customer::customer() . tpl_customer::username()];

        $email = $this->data[tpl_customer::customer() . tpl_customer::email()];

        $f_name = $this->data[tpl_customer::customer() . tpl_customer::f_name()];

        $l_name = $this->data[tpl_customer::customer() . tpl_customer::l_name()];

        $phone = $this->data[tpl_customer::customer() . tpl_customer::phone()];

        $mobile = $this->data[tpl_customer::customer() . tpl_customer::mobile()];

        $address = $this->data[tpl_customer::customer() . tpl_customer::address()];

        $full_address = $this->data[tpl_customer::customer() . tpl_customer::full_address()];

        $password = $this->data[tpl_customer::customer() . tpl_customer::password()];

        $db = new data_base(
            tpl_customer::customer(),
            array(
                tpl_customer::username() => $username,
                tpl_customer::email() => $email,
                tpl_customer::f_name() => $f_name,
                tpl_customer::l_name() => $l_name,
                tpl_customer::phone() => $phone,
                tpl_customer::mobile() => $mobile,
                tpl_customer::address() => $address,
                tpl_customer::full_address() => $full_address,
                tpl_customer::password() => $this->hash_password($password),
                tpl_customer::date_in() => date_time::Date_time_24(),
                tpl_customer::status() => 1,
                tpl_customer::id_user() => 1,
                tpl_customer::path_image() => 'include/img/customer/user_default.png',
            )
        );

        $data = $db->add();

        if ($data) {

            $this->use->use_lib('site/sessions_customer');

            $sessions = new sessions_customer();

            if ($sessions->new_login()) {
                $sessions->id_customer($data);

                echo json_encode(
                    array(
                        'valid' => true,
                        'title' => lang('customer_register_massage_title_success'),
                        'massage' => $f_name . ' ' . $l_name . ' ' . lang('customer_register_massage_massage_success'),

                    )
                );
            } else {

                echo json_encode(
                    array(
                        'valid' => false,
                        'title' => lang('customer_register_massage_title_oops'),
                        'massage' => $f_name . ' ' . $l_name . ' ' . lang('customer_register_massage_massage_oops'),
                    )
                );
            }

        } else {

            echo json_encode(
                array(
                    'valid' => false,
                    'title' => lang('customer_register_massage_title_oops'),
                    'massage' => $f_name . ' ' . $l_name . ' ' . lang('customer_register_massage_massage_oops'),
                )
            );
        }

    }

    public function login()
    {

        $username = $this->data[tpl_customer::customer() . tpl_customer::username()];

        $password = $this->data[tpl_customer::customer() . tpl_customer::password()];

        $db = new data_base(
            tpl_customer::customer(),
            array(
                tpl_customer::id(),
                tpl_customer::username(),
                tpl_customer::f_name(),
                tpl_customer::l_name(),
            ),
            array(
                tpl_customer::username() => $username,
                tpl_customer::password() => $this->hash_password($password)
            )
        );

        $data = $db->get_where();

        if ($data) {

            $this->use->use_lib('site/sessions_customer');

            $sessions = new sessions_customer();

            if ($sessions->new_login()) {
                $sessions->id_customer($data);

                echo json_encode(
                    array(
                        'valid' => true,
                        'title' => lang('customer_login_massage_title_success'),
                        'massage' => $data[0][tpl_customer::f_name()] . ' ' . $data[0][tpl_customer::l_name()] . ' ' . lang('customer_login_massage_massage_success'),

                    )
                );
            } else {

                echo json_encode(
                    array(
                        'valid' => false,
                        'title' => lang('customer_register_massage_title_oops'),
                        'massage' =>  $data[0][tpl_customer::f_name()] . ' ' . $data[0][tpl_customer::l_name()] . ' ' . lang('customer_register_massage_massage_oops'),
                    )
                );
            }


        } else {

            echo json_encode(
                array(
                    'valid' => false,
                    'title' => lang('customer_login_massage_title_oops'),
                    'massage' =>lang('customer_login_massage_massage_invalid'),
                )
            );

        }


    }

    public static function hash_password($password)
    {


        return md5(md5(md5('2015') . md5('28') . md5('10')) . $password);

    }


    public function find_shipping_type()
    {

        $db = new data_base(
            tpl_shipping_type::shipping_type(),
            array(
                tpl_shipping_type::id(),
                tpl_shipping_type::name(),
                tpl_shipping_type::price(),
            ), array(
                tpl_shipping_type::status() => 1
            )
        );
        $data = $db->get_where();
        $w = '';
        foreach ($data as $row) {
            $w = $w . '<option value="' . $row[tpl_shipping_type::id()] . '">' . $row[tpl_shipping_type::name()] . '</option>';
        }
        return $w;
    }


    public function check_out_final(){

        $this->use->use_lib('site/sessions_customer');

        $session = new sessions_customer();

        $id_shipping = $this->data[tpl_order_customer::order_customer().tpl_order_customer::id_shipping()];
        $date_delivery = $this->data[tpl_order_customer::order_customer().tpl_order_customer::date_delivery()];
        $time_delivery = $this->data[tpl_order_customer::order_customer().tpl_order_customer::time_delivery()];

        $db = new data_base(
            tpl_order_customer::order_customer(),
            array(
                tpl_order_customer::id_shipping()=>$id_shipping,
                tpl_order_customer::time_delivery()=>$time_delivery,
                tpl_order_customer::date_delivery()=>$date_delivery,
                tpl_order_customer::id_customer()=>$session->get_id_customer()[0][tpl_customer::id()],
                tpl_order_customer::id_user()=>1,
                tpl_order_customer::id_status_oder()=>2,
                tpl_order_customer::date_in()=>date_time::Date_time_24(),
            )
        );

        $id = $db->add();

        foreach($session->cart() as $row){


            $db = new data_base(
                tpl_order_items::order_items(),
                array(
                    tpl_order_items::id_order()=>$id,
                    tpl_order_items::date_in()=>date_time::Date_time_24(),
                    tpl_order_items::id_user()=>1,
                    tpl_order_items::qty()=>$row['qty'],
                    tpl_order_items::id_food()=>$row['id']
                )
            );

           $db->add();

        }

        $session->remove_all_cart();

        echo json_encode(
            array(
                'valid' => true,
                'title' => lang('customer_check_out_massage_title_success'),
                'massage' =>lang('customer_login_massage_massage_success'),
            )
        );

    }


}
<?php

class order_customer_lib_ad
{
    private $CI;

    private $use;

    private $name = 'order_customer';

    private $user = 'user_site';

    private $data;

    private $session;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_lib('admin/sys/class_sessions_admin');

        $this->session = new class_sessions_admin();

        $this->use->use_model('data_base');

        $this->use->use_lib('system/post_get/class_post');

        $this->use->use_lib('system/post_get/class_get');

        $this->use->use_lib('system/array/class_array');

        $this->use->use_lib('system/date_time/date_time');

        $this->use->use_lib('system/bootstrap/class_massage');

        $this->use->use_lib('db/tpl_' . $this->name);

        $this->use->use_lib('db/tpl_' . $this->user);

        $this->use->use_lib('db/tpl_shipping_type');

        $this->use->use_lib('db/tpl_status_order');

        $this->use->use_lib('db/tpl_customer');

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

    public function get($index)
    {

        return $this->data[$index];

    }

    public function find()
    {

        $id = $this->data[tpl_customer::id()];

        $db = new data_base(

            tpl_order_customer::order_customer(),
            array(

                tpl_order_customer::id(),

                tpl_order_customer::date_delivery(),

                tpl_order_customer::time_delivery(),

                tpl_order_customer::id_status_oder(),

                tpl_order_customer::id_shipping(),

                tpl_order_customer::id_customer(),

                data_base::select_multiple_table(
                    tpl_status_order::status_order(),
                    tpl_status_order::status_order() . '.' . tpl_status_order::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_status_oder(),
                    tpl_status_order::name(),
                    tpl_status_order::status_order() . '_' . tpl_status_order::name()
                ),

                data_base::select_multiple_table(
                    tpl_shipping_type::shipping_type(),
                    tpl_shipping_type::shipping_type() . '.' . tpl_user_site::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_shipping(),
                    tpl_shipping_type::name(),
                    tpl_shipping_type::shipping_type() . '_' . tpl_shipping_type::name()
                ),

                data_base::select_multiple_table(
                    tpl_customer::customer(),
                    tpl_customer::customer() . '.' . tpl_customer::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_customer(),
                    tpl_customer::f_name(),
                    tpl_customer::customer() . '_' . tpl_customer::f_name()
                ),

                data_base::select_multiple_table(
                    tpl_customer::customer(),
                    tpl_customer::customer() . '.' . tpl_customer::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_customer(),
                    tpl_customer::l_name(),
                    tpl_customer::customer() . '_' . tpl_customer::l_name()
                ),

                data_base::select_multiple_table(
                    tpl_customer::customer(),
                    tpl_customer::customer() . '.' . tpl_customer::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_customer(),
                    tpl_customer::address(),
                    tpl_customer::customer() . '_' . tpl_customer::address()
                ),

                data_base::select_multiple_table(
                    tpl_customer::customer(),
                    tpl_customer::customer() . '.' . tpl_customer::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_customer(),
                    tpl_customer::full_address(),
                    tpl_customer::customer() . '_' . tpl_customer::full_address()
                ),

                data_base::select_multiple_table(
                    tpl_customer::customer(),
                    tpl_customer::customer() . '.' . tpl_customer::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_customer(),
                    tpl_customer::email(),
                    tpl_customer::customer() . '_' . tpl_customer::email()
                ),

                data_base::select_multiple_table(
                    tpl_customer::customer(),
                    tpl_customer::customer() . '.' . tpl_customer::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_customer(),
                    tpl_customer::phone(),
                    tpl_customer::customer() . '_' . tpl_customer::phone()
                ),

                data_base::select_multiple_table(
                    tpl_customer::customer(),
                    tpl_customer::customer() . '.' . tpl_customer::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_customer(),
                    tpl_customer::date_in(),
                    tpl_customer::customer() . '_' . tpl_customer::date_in()
                ),

                data_base::select_multiple_table(
                    tpl_customer::customer(),
                    tpl_customer::customer() . '.' . tpl_customer::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_customer(),
                    tpl_customer::username(),
                    tpl_customer::customer() . '_' . tpl_customer::username()
                )
            ),array(
                tpl_customer::id()=>$id
            )
        );


        return $db->get_where();

    }

    public function find_all_ajax()
    {

        $db = new data_base(

            tpl_order_customer::order_customer(),
            array(

                tpl_order_customer::id(),

                tpl_order_customer::date_delivery(),

                tpl_order_customer::time_delivery(),

                tpl_order_customer::id_status_oder(),

                tpl_order_customer::id_shipping(),

                tpl_order_customer::id_customer(),
                tpl_order_customer::date_in(),

                data_base::select_multiple_table(
                    tpl_status_order::status_order(),
                    tpl_status_order::status_order() . '.' . tpl_status_order::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_status_oder(),
                    tpl_status_order::name(),
                    tpl_status_order::status_order() . '_' . tpl_status_order::name()
                ),

                data_base::select_multiple_table(
                    tpl_shipping_type::shipping_type(),
                    tpl_shipping_type::shipping_type() . '.' . tpl_user_site::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_shipping(),
                    tpl_shipping_type::name(),
                    tpl_shipping_type::shipping_type() . '_' . tpl_shipping_type::name()
                ),

                data_base::select_multiple_table(
                    tpl_customer::customer(),
                    tpl_customer::customer() . '.' . tpl_customer::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_customer(),
                    tpl_customer::f_name(),
                    tpl_customer::customer() . '_' . tpl_customer::f_name()
                )
            )
        );


        echo json_encode($db->get());

    }

    public function find_all_status_order()
    {

        $db = new data_base(
            tpl_status_order::status_order(),
            array(
                tpl_status_order::id(),
                tpl_status_order::name()
            ), array(
                tpl_status_order::status() => 1
            )
        );

        $data = $db->get_where();

        $w = '';

        foreach ($data as $row) {

            $w = $w . '<option value="' . $row[tpl_status_order::id()] . '">' . $row[tpl_status_order::name()] . '</option>';

        }

        return $w;
    }

    public function remove()
    {

        $db = new data_base(
            tpl_order_customer::order_customer(),
            array(
                tpl_order_customer::id()
            ),
            array(
                tpl_order_customer::id() => $this->get(tpl_order_customer::order_customer() . '_' . tpl_order_customer::id())
            )
        );

        $results = $db->delete();

        if ($results) {

            echo json_encode(
                array(
                    'valid' => true,
                    'title' => 'Successfully !!',
                    'massage' => 'It has been deleted ' . $this->name . ' ',

                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => false,
                    'title' => 'Oops !!',
                    'massage' => 'Was not deleted ' . $this->name . ', please try again',

                )
            );

        }

    }

    public function insert()
    {


        $id_customer = $this->data[tpl_order_customer::order_customer() . '_' . tpl_order_customer::id_customer()];

        $date_delivery = $this->data[tpl_order_customer::order_customer() . '_' . tpl_order_customer::date_delivery()];

        $time_delivery = $this->data[tpl_order_customer::order_customer() . '_' . tpl_order_customer::time_delivery()];

        $id_status_oder = $this->data[tpl_order_customer::order_customer() . '_' . tpl_order_customer::id_status_oder()];

        $id_shipping = $this->data[tpl_order_customer::order_customer() . '_' . tpl_order_customer::id_shipping()];

        $db = new data_base(
            tpl_order_customer::order_customer(),
            array(
                tpl_order_customer::id_customer() => $id_customer,
                tpl_order_customer::date_delivery() => $date_delivery,
                tpl_order_customer::time_delivery() => $time_delivery,
                tpl_order_customer::id_status_oder() => $id_status_oder,
                tpl_order_customer::id_shipping() => $id_shipping,
                tpl_order_customer::id_user() => $this->session->Get_id_user(),
                tpl_order_customer::date_in() => date_time::Date_time_24()
            )
        );

        $results = $db->add();

        if ($results) {

            echo json_encode(
                array(
                    'valid' => 1,
                    'title' => 'Successfully !!',
                    'massage' => 'I\'ve been Add ' . $this->name . ' ' . $id_customer

                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => 0,
                    'title' => 'Oops !!',
                    'massage' => 'Was not add ' . $this->name . ' ' . $id_customer . ', please try again'
                )
            );

        }

    }

    public function update()
    {


        $id = $this->data[tpl_order_customer::order_customer() . '_' . tpl_order_customer::id() . '_update'];

        $id_customer = $this->data[tpl_order_customer::order_customer() . '_' . tpl_order_customer::id_customer() . '_update'];

        $date_delivery = $this->data[tpl_order_customer::order_customer() . '_' . tpl_order_customer::date_delivery() . '_update'];

        $time_delivery = $this->data[tpl_order_customer::order_customer() . '_' . tpl_order_customer::time_delivery() . '_update'];

        $id_status_oder = $this->data[tpl_order_customer::order_customer() . '_' . tpl_order_customer::id_status_oder() . '_update'];

        $id_shipping = $this->data[tpl_order_customer::order_customer() . '_' . tpl_order_customer::id_shipping() . '_update'];


        $db = new data_base(
            tpl_order_customer::order_customer(),
            array(
                tpl_order_customer::id_customer() => $id_customer,
                tpl_order_customer::date_delivery() => $date_delivery,
                tpl_order_customer::time_delivery() => $time_delivery,
                tpl_order_customer::id_status_oder() => $id_status_oder,
                tpl_order_customer::id_shipping() => $id_shipping,
                tpl_order_customer::id_user() => $this->session->Get_id_user(),
                tpl_order_customer::date_in() => date_time::Date_time_24()
            ), array(
                tpl_order_customer::id() => $id
            )
        );

        $results = $db->change();

        if ($results) {

            echo json_encode(
                array(
                    'valid' => 1,
                    'title' => 'Successfully !!',
                    'massage' => 'I\'ve been Update ' . $this->name . ' ' . $id_customer
                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => 0,
                    'title' => 'Oops !!',
                    'massage' => 'Was not add ' . $this->name . ' ' . $id_customer . ', please try again'
                )
            );

        }

    }

    public function update_status()
    {

        $id = $this->data[tpl_order_customer::order_customer() . '_' . tpl_order_customer::id()];

        $status = $this->data[tpl_order_customer::order_customer() . '_' . tpl_order_customer::id_status_oder()];

        $db = new data_base(
            tpl_order_customer::order_customer(),
            array(
                tpl_order_customer::id_status_oder() => $status,
                tpl_order_customer::id_user() => $this->session->Get_id_user(),
                tpl_order_customer::date_in() => date_time::Date_time_24()
            ), array(
                tpl_order_customer::id() => $id
            )
        );

        $results = $db->change();

        $status_data = $status == 1 ? 'active' : 'dative';

        if ($results) {

            echo json_encode(
                array(
                    'valid' => 1,
                    'title' => 'Successfully !!',
                    'massage' => 'I\'ve been Update ' . $this->name . ' ' . $status_data

                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => 0,
                    'title' => 'Oops !!',
                    'massage' => 'Was not Update ' . $this->name . ' ' . $status_data . ', please try again'
                )
            );

        }

    }

    public function count()
    {
        $db = new data_base(
            tpl_order_customer::order_customer(),
            array(
                tpl_order_customer::id()
            ), array(
                tpl_order_customer::new_order() => 1
            )
        );

        $data = $db->get_where();

        $db = new data_base(
            tpl_order_customer::order_customer(), array(
                tpl_order_customer::new_order() => 0
            )
        );

        $db->change_no_where();

        return count($data);

    }

    public function today()
    {
        $db = new data_base(
            tpl_order_customer::order_customer(),
            array(
                tpl_order_customer::id()
            )
            , array(
                "DATE_FORMAT(" . tpl_order_customer::date_in() . ",'%Y-%m-%d')" => date_time::Date()
            )
        );
        $data = $db->get_where();
        return count($data);
    }

    public function new_order_ajax(){

        $db = new data_base(

            tpl_order_customer::order_customer(),
            array(

                tpl_order_customer::id(),

                tpl_order_customer::date_delivery(),

                tpl_order_customer::time_delivery(),

                tpl_order_customer::id_status_oder(),

                tpl_order_customer::id_shipping(),

                tpl_order_customer::id_customer(),

                data_base::select_multiple_table(
                    tpl_status_order::status_order(),
                    tpl_status_order::status_order() . '.' . tpl_status_order::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_status_oder(),
                    tpl_status_order::name(),
                    tpl_status_order::status_order() . '_' . tpl_status_order::name()
                ),

                data_base::select_multiple_table(
                    tpl_shipping_type::shipping_type(),
                    tpl_shipping_type::shipping_type() . '.' . tpl_user_site::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_shipping(),
                    tpl_shipping_type::name(),
                    tpl_shipping_type::shipping_type() . '_' . tpl_shipping_type::name()
                ),

                data_base::select_multiple_table(
                    tpl_customer::customer(),
                    tpl_customer::customer() . '.' . tpl_customer::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_customer(),
                    tpl_customer::f_name(),
                    tpl_customer::customer() . '_' . tpl_customer::f_name()
                )
            )
        );


        echo json_encode($db->get());

    }


    public function select(){

        $db = new data_base(
            tpl_order_customer::order_customer(),
            array(
                tpl_order_customer::id(),
                data_base::select_multiple_table(
                    tpl_customer::customer(),
                    tpl_customer::customer() . '.' . tpl_customer::id(),
                    tpl_order_customer::order_customer() . '.' . tpl_order_customer::id_customer(),
                    tpl_customer::f_name(),
                    tpl_customer::customer() . '_' . tpl_customer::f_name()
                )
            )
        );

        $data = $db->get();

        $w = '<option value="">Select '.tpl_order_customer::order_customer().'</option>';

        foreach($data as $row){

            $w=$w.'<option value="'.$row[tpl_order_customer::id()].'">'.$row[tpl_customer::customer() . '_' . tpl_customer::f_name()].'</option>';

        }

        return $w;
    }
}
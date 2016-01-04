<?php

class sessions_customer
{


    private $use;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_lib('session');

    }

    public function get_login()
    {


        return $this->CI->session->userdata('login_customer');

    }


    public function new_login()
    {

        $this->CI->session->set_userdata('login_customer', true);

        return true;

    }

    public function info_customer($data_user)
    {

        $this->CI->session->set_userdata('info_customer', $data_user);

        return true;

    }

    public function get_info_customer()
    {

        return $this->CI->session->userdata('info_customer');

    }

    public function id_customer($data_user)
    {

        $this->CI->session->set_userdata('id_customer', $data_user);

        return true;

    }

    public function get_id_customer()
    {

        return $this->CI->session->userdata('id_customer');

    }


    public function remove_login()
    {

        $this->CI->session->set_userdata('login_customer', false);

        $this->CI->session->unset_userdata('login_customer');

        $this->CI->session->unset_userdata('id_customer');

        $this->CI->session->unset_userdata('info_customer');

        return true;

    }

    public function cart()
    {

        return $this->CI->session->userdata('cart_items');
    }

    public function add_cart($id, $qty)
    {

        $counter = 0;

        $find = 0;

        $data = array(
            'id' => $id,
            'qty' => $qty
        );

        $cart = $this->CI->session->userdata('cart_items');

        if (is_array($cart)) {

        } else {

            $cart = array();
        }

        foreach ($cart as $row) {

            if ($row['id'] == $id) {

                $cart[$counter]['qty'] = $row['qty'] + $qty;
                $find = 1;
            }
            $counter++;
        }
        if ($find == 0) {
            array_push($cart, $data);
        }
        $this->CI->session->set_userdata('cart_items', $cart);

        return true;
    }

    public function remove_all_cart()
    {
        return $this->CI->session->unset_userdata('cart_items');
    }

    public function remove_item_cart($id){

        $counter = 0;

        $cart = $this->CI->session->userdata('cart_items');



        foreach ($cart as $row) {

            if ($row['id'] == $id) {

                unset($cart[$counter]);
            }
            $counter++;
        }

        $this->CI->session->set_userdata('cart_items', array_values($cart));

        return true;

    }
}
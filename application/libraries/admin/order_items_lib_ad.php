<?php
class order_items_lib_ad
{
    private $CI;

    private $use;

    private $name = 'order_items';

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

        $this->use->use_lib('db/tpl_'.$this->name);

        $this->use->use_lib('db/tpl_'.$this->user);

        $this->use->use_lib('db/tpl_order_customer');

        $this->use->use_lib('db/tpl_food');

        $this->use->use_lib('db/tpl_customer');

        $this->use->use_lib('db/tpl_food');

    }

    public function set($index = null , $type= null){

        if($type == 'post'){

            $post = new class_post($index);

            if($post->validation()){

                $this->data[$index]=$post->get_value();

            }
        }else if($type == 'get'){

            $get = new class_get($index);

            if($get->validation()){

                $this->data[$index]=$get->get_value();

            }
        }
    }

    public function get($index){

        return $this->data[$index];

    }

    public function find(){

        $db = new data_base(
            tpl_order_items::order_items(),
            array(
                tpl_order_items::id(),
                tpl_order_items::date_in(),
                tpl_order_items::id_food(),
                tpl_order_items::id_order(),
                tpl_order_items::qty(),
                data_base::select_multiple_table(
                    tpl_food::food(),
                    tpl_food::food().'.'.tpl_food::id(),
                    tpl_order_items::order_items().'.'.tpl_order_items::id_food(),
                    tpl_food::name(),
                    tpl_food::food().'_'.tpl_food::name()
                ),
                data_base::select_multiple_table(
                    tpl_food::food(),
                    tpl_food::food().'.'.tpl_food::id(),
                    tpl_order_items::order_items().'.'.tpl_order_items::id_food(),
                    tpl_food::price(),
                    tpl_food::food().'_'.tpl_food::price()
                ),
                data_base::select_multiple_table(
                    tpl_customer::customer(),
                    tpl_customer::customer().'.'.tpl_customer::id(),
                    data_base::select_multiple_table(
                        tpl_order_customer::order_customer(),
                        tpl_order_customer::order_customer().'.'.tpl_order_customer::id(),
                        tpl_order_items::order_items().'.'.tpl_order_items::id_order(),
                        tpl_order_customer::id_customer()

                    ),
                    tpl_customer::f_name(),
                    tpl_customer::customer().'_'.tpl_customer::f_name()
                ),
            ),array(
                tpl_order_items::id_order()=>$this->data[tpl_order_customer::id()]
            )
        );

        return $db->get_where();

    }

    public function find_all(){

        $db = new data_base(

            tpl_order_items::order_items(),
            array(

                tpl_order_items::id(),

                tpl_order_items::date_in(),

                tpl_order_items::id_food(),

                tpl_order_items::id_order(),

                tpl_order_items::qty(),

                data_base::select_multiple_table(
                    tpl_food::food(),
                    tpl_food::food().'.'.tpl_food::id(),
                    tpl_order_items::order_items().'.'.tpl_order_items::id_food(),
                    tpl_food::name(),
                    tpl_food::food().'_'.tpl_food::name()
                ),
                data_base::select_multiple_table(
                    tpl_customer::customer(),
                    tpl_customer::customer().'.'.tpl_customer::id(),
                    data_base::select_multiple_table(
                        tpl_order_customer::order_customer(),
                        tpl_order_customer::order_customer().'.'.tpl_order_customer::id(),
                        tpl_order_items::order_items().'.'.tpl_order_items::id_order(),
                        tpl_order_customer::order_customer(),
                        tpl_order_customer::order_customer().'_'.tpl_order_customer::id_customer()
                    ),
                    tpl_customer::customer(),
                    tpl_customer::customer().'_'.tpl_customer::f_name()
                ),
            )
        );


        return $db->get();

    }

    public function find_all_ajax(){

        $db = new data_base(
            tpl_order_items::order_items(),
            array(
                tpl_order_items::id(),
                tpl_order_items::date_in(),
                tpl_order_items::id_food(),
                tpl_order_items::id_order(),
                tpl_order_items::qty(),
                data_base::select_multiple_table(
                    tpl_food::food(),
                    tpl_food::food().'.'.tpl_food::id(),
                    tpl_order_items::order_items().'.'.tpl_order_items::id_food(),
                    tpl_food::name(),
                    tpl_food::food().'_'.tpl_food::name()
                ),
                data_base::select_multiple_table(
                    tpl_customer::customer(),
                    tpl_customer::customer().'.'.tpl_customer::id(),
                    data_base::select_multiple_table(
                        tpl_order_customer::order_customer(),
                        tpl_order_customer::order_customer().'.'.tpl_order_customer::id(),
                        tpl_order_items::order_items().'.'.tpl_order_items::id_order(),
                        tpl_order_customer::id_customer()

                    ),
                    tpl_customer::f_name(),
                    tpl_customer::customer().'_'.tpl_customer::f_name()
                ),
            )
        );

        echo json_encode($db->get());

    }

    public function search_name_by_id(){

        $db = new data_base(
            tpl_order_items::order_items(),
            array(
                tpl_order_items::id_food()
            ),
            array(
                tpl_order_items::id()=>$this->get(tpl_order_items::order_items().'_'.tpl_order_items::id())
            )
        );

        $results = $db->get_where();

        return ($results);
    }

    public function remove(){

        $db = new data_base(
            tpl_order_items::order_items(),
            array(
                tpl_order_items::id()
            ),
            array(
                tpl_order_items::id()=>$this->get(tpl_order_items::order_items().'_'.tpl_order_items::id())
            )
        );

        $results = $db->delete();

        if($results){

            echo  json_encode(
                array(
                    'valid'=>true,
                    'title'=>'Successfully !!',
                    'massage'=>'It has been deleted '.$this->name.' ',

                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>false,
                    'title'=>'Oops !!',
                    'massage'=>'Was not deleted '.$this->name.', please try again',

                )
            );

        }

    }

    public function insert(){



        $id_food = $this->data[tpl_order_items::order_items().'_'.tpl_order_items::id_food()];
        $id_order = $this->data[tpl_order_items::order_items().'_'.tpl_order_items::id_order()];
        $qty = $this->data[tpl_order_items::order_items().'_'.tpl_order_items::qty()];

        $db = new data_base(
            tpl_order_items::order_items(),
            array(
                tpl_order_items::id_food()=>$id_food,
                tpl_order_items::id_user()=>$this->session->Get_id_user(),
                tpl_order_items::id_order()=>$id_order,
                tpl_order_items::qty()=>$qty,
                tpl_order_items::date_in()=>date_time::Date_time_24()
            )
        );

        $results = $db->add();

        if($results){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Add '.$this->name.' '.$qty

                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not add '.$this->name.' '.$qty.', please try again'
                )
            );

        }

    }

    public function update(){

        $id_food = $this->data[tpl_order_items::order_items().'_'.tpl_order_items::id_food().'_update'];

        $id_order = $this->data[tpl_order_items::order_items().'_'.tpl_order_items::id_order().'_update'];

        $qty = $this->data[tpl_order_items::order_items().'_'.tpl_order_items::qty().'_update'];

        $id = $this->data[tpl_order_items::order_items().'_'.tpl_order_items::id().'_update'];

        $db = new data_base(
            tpl_order_items::order_items(),
            array(
                tpl_order_items::id_food()=>$id_food,
                tpl_order_items::id_order()=>$id_order,
                tpl_order_items::qty()=>$qty,
                tpl_order_items::id_user()=>$this->session->Get_id_user(),
                tpl_order_items::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_order_items::id()=>$id
            )
        );

        $results = $db->change();

        if($results){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Update '.$this->name.' '.$qty
                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not add '.$this->name.' '.$qty.', please try again'
                )
            );

        }

    }


    public function count()
    {
        $db = new data_base(
            tpl_order_items::order_items(),
            array(
                tpl_order_items::id()
            )
        );

        $data = $db->get();

        return count($data);

    }
}
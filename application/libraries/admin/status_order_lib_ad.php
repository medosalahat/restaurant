<?php
class status_order_lib_ad
{
    private $CI;

    private $use;

    private $name = 'status_order';

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

    public function find_all(){

        $db = new data_base(

            tpl_status_order::status_order(),
            array(

                tpl_status_order::id(),

                tpl_status_order::date_in(),

                tpl_status_order::name(),

                tpl_status_order::status(),

                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_status_order::status_order().'.'.tpl_status_order::id_user(),
                    tpl_user_site::name()
                )
            )
        );


        return $db->get();

    }

    public function find_all_ajax(){

        $db = new data_base(

            tpl_status_order::status_order(),
            array(

                tpl_status_order::id(),

                tpl_status_order::date_in(),

                tpl_status_order::name(),

                tpl_status_order::status(),

                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_status_order::status_order().'.'.tpl_status_order::id_user(),
                    tpl_user_site::name(),
                    tpl_status_order::status_order().'_'.tpl_user_site::name()
                )
            )
        );


        echo json_encode($db->get());

    }

    public function search_name_by_id(){

        $db = new data_base(
            tpl_status_order::status_order(),
            array(
                tpl_status_order::name()
            ),
            array(
                tpl_status_order::id()=>$this->get(tpl_status_order::status_order().'_'.tpl_status_order::id())
            )
        );

        $results = $db->get_where();

        return ($results);
    }

    public function remove(){

        $db = new data_base(
            tpl_status_order::status_order(),
            array(
                tpl_status_order::id()
            ),
            array(
                tpl_status_order::id()=>$this->get(tpl_status_order::status_order().'_'.tpl_status_order::id())
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



        $name_data = $this->data[tpl_status_order::status_order().'_'.tpl_status_order::name()];

        $db = new data_base(
            tpl_status_order::status_order(),
            array(
                tpl_status_order::name()=>$name_data,
                tpl_status_order::id_user()=>$this->session->Get_id_user(),
                tpl_status_order::status()=>0,
                tpl_status_order::date_in()=>date_time::Date_time_24()
            )
        );

        $results = $db->add();

        if($results){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Add '.$this->name.' '.$name_data

                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not add '.$this->name.' '.$name_data.', please try again'
                )
            );

        }

    }

    public function update(){

        $name = $this->data[tpl_status_order::status_order().'_'.tpl_status_order::name().'_update'];
        $id = $this->data[tpl_status_order::status_order().'_'.tpl_status_order::id().'_update'];



        $db = new data_base(
            tpl_status_order::status_order(),
            array(
                tpl_status_order::name()=>$name,
                tpl_status_order::id_user()=>$this->session->Get_id_user(),
                tpl_status_order::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_status_order::id()=>$id
            )
        );

        $results = $db->change();

        if($results){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Update '.$this->name.' '.$name
                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not add '.$this->name.' '.$name.', please try again'
                )
            );

        }

    }

    public function update_status(){

        $id = $this->data[tpl_status_order::status_order().'_'.tpl_status_order::id()];

        $status = $this->data[tpl_status_order::status_order().'_'.tpl_status_order::status()];

        $db = new data_base(
            tpl_status_order::status_order(),
            array(
                tpl_status_order::status()=>$status,
                tpl_status_order::id_user()=>$this->session->Get_id_user(),
                tpl_status_order::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_status_order::id()=>$id
            )
        );

        $results = $db->change();

        $status_data = $status == 1 ? 'active' : 'dative';

        if($results){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Update '.$this->name.' '.$status_data

                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not Update '.$this->name.' '.$status_data.', please try again'
                )
            );

        }

    }
    public function count()
    {
        $db = new data_base(
            tpl_status_order::status_order(),
            array(
                tpl_status_order::id()
            )
        );

        $data = $db->get();

        return count($data);

    }

    public function select(){

        $db = new data_base(
            tpl_status_order::status_order(),
            array(
                tpl_status_order::id(),
                tpl_status_order::name(),

            ),array(
                tpl_status_order::status()=>1
            )
        );

        $data = $db->get_where();

        $w = '<option value="">Select '.tpl_status_order::status_order().'</option>';

        foreach($data as $row){

            $w=$w.'<option value="'.$row[tpl_status_order::id()].'">'.$row[tpl_status_order::name()].'</option>';

        }

        return $w;
    }
}
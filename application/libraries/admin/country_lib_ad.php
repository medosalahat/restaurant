<?php
class country_lib_ad
{
    private $CI;

    private $use;

    private $name = 'country';

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

            tpl_country::country(),
            array(

                tpl_country::id(),

                tpl_country::date_in(),

                tpl_country::name(),

                tpl_country::description(),

                tpl_country::short_name(),

                tpl_country::status(),

                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_country::country().'.'.tpl_country::id_user(),
                    tpl_user_site::name()
                )
            )
        );


        return $db->get();

    }

    public function find_all_ajax(){

        $db = new data_base(

            tpl_country::country(),
            array(

                tpl_country::id(),

                tpl_country::date_in(),

                tpl_country::name(),

                tpl_country::description(),

                tpl_country::short_name(),

                tpl_country::status(),

                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_country::country().'.'.tpl_country::id_user(),
                    tpl_user_site::name(),
                    tpl_country::country().'_'.tpl_user_site::name()
                )
            )
        );


        echo json_encode($db->get());

    }

    public function search_name_by_id(){

        $db = new data_base(
            tpl_country::country(),
            array(
                tpl_country::name()
            ),
            array(
                tpl_country::id()=>$this->get(tpl_country::country().'_'.tpl_country::id())
            )
        );

        $results = $db->get_where();

        return ($results);
    }

    public function remove(){

        $db = new data_base(
            tpl_country::country(),
            array(
                tpl_country::id()
            ),
            array(
                tpl_country::id()=>$this->get(tpl_country::country().'_'.tpl_country::id())
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



        $name_data = $this->data[tpl_country::country().'_'.tpl_country::name()];
        $short_name_data = $this->data[tpl_country::country().'_'.tpl_country::short_name()];
        $description_data = $this->data[tpl_country::country().'_'.tpl_country::description()];

        $db = new data_base(
            tpl_country::country(),
            array(
                tpl_country::name()=>$name_data,
                tpl_country::short_name()=>$short_name_data,
                tpl_country::description()=>$description_data,
                tpl_country::id_user()=>$this->session->Get_id_user(),
                tpl_country::status()=>0,
                tpl_country::date_in()=>date_time::Date_time_24()
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

        $name = $this->data[tpl_country::country().'_'.tpl_country::name().'_update'];
        $id = $this->data[tpl_country::country().'_'.tpl_country::id().'_update'];
        $short_name = $this->data[tpl_country::country().'_'.tpl_country::short_name().'_update'];
        $description = $this->data[tpl_country::country().'_'.tpl_country::description().'_update'];



        $db = new data_base(
            tpl_country::country(),
            array(
                tpl_country::name()=>$name,
                tpl_country::short_name()=>$short_name,
                tpl_country::description()=>$description,
                tpl_country::id_user()=>$this->session->Get_id_user(),
                tpl_country::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_country::id()=>$id
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

        $id = $this->data[tpl_country::country().'_'.tpl_country::id()];

        $status = $this->data[tpl_country::country().'_'.tpl_country::status()];

        $db = new data_base(
            tpl_country::country(),
            array(
                tpl_country::status()=>$status,
                tpl_country::id_user()=>$this->session->Get_id_user(),
                tpl_country::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_country::id()=>$id
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

    public function select(){

        $db = new data_base(
            tpl_country::country(),
            array(
                tpl_country::id(),
                tpl_country::short_name()
            ),array(
                tpl_country::status()=>1
            )
        );

        $data = $db->get();

        $w = '<option value="">Select '.tpl_country::country().'</option>';

        foreach($data as $row){

            $w=$w.'<option value="'.$row[tpl_country::id()].'">'.$row[tpl_country::short_name()].'</option>';

        }

        return $w;
    }

    public function count()
    {
        $db = new data_base(
            tpl_country::country(),
            array(
                tpl_country::id()
            )
        );

        $data = $db->get();

        return count($data);

    }
}
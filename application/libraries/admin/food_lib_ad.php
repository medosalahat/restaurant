<?php
class food_lib_ad
{
    private $CI;

    private $use;

    private $name = 'food';

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

        $this->use->use_lib('db/tpl_section_food');

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

            tpl_food::food(),
            array(

                tpl_food::id(),

                tpl_food::date_in(),

                tpl_food::name(),

                tpl_food::status(),

                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_food::food().'.'.tpl_food::id_user(),
                    tpl_user_site::name()
                )
            )
        );


        return $db->get();

    }

    public function find_all_ajax(){

        $db = new data_base(

            tpl_food::food(),
            array(

                tpl_food::id(),

                tpl_food::date_in(),

                tpl_food::name(),

                tpl_food::short_name(),

                tpl_food::description(),

                tpl_food::id_section_food(),

                tpl_food::price(),

                tpl_food::status(),

                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_food::food().'.'.tpl_food::id_user(),
                    tpl_user_site::name(),
                    tpl_food::food().'_'.tpl_user_site::name()
                ),
                data_base::select_multiple_table(
                    tpl_section_food::section_food(),
                    tpl_section_food::section_food().'.'.tpl_user_site::id(),
                    tpl_food::food().'.'.tpl_food::id_section_food(),
                    tpl_section_food::short_name(),
                    tpl_food::food().'_'.tpl_section_food::short_name()
                )

            )
        );


        echo json_encode($db->get());

    }

    public function search_name_by_id(){

        $db = new data_base(
            tpl_food::food(),
            array(
                tpl_food::name()
            ),
            array(
                tpl_food::id()=>$this->get(tpl_food::food().'_'.tpl_food::id())
            )
        );

        $results = $db->get_where();

        return ($results);
    }

    public function remove(){

        $db = new data_base(
            tpl_food::food(),
            array(
                tpl_food::id()
            ),
            array(
                tpl_food::id()=>$this->get(tpl_food::food().'_'.tpl_food::id())
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

    public function select_section_food(){

        $db = new data_base(
            tpl_section_food::section_food(),
            array(
                tpl_section_food::id(),
                tpl_section_food::short_name()
            ),array(
                tpl_section_food::status()=>1
            )
        );

        $data = $db->get();

        $w = '<option value="">Select Section Food</option>';

        foreach($data as $row){

            $w=$w.'<option value="'.$row[tpl_food::id()].'">'.$row[tpl_food::short_name()].'</option>';

        }

        return $w;
    }

    public function insert(){



        $section_food  = $this->data[tpl_section_food::section_food().'_'.tpl_section_food::id()];

        $name_food = $this->data[tpl_food::food().'_'.tpl_food::name()];

        $short_name_food = $this->data[tpl_food::food().'_'.tpl_food::short_name()];

        $description_food = $this->data[tpl_food::food().'_'.tpl_food::description()];

        $price_food = $this->data[tpl_food::food().'_'.tpl_food::price()];

        $db = new data_base(
            tpl_food::food(),
            array(
                tpl_food::id_section_food()=>$section_food,
                tpl_food::name()=>$name_food,
                tpl_food::short_name()=>$short_name_food,
                tpl_food::price()=>$description_food,
                tpl_food::description()=>$price_food,
                tpl_food::id_user()=>$this->session->Get_id_user(),
                tpl_food::status()=>0,
                tpl_food::date_in()=>date_time::Date_time_24()
            )
        );

        $results = $db->add();

        if($results){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Add '.$this->name.' '.$short_name_food

                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not add '.$this->name.' '.$short_name_food.', please try again'
                )
            );

        }

    }

    public function update(){

        $id = $this->data[tpl_food::food().'_'.tpl_food::id().'_update'];

        $id_section_food = $this->data[tpl_section_food::section_food().'_'.tpl_section_food::id().'_update'];

        $name = $this->data[tpl_food::food().'_'.tpl_food::name().'_update'];

        $short_name = $this->data[tpl_food::food().'_'.tpl_food::short_name().'_update'];

        $price = $this->data[tpl_food::food().'_'.tpl_food::price().'_update'];

        $description = $this->data[tpl_food::food().'_'.tpl_food::description().'_update'];

        $db = new data_base(
            tpl_food::food(),
            array(
                tpl_food::id_section_food()=>$id_section_food,
                tpl_food::name()=>$name,
                tpl_food::short_name()=>$short_name,
                tpl_food::price()=>$price,
                tpl_food::description()=>$description,
                tpl_food::id_user()=>$this->session->Get_id_user(),
                tpl_food::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_food::id()=>$id
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

        $id = $this->data[tpl_food::food().'_'.tpl_food::id()];

        $status = $this->data[tpl_food::food().'_'.tpl_food::status()];

        $db = new data_base(
            tpl_food::food(),
            array(
                tpl_food::status()=>$status,
                tpl_food::id_user()=>$this->session->Get_id_user(),
                tpl_food::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_food::id()=>$id
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
            tpl_food::food(),
            array(
                tpl_food::id()
            )
        );

        $data = $db->get();

        return count($data);

    }

    public function select(){

        $db = new data_base(
            tpl_food::food(),
            array(
                tpl_food::id(),
                tpl_food::short_name()
            ),array(
                tpl_food::status()=>1
            )
        );

        $data = $db->get();

        $w = '<option value="">Select '.tpl_food::food().'</option>';

        foreach($data as $row){

            $w=$w.'<option value="'.$row[tpl_food::id()].'">'.$row[tpl_food::short_name()].'</option>';

        }

        return $w;
    }

}
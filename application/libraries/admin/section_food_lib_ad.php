<?php
class section_food_lib_ad
{
    private $CI;

    private $use;

    private $name = 'section_food';

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
        $this->use->use_lib('db/tpl_country');


        $this->use->use_lib('system/image/class_upload_image');

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

    public function get($index = null){

        return $this->data[$index];

    }

    public function find_all(){

        $db = new data_base(

            tpl_section_food::section_food(),
            array(

                tpl_section_food::id(),

                tpl_section_food::date_in(),

                tpl_section_food::name(),
                tpl_section_food::path_image(),

                tpl_section_food::description(),
                tpl_section_food::short_name(),

                tpl_section_food::status(),

                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_section_food::section_food().'.'.tpl_section_food::id_user(),
                    tpl_user_site::name()
                ),

                data_base::select_multiple_table(
                    tpl_country::country(),
                    tpl_country::country().'.'.tpl_country::id(),
                    tpl_section_food::section_food().'.'.tpl_section_food::id_country(),
                    tpl_country::name()
                )
            )
        );


        return $db->get();

    }

    public function find_all_ajax(){

        $db = new data_base(

            tpl_section_food::section_food(),
            array(

                tpl_section_food::id(),

                tpl_section_food::date_in(),

                tpl_section_food::name(),
                tpl_section_food::description(),
                tpl_section_food::short_name(),

                tpl_section_food::status(),
                tpl_section_food::path_image(),
                tpl_section_food::id_country(),

                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_section_food::section_food().'.'.tpl_section_food::id_user(),
                    tpl_user_site::name(),
                    tpl_user_site::user_site().'_'.tpl_user_site::name()
                ),

                data_base::select_multiple_table(
                    tpl_country::country(),
                    tpl_country::country().'.'.tpl_country::id(),
                    tpl_section_food::section_food().'.'.tpl_section_food::id_country(),
                    tpl_country::short_name(),
                    tpl_country::country().'_'.tpl_country::name()
                )
            )
        );


        echo json_encode($db->get());

    }

    public function search_name_by_id(){



        $db = new data_base(
            tpl_section_food::section_food(),
            array(
                tpl_section_food::id(),

                tpl_section_food::date_in(),

                tpl_section_food::name(),
                tpl_section_food::description(),
                tpl_section_food::short_name(),

                tpl_section_food::status(),
                tpl_section_food::id_country(),

                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_section_food::section_food().'.'.tpl_section_food::id_user(),
                    tpl_user_site::name(),
                    tpl_user_site::user_site().'_'.tpl_user_site::name()
                ),

                data_base::select_multiple_table(
                    tpl_country::country(),
                    tpl_country::country().'.'.tpl_country::id(),
                    tpl_section_food::section_food().'.'.tpl_section_food::id_country(),
                    tpl_country::short_name(),
                    tpl_country::country().'_'.tpl_country::name()
                )
            ),
            array(
                tpl_section_food::id()=>$this->get(tpl_section_food::id())
            )
        );

        $results = $db->get_where();

        return array_shift($results);
    }

    public function remove(){

        $db = new data_base(
            tpl_section_food::section_food(),
            array(
                tpl_section_food::id()
            ),
            array(
                tpl_section_food::id()=>$this->get(tpl_section_food::section_food().'_'.tpl_section_food::id())
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



        $name_data = $this->data[tpl_section_food::section_food().'_'.tpl_section_food::name()];
        $short_name = $this->data[tpl_section_food::section_food().'_'.tpl_section_food::short_name()];
        $description = $this->data[tpl_section_food::section_food().'_'.tpl_section_food::description()];
        $id_country = $this->data[tpl_section_food::section_food().'_'.tpl_section_food::id_country()];

        $db = new data_base(
            tpl_section_food::section_food(),
            array(
                tpl_section_food::name()=>$name_data,
                tpl_section_food::id_country()=>$id_country,
                tpl_section_food::short_name()=>$short_name,
                tpl_section_food::description()=>$description,
                tpl_section_food::id_user()=>$this->session->Get_id_user(),
                tpl_section_food::status()=>0,
                tpl_section_food::date_in()=>date_time::Date_time_24()
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

        $name = $this->data[tpl_section_food::section_food().'_'.tpl_section_food::name().'_update'];
        $id_country = $this->data[tpl_section_food::section_food().'_'.tpl_section_food::id_country().'_update'];
        $description = $this->data[tpl_section_food::section_food().'_'.tpl_section_food::description().'_update'];
        $short_name = $this->data[tpl_section_food::section_food().'_'.tpl_section_food::short_name().'_update'];
        $id = $this->data[tpl_section_food::section_food().'_'.tpl_section_food::id().'_update'];



        $db = new data_base(
            tpl_section_food::section_food(),
            array(
                tpl_section_food::name()=>$name,
                tpl_section_food::id_country()=>$id_country,
                tpl_section_food::description()=>$description,
                tpl_section_food::short_name()=>$short_name,
                tpl_section_food::id_user()=>$this->session->Get_id_user(),
                tpl_section_food::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_section_food::id()=>$id
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

        $id = $this->data[tpl_section_food::section_food().'_'.tpl_section_food::id()];

        $status = $this->data[tpl_section_food::section_food().'_'.tpl_section_food::status()];

        $db = new data_base(
            tpl_section_food::section_food(),
            array(
                tpl_section_food::status()=>$status,
                tpl_section_food::id_user()=>$this->session->Get_id_user(),
                tpl_section_food::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_section_food::id()=>$id
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

    public function count()
    {
        $db = new data_base(
            tpl_section_food::section_food(),
            array(
                tpl_section_food::id()
            )
        );

        $data = $db->get();

        return count($data);

    }

    public function update_image()
    {

        $id = $this->data[tpl_section_food::section_food().'_'.tpl_section_food::id().'_update_image'];

        $image = new class_upload_image('image_update', 'include/img/' . tpl_section_food::section_food());

        if ($image->get_type() == 'image/png' || $image->get_type() == 'image/jpeg') {
            if ($image->get_error()) {
                $image_path = $image->move_file();
                if ($image_path == false) {
                    echo json_encode(array('valid' => false));
                } else {

                    $db = new data_base(
                        tpl_section_food::section_food(),
                        array(
                            tpl_section_food::path_image() => $image_path
                        ), array(
                            tpl_section_food::id() => $id
                        )
                    );

                    if ($db->change()) {

                        echo json_encode(array('valid' => true, 'image' => $image_path));
                    } else {
                        echo json_encode(array('valid' => false));
                    }
                }
            } else {
                echo json_encode(array('valid' => false));
            }
        } else {
            echo json_encode(array('valid' => false));
        }


    }
}
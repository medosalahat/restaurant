<?php
class image_food_lib_ad
{
    private $CI;

    private $use;

    private $name = 'image_food';

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

        $this->use->use_lib('db/tpl_food');

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

    public function get($index){

        return $this->data[$index];

    }

    public function find_all(){

        $db = new data_base(

            tpl_image_food::image_food(),
            array(

                tpl_image_food::id(),

                tpl_image_food::date_in(),

                tpl_image_food::title(),
                tpl_image_food::description(),
                tpl_image_food::path_image(),
                tpl_image_food::id_food(),

                tpl_image_food::status(),

                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_image_food::image_food().'.'.tpl_image_food::id_user(),
                    tpl_user_site::name(),
                    tpl_user_site::user_site() . '_' . tpl_user_site::name()
                ),
                data_base::select_multiple_table(
                    tpl_food::food(),
                    tpl_food::food().'.'.tpl_food::id(),
                    tpl_image_food::image_food().'.'.tpl_image_food::id_food(),
                    tpl_food::name(),
                    tpl_food::food() . '_' . tpl_food::name()
                )
            )
        );


        return $db->get();

    }

    public function find_all_ajax(){

        $db = new data_base(

            tpl_image_food::image_food(),
            array(

                tpl_image_food::id(),

                tpl_image_food::date_in(),

                tpl_image_food::title(),
                tpl_image_food::description(),
                tpl_image_food::path_image(),
                tpl_image_food::id_food(),

                tpl_image_food::status(),

                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_image_food::image_food().'.'.tpl_image_food::id_user(),
                    tpl_user_site::name(),
                    tpl_user_site::user_site() . '_' . tpl_user_site::name()
                ),
                data_base::select_multiple_table(
                    tpl_food::food(),
                    tpl_food::food().'.'.tpl_food::id(),
                    tpl_image_food::image_food().'.'.tpl_image_food::id_food(),
                    tpl_food::name(),
                    tpl_food::food() . '_' . tpl_food::name()
                )
            )
        );


        echo json_encode($db->get());

    }

    public function search_name_by_id(){

        $db = new data_base(
            tpl_image_food::image_food(),
            array(
                tpl_image_food::title()
            ),
            array(
                tpl_image_food::id()=>$this->get(tpl_image_food::image_food().'_'.tpl_image_food::id())
            )
        );

        $results = $db->get_where();

        return ($results);
    }

    public function remove(){

        $db = new data_base(
            tpl_image_food::image_food(),
            array(
                tpl_image_food::id()
            ),
            array(
                tpl_image_food::id()=>$this->get(tpl_image_food::image_food().'_'.tpl_image_food::id())
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

        $id_food = $this->data[tpl_image_food::image_food().'_'.tpl_image_food::id_food()];

        $title = $this->data[tpl_image_food::image_food().'_'.tpl_image_food::title()];

        $description = $this->data[tpl_image_food::image_food().'_'.tpl_image_food::description()];

        $image = new class_upload_image('image_new', 'include/img/' . tpl_image_food::image_food());

        if ($image->get_type() == 'image/png' || $image->get_type() == 'image/jpeg') {

            if ($image->get_error()) {

                $image_path = $image->move_file();

                if ($image_path == false) {

                    echo json_encode(array('valid' => false));

                } else {

                    $db = new data_base(

                        tpl_image_food::image_food(),

                        array(

                            tpl_image_food::id_food()=>$id_food,

                            tpl_image_food::title()=>$title,

                            tpl_image_food::description()=>$description,

                            tpl_image_food::path_image()=>$image_path,

                            tpl_image_food::id_user()=>$this->session->Get_id_user(),

                            tpl_image_food::status()=>0,

                            tpl_image_food::date_in()=>date_time::Date_time_24()

                        )

                    );

                    $results = $db->add();

                    if($results){

                        echo  json_encode(
                            array(
                                'valid'=>1,
                                'title'=>'Successfully !!',
                                'massage'=>'I\'ve been Add '.$this->name.' '.$title

                            )
                        );

                    }else{

                        echo  json_encode(
                            array(
                                'valid'=>0,
                                'title'=>'Oops !!',
                                'massage'=>'Was not add '.$this->name.' '.$title.', please try again'
                            )
                        );

                    }



                }
            } else {
                echo json_encode(array('valid' => false));
            }
        } else {
            echo json_encode(array('valid' => false));
        }

    }

    public function update(){

        $id_food= $this->data[tpl_image_food::image_food().'_'.tpl_image_food::id_food().'_update'];
        $title = $this->data[tpl_image_food::image_food().'_'.tpl_image_food::title().'_update'];
        $description = $this->data[tpl_image_food::image_food().'_'.tpl_image_food::description().'_update'];
        $id = $this->data[tpl_image_food::image_food().'_'.tpl_image_food::id().'_update'];



        $db = new data_base(
            tpl_image_food::image_food(),
            array(
                tpl_image_food::title()=>$title,
                tpl_image_food::description()=>$description,
                tpl_image_food::id_food()=>$id_food,
                tpl_image_food::id_user()=>$this->session->Get_id_user(),
                tpl_image_food::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_image_food::id()=>$id
            )
        );

        $results = $db->change();

        if($results){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Update '.$this->name.' '.$title
                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not add '.$this->name.' '.$title.', please try again'
                )
            );

        }

    }

    public function update_status(){

        $id = $this->data[tpl_image_food::image_food().'_'.tpl_image_food::id()];

        $status = $this->data[tpl_image_food::image_food().'_'.tpl_image_food::status()];

        $db = new data_base(
            tpl_image_food::image_food(),
            array(
                tpl_image_food::status()=>$status,
                tpl_image_food::id_user()=>$this->session->Get_id_user(),
                tpl_image_food::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_image_food::id()=>$id
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
            tpl_image_food::image_food(),
            array(
                tpl_image_food::id()
            )
        );

        $data = $db->get();

        return count($data);

    }

    public function select(){


        $db = new data_base(
            tpl_image_food::image_food(),
            array(
                tpl_image_food::id(),
                tpl_image_food::title()
            ),array(
                tpl_image_food::status()=>1
            )
        );

        $data = $db->get();

        $w = '<option value="">Select Category</option>';

        foreach($data as $row){

            $w=$w.'<option value="'.$row[tpl_image_food::id()].'">'.$row[tpl_image_food::title()].'</option>';

        }

        return $w;
    }

    public function update_image()
    {

        $id = $this->data[tpl_image_food::image_food().'_'.tpl_image_food::id().'_update_image'];

        $image = new class_upload_image('image_update', 'include/img/' . tpl_image_food::image_food());

        if ($image->get_type() == 'image/png' || $image->get_type() == 'image/jpeg') {
            if ($image->get_error()) {
                $image_path = $image->move_file();
                if ($image_path == false) {
                    echo json_encode(array('valid' => false));
                } else {

                    $db = new data_base(
                        tpl_image_food::image_food(),
                        array(
                            tpl_image_food::path_image() => $image_path
                        ), array(
                            tpl_image_food::id() => $id
                        )
                    );

                    if ($db->change()) {

                        echo json_encode(array('valid' => true, 'image' => $image_path));
                    } else {
                        echo json_encode(array('valid' => $id));
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
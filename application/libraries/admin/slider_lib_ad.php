<?php
class slider_lib_ad
{
    private $CI;

    private $use;

    private $name = 'slider';

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

            tpl_slider::slider(),
            array(

                tpl_slider::id(),

                tpl_slider::date_in(),

                tpl_slider::title(),
                tpl_slider::description(),

                tpl_slider::status(),

                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_slider::slider().'.'.tpl_slider::id_user(),
                    tpl_user_site::name()
                )
            )
        );


        return $db->get();

    }

    public function find_all_ajax(){

        $db = new data_base(

            tpl_slider::slider(),
            array(

                tpl_slider::id(),

                tpl_slider::date_in(),

                tpl_slider::title(),
                tpl_slider::description(),
                tpl_slider::image_path(),

                tpl_slider::status(),

                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_slider::slider().'.'.tpl_slider::id_user(),
                    tpl_user_site::name(),
                    tpl_user_site::user_site().'_'.tpl_user_site::name()
                )
            )
        );


        echo json_encode($db->get());

    }

    public function search_name_by_id(){

        $db = new data_base(
            tpl_slider::slider(),
            array(
                tpl_slider::title()
            ),
            array(
                tpl_slider::id()=>$this->get(tpl_slider::slider().'_'.tpl_slider::id())
            )
        );

        $results = $db->get_where();

        return ($results);
    }

    public function remove(){

        $db = new data_base(
            tpl_slider::slider(),
            array(
                tpl_slider::id()
            ),
            array(
                tpl_slider::id()=>$this->get(tpl_slider::slider().'_'.tpl_slider::id())
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



        $title = $this->data[tpl_slider::slider().'_'.tpl_slider::title()];

        $description = $this->data[tpl_slider::slider().'_'.tpl_slider::description()];

        $image = new class_upload_image('image_new', 'include/img/' . tpl_slider::slider());

        if ($image->get_type() == 'image/png' || $image->get_type() == 'image/jpeg') {

            if ($image->get_error()) {

                $image_path = $image->move_file();

                if ($image_path == false) {

                    echo json_encode(array('valid' => false));

                } else {

                    $db = new data_base(

                        tpl_slider::slider(),

                        array(
                            tpl_slider::title()=>$title,

                            tpl_slider::description()=>$description,

                            tpl_slider::image_path()=>$image_path,

                            tpl_slider::id_user()=>$this->session->Get_id_user(),

                            tpl_slider::status()=>0,

                            tpl_slider::date_in()=>date_time::Date_time_24()

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

        $title = $this->data[tpl_slider::slider().'_'.tpl_slider::title().'_update'];
        $description = $this->data[tpl_slider::slider().'_'.tpl_slider::description().'_update'];
        $id = $this->data[tpl_slider::slider().'_'.tpl_slider::id().'_update'];



        $db = new data_base(
            tpl_slider::slider(),
            array(
                tpl_slider::title()=>$title,
                tpl_slider::description()=>$description,
                tpl_slider::id_user()=>$this->session->Get_id_user(),
                tpl_slider::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_slider::id()=>$id
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

        $id = $this->data[tpl_slider::slider().'_'.tpl_slider::id()];

        $status = $this->data[tpl_slider::slider().'_'.tpl_slider::status()];

        $db = new data_base(
            tpl_slider::slider(),
            array(
                tpl_slider::status()=>$status,
                tpl_slider::id_user()=>$this->session->Get_id_user(),
                tpl_slider::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_slider::id()=>$id
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
            tpl_slider::slider(),
            array(
                tpl_slider::id()
            )
        );

        $data = $db->get();

        return count($data);

    }

    public function update_image()
    {

        $id = $this->data[tpl_slider::slider().'_'.tpl_slider::id().'_update_image'];

        $image = new class_upload_image('image_update', 'include/img/' . tpl_slider::slider());

        if ($image->get_type() == 'image/png' || $image->get_type() == 'image/jpeg') {
            if ($image->get_error()) {
                $image_path = $image->move_file();
                if ($image_path == false) {
                    echo json_encode(array('valid' => false));
                } else {

                    $db = new data_base(
                        tpl_slider::slider(),
                        array(
                            tpl_slider::image_path() => $image_path
                        ), array(
                            tpl_slider::id() => $id
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
<?php
class post_lib_ad
{
    private $CI;

    private $use;

    private $name = 'post';

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

        $this->use->use_lib('db/tpl_category');

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

            tpl_post::post(),
            array(
                tpl_post::id(),
                tpl_post::date_in(),
                tpl_post::title(),
                tpl_post::description(),
                tpl_post::id_category(),
                tpl_post::status(),
                tpl_post::date_in(),
                tpl_post::image_path(),
                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_post::post().'.'.tpl_post::id_user(),
                    tpl_user_site::name(),
                    tpl_user_site::user_site().'_'.tpl_user_site::name()
                ),
                data_base::select_multiple_table(
                    tpl_category::category(),
                    tpl_category::category().'.'.tpl_category::id(),
                    tpl_post::post().'.'.tpl_post::id_user(),
                    tpl_category::name(),
                    tpl_category::category().'_'.tpl_category::name()
                )
            )
        );


        return $db->get();

    }

    public function find_all_ajax(){

        $db = new data_base(

            tpl_post::post(),
            array(

                tpl_post::id(),
                tpl_post::date_in(),
                tpl_post::title(),
                tpl_post::description(),
                tpl_post::id_category(),
                tpl_post::status(),
                tpl_post::date_in(),
                tpl_post::image_path(),
                tpl_post::service(),
                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_post::post().'.'.tpl_post::id_user(),
                    tpl_user_site::name(),
                    tpl_user_site::user_site().'_'.tpl_user_site::name()
                ),
                data_base::select_multiple_table(
                    tpl_category::category(),
                    tpl_category::category().'.'.tpl_category::id(),
                    tpl_post::post().'.'.tpl_post::id_category(),
                    tpl_category::name(),
                    tpl_category::category().'_'.tpl_category::name()
                )
            )
        );


        echo json_encode($db->get());

    }

    public function search_name_by_id(){

        $db = new data_base(
            tpl_post::post(),
            array(
                tpl_post::title()
            ),
            array(
                tpl_post::id()=>$this->get(tpl_post::post().'_'.tpl_post::id())
            )
        );

        $results = $db->get_where();

        return ($results);
    }

    public function remove(){

        $db = new data_base(
            tpl_post::post(),
            array(
                tpl_post::id()
            ),
            array(
                tpl_post::id()=>$this->get(tpl_post::post().'_'.tpl_post::id())
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



        $title = $this->data[tpl_post::post().'_'.tpl_post::title()];

        $id_category = $this->data[tpl_post::post().'_'.tpl_post::id_category()];

        $description = $this->data[tpl_post::post().'_'.tpl_post::description()];

        $db = new data_base(
            tpl_post::post(),
            array(
                tpl_post::description()=>$description,
                tpl_post::title()=>$title,
                tpl_post::id_category()=>$id_category,
                tpl_post::id_user()=>$this->session->Get_id_user(),
                tpl_post::status()=>0,
                tpl_post::date_in()=>date_time::Date_time_24()
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

    public function update(){

        $title = $this->data[tpl_post::post().'_'.tpl_post::title().'_update'];

        $description = $this->data[tpl_post::post().'_'.tpl_post::description().'_update'];

        $id = $this->data[tpl_post::post().'_'.tpl_post::id().'_update'];

        $id_category = $this->data[tpl_post::post().'_'.tpl_post::id_category().'_update'];



        $db = new data_base(
            tpl_post::post(),
            array(
                tpl_post::title()=>$title,
                tpl_post::description()=>$description,
                tpl_post::id_category()=>$id_category,
                tpl_post::id_user()=>$this->session->Get_id_user(),
                tpl_post::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_post::id()=>$id
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

        $id = $this->data[tpl_post::post().'_'.tpl_post::id()];

        $status = $this->data[tpl_post::post().'_'.tpl_post::status()];

        $db = new data_base(
            tpl_post::post(),
            array(
                tpl_post::status()=>$status,
                tpl_post::id_user()=>$this->session->Get_id_user(),
                tpl_post::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_post::id()=>$id
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
    public function update_service(){

        $id = $this->data[tpl_post::post().'_'.tpl_post::id()];

        $status = $this->data[tpl_post::post().'_'.tpl_post::service()];

        $db = new data_base(
            tpl_post::post(),
            array(
                tpl_post::service()=>$status,
                tpl_post::id_user()=>$this->session->Get_id_user(),
                tpl_post::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_post::id()=>$id
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
            tpl_post::post(),
            array(
                tpl_post::id()
            )
        );

        $data = $db->get();

        return count($data);

    }

    public function update_image()
    {

        $id = $this->data[tpl_post::post().'_'.tpl_post::id().'_update_image'];

        $image = new class_upload_image('image_update', 'include/img/' . tpl_post::post());

        if ($image->get_type() == 'image/png' || $image->get_type() == 'image/jpeg') {
            if ($image->get_error()) {
                $image_path = $image->move_file();
                if ($image_path == false) {
                    echo json_encode(array('valid' => false));
                } else {

                    $db = new data_base(
                        tpl_post::post(),
                        array(
                            tpl_post::image_path() => $image_path
                        ), array(
                            tpl_post::id() => $id
                        )
                    );

                    if ($db->change()) {

                        echo json_encode(array('valid' => true, 'image' => $image_path));
                    } else {
                        echo json_encode(array('valid' => false,'ms'));
                    }
                }
            } else {
                echo json_encode(array('valid' => false,'ms2'));
            }
        } else {
            echo json_encode(array('valid' => false,'ms3'));
        }


    }
}
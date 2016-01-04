<?php
class customer_lib_ad
{
    private $CI;

    private $use;

    private $name = 'customer';

    private $user = 'user_site';

    private $data;

    private $session;

    private $user_lib;

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

        $this->use->use_lib('admin/user_lib_ad');

        $this->use->use_lib('system/image/class_upload_image');

        $this->use->use_lib('db/tpl_'.$this->name);

        $this->use->use_lib('db/tpl_'.$this->user);

        $this->user_lib = new user_lib_ad();

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
        }else if($type == tpl_customer::id()){

                $this->data[tpl_customer::id()]=$index;
        }
    }

    public function get($index){

        return $this->data[$index];

    }

    public function find_all(){

        $db = new data_base(

            tpl_customer::customer(),
            array(
                tpl_customer::id(),
                tpl_customer::f_name(),
                tpl_customer::l_name(),
                tpl_customer::email(),
                tpl_customer::username(),
                tpl_customer::password(),
                tpl_customer::phone(),
                tpl_customer::mobile(),
                tpl_customer::address(),
                tpl_customer::full_address(),
                tpl_customer::status(),
                tpl_customer::date_in(),
                tpl_customer::path_image(),
                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_customer::customer().'.'.tpl_customer::id_user(),
                    tpl_user_site::name()
                )
            )
        );


        return $db->get();

    }

    public function find(){

        $db = new data_base(

            tpl_customer::customer(),
            array(
                tpl_customer::id(),
                tpl_customer::f_name(),
                tpl_customer::l_name(),
                tpl_customer::email(),
                tpl_customer::username(),
                tpl_customer::password(),
                tpl_customer::phone(),
                tpl_customer::mobile(),
                tpl_customer::address(),
                tpl_customer::full_address(),
                tpl_customer::ip(),
                tpl_customer::status(),
                tpl_customer::date_in(),
                tpl_customer::path_image(),
                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_customer::customer().'.'.tpl_customer::id_user(),
                    tpl_user_site::name()
                )
            ),array(
                tpl_customer::id()=>$this->data[tpl_customer::id()]
            )
        );


        return $db->get_where();

    }

    public function find_all_ajax(){

        $db = new data_base(

            tpl_customer::customer(),
            array(

                tpl_customer::id(),
                tpl_customer::f_name(),
                tpl_customer::l_name(),
                tpl_customer::email(),
                tpl_customer::username(),
                tpl_customer::password(),
                tpl_customer::phone(),
                tpl_customer::mobile(),
                tpl_customer::address(),
                tpl_customer::full_address(),
                tpl_customer::ip(),
                tpl_customer::date_in(),
                tpl_customer::path_image(),
                tpl_customer::status(),
                data_base::select_multiple_table(
                    tpl_user_site::user_site(),
                    tpl_user_site::user_site().'.'.tpl_user_site::id(),
                    tpl_customer::customer().'.'.tpl_customer::id_user(),
                    tpl_user_site::name(),
                    tpl_customer::customer().'_'.tpl_user_site::name()
                )
            )
        );


        echo json_encode($db->get());

    }

    public function search_name_by_id(){

        $db = new data_base(
            tpl_customer::customer(),
            array(
                tpl_customer::f_name()
            ),
            array(
                tpl_customer::id()=>$this->get(tpl_customer::customer().'_'.tpl_customer::id())
            )
        );

        $results = $db->get_where();

        return ($results);
    }

    public function remove(){

        $db = new data_base(
            tpl_customer::customer(),
            array(
                tpl_customer::id()
            ),
            array(
                tpl_customer::id()=>$this->get(tpl_customer::customer().'_'.tpl_customer::id())
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



        $f_name = $this->data[tpl_customer::customer().'_'.tpl_customer::f_name()];
        $l_name = $this->data[tpl_customer::customer().'_'.tpl_customer::l_name()];
        $email = $this->data[tpl_customer::customer().'_'.tpl_customer::email()];
        $username = $this->data[tpl_customer::customer().'_'.tpl_customer::username()];
        $password = $this->data[tpl_customer::customer().'_'.tpl_customer::password()];
        $phone = $this->data[tpl_customer::customer().'_'.tpl_customer::phone()];
        $mobile = $this->data[tpl_customer::customer().'_'.tpl_customer::mobile()];
        $address = $this->data[tpl_customer::customer().'_'.tpl_customer::address()];
        $full_address = $this->data[tpl_customer::customer().'_'.tpl_customer::full_address()];

        $db = new data_base(
            tpl_customer::customer(),
            array(
                tpl_customer::f_name()=>$f_name,
                tpl_customer::l_name()=>$l_name,
                tpl_customer::email()=>$email,
                tpl_customer::username()=>$username,
                tpl_customer::password()=>$this->user_lib->hash_password($password),
                tpl_customer::phone()=>$phone,
                tpl_customer::mobile()=>$mobile,
                tpl_customer::address()=>$address,
                tpl_customer::full_address()=>$full_address,
                tpl_customer::id_user()=>$this->session->Get_id_user(),
                tpl_customer::status()=>0,
                tpl_customer::date_in()=>date_time::Date_time_24()
            )
        );

        $results = $db->add();

        if($results){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Add '.$this->name.' '.$f_name.' '.$l_name

                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not add '.$this->name.' '.$f_name.' '.$l_name.', please try again'
                )
            );

        }

    }

    public function update(){

        $id = $this->data[tpl_customer::customer().'_'.tpl_customer::id().'_update'];

        $f_name = $this->data[tpl_customer::customer().'_'.tpl_customer::f_name().'_update'];

        $l_name = $this->data[tpl_customer::customer().'_'.tpl_customer::l_name().'_update'];

        $email = $this->data[tpl_customer::customer().'_'.tpl_customer::email().'_update'];

        $username = $this->data[tpl_customer::customer().'_'.tpl_customer::username().'_update'];

        $phone = $this->data[tpl_customer::customer().'_'.tpl_customer::phone().'_update'];

        $mobile = $this->data[tpl_customer::customer().'_'.tpl_customer::mobile().'_update'];

        $address = $this->data[tpl_customer::customer().'_'.tpl_customer::address().'_update'];

        $full_address = $this->data[tpl_customer::customer().'_'.tpl_customer::full_address().'_update'];

        $db = new data_base(
            tpl_customer::customer(),
            array(
                tpl_customer::f_name()=>$f_name,
                tpl_customer::l_name()=>$l_name,
                tpl_customer::email()=>$email,
                tpl_customer::username()=>$username,
                tpl_customer::phone()=>$phone,
                tpl_customer::mobile()=>$mobile,
                tpl_customer::address()=>$address,
                tpl_customer::full_address()=>$full_address,
                tpl_customer::id_user()=>$this->session->Get_id_user(),
                tpl_customer::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_customer::id()=>$id
            )
        );

        $results = $db->change();

        if($results){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Update '.$this->name.' '.$f_name.' '.$l_name
                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not add '.$this->name.' '.$f_name.' '.$l_name.', please try again'
                )
            );

        }

    }

    public function update_status(){

        $id = $this->data[tpl_customer::customer().'_'.tpl_customer::id()];

        $status = $this->data[tpl_customer::customer().'_'.tpl_customer::status()];

        $db = new data_base(
            tpl_customer::customer(),
            array(
                tpl_customer::status()=>$status,
                tpl_customer::id_user()=>$this->session->Get_id_user(),
                tpl_customer::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_customer::id()=>$id
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


    public function update_password(){

        $id = $this->data[tpl_customer::customer().'_'.tpl_customer::id().'_update_password'];

        $password = $this->data[tpl_customer::customer().'_'.tpl_customer::password().'_update_password'];

        $db = new data_base(
            tpl_customer::customer(),
            array(
                tpl_customer::password()=>$this->user_lib->hash_password($password),
                tpl_customer::id_user()=>$this->session->Get_id_user(),
                tpl_customer::date_in()=>date_time::Date_time_24()
            ),array(
                tpl_customer::id()=>$id
            )
        );

        $results = $db->change();

        if($results){

            echo  json_encode(
                array(
                    'valid'=>1,
                    'title'=>'Successfully !!',
                    'massage'=>'I\'ve been Update '.$this->name.' Password '

                )
            );

        }else{

            echo  json_encode(
                array(
                    'valid'=>0,
                    'title'=>'Oops !!',
                    'massage'=>'Was not Update '.$this->name.' Password , please try again'
                )
            );

        }

    }

    public function count()
    {
        $db = new data_base(
            tpl_customer::customer(),
            array(
                tpl_customer::id()
            )
        );

        $data = $db->get();

        return count($data);

    }

    public function update_image()
    {

        $id = $this->data[tpl_customer::customer().'_'.tpl_customer::id().'_update_image'];

        $image = new class_upload_image('image_update', 'include/img/' . tpl_customer::customer());

        if ($image->get_type() == 'image/png' || $image->get_type() == 'image/jpeg') {
            if ($image->get_error()) {
                $image_path = $image->move_file();
                if ($image_path == false) {
                    echo json_encode(array('valid' => false));
                } else {

                    $db = new data_base(
                        tpl_customer::customer(),
                        array(
                            tpl_customer::path_image() => $image_path
                        ), array(
                            tpl_customer::id() => $id
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

    public function select(){

        $db = new data_base(
            tpl_customer::customer(),
            array(
                tpl_customer::id(),
                tpl_customer::f_name(),
                tpl_customer::l_name(),

            ),array(
                tpl_customer::status()=>1
            )
        );

        $data = $db->get_where();

        $w = '<option value="">Select '.tpl_customer::customer().'</option>';

        foreach($data as $row){

            $w=$w.'<option value="'.$row[tpl_customer::id()].'">'.$row[tpl_customer::f_name()].' '.$row[tpl_customer::l_name()].'</option>';

        }

        return $w;
    }
}
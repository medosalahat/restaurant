<?php

class user_lib_ad
{
    private $CI;

    private $use;

    private $data = array();

    private $session;

    private $name;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->use = new class_loader();

        $this->use->use_lib('admin/sys/class_sessions_admin');

        $this->session = new class_sessions_admin();

        $this->use->use_lib('db/tpl_user_site');

        $this->use->use_lib('system/post_get/class_post');

        $this->use->use_lib('admin/sys/class_sessions_admin');

        $this->use->use_lib('system/array/class_array');

        $this->use->use_lib('system/date_time/date_time');

        $this->use->use_lib('system/bootstrap/class_massage');

        $this->use->use_lib('system/image/class_upload_image');

        $this->use->use_model('data_base');
    }

    public function set($index = null, $type = null)
    {

        if ($type == 'post') {

            $post = new class_post($index);

            if ($post->validation()) {

                $this->data[$index] = $post->get_value();

                return true;
            } else {

                return false;
            }
        } else if ($type == 'get') {

            $get = new class_get($index);

            if ($get->validation()) {

                $this->data[$index] = $get->get_value();

                return true;
            } else {

                return false;
            }
        }

        return false;
    }

    public function get($index)
    {

        return $this->data[$index];

    }

    public function find_users_login()
    {

        $db = new data_base(
            tpl_user_site::user_site(),
            array(
                tpl_user_site::id()
            ), array(
                tpl_user_site::username() => $this->data[tpl_user_site::user_site() . '_' . tpl_user_site::username()],
                tpl_user_site::password() => $this->hash_password($this->data[tpl_user_site::user_site() . '_' . tpl_user_site::password()]),
                tpl_user_site::status() => 1
            )
        );

        $results = $db->get_where();

        $results = array_shift($results);

        if (!empty($results[tpl_user_site::id()])) {

            $this->session->new_login_admin();

            $this->session->set_id_user($results[tpl_user_site::id()]);

            return json_encode(array('valid' => true));
        } else {

            return json_encode(
                array(
                    'valid' => false,
                    'title' => 'Oops !!',
                    'massage' => 'The password you\'ve entered is incorrect',
                )
            );
        }

    }

    public static function hash_password($password)
    {


        return md5(md5(md5('2015') . md5('28') . md5('10')) . $password);

    }


    public function find_all()
    {

        $db = new data_base(

            tpl_user_site::user_site(),
            array(

                tpl_user_site::id(),

                tpl_user_site::date_in(),

                tpl_user_site::name(),

                tpl_user_site::status(),
                tpl_user_site::path_image(),
                tpl_user_site::username(),

                tpl_user_site::password(),

            )
        );


        return $db->get();

    }

    public function find_all_ajax()
    {

        $db = new data_base(
            tpl_user_site::user_site(),
            array(

                tpl_user_site::id(),

                tpl_user_site::date_in(),

                tpl_user_site::name(),

                tpl_user_site::status(),

                tpl_user_site::username(),

                tpl_user_site::password(),
                tpl_user_site::path_image(),

            )
        );


        echo json_encode($db->get());

    }

    public function search_name_by_id()
    {

        $db = new data_base(
            tpl_user_site::user_site(),
            array(
                tpl_user_site::name()
            ),
            array(
                tpl_user_site::id() => $this->get(tpl_user_site::user_site() . '_' . tpl_user_site::id())
            )
        );

        $results = $db->get_where();

        return ($results);
    }

    public function remove()
    {

        $db = new data_base(
            tpl_user_site::user_site(),
            array(
                tpl_user_site::id()
            ),
            array(
                tpl_user_site::id() => $this->get(tpl_user_site::user_site() . '_' . tpl_user_site::id())
            )
        );

        $results = $db->delete();

        if ($results) {

            echo json_encode(
                array(
                    'valid' => true,
                    'title' => 'Successfully !!',
                    'massage' => 'It has been deleted ' . $this->name . ' ',

                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => false,
                    'title' => 'Oops !!',
                    'massage' => 'Was not deleted ' . $this->name . ', please try again',

                )
            );

        }

    }

    public function insert()
    {


        $name_data = $this->data[tpl_user_site::user_site() . '_' . tpl_user_site::name()];
        $user_site = $this->data[tpl_user_site::user_site() . '_' . tpl_user_site::username()];
        $password = $this->data[tpl_user_site::user_site() . '_' . tpl_user_site::password()];

        $db = new data_base(
            tpl_user_site::user_site(),
            array(
                tpl_user_site::name() => $name_data,
                tpl_user_site::username() => $user_site,
                tpl_user_site::password() => $this->hash_password($password),

                tpl_user_site::status() => 0,
                tpl_user_site::date_in() => date_time::Date_time_24()
            )
        );

        $results = $db->add();

        if ($results) {

            echo json_encode(
                array(
                    'valid' => 1,
                    'title' => 'Successfully !!',
                    'massage' => 'I\'ve been Add ' . $this->name . ' ' . $name_data

                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => 0,
                    'title' => 'Oops !!',
                    'massage' => 'Was not add ' . $this->name . ' ' . $name_data . ', please try again'
                )
            );

        }

    }

    public function update()
    {

        $name = $this->data[tpl_user_site::user_site() . '_' . tpl_user_site::name() . '_update'];
        $username = $this->data[tpl_user_site::user_site() . '_' . tpl_user_site::username() . '_update'];
        $id = $this->data[tpl_user_site::user_site() . '_' . tpl_user_site::id() . '_update'];


        $db = new data_base(
            tpl_user_site::user_site(),
            array(
                tpl_user_site::name() => $name,
                tpl_user_site::username() => $username,
                tpl_user_site::date_in() => date_time::Date_time_24()
            ), array(
                tpl_user_site::id() => $id
            )
        );

        $results = $db->change();

        if ($results) {

            echo json_encode(
                array(
                    'valid' => 1,
                    'title' => 'Successfully !!',
                    'massage' => 'I\'ve been Update ' . $this->name . ' ' . $name
                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => 0,
                    'title' => 'Oops !!',
                    'massage' => 'Was not add ' . $this->name . ' ' . $name . ', please try again'
                )
            );

        }

    }

    public function update_password()
    {

        $password = $this->data[tpl_user_site::user_site() . '_' . tpl_user_site::password() . '_update_password'];
        $id = $this->data[tpl_user_site::user_site() . '_' . tpl_user_site::id() . '_update_password'];


        $db = new data_base(
            tpl_user_site::user_site(),
            array(
                tpl_user_site::password() => $this->hash_password($password),
                tpl_user_site::date_in() => date_time::Date_time_24()
            ), array(
                tpl_user_site::id() => $id
            )
        );

        $results = $db->change();

        if ($results) {

            echo json_encode(
                array(
                    'valid' => 1,
                    'title' => 'Successfully !!',
                    'massage' => 'I\'ve been Update ' . $this->name . ' ' . $password
                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => 0,
                    'title' => 'Oops !!',
                    'massage' => 'Was not add ' . $this->name . ' ' . $password . ', please try again'
                )
            );

        }

    }

    public function update_status()
    {

        $id = $this->data[tpl_user_site::user_site() . '_' . tpl_user_site::id()];

        $status = $this->data[tpl_user_site::user_site() . '_' . tpl_user_site::status()];

        $db = new data_base(
            tpl_user_site::user_site(),
            array(
                tpl_user_site::status() => $status,

                tpl_user_site::date_in() => date_time::Date_time_24()
            ), array(
                tpl_user_site::id() => $id
            )
        );

        $results = $db->change();

        $status_data = $status == 1 ? 'active' : 'dative';

        if ($results) {

            echo json_encode(
                array(
                    'valid' => 1,
                    'title' => 'Successfully !!',
                    'massage' => 'I\'ve been Update ' . $this->name . ' ' . $status_data

                )
            );

        } else {

            echo json_encode(
                array(
                    'valid' => 0,
                    'title' => 'Oops !!',
                    'massage' => 'Was not Update ' . $this->name . ' ' . $status_data . ', please try again'
                )
            );

        }

    }

    public function count()
    {
        $db = new data_base(
            tpl_user_site::user_site(),
            array(
                tpl_user_site::id()
            )
        );

        $data = $db->get();

        return count($data);

    }

    public function check_username()
    {

        $username = '';

        if (isset($_GET['a'])) {

            $username = $this->data[tpl_user_site::user_site() . '_' . tpl_user_site::username() . '_update'];

        } else if (isset($_GET['s'])) {

            $username = $this->data[tpl_user_site::user_site() . '_' . tpl_user_site::username()];

        }


        $db = new data_base(
            tpl_user_site::user_site(),
            array(
                tpl_user_site::id()
            ), array(
                tpl_user_site::username() => $username
            )
        );

        if (empty($db->get_where())) {

            echo json_encode(array('valid' => true));
        } else {
            echo json_encode(array('valid' => false));
        }
    }

    public function update_image()
    {

        $id = $this->data[tpl_user_site::user_site().'_'.tpl_user_site::id().'_update_image'];

        $image = new class_upload_image('image_update', 'include/img/' . tpl_user_site::user_site());

        if ($image->get_type() == 'image/png' || $image->get_type() == 'image/jpeg') {
            if ($image->get_error()) {
                $image_path = $image->move_file();
                if ($image_path == false) {
                    echo json_encode(array('valid' => false));
                } else {

                    $db = new data_base(
                        tpl_user_site::user_site(),
                        array(
                            tpl_user_site::path_image() => $image_path
                        ), array(
                            tpl_user_site::id() => $id
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
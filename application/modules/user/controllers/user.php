<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends My_Controller {

    function __construct()
    {
        parent::__construct();

        $this->Menu = 'user';

        $this->load->model('User_role_model');
        $this->load->model('User_group_model');

    }

    function index()
    {
        $this->manage_user();
    }

    function manage_user()
    {
        if(!isset($_POST['ajax']) && !isset($_POST['submit'])) {  $this->show_404();return; }

        $data['users'] = array();

        $user = new User_model();
        if(isset($_POST['submit']))
        {
            Model_base::map_objects($user, $_POST);
            $data = array_merge($data,$_POST);

            //echo json_encode($result);
            //var_dump($data);
        }

        $result = $user->gets($user);
        if($result->success)$data['users'] = $result->models;

        $user_group = new User_group_model();
        $result = $this->User_group_model->gets($user_group);
        if($result->success) $data['user_groups'] = $result->models;

        $this->load->view('user/manage_user', $data);

    }

    private function upload_image(User_model &$user, $delete_if_exist = true)
    {
        if(isset($_FILES['file']) && $_FILES['file']['name'] != '')
        {
            $file_name = $_FILES['file']['name'];
            $file_name = $user->user_name.".".pathinfo($file_name, PATHINFO_EXTENSION);
            $file_path = $this->get_user_image_path();

            //delete old file
            if($delete_if_exist && !$this->delete_file($file_path.$file_name)) return false;

            $upload = $this->upload_file($file_path , $file_name);
            if(!$upload) return false;

            $user->image = $file_name;
        }

        return true;
    }

    function edit($user_id = 0)
    {
        if(!isset($_POST['ajax']) && !isset($_POST['submit'])) {  $this->show_404();return; }

        $data=array();

        if($this->input->post('submit'))
        {
            $data['user_id'] = $this->input->post('user_id');
            $data['user_name'] = $this->input->post('user_name');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['user_group_id'] = $this->input->post('user_group');
            $data['contact_id'] = $this->input->post('contact_id');
            $data['is_active'] = isset($_POST['is_active'])?1:0;
            $data['created_date'] = $this->input->post('created_date');

            $data = $this->security->xss_clean($data);

            $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|greater_than[0]');
            $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|max_length[100]');
            //$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[20]');
            //$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[3]|max_length[20]|matches[password]');
            $this->form_validation->set_rules('user_group', 'User Type', 'required|greater_than[0]');
            //$this->form_validation->set_rules('is_active', 'Is active', 'required');


            if ($this->form_validation->run())
            {
                $user_model = new User_model();
                Model_base::map_objects($user_model, $data);

                //update photo
                if(!$this->upload_image($user_model))
                {
                    $message = $this->create_message('Cannot upload photo', 'Error');
                    $result = new Message_result();
                    $result->message = json_encode($message);
                    echo json_encode($result);
                    return false;
                }

                //begin transaction
                $this->db->trans_begin();

                $result = $this->User_model->update($user_model);

                if($result->success)
                {
                    $this->apply_permission($result->model->user_id);
                }

                if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();

                    $message = $this->create_message('Cannot add', 'Error');
                    $result = new Message_result();
                    $result->message = json_encode($message);
                    echo json_encode($result);
                    return false;
                }
                else
                {
                    $this->db->trans_commit();

                    $message = $this->create_message($result->message, $result->success?'':'Error');
                    $result->message = json_encode($message);
                    echo json_encode($result);
                    return false;
                }

            }
            else
            {
                //echo validation_errors();
                $message = $this->create_message(validation_errors(), 'Error');
                $result = new Message_result();
                $result->message = json_encode($message);
                echo json_encode($result);
                return false;
            }
        }
        else
        {
            $json = $this->get_json_object();
            if($json===true)
            {
                $model = new User_model();
                $model->user_id = $user_id;
                $result = $this->User_model->get($model);
                if($result->success)
                {
                    $user = $result->model;
                }
                else
                {
                    $this->show_404(); return;
                }
            }
            else
            {
                $user = new User_model();
                Model_base::map_objects($user, $json, true);
            }
            $data['title'] = "Edit User";
            $data['readonly'] = true;
            $data['url'] = base_url()."user/edit";
            $data['user'] = $user;

            if (isset($user->image) && $user->image != '')
            {
                $user->photo_path = $this->get_user_image_site().$user->image;
            }
            else
            {
                $user->photo_path = $this->default_user_image();
            }

            $user_role = new User_role_model();
            $result = $this->User_role_model->gets($user_role);
            if($result->success) $data['user_roles'] = $result->models;

            $result = $this->User_model->get_permission($user);
            if($result->success) $data['permission'] = $result->models;

            $this->load->view('user/new_user', $data);
        }


    }

    function add()
    {
        if(!isset($_POST['ajax']) && !isset($_POST['submit'])) {  $this->show_404();return; }

        if($this->input->post('submit'))
        {
            $data['user_id'] = $this->input->post('user_id');
            $data['user_name'] = $this->input->post('user_name');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['user_group_id'] = $this->input->post('user_group');
            $data['contact_id'] = $this->input->post('contact_id');
            $data['is_active'] = isset($_POST['is_active'])?1:0;
            $data['created_date'] = $this->input->post('created_date');

            $data = $this->security->xss_clean($data);

            $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[20]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[3]|max_length[20]|matches[password]');
            $this->form_validation->set_rules('user_group', 'User Type', 'required|greater_than[0]');
            //$this->form_validation->set_rules('is_active', 'Is active', 'required');


            if ($this->form_validation->run())
            {
                $user_model = new User_model();
                Model_base::map_objects($user_model, $data);

                //update photo
                if(!$this->upload_image($user_model))
                {
                    $message = $this->create_message('Cannot upload photo', 'Error');
                    $result = new Message_result();
                    $result->message = json_encode($message);
                    echo json_encode($result);
                    return false;
                }

                //begin transaction
                $this->db->trans_begin();

                if($user_model->user_id==0) $result = $this->User_model->add($user_model);
                else $result = $this->User_model->update($user_model);

                if($result->success)
                {
                    $this->apply_permission($result->model->user_id);
                }

                if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();

                    $message = $this->create_message('Cannot add', 'Error');
                    $result = new Message_result();
                    $result->message = json_encode($message);
                    echo json_encode($result);
                    return false;
                }
                else
                {
                    $this->db->trans_commit();

                    $message = $this->create_message($result->message, $result->success?'':'Error');
                    $result->message = json_encode($message);
                    echo json_encode($result);
                    return false;
                }
            }
            else
            {
                //echo validation_errors();
                $message = $this->create_message(validation_errors(), 'Error');
                $result = new Message_result();
                $result->message = json_encode($message);
                echo json_encode($result);
                return false;
            }
        }
        else
        {
            $user = new User_model();
            $user->photo_path = $this->default_user_image();
            $data['user'] = $user;
            $data['url'] = base_url()."user/add";

            $user_role = new User_role_model();
            $result = $this->User_role_model->gets($user_role);
            if($result->success) $data['user_roles'] = $result->models;

            $this->load->view('user/new_user', $data);
        }
    }

    private function apply_permission($user_id)
    {
        $this->db->where('user_id', $user_id);
        $result = $this->db->delete('permission');
        if(!$result) return false;

        if(isset($_POST['user_roles'])){
            $data = array();
            foreach($_POST['user_roles'] as $id){
                $data[] = array('user_role_id'=>$id, 'user_id'=>$user_id);
            }
            return $this->db->insert_batch('permission', $data);
        }

        return true;
    }

    function change_password()
    {

        $data=array();

        if($this->input->post('submit'))
        {
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['confirm_password'] = $this->input->post('confirm_password');
            $data['user_id'] = $this->UserSession->user_id;

            $data = $this->security->xss_clean($data);

            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[20]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[3]|max_length[20]|matches[password]');

            if ($this->form_validation->run())
            {
                $user_model = new User_model();
                Model_base::map_objects($user_model, $data);

                $result = $this->User_model->change_password($user_model);

                if ($result->success)
                {
                    $message = $this->create_message($result->message);
                    $result->message = json_encode($message);
                    echo json_encode($result);
                    return true;
                }
                else
                {
                    $message = $this->create_message($result->message, 'Error');
                    $result->message = json_encode($message);
                    echo json_encode($result);
                    return false;
                }
            }
            else
            {
                //echo validation_errors();
                $message = $this->create_message(validation_errors(), 'Error');
                $result = new Message_result();
                $result->message = json_encode($message);
                echo json_encode($result);
                return false;
            }
        }

        $this->load->view('user/change_password', $data);
    }

    function delete()
    {
        if(!isset($_POST['submit'])) { $this->show_404(); return; }

        $data['user_id'] = $this->input->post('user_id');
        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('user_id', 'User ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $user_model = new User_model();
            Model_base::map_objects($user_model, $data);

            $result = $this->User_model->delete($user_model);

            $message = $this->create_message($result->message, $result->success?'':'Error');
            $result->message = json_encode($message);
            echo json_encode($result);
            return false;

        }
        else
        {
            //echo validation_errors();
            $message = $this->create_message(validation_errors(), 'Error');
            $result = new Message_result();
            $result->message = json_encode($message);
            echo json_encode($result);
            return false;
        }
    }


    function get_combobox_items($search='')
    {
        $search = $search!=''? $search : strip_tags(trim($_GET['q']));

        $model = new User_model();
        $model->user_name = $search;

        $result = $this->User_model->get_combobox_items($model);
        if($result->success)
        {
            $data = $result->models;
        }
        else
        {
            $data[] = array('id' => '0', 'text' => 'No Data Found');
        }

        echo json_encode($data);
    }

}
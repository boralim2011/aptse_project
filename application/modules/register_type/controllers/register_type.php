<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register_type extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        $this->Menu = 'register_type';

        $this->load->model('Register_type_model');
    }

    function index()
    {
        $this->manage_register_type();
    }

    function manage_register_type()
    {
        if(!isset($_POST['ajax'])) {  $this->show_404();return; }

        $register_type = new Register_type_model();
        $result = $this->Register_type_model->gets($register_type);

        $data['register_types'] = array();
        if($result->success)
        {
            $data['register_types'] = $result->models;
        }

        $this->load->view('register_type/manage_register_type', $data);
    }

    function edit()
    {

        if(!isset($_POST['submit'])) {  $this->show_404();return; }

//        $data['register_type_name'] = $this->input->post('register_type_name');
//        $data['register_type_id'] = $this->input->post('register_type_id');
//        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('register_type_name', 'Register Type Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('register_type_id', 'Register Type ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $register_type_model = new Register_type_model();
            Model_base::map_objects($register_type_model, $_POST);

            $result = $this->Register_type_model->update($register_type_model);

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

    function add()
    {
        if(!isset($_POST['submit'])) {  $this->show_404();return; }

//        $data['register_type_name'] = $this->input->post('register_type_name');
//        $data['register_type_id'] = $this->input->post('register_type_id');
//        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('register_type_name', 'Register Type Name', 'trim|required|min_length[2]|max_length[100]');

        if ($this->form_validation->run())
        {
            $register_type_model = new Register_type_model();
            Model_base::map_objects($register_type_model, $_POST);

            if($register_type_model->register_type_id==0) $result = $this->Register_type_model->add($register_type_model);
            else $result = $this->Register_type_model->update($register_type_model);

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

    function delete()
    {
        if(!isset($_POST['submit'])) {
            $this->show_404();return;
        }

        $data['register_type_id'] = $this->input->post('register_type_id');
        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('register_type_id', 'Register Type ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $register_type_model = new Register_type_model();
            Model_base::map_objects($register_type_model, $data);

            $result = $this->Register_type_model->delete($register_type_model);

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



    function get_combobox_items($search='')
    {
        $search = $search!=''? $search : strip_tags(trim($_GET['q']));

        $model = new Register_type_model();
        $model->register_type_name = $search;

        $result = $this->Register_type_model->get_combobox_items($model);
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
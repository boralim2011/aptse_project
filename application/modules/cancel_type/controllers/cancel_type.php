<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cancel_type extends My_Controller {

    function __construct()
    {
        parent::__construct();

        $this->Menu = 'cancel_type';

        $this->load->model('Cancel_type_model');
    }

    function index()
    {
        $this->manage_cancel_type();
    }

    function manage_cancel_type()
    {
        if(!isset($_POST['ajax'])) {  $this->show_404();return; }

        $cancel_type = new Cancel_type_model();
        $result = $this->Cancel_type_model->gets($cancel_type);

        $data['cancel_types'] = array();
        if($result->success)
        {
            $data['cancel_types'] = $result->models;
        }

        $this->load->view('cancel_type/manage_cancel_type', $data);
    }

    function edit()
    {

        if(!isset($_POST['submit'])) {  $this->show_404();return; }

//        $data['cancel_type_name'] = $this->input->post('cancel_type_name');
//        $data['cancel_type_id'] = $this->input->post('cancel_type_id');
//        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('cancel_type_name', 'Cancel Type Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('cancel_type_id', 'Cancel Type ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $cancel_type_model = new Cancel_type_model();
            Model_base::map_objects($cancel_type_model, $_POST);

            $result = $this->Cancel_type_model->update($cancel_type_model);

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

//        $data['cancel_type_name'] = $this->input->post('cancel_type_name');
//        $data['cancel_type_id'] = $this->input->post('cancel_type_id');
//        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('cancel_type_name', 'Cancel Type Name', 'trim|required|min_length[2]|max_length[100]');

        if ($this->form_validation->run())
        {
            $cancel_type_model = new Cancel_type_model();
            Model_base::map_objects($cancel_type_model, $_POST);

            if($cancel_type_model->cancel_type_id==0) $result = $this->Cancel_type_model->add($cancel_type_model);
            else $result = $this->Cancel_type_model->update($cancel_type_model);

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

        $data['cancel_type_id'] = $this->input->post('cancel_type_id');
        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('cancel_type_id', 'Cancel Type ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $cancel_type_model = new Cancel_type_model();
            Model_base::map_objects($cancel_type_model, $data);

            $result = $this->Cancel_type_model->delete($cancel_type_model);

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

        $model = new Cancel_type_model();
        $model->cancel_type_name = $search;

        $result = $this->Cancel_type_model->get_combobox_items($model);
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
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Service_type extends My_Controller {

    function __construct()
    {
        parent::__construct();

        $this->Menu = 'service_type';

        $this->load->model('Service_type_model');
    }

    function index()
    {
        $this->manage_service_type();
    }

    function manage_service_type()
    {
        if(!isset($_POST['ajax'])) {  $this->show_404();return; }

        $service_type = new Service_type_model();
        $result = $this->Service_type_model->gets($service_type);

        $data['service_types'] = array();
        if($result->success)
        {
            $data['service_types'] = $result->models;
        }

        $this->load->view('service_type/manage_service_type', $data);
    }

    function edit()
    {

        if(!isset($_POST['submit'])) {  $this->show_404();return; }

//        $data['service_type_name'] = $this->input->post('service_type_name');
//        $data['service_type_code'] = $this->input->post('service_type_code');
//        $data['service_type_id'] = $this->input->post('service_type_id');
//        $data = $this->security->xss_clean($data);

        $this->form_validation->set_rules('service_type_name', 'Service Type Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('service_type_code', 'Service Type Code', 'trim|required|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('service_type_id', 'Service Type ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $service_type_model = new Service_type_model();
            Model_base::map_objects($service_type_model, $_POST);

            $result = $this->Service_type_model->update($service_type_model);

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

//        $data['service_type_name'] = $this->input->post('service_type_name');
//        $data['service_type_code'] = $this->input->post('service_type_code');
//        $data['service_type_id'] = $this->input->post('service_type_id');
//        $data = $this->security->xss_clean($data);

        $this->form_validation->set_rules('service_type_name', 'Service Type Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('service_type_code', 'Service Type Code', 'trim|required|min_length[2]|max_length[20]');

        if ($this->form_validation->run())
        {
            $service_type_model = new Service_type_model();
            Model_base::map_objects($service_type_model, $_POST);

            if($service_type_model->service_type_id==0) $result = $this->Service_type_model->add($service_type_model);
            else $result = $this->Service_type_model->update($service_type_model);

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

        $data['service_type_id'] = $this->input->post('service_type_id');
        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('service_type_id', 'Service Type ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $service_type_model = new Service_type_model();
            Model_base::map_objects($service_type_model, $data);

            $result = $this->Service_type_model->delete($service_type_model);

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

        $model = new Service_type_model();
        $model->service_type_name = $search;

        $result = $this->Service_type_model->get_combobox_items($model);
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
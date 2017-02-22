<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Agency_type extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        $this->Menu = 'agency_type';

        $this->load->model('Agency_type_model');
    }

    function index()
    {
        $this->manage_agency_type();
    }

    function manage_agency_type()
    {
        if(!isset($_POST['ajax'])) {  $this->show_404();return; }

        $agency_type = new Agency_type_model();
        $result = $this->Agency_type_model->gets($agency_type);

        $data['agency_types'] = array();
        if($result->success)
        {
            $data['agency_types'] = $result->models;
        }

        $this->load->view('agency_type/manage_agency_type', $data);
    }

    function edit()
    {

        if(!isset($_POST['submit'])) {  $this->show_404();return; }

//        $data['agency_type_name'] = $this->input->post('agency_type_name');
//        $data['agency_type_id'] = $this->input->post('agency_type_id');
//        $data = $this->security->xss_clean($data);

        $this->form_validation->set_rules('agency_type_name', 'Agency_type Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('agency_type_id', 'Agency_type ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $agency_type_model = new Agency_type_model();
            Model_base::map_objects($agency_type_model, $_POST);

            $result = $this->Agency_type_model->update($agency_type_model);

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

//        $data['agency_type_name'] = $this->input->post('agency_type_name');
//        $data['agency_type_id'] = $this->input->post('agency_type_id');
//        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('agency_type_name', 'Agency_type Name', 'trim|required|min_length[2]|max_length[100]');

        if ($this->form_validation->run())
        {
            $agency_type_model = new Agency_type_model();
            Model_base::map_objects($agency_type_model, $_POST);

            if($agency_type_model->agency_type_id==0) $result = $this->Agency_type_model->add($agency_type_model);
            else $result = $this->Agency_type_model->update($agency_type_model);

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

        $data['agency_type_id'] = $this->input->post('agency_type_id');
        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('agency_type_id', 'Agency_type ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $agency_type_model = new Agency_type_model();
            Model_base::map_objects($agency_type_model, $data);

            $result = $this->Agency_type_model->delete($agency_type_model);

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

        $model = new Agency_type_model();
        $model->agency_type_name = $search;

        $result = $this->Agency_type_model->get_combobox_items($model);
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
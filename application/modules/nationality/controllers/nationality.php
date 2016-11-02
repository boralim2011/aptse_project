<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Nationality extends My_Controller {

    function __construct()
    {
        parent::__construct();

        $this->Menu = 'nationality';

        $this->load->model('Nationality_model');
    }

    function index()
    {
        $this->manage_nationality();
    }

    function manage_nationality()
    {
        if(!isset($_POST['ajax'])) {  $this->show_404();return; }

        $nationality = new Nationality_model();
        $result = $this->Nationality_model->gets($nationality);

        $data['nationalitys'] = array();
        if($result->success)
        {
            $data['nationalitys'] = $result->models;
        }

        $this->load->view('nationality/manage_nationality', $data);
    }

    function edit()
    {

        if(!isset($_POST['submit'])) {  $this->show_404();return; }

//        $data['nationality_name'] = $this->input->post('nationality_name');
//        $data['nationality_id'] = $this->input->post('nationality_id');
//        $data = $this->security->xss_clean($data);

        $this->form_validation->set_rules('nationality_name', 'Nationality Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('nationality_id', 'Nationality ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $nationality_model = new Nationality_model();
            Model_base::map_objects($nationality_model, $_POST);

            $result = $this->Nationality_model->update($nationality_model);

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

//        $data['nationality_name'] = $this->input->post('nationality_name');
//        $data['nationality_id'] = $this->input->post('nationality_id');
//        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('nationality_name', 'Nationality Name', 'trim|required|min_length[2]|max_length[100]');

        if ($this->form_validation->run())
        {
            $nationality_model = new Nationality_model();
            Model_base::map_objects($nationality_model, $_POST);

            if($nationality_model->nationality_id==0) $result = $this->Nationality_model->add($nationality_model);
            else $result = $this->Nationality_model->update($nationality_model);

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

        $data['nationality_id'] = $this->input->post('nationality_id');
        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('nationality_id', 'Nationality ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $nationality_model = new Nationality_model();
            Model_base::map_objects($nationality_model, $data);

            $result = $this->Nationality_model->delete($nationality_model);

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

        $model = new Nationality_model();
        $model->nationality_name = $search;

        $result = $this->Nationality_model->get_combobox_items($model);
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
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Border_crossings extends My_Controller {

    function __construct()
    {
        parent::__construct();

        $this->Menu = 'border_crossings';

        $this->load->model('Border_crossings_model');
    }

    function index()
    {
        $this->manage_border_crossings();
    }

    function manage_border_crossings()
    {
        if(!isset($_POST['ajax'])) {  $this->show_404();return; }

        $border_crossings = new Border_crossings_model();
        $result = $this->Border_crossings_model->gets($border_crossings);

        $data['border_crossingss'] = array();
        if($result->success)
        {
            $data['border_crossingss'] = $result->models;
        }

        $this->load->view('border_crossings/manage_border_crossings', $data);
    }

    function edit()
    {

        if(!isset($_POST['submit'])) {  $this->show_404();return; }

//        $data['border_crossings_name'] = $this->input->post('border_crossings_name');
//        $data['border_crossings_id'] = $this->input->post('border_crossings_id');
//        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('border_crossings_name', 'Border Crossings Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('border_crossings_name_kh', 'Border Crossings Name (Khmer)', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('border_crossings_id', 'Border Crossings ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $border_crossings_model = new Border_crossings_model();
            Model_base::map_objects($border_crossings_model, $_POST);

            $result = $this->Border_crossings_model->update($border_crossings_model);

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

//        $data['border_crossings_name'] = $this->input->post('border_crossings_name');
//        $data['border_crossings_id'] = $this->input->post('border_crossings_id');
//        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('border_crossings_name', 'Border Crossings Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('border_crossings_name_kh', 'Border Crossings Name (Khmer)', 'trim|required|min_length[2]|max_length[100]');

        if ($this->form_validation->run())
        {
            $border_crossings_model = new Border_crossings_model();
            Model_base::map_objects($border_crossings_model, $_POST);

            if($border_crossings_model->border_crossings_id==0) $result = $this->Border_crossings_model->add($border_crossings_model);
            else $result = $this->Border_crossings_model->update($border_crossings_model);

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

        $data['border_crossings_id'] = $this->input->post('border_crossings_id');
        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('border_crossings_id', 'Border Crossings ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $border_crossings_model = new Border_crossings_model();
            Model_base::map_objects($border_crossings_model, $data);

            $result = $this->Border_crossings_model->delete($border_crossings_model);

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

        $model = new Border_crossings_model();
        $model->border_crossings_name = $search;

        $result = $this->Border_crossings_model->get_combobox_items($model);
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
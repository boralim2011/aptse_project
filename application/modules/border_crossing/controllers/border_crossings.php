<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Border_crossing extends My_Controller {

    function __construct()
    {
        parent::__construct();

        $this->Menu = 'border_crossing';

        $this->load->model('Border_crossing_model');
    }

    function index()
    {
        $this->manage_border_crossing();
    }

    function manage_border_crossing()
    {
        if(!isset($_POST['ajax'])) {  $this->show_404();return; }

        $border_crossing = new Border_crossing_model();
        $result = $this->Border_crossing_model->gets($border_crossing);

        $data['border_crossings'] = array();
        if($result->success)
        {
            $data['border_crossings'] = $result->models;
        }

        $this->load->view('border_crossing/manage_border_crossing', $data);
    }

    function edit()
    {

        if(!isset($_POST['submit'])) {  $this->show_404();return; }

//        $data['border_crossing_name'] = $this->input->post('border_crossing_name');
//        $data['border_crossing_id'] = $this->input->post('border_crossing_id');
//        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('border_crossing_name', 'Border Crossing Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('border_crossing_name_kh', 'Border Crossing Name (Khmer)', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('border_crossing_id', 'Border Crossing ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $border_crossing_model = new Border_crossing_model();
            Model_base::map_objects($border_crossing_model, $_POST);

            $result = $this->Border_crossing_model->update($border_crossing_model);

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

//        $data['border_crossing_name'] = $this->input->post('border_crossing_name');
//        $data['border_crossing_id'] = $this->input->post('border_crossing_id');
//        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('border_crossing_name', 'Border Crossing Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('border_crossing_name_kh', 'Border Crossing Name (Khmer)', 'trim|required|min_length[2]|max_length[100]');

        if ($this->form_validation->run())
        {
            $border_crossing_model = new Border_crossing_model();
            Model_base::map_objects($border_crossing_model, $_POST);

            if($border_crossing_model->border_crossing_id==0) $result = $this->Border_crossing_model->add($border_crossing_model);
            else $result = $this->Border_crossing_model->update($border_crossing_model);

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

        $data['border_crossing_id'] = $this->input->post('border_crossing_id');
        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('border_crossing_id', 'Border Crossing ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $border_crossing_model = new Border_crossing_model();
            Model_base::map_objects($border_crossing_model, $data);

            $result = $this->Border_crossing_model->delete($border_crossing_model);

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

        $model = new Border_crossing_model();
        $model->border_crossing_name = $search;

        $result = $this->Border_crossing_model->get_combobox_items($model);
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
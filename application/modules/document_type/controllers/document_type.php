<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Document_type extends My_Controller {

    function __construct()
    {
        parent::__construct();

        $this->Menu = 'document_type';

        $this->load->model('Document_type_model');
    }

    function index()
    {
        $this->manage_document_type();
    }

    function manage_document_type()
    {
        if(!isset($_POST['ajax'])) {  $this->show_404();return; }

        $document_type = new Document_type_model();
        $result = $this->Document_type_model->gets($document_type);

        $data['document_types'] = array();
        if($result->success)
        {
            $data['document_types'] = $result->models;
        }

        $this->load->view('document_type/manage_document_type', $data);
    }

    function edit()
    {

        if(!isset($_POST['submit'])) {  $this->show_404();return; }

//        $data['document_type_name'] = $this->input->post('document_type_name');
//        $data['document_type_id'] = $this->input->post('document_type_id');
//        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('document_type_name', 'Document Type Name', 'trim|required|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('document_type_id', 'Document Type ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $document_type_model = new Document_type_model();
            Model_base::map_objects($document_type_model, $_POST);

            $result = $this->Document_type_model->update($document_type_model);

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

//        $data['document_type_name'] = $this->input->post('document_type_name');
//        $data['document_type_id'] = $this->input->post('document_type_id');
//        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('document_type_name', 'Document Type Name', 'trim|required|min_length[2]|max_length[100]');

        if ($this->form_validation->run())
        {
            $document_type_model = new Document_type_model();
            Model_base::map_objects($document_type_model, $_POST);

            if($document_type_model->document_type_id==0) $result = $this->Document_type_model->add($document_type_model);
            else $result = $this->Document_type_model->update($document_type_model);

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

        $data['document_type_id'] = $this->input->post('document_type_id');
        $data = $this->security->xss_clean($data);
        $this->form_validation->set_rules('document_type_id', 'Document Type ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $document_type_model = new Document_type_model();
            Model_base::map_objects($document_type_model, $data);

            $result = $this->Document_type_model->delete($document_type_model);

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

        $model = new Document_type_model();
        $model->document_type_name = $search;

        $result = $this->Document_type_model->get_combobox_items($model);
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
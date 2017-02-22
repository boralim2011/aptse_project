<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Arrival_departure extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        $this->Menu = 'arrival_departures';

        $this->load->model('Contact_model');
        $this->load->model('Contact_address_model');
        $this->load->model('Location_model');
        $this->load->model('Arrival_departure_model');
        $this->load->model('Service_type_model');
        $this->load->model("Register_model");
        $this->load->model("Register_type_model");
    }


    public $contact_type = 'Register';

    function index()
    {
        $this->manage_arrival_departures();
    }

    function manage_arrival_departures()
    {
        if(!isset($_POST['ajax']) && !isset($_POST['submit'])) {  $this->show_404();return; }

        $data['arrival_departuress'] = array();

        $arrival_departure = new Arrival_departure_model();
        $contact = new Contact_model();
        $register = new Register_model();

        if(isset($_POST['submit']))
        {
            if(!isset($_POST['all_date']))
            {
                $message= '';
                if(!$this->valid_date($_POST['from_date'])) $message="Please enter from date<br/>";
                if(!$this->valid_date($_POST['to_date'])) $message.="Please enter to date";

                $this->show_error($message);
            }

            Model_base::map_objects($arrival_departure, $_POST);
            Model_base::map_objects($contact, $_POST);
            Model_base::map_objects($register, $_POST);

            $data = array_merge($data,$_POST);
            //echo json_encode($result);
            //var_dump($data);
        }

        $arrival_departure->all_date = isset($_POST['all_date']) && $_POST['all_date']==1? 1:0 ;
        $arrival_departure->from_date = isset($_POST['from_date'])? $_POST['from_date']: Date('Y-m-01');
        $arrival_departure->to_date = isset($_POST['to_date'])? $_POST['to_date']: Date('Y-m-d');
        $arrival_departure->agency_type_id = isset($_POST['agency_type_id'])? $_POST['agency_type_id']: 0;
        $arrival_departure->search_option= isset($_POST['search_option'])? $_POST['search_option']:'like';

        $register->id_card_no = isset($_POST['search_by']) && $_POST['search_by']=='id_card_no'? $_POST['search']:"";
        $register->passport_no = isset($_POST['search_by']) && $_POST['search_by']=='passport_no'? $_POST['search']:"";
        $register->worker_code = isset($_POST['search_by']) && $_POST['search_by']=='worker_code'? $_POST['search']:"";

        $contact->phone_number = isset($_POST['search_by']) && $_POST['search_by']=='phone_number'? $_POST['search']:"";
        $contact->contact_code = isset($_POST['search_by']) && $_POST['search_by']=='contact_code'? $_POST['search']:"";
        $contact->contact_name = isset($_POST['search_by']) && $_POST['search_by']=='contact_name'? $_POST['search']:"";
        $contact->contact_name_kh = isset($_POST['search_by']) && $_POST['search_by']=='contact_name_kh'? $_POST['search']:"";
        $contact->first_name = isset($_POST['search_by']) && $_POST['search_by']=='first_name'? $_POST['search']:"";
        $contact->first_name_kh = isset($_POST['search_by']) && $_POST['search_by']=='first_name_kh'? $_POST['search']:"";
        $contact->last_name = isset($_POST['search_by']) && $_POST['search_by']=='last_name'? $_POST['search']:"";
        $contact->last_name_kh = isset($_POST['search_by']) && $_POST['search_by']=='last_name_kh'? $_POST['search']:"";
        $contact->contact_type = $this->contact_type;

        Model_base::map_objects($arrival_departure, $contact, true);
        Model_base::map_objects($arrival_departure, $register, true);

        $result = $this->Arrival_departure_model->gets($arrival_departure);
        if($result->success)$data['arrival_departures'] = $result->models;

        $agency = new Contact_model();
        $agency->contact_type='Agency';
        $result = $this->Contact_model->gets($agency);
        if($result->success)$data['agencies'] = $result->models;

        $company = new Contact_model();
        $company->contact_type='Company';
        $result = $this->Contact_model->gets($company);
        if($result->success)$data['companies'] = $result->models;

        $country = new Location_model();
        $country->location_type_id = 1;
        $result = $this->Location_model->gets($country);
        if($result->success)$data['countries'] = $result->models;

        $service = new Service_type_model();
        $result = $this->Service_type_model->gets($service);
        if($result->success)$data['service_types'] = $result->models;

        $register_type = new Register_type_model();
        $result = $this->Register_type_model->gets($register_type);
        if($result->success)$data['worker_types'] = $result->models;

        $recruiter = new Contact_model();
        $recruiter->contact_type='Recruiter';
        $result = $this->Contact_model->gets($recruiter);
        if($result->success)$data['recruiters'] = $result->models;

        $data = array_merge($data,(array)$arrival_departure);

        $this->load->view('arrival_departure/manage_arrival_departure', $data);

    }

    function get_address(Contact_model $model, $key='contact')
    {
        if($model->contact_id!=0)
        {
            $address = new Contact_address_model();
            $address->contact_id = $model->contact_id;
            $address->address_key = $key;

            $result = $this->Contact_address_model->gets($address);

            if($result->success){
                return $result->models[0];
            }

        }

        $address = new Contact_address_model();
        $address->address_key = $key;

        $country = $this->Location_model->get_default_country();
        if($country){
            $address->country_id = $country->location_id;
            $address->country = $country->location_name;
        }

        return $address;
    }

    function edit($arrival_departure_id = 0)
    {

        if(!isset($_POST['ajax']) && !isset($_POST['submit'])) {  $this->show_404();return; }

        $data=array();

        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('arrival_departure_id', 'Arrival Departure ID', 'required|greater_than[0]');
            $this->form_validation->set_rules('register_id', 'Register ID', 'required|greater_than[0]');
            $this->form_validation->set_rules('from_location_id', 'From Location', 'required|greater_than[0]');
            $this->form_validation->set_rules('to_location_id', 'To Location', 'required|greater_than[0]');
            $this->form_validation->set_rules('visa_issue_location_id', 'Visa Issue Location', 'required|greater_than[0]');
            $this->form_validation->set_rules('arrival_departure_date', 'Arrival_departure Date', 'trim|required|min_length[10]|max_length[10]');

            if ($this->form_validation->run())
            {
                $arrival_departure_model = new Arrival_departure_model();
                Model_base::map_objects($arrival_departure_model, $_POST);

                $arrival_departure_model->modified_by = $this->UserSession->user_id;


                //begin transaction
                $this->db->trans_begin();

                $result = $this->Arrival_departure_model->update($arrival_departure_model);

                if($result->success)
                {
                    //do something more
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
            $model = new Arrival_departure_model();
            $model->arrival_departure_id = $arrival_departure_id;
            $result = $this->Arrival_departure_model->get($model);


            if($result->success)
            {
                $arrival_departure = $result->model;
            }
            else
            {
                $this->show_404(); return;
            }

            $data['title'] = "Edit Arrival_departure";
            $data['url'] = base_url()."arrival_departure/edit";
            $data['arrival_departure'] = $arrival_departure;

            $this->load->view('arrival_departure/new_arrival_departure', $data);
        }


    }

    function add()
    {
        if(!isset($_POST['ajax']) && !isset($_POST['submit'])) {  $this->show_404();return; }

        if($this->input->post('submit'))
        {

            $this->form_validation->set_rules('register_id', 'Register ID', 'required|greater_than[0]');
            $this->form_validation->set_rules('from_location_id', 'From Location', 'required|greater_than[0]');
            $this->form_validation->set_rules('to_location_id', 'To Location', 'required|greater_than[0]');
            $this->form_validation->set_rules('visa_issue_location_id', 'Visa Issue Location', 'required|greater_than[0]');
            $this->form_validation->set_rules('arrival_departure_date', 'Arrival_departure Date', 'trim|required|min_length[10]|max_length[10]');

            if ($this->form_validation->run())
            {
                $arrival_departure_model = new Arrival_departure_model();
                Model_base::map_objects($arrival_departure_model, $_POST);

                $arrival_departure_model->created_by = $this->UserSession->user_id;
                $arrival_departure_model->modified_by = $this->UserSession->user_id;

                //begin transaction
                $this->db->trans_begin();

                if($arrival_departure_model->arrival_departure_id==0) $result = $this->Arrival_departure_model->add($arrival_departure_model);
                else $result = $this->Arrival_departure_model->update($arrival_departure_model);

                if($result->success)
                {
                    //do something more
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
                $error_message = validation_errors();
                if(strlen($error_message)>500) $error_message="Please enter the required field with red *";

                $message = $this->create_message($error_message, 'Error');
                $result = new Message_result();
                $result->message = json_encode($message);
                echo json_encode($result);
                return false;
            }
        }
        else
        {
            $arrival_departure = new Arrival_departure_model();

            $data['arrival_departure'] = $arrival_departure;
            $data['url'] = base_url()."arrival_departure/add";

            $this->load->view('arrival_departure/new_arrival_departure', $data);
        }
    }

    function print_form($id, $form_name='khmer_arrival_departure')
    {
        $model = new Arrival_departure_model();
        $model->arrival_departure_id = $id;
        $result = $this->Arrival_departure_model->get($model);

        if($result->success)
        {
            $arrival_departure = $result->model;
        }
        else
        {
            $this->show_404(); return;
        }

        $data['arrival_departure'] = $arrival_departure;

        $this->load->view("arrival_departure/$form_name", $data);
    }

    function print_th($id)
    {
        $model = new Arrival_departure_model();
        $model->arrival_departure_id = $id;
        $result = $this->Arrival_departure_model->get($model);

        if($result->success)
        {
            $arrival_departure = $result->model;
        }
        else
        {
            $this->show_404(); return;
        }

        $data['arrival_departure'] = $arrival_departure;

        $this->load->view('arrival_departure/thai_arrival_departure', $data);
    }

    function print_kh($id)
    {
        $model = new Arrival_departure_model();
        $model->arrival_departure_id = $id;
        $result = $this->Arrival_departure_model->get($model);

        if($result->success)
        {
            $arrival_departure = $result->model;
        }
        else
        {
            $this->show_404(); return;
        }

        $data['arrival_departure'] = $arrival_departure;

        //echo print_r($data);

        $this->load->view('arrival_departure/khmer_arrival_departure', $data);
    }


    function delete()
    {
        if(!isset($_POST['submit'])) { $this->show_404(); return; }

        $this->form_validation->set_rules('arrival_departure_id', 'Arrival_departure ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $arrival_departure_model = new Arrival_departure_model();
            $arrival_departure_model->arrival_departure_id = $this->input->post('arrival_departure_id');

            $result = $this->Arrival_departure_model->delete($arrival_departure_model);

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

        $model = new Arrival_departure_model();
        $model->arrival_departures_name = $search;

        $result = $this->Arrival_departure_model->get_combobox_items($model);
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
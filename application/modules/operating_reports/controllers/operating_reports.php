<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Operating_reports extends My_Controller {

    function __construct()
    {
        parent::__construct();

        $this->Menu = 'register';

        $this->load->model('Contact_model');
        //$this->load->model('Contact_address_model');
        $this->load->model('Location_model');
        $this->load->model('Register_model');
        $this->load->model('Service_type_model');
        $this->load->model('Register_type_model');
    }


    public $contact_type = 'Register';

    function index()
    {
        $this->manage_register();
    }

    function manage_register()
    {
        if(!isset($_POST['ajax']) && !isset($_POST['submit'])) {  $this->show_404();return; }

        $data['registers'] = array();

        $register = new Register_model();
        $contact = new Contact_model();

        if(isset($_POST['submit']))
        {
            if(!isset($_POST['all_date']))
            {
                $message= '';
                if(!$this->valid_date($_POST['from_date'])) $message="Please enter from date<br/>";
                if(!$this->valid_date($_POST['to_date'])) $message.="Please enter to date";

                $this->show_error($message);
            }

            Model_base::map_objects($register, $_POST);
            Model_base::map_objects($contact, $_POST);

            $data = array_merge($data,$_POST);
            //echo json_encode($result);
            //var_dump($data);
        }

        $register->all_date = isset($_POST['all_date']) && $_POST['all_date']==1? 1:0 ;
        $register->from_date = isset($_POST['from_date'])? $_POST['from_date']: Date('Y-m-01');
        $register->to_date = isset($_POST['to_date'])? $_POST['to_date']: Date('Y-m-d');
        $register->agency_type_id = isset($_POST['agency_type_id'])? $_POST['agency_type_id']: 0;
        $register->date_of= isset($_POST['date_of'])? $_POST['date_of']:'register_date';
        $register->search_option= isset($_POST['search_option'])? $_POST['search_option']:'like';

        $register->id_card_no = isset($_POST['search_by']) && $_POST['search_by']=='id_card_no'? $_POST['search']:$register->id_card_no;
        $register->passport_no = isset($_POST['search_by']) && $_POST['search_by']=='passport_no'? $_POST['search']:$register->passport_no;
        $register->worker_code = isset($_POST['search_by']) && $_POST['search_by']=='worker_code'? $_POST['search']:$register->worker_code;

        $contact->phone_number = isset($_POST['search_by']) && $_POST['search_by']=='phone_number'? $_POST['search']:$contact->phone_number;
        $contact->contact_code = isset($_POST['search_by']) && $_POST['search_by']=='contact_code'? $_POST['search']:$contact->contact_code;
        $contact->contact_name = isset($_POST['search_by']) && $_POST['search_by']=='contact_name'? $_POST['search']:$contact->contact_name;
        $contact->contact_name_kh = isset($_POST['search_by']) && $_POST['search_by']=='contact_name_kh'? $_POST['search']:$contact->contact_name_kh;
        $contact->first_name = isset($_POST['search_by']) && $_POST['search_by']=='first_name'? $_POST['search']:$contact->first_name;
        $contact->first_name_kh = isset($_POST['search_by']) && $_POST['search_by']=='first_name_kh'? $_POST['search']:$contact->first_name_kh;
        $contact->last_name = isset($_POST['search_by']) && $_POST['search_by']=='last_name'? $_POST['search']:$contact->last_name;
        $contact->last_name_kh = isset($_POST['search_by']) && $_POST['search_by']=='last_name_kh'? $_POST['search']:$contact->last_name_kh;


        Model_base::map_objects($register, $contact, true);


        $report_name = isset($_POST['report_name'])?$_POST['report_name']:'bio_data';
        $data['report_name'] = $report_name;

        $order_by = "order by st.service_type_name";
        if($report_name=='worker_fly')
        {
            $order_by = "order by r.date_of_fly, st.service_type_name";
            $register->date_of = "date_of_fly";
        }
        elseif($report_name=='worker_cancel')
        {
            $order_by = "order by r.canceled_date, st.service_type_name";
            $register->date_of = "canceled_date";
        }

        $register->contact_type = $this->contact_type;
        $result = $this->Register_model->gets($register, $order_by);
        if($result->success)$data['registers'] = $result->models;

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

        $data = array_merge($data,(array)$register);

        $this->load->view('operating_reports/operating_reports', $data);

    }


    function print_report()
    {
        if(!isset($_POST['report_name'])) { $this->show_404(); return; }

        $report_name= $_POST['report_name'];


        $data = $_POST;
        $data['registers'] = json_decode($_POST['registers']);
        $this->load->view("operating_reports/print_$report_name", $data);
    }

}
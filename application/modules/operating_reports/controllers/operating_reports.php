<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Operating_reports extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        $this->Menu = 'register';

        $this->load->model('Contact_model');
        $this->load->model('Contact_address_model');
        $this->load->model('Location_model');
        $this->load->model('Service_type_model');
        $this->load->model("Register_type_model");
        $this->load->model("Document_type_model");
    }


    public $contact_type = 'Register';

    function index()
    {
        $this->show_report();
    }

    function show_report($view_country=3)
    {
        //if(!isset($_POST['ajax']) && !isset($_POST['search'])) {  $this->show_404();return; }

        $search = isset($_POST['search'])?$_POST['search']:'';
        //$page = isset($_POST['page']) ? $_POST['page']: 1;
        //$display = isset($_POST['display']) ? $_POST['display']: 10;
        $search_by = isset($_POST['search_by'])? $_POST['search_by']: 'contact_name';

        $all_date = isset($_POST['all_date']);
        $from_date = isset($_POST['from_date'])? $_POST['from_date']: Date('Y-m-d');
        $to_date = isset($_POST['to_date'])? $_POST['to_date']: Date('Y-m-d');
        $date_of = isset( $_POST['date_of'])?  $_POST['date_of']: "register_date";

        $report_name = isset($_POST['report_name'])?$_POST['report_name']: "mfa_list_thai_report";

        $data['registers'] = array();

        $contact = new Contact_model();

        Model_base::map_objects($contact, $_POST, true);

        $contact->report_name = $report_name;
        $contact->search = $search;
        //$contact->display = $display;
        //$contact->page = $page;
        $contact->search_by = $search_by;
        $contact->show_all = 1;

        $contact->all_date = $all_date;
        $contact->from_date = $from_date;
        $contact->to_date = $to_date;
        $contact->date_of = $date_of;


        $contact->to_country_id = isset($_POST['to_country_id'])? $_POST['to_country_id'] : $view_country;

        $contact->contact_type = $this->contact_type;

        //if(isset($_POST['search'])) {echo print_r($contact); exit;}

        $result = $this->Contact_model->get_reports($contact);
        if($result->success)
        {
            $data['registers'] = $result->models;
            //$data['company_name'] = isset($result->models[0]->company_name)?$result->models[0]->company_name:"";
            $data['employer_name'] = isset($result->models[0]->employer_name)?$result->models[0]->employer_name:"";
            $data['employer_address'] = isset($result->models[0]->employer_address)?$result->models[0]->employer_address:"";
        }

        //Pagination
        //$data['display'] = $display;
        //$data['page'] = $page;
        $data['search'] = $search;
        $data['search_by'] = $search_by;
        //$data['pages'] = is_array($result->models)? ceil($result->models[0]->records / $display): 0;
        //$data['records'] = is_array($result->models)? $result->models[0]->records:0;

        $data['view_country'] = $view_country;

        //get company info
        $company = new Contact_model();
        $company->contact_id = 1;
        $result = $this->Contact_model->get($company);
        if($result->success) {
            $data['company_name'] = $result->model->contact_name;
        }
        //get company address
        $address = new Contact_address_model();
        $address->contact_id = $company->contact_id;
        $address->address_key = "contact";
        $result = $this->Contact_address_model->gets($address);
        if($result->success){
            $data['company_address'] = $result->models[0]->address;
        }

        $agency = new Contact_model();
        $agency->contact_type='Agency';
        $result = $this->Contact_model->get_list($agency);
        if($result->success)$data['agencies'] = $result->models;

        $company = new Contact_model();
        $company->contact_type='Company';
        $result = $this->Contact_model->get_list($company);
        if($result->success)$data['companies'] = $result->models;

        $recruiter = new Contact_model();
        $recruiter->contact_type='Recruiter';
        $result = $this->Contact_model->get_list($recruiter);
        if($result->success)$data['recruiters'] = $result->models;


        $country = new Location_model();
        $country->location_type_id = 1;
        $result = $this->Location_model->gets($country);
        if($result->success)$data['countries'] = $result->models;

        $service = new Service_type_model();
        $result = $this->Service_type_model->gets($service);
        if($result->success)$data['service_types'] = $result->models;

        $register_type = new Register_type_model();
        $result = $this->Register_type_model->gets($register_type);
        if($result->success)$data['register_types'] = $result->models;

        $document_type = new Document_type_model();
        $result = $this->Document_type_model->gets($document_type);
        if($result->success)$data['document_types'] = $result->models;

        $data = array_merge($data,(array)$contact);

        $data['report_no'] = isset($_POST['report_no'])?$_POST['report_no']:"";
        $data['logo'] = $this->get_file_site().'logo_mfa_thai.png';


        if(isset($_POST['print']))
        {
            $this->load->view('operating_reports/print_reports', $data);
        }
        else
        {
            $this->load->view('operating_reports/manage_reports', $data);
        }

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
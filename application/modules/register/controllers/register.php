<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends My_Controller {

    function __construct()
    {
        parent::__construct();

        $this->Menu = 'register';

        $this->load->model('Contact_model');
        $this->load->model('Contact_address_model');
        $this->load->model('Location_model');
        $this->load->model('Register_model');
        $this->load->model('Service_type_model');
        $this->load->model("Register_type_model");
    }


    public $contact_type = 'Register';

    function index($country_id=3)
    {
        $this->manage_register($country_id);
    }


    function manage_register($country_id=3)
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
        $register->to_country_id = isset($_POST['to_country_id'])? $_POST['to_country_id']: $country_id;

        $contact->phone_number = isset($_POST['search_by']) && $_POST['search_by']=='phone_number'? $_POST['search']:$contact->phone_number;
        $contact->contact_code = isset($_POST['search_by']) && $_POST['search_by']=='contact_code'? $_POST['search']:$contact->contact_code;
        $contact->contact_name = isset($_POST['search_by']) && $_POST['search_by']=='contact_name'? $_POST['search']:$contact->contact_name;
        $contact->contact_name_kh = isset($_POST['search_by']) && $_POST['search_by']=='contact_name_kh'? $_POST['search']:$contact->contact_name_kh;
        $contact->first_name = isset($_POST['search_by']) && $_POST['search_by']=='first_name'? $_POST['search']:$contact->first_name;
        $contact->first_name_kh = isset($_POST['search_by']) && $_POST['search_by']=='first_name_kh'? $_POST['search']:$contact->first_name_kh;
        $contact->last_name = isset($_POST['search_by']) && $_POST['search_by']=='last_name'? $_POST['search']:$contact->last_name;
        $contact->last_name_kh = isset($_POST['search_by']) && $_POST['search_by']=='last_name_kh'? $_POST['search']:$contact->last_name_kh;


        Model_base::map_objects($register, $contact, true);

        $register->contact_type = $this->contact_type;
        $result = $this->Register_model->gets($register);
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

        $this->load->view('register/manage_register', $data);

    }

    private function upload_image(Contact_model &$register, $delete_if_exist = true)
    {
        if(isset($_FILES['file']) && $_FILES['file']['name'] != '')
        {
            $this->Contact_model->generate_code($register);
            $file_name = $_FILES['file']['name'];
            $file_name = $register->contact_code.".".pathinfo($file_name, PATHINFO_EXTENSION);
            $file_path = $this->get_photo_path();

            //delete old file
            if($delete_if_exist && !$this->delete_file($file_path.$file_name)) return false;

            $upload = $this->upload_file($file_path , $file_name);
            if(!$upload) return false;

            $register->photo = $file_name;
        }

        return true;
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

    function edit($worker_id = 0)
    {

        if(!isset($_POST['ajax']) && !isset($_POST['submit'])) {  $this->show_404();return; }

        $data=array();

        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('worker_id', 'Register ID', 'required|greater_than[0]');
            $this->form_validation->set_rules('contact_id', 'Contact ID', 'required|greater_than[0]');
            $this->form_validation->set_rules('contact_name', 'Register Name', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('contact_name_kh', 'Register Name (Khmer)', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('first_name_kh', 'First Name (Khmer)', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('last_name', 'Last Name Khmer', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('last_name_kh', 'Last Name Khmer', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required|min_length[1]|max_length[1]');
            $this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|required|min_length[1]|max_length[20]');
            $this->form_validation->set_rules('nationality_id', 'Nationality', 'required|greater_than[0]');
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|min_length[9]|max_length[100]');

            //$this->form_validation->set_rules('father_name', 'Father Name', 'trim|required|min_length[2]|max_length[100]');
            //$this->form_validation->set_rules('father_name_kh', 'Father Name (Khmer)', 'trim|required|min_length[2]|max_length[100]');
            //$this->form_validation->set_rules('mother_name', 'Mother Name', 'trim|required|min_length[2]|max_length[100]');
            //$this->form_validation->set_rules('mother_name_kh', 'Mother Name (Khmer)', 'trim|required|min_length[2]|max_length[100]');

            $this->form_validation->set_rules('company_id', 'Company Name', 'required|greater_than[0]');
            $this->form_validation->set_rules('service_type_id', 'Service Type', 'required|greater_than[0]');
            $this->form_validation->set_rules('recruiter_id', 'Recruiter', 'required|greater_than[0]');
            $this->form_validation->set_rules('to_country_id', 'Country', 'required|greater_than[0]');
            $this->form_validation->set_rules('register_date', 'Register Date', 'trim|required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('worker_type_id', 'Register Type', 'required|greater_than[0]');


            if ($this->form_validation->run())
            {
                $contact_model = new Contact_model();
                Model_base::map_objects($contact_model, $_POST);

                //update photo
                if(!$this->upload_image($contact_model))
                {
                    $message = $this->create_message('Cannot upload photo', 'Error');
                    $result = new Message_result();
                    $result->message = json_encode($message);
                    echo json_encode($result);
                    return false;
                }

                //begin transaction
                $this->db->trans_begin();

                $result = $this->Contact_model->update($contact_model);

                if($result->success)
                {
                    //contact address
                    $save = $this->save_address($contact_model);
                    if($save->success)
                    {
                        $result->model->address_id = $save->model->address_id;
                    }
                    else
                    {
                        $this->db->trans_rollback();

                        $message = $this->create_message($save->message, 'Error');
                        $save->message = json_encode($message);
                        echo json_encode($save);
                        return false;
                    }
                    //place of birth
                    $save = $this->save_address($contact_model, 'pob', 1);
                    if($save->success)
                    {
                        $result->model->address_id1 = $save->model->address_id;
                    }
                    else
                    {
                        $this->db->trans_rollback();

                        $message = $this->create_message($save->message, 'Error');
                        $save->message = json_encode($message);
                        echo json_encode($save);
                        return false;
                    }
                    //parent address
                    $save = $this->save_address($contact_model, 'parent_address', 2);
                    if($save->success)
                    {
                        $result->model->address_id2 = $save->model->address_id;
                    }
                    else
                    {
                        $this->db->trans_rollback();

                        $message = $this->create_message($save->message, 'Error');
                        $save->message = json_encode($message);
                        echo json_encode($save);
                        return false;
                    }
                    //register info
                    $save = $this->save_register($contact_model);
                    if($save->success)
                    {
                        $result->model->worker_id = $save->model->worker_id;
                    }
                    else
                    {
                        $this->db->trans_rollback();

                        $message = $this->create_message($save->message, 'Error');
                        $save->message = json_encode($message);
                        echo json_encode($save);
                        return false;
                    }
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
            $model = new Register_model();
            $model->worker_id = $worker_id;
            $result = $this->Register_model->get($model);
            $contact = new Contact_model();

            if($result->success)
            {
                $register = $result->model;
                Model_base::map_objects($contact, $register);
            }
            else
            {
                $this->show_404(); return;
            }

            if (isset($contact->photo) && $register->photo != '')
            {
                $contact->photo_path = $this->get_photo_site().$register->photo;
            }
            else
            {
                $contact->photo_path = $this->default_user_image();
            }

            $address = $this->get_address($contact);
            $pob = $this->get_address($contact, 'pob');
            $parent_address = $this->get_address($contact, 'parent_address');

            $data['title'] = "Edit Register";
            $data['url'] = base_url()."register/edit";
            $data['contact'] = $contact;
            $data['register'] = $register;
            $data['address'] = $address;
            $data['place_of_birth'] = $pob;
            $data['parent_address'] = $parent_address;

            $this->load->view('register/new_register', $data);
        }


    }

    function add($country_id=0)
    {
        if(!isset($_POST['ajax']) && !isset($_POST['submit'])) {  $this->show_404();return; }


        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('contact_name', 'Register Name', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('contact_name_kh', 'Register Name (Khmer)', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('first_name_kh', 'First Name (Khmer)', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('last_name', 'Last Name Khmer', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('last_name_kh', 'Last Name Khmer', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required|min_length[1]|max_length[1]');
            $this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|required|min_length[1]|max_length[20]');
            $this->form_validation->set_rules('nationality_id', 'Nationality', 'required|greater_than[0]');
            $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|min_length[9]|max_length[100]');

            //$this->form_validation->set_rules('father_name', 'Father Name', 'trim|required|min_length[2]|max_length[100]');
            //$this->form_validation->set_rules('father_name_kh', 'Father Name (Khmer)', 'trim|required|min_length[2]|max_length[100]');
            //$this->form_validation->set_rules('mother_name', 'Mother Name', 'trim|required|min_length[2]|max_length[100]');
            //$this->form_validation->set_rules('mother_name_kh', 'Mother Name (Khmer)', 'trim|required|min_length[2]|max_length[100]');

            $this->form_validation->set_rules('company_id', 'Company Name', 'required|greater_than[0]');
            $this->form_validation->set_rules('service_type_id', 'Service Type', 'required|greater_than[0]');
            $this->form_validation->set_rules('recruiter_id', 'Recruiter', 'required|greater_than[0]');
            $this->form_validation->set_rules('to_country_id', 'Country', 'required|greater_than[0]');
            $this->form_validation->set_rules('register_date', 'Register Date', 'trim|required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('worker_type_id', 'Register Type', 'required|greater_than[0]');


            if ($this->form_validation->run())
            {
                $contact_model = new Contact_model();
                Model_base::map_objects($contact_model, $_POST);

                //update photo
                if(!$this->upload_image($contact_model))
                {
                    $message = $this->create_message('Cannot upload photo', 'Error');
                    $result = new Message_result();
                    $result->message = json_encode($message);
                    echo json_encode($result);
                    return false;
                }

                //begin transaction
                $this->db->trans_begin();

                if($contact_model->contact_id==0) $result = $this->Contact_model->add($contact_model);
                else $result = $this->Contact_model->update($contact_model);

                if($result->success)
                {
                    //contact address
                    $save = $this->save_address($contact_model);
                    if($save->success)
                    {
                        $result->model->address_id = $save->model->address_id;
                    }
                    else
                    {
                        $this->db->trans_rollback();

                        $message = $this->create_message($save->message, 'Error');
                        $save->message = json_encode($message);
                        echo json_encode($save);
                        return false;
                    }
                    //place of birth
                    $save = $this->save_address($contact_model, 'pob', 1);
                    if($save->success)
                    {
                        $result->model->address_id1 = $save->model->address_id;
                    }
                    else
                    {
                        $this->db->trans_rollback();

                        $message = $this->create_message($save->message, 'Error');
                        $save->message = json_encode($message);
                        echo json_encode($save);
                        return false;
                    }
                    //parent address
                    $save = $this->save_address($contact_model, 'parent_address', 2);
                    if($save->success)
                    {
                        $result->model->address_id2 = $save->model->address_id;
                    }
                    else
                    {
                        $this->db->trans_rollback();

                        $message = $this->create_message($save->message, 'Error');
                        $save->message = json_encode($message);
                        echo json_encode($save);
                        return false;
                    }
                    //register info
                    $save = $this->save_register($contact_model);
                    if($save->success)
                    {
                        $result->model->worker_id = $save->model->worker_id;
                    }
                    else
                    {
                        $this->db->trans_rollback();

                        $message = $this->create_message($save->message, 'Error');
                        $save->message = json_encode($message);
                        echo json_encode($save);
                        return false;
                    }
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
            $contact = new Contact_model();
            $contact->photo_path = $this->default_user_image();
            $contact->contact_type = $this->contact_type;

            $register = new Register_model();

            $address = $this->get_address($contact);

            $register->to_country_id = $country_id;
            $register->to_country_name = array_key_exists($country_id, $this->Country_names)? $this->Country_names[$country_id]:'';

            $data['contact'] = $contact;
            $data['register'] = $register;
            $data['url'] = base_url()."register/add/$country_id";
            $data['address'] = $address;
            $data['place_of_birth'] = $address;
            $data['parent_address'] = $address;

            $this->load->view('register/new_register', $data);
        }
    }

    function save_register(Contact_model $model=null)
    {

        $register = new Register_model();
        Model_base::map_objects($register, $_POST);
        $register->contact_id= $model->contact_id;

        if($register->worker_id==0) $result = $this->Register_model->add($register);
        else $result = $this->Register_model->update($register);

        return $result;
    }

    function save_address(Contact_model $model, $address_key='contact', $index='')
    {
        $address = new Contact_address_model();
        $address->contact_id = $model->contact_id;
        $address->address_key = $address_key;
        $address->address_id = $_POST["address_id$index"];
        $address->country_id = $_POST["country_id$index"];
        $address->province_city_id = $_POST["province_city_id$index"];
        $address->district_khan_id = $_POST["district_khan_id$index"];
        $address->commune_sangkat_id = $_POST["commune_sangkat_id$index"];
        $address->village_id = $_POST["village_id$index"];
        $address->house_no = $_POST["house_no$index"];
        $address->street_no = $_POST["street_no$index"];

        if($address->address_id==0)
        {
            return $this->Contact_address_model->add($address);
        }
        else
        {
            return $this->Contact_address_model->update($address);
        }
    }


    function delete()
    {
        if(!isset($_POST['submit'])) { $this->show_404(); return; }

        $this->form_validation->set_rules('contact_id', 'Register ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $contact_model = new Contact_model();
            $contact_model->contact_id = $this->input->post('contact_id');

            $result = $this->Contact_model->delete($contact_model);

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

    function generate_code()
    {
        if(!isset($_POST['submit'])) {  $this->show_404();return; }

        $register = new Register_model();
        Model_base::map_objects($register, $_POST);

        $company = new Contact_model();
        $company->contact_id = $_POST['company_id'];
        $com = $this->Contact_model->get($company);

        $service_type = new Service_type_model();
        $service_type->service_type_id=$_POST['service_type_id'];
        $ser = $this->Service_type_model->get($service_type);

        if($com->success && $ser->success) $register->prefix = $com->model->contact_code."-".$ser->model->service_type_code;

        $this->Register_model->generate_code($register);

        echo json_encode($register);
    }


    function get_combobox_items($search='')
    {
        $search = $search!=''? $search : strip_tags(trim($_GET['q']));

        $model = new Register_model();
        $model->worker_code = $search;

        $result = $this->Register_model->get_combobox_items($model);
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
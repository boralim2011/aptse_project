<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Employer extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        $this->Menu = 'employer';

        $this->load->model('Contact_model');
        $this->load->model('Contact_address_model');
        $this->load->model('Location_model');
        $this->load->model('Agency_type_model');
    }

    public $contact_type = 'Employer';

    function index()
    {
        $this->manage_employer();
    }

    function manage_employer()
    {
        if(!isset($_POST['ajax']) && !isset($_POST['submit'])) {  $this->show_404();return; }

        $search = isset($_POST['search'])?$_POST['search']:'';
        $page = isset($_POST['page']) ? $_POST['page']: 1;
        $display = isset($_POST['display']) ? $_POST['display']: 10;
        $search_by = isset($_POST['search_by'])? $_POST['search_by']: 'contact_name';

        $agency_type_id = isset($_POST['agency_type_id'])? $_POST['agency_type_id']:0;

        $data['employers'] = array();

        $employer = new Contact_model();
        $employer->search = $search;
        $employer->display = $display;
        $employer->page = $page;
        $employer->search_by = $search_by;
        $employer->agency_type_id = $agency_type_id;

        $employer->contact_type = $this->contact_type;
        $result = $employer->gets($employer);
        if($result->success)$data['employers'] = $result->models;

        $data['agency_type_id'] = $agency_type_id;

        //Pagination
        $data['display'] = $display;
        $data['page'] = $page;
        $data['search'] = $search;
        $data['search_by'] = $search_by;
        $data['pages'] = is_array($result->models)? ceil($result->models[0]->records / $display): 0;
        $data['records'] = is_array($result->models)? $result->models[0]->records:0;

        $agency_type = new Agency_type_model();
        $result = $this->Agency_type_model->gets($agency_type);
        if($result->success) $data['agency_types'] = $result->models;

        $this->load->view('employer/manage_employer', $data);

    }

    private function upload_image(Contact_model &$employer, $delete_if_exist = true)
    {
        if(isset($_FILES['file']) && $_FILES['file']['name'] != '')
        {
            $this->Contact_model->generate_code($employer);
            $file_name = $_FILES['file']['name'];
            $file_name = $employer->contact_code.".".pathinfo($file_name, PATHINFO_EXTENSION);
            $file_path = $this->get_photo_path();

            //delete old file
            if($delete_if_exist && !$this->delete_file($file_path.$file_name)) return false;

            $upload = $this->upload_file($file_path , $file_name);
            if(!$upload) return false;

            $employer->photo = $file_name;
        }

        return true;
    }

    function get_address(Contact_model $model)
    {
        if($model->contact_id!=0)
        {
            $address = new Contact_address_model();
            $address->contact_id = $model->contact_id;
            $address->address_key = 'contact';

            $result = $this->Contact_address_model->gets($address);

            if($result->success){
                return $result->models[0];
            }

        }

        $address = new Contact_address_model();

        $country = $this->Location_model->get_default_country();
        if($country){
            $address->country_id = $country->location_id;
            $address->country = $country->location_name;
        }

        return $address;
    }

    function edit($employer_id = 0)
    {
        if(!isset($_POST['ajax']) && !isset($_POST['submit'])) {  $this->show_404();return; }

        $data=array();

        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('contact_id', 'Employer ID', 'trim|required|greater_than[0]');
            $this->form_validation->set_rules('contact_name', 'Employer Name', 'trim|required|min_length[2]|max_length[100]');
            //$this->form_validation->set_rules('contact_code', 'Employer Code', 'trim|required|min_length[2]|max_length[100]');
            //$this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|min_length[9]|max_length[100]');
            $this->form_validation->set_rules('agency_type_id', 'Employer Type', 'required|greater_than[0]');
            $this->form_validation->set_rules('country_id', 'Country', 'required|greater_than[0]');
            //$this->form_validation->set_rules('province_city_id', 'Province/City', 'required|greater_than[0]');
            //$this->form_validation->set_rules('district_khan_id', 'District/Khan', 'required|greater_than[0]');
            //$this->form_validation->set_rules('commune_sangkat_id', 'Commune/Sangkat', 'required|greater_than[0]');

            if ($this->form_validation->run())
            {
                $employer_model = new Contact_model();
                Model_base::map_objects($employer_model, $_POST);
                $employer_model->contact_type = $this->contact_type;

                //update photo
                if(!$this->upload_image($employer_model))
                {
                    $message = $this->create_message('Cannot upload photo', 'Error');
                    $result = new Message_result();
                    $result->message = json_encode($message);
                    echo json_encode($result);
                    return false;
                }

                //begin transaction
                $this->db->trans_begin();

                $result = $this->Contact_model->update($employer_model);

                if($result->success)
                {
                    $save = $this->save_address($employer_model);
                    if($save->success)
                    {
                        $result->model->address_id = $save->model->address_id;
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

            $model = new Contact_model();
            $model->contact_id = $employer_id;
            $result = $this->Contact_model->get($model);
            if($result->success)
            {
                $employer = $result->model;
            }
            else
            {
                $this->show_404(); return;
            }

            if (isset($employer->photo) && $employer->photo != '')
            {
                $employer->photo_path = $this->get_photo_site().$employer->photo;
            }
            else
            {
                $employer->photo_path = $this->get_logo_image();
            }

//            $agency_type = new Agency_type_model();
//            $agency_type->agency_type_id= $employer->agency_type_id;
//            $result = $this->Agency_type_model->get($agency_type);
//            if($result->success) $employer->agency_type_name = $result->model->agency_type_name;

            $address = $this->get_address($employer);

            $data['title'] = "Edit Employer";
            $data['url'] = base_url()."employer/edit";
            $data['employer'] = $employer;
            $data['address'] = $address;

            $this->load->view('employer/new_employer', $data);
        }


    }

    function add()
    {
        if(!isset($_POST['ajax']) && !isset($_POST['submit'])) {  $this->show_404();return; }


        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('contact_name', 'Employer Name', 'trim|required|min_length[2]|max_length[100]');
            //$this->form_validation->set_rules('contact_code', 'Employer Code', 'trim|required|min_length[2]|max_length[100]');
            //$this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|min_length[9]|max_length[100]');
            $this->form_validation->set_rules('agency_type_id', 'Employer Type', 'required|greater_than[0]');
            $this->form_validation->set_rules('country_id', 'Country', 'required|greater_than[0]');
            //$this->form_validation->set_rules('province_city_id', 'Province/City', 'required|greater_than[0]');
            //$this->form_validation->set_rules('district_khan_id', 'District/Khan', 'required|greater_than[0]');
            //$this->form_validation->set_rules('commune_sangkat_id', 'Commune/Sangkat', 'required|greater_than[0]');

            if ($this->form_validation->run())
            {
                $employer_model = new Contact_model();
                Model_base::map_objects($employer_model, $_POST);
                $employer_model->contact_type = $this->contact_type;

                //update photo
                if(!$this->upload_image($employer_model))
                {
                    $message = $this->create_message('Cannot upload photo', 'Error');
                    $result = new Message_result();
                    $result->message = json_encode($message);
                    echo json_encode($result);
                    return false;
                }

                //begin transaction
                $this->db->trans_begin();

                if($employer_model->contact_id==0) $result = $this->Contact_model->add($employer_model);
                else $result = $this->Contact_model->update($employer_model);


                if($result->success)
                {
                    $save = $this->save_address($employer_model);
                    if($save->success)
                    {
                        $result->model->address_id = $save->model->address_id;
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
            $employer = new Contact_model();
            $employer->photo_path = $this->get_logo_image();
            $employer->contact_type = $this->contact_type;

            $address = $this->get_address($employer);

            $data['employer'] = $employer;
            $data['url'] = base_url()."employer/add";
            $data['address'] = $address;

            $this->load->view('employer/new_employer', $data);
        }
    }

    function save_address(Contact_model $model=null)
    {
        //$_POST['country_id'] = 2;
        //$_POST['province_city_id'] = 3;
        //$_POST['address_id'] = 1;
        //$_POST['contact_id'] = 5;

        $address = new Contact_address_model();
        Model_base::map_objects($address, $_POST);
        $address->contact_id = $model->contact_id;

        if($address->address_id==0)
        {
             return $this->Contact_address_model->add($address);
        }
        else
        {
             return $this->Contact_address_model->update($address);
        }

        //echo $this->db->last_query();
    }


    function delete()
    {
        if(!isset($_POST['submit'])) { $this->show_404(); return; }

        $this->form_validation->set_rules('contact_id', 'Employer ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $employer_model = new Contact_model();
            $employer_model->contact_id = $this->input->post('contact_id');

            $result = $this->Contact_model->delete($employer_model);

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

        $model = new Contact_model();
        $model->contact_name = $search;
        $model->contact_type = $this->contact_type;

        $result = $this->Contact_model->get_combobox_items($model);
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
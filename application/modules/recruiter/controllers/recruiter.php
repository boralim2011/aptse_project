<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recruiter extends My_Controller {

    function __construct()
    {
        parent::__construct();

        $this->Menu = 'recruiter';

        $this->load->model('Contact_model');
        $this->load->model('Contact_address_model');
        $this->load->model('Location_model');
    }

    public $contact_type = 'Recruiter';

    function index()
    {
        $this->manage_recruiter();
    }

    function manage_recruiter()
    {
        if(!isset($_POST['ajax']) && !isset($_POST['submit'])) {  $this->show_404();return; }

        $search = isset($_POST['search'])?$_POST['search']:'';
        $page = isset($_POST['page']) ? $_POST['page']: 1;
        $display = isset($_POST['display']) ? $_POST['display']: 10;
        $search_by = isset($_POST['search_by'])? $_POST['search_by']: 'contact_name';

        $data['recruiters'] = array();

        $recruiter = new Contact_model();
        $recruiter->search = $search;
        $recruiter->display = $display;
        $recruiter->page = $page;
        $recruiter->search_by = $search_by;

        $recruiter->contact_type = $this->contact_type;
        $result = $recruiter->gets($recruiter);
        if($result->success)$data['recruiters'] = $result->models;

        //Pagination
        $data['display'] = $display;
        $data['page'] = $page;
        $data['search'] = $search;
        $data['search_by'] = $search_by;
        $data['pages'] = is_array($result->models)? ceil($result->models[0]->records / $display): 0;
        $data['records'] = is_array($result->models)? $result->models[0]->records:0;

        $this->load->view('recruiter/manage_recruiter', $data);

    }

    private function upload_image(Contact_model &$recruiter, $delete_if_exist = true)
    {
        if(isset($_FILES['file']) && $_FILES['file']['name'] != '')
        {
            $this->Contact_model->generate_code($recruiter);
            $file_name = $_FILES['file']['name'];
            $file_name = $recruiter->contact_code.".".pathinfo($file_name, PATHINFO_EXTENSION);
            $file_path = $this->get_photo_path();

            //delete old file
            if($delete_if_exist && !$this->delete_file($file_path.$file_name)) return false;

            $upload = $this->upload_file($file_path , $file_name);
            if(!$upload) return false;

            $recruiter->photo = $file_name;
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

    function edit($recruiter_id = 0)
    {
        if(!isset($_POST['ajax']) && !isset($_POST['submit'])) {  $this->show_404();return; }

        $data=array();

        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('contact_id', 'Recruiter ID', 'trim|required|greater_than[0]');
            $this->form_validation->set_rules('contact_name', 'Recruiter Name', 'trim|required|min_length[2]|max_length[100]');
            //$this->form_validation->set_rules('contact_code', 'Recruiter Code', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|min_length[9]|max_length[100]');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required|min_length[1]|max_length[1]');
            $this->form_validation->set_rules('country_id', 'Country', 'required|greater_than[0]');
            //$this->form_validation->set_rules('province_city_id', 'Province/City', 'required|greater_than[0]');
            //$this->form_validation->set_rules('district_khan_id', 'District/Khan', 'required|greater_than[0]');
            //$this->form_validation->set_rules('commune_sangkat_id', 'Commune/Sangkat', 'required|greater_than[0]');

            if ($this->form_validation->run())
            {
                $recruiter_model = new Contact_model();
                Model_base::map_objects($recruiter_model, $_POST);
                $recruiter_model->contact_type = $this->contact_type;

                //update photo
                if(!$this->upload_image($recruiter_model))
                {
                    $message = $this->create_message('Cannot upload photo', 'Error');
                    $result = new Message_result();
                    $result->message = json_encode($message);
                    echo json_encode($result);
                    return false;
                }

                //begin transaction
                $this->db->trans_begin();

                $result = $this->Contact_model->update($recruiter_model);

                if($result->success)
                {
                    $save = $this->save_address($recruiter_model);
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
            $model->contact_id = $recruiter_id;
            $result = $this->Contact_model->get($model);
            if($result->success)
            {
                $recruiter = $result->model;
            }
            else
            {
                $this->show_404(); return;
            }

            if (isset($recruiter->photo) && $recruiter->photo != '')
            {
                $recruiter->photo_path = $this->get_photo_site().$recruiter->photo;
            }
            else
            {
                $recruiter->photo_path = $this->default_user_image();
            }

            $address = $this->get_address($recruiter);

            $data['title'] = "Edit Recruiter";
            $data['url'] = base_url()."recruiter/edit";
            $data['recruiter'] = $recruiter;
            $data['address'] = $address;

            $this->load->view('recruiter/new_recruiter', $data);
        }


    }

    function add()
    {
        if(!isset($_POST['ajax']) && !isset($_POST['submit'])) {  $this->show_404();return; }


        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('contact_name', 'Recruiter Name', 'trim|required|min_length[2]|max_length[100]');
            //$this->form_validation->set_rules('contact_code', 'Recruiter Code', 'trim|required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|min_length[9]|max_length[100]');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required|min_length[1]|max_length[1]');
            $this->form_validation->set_rules('country_id', 'Country', 'required|greater_than[0]');
            //$this->form_validation->set_rules('province_city_id', 'Province/City', 'required|greater_than[0]');
            //$this->form_validation->set_rules('district_khan_id', 'District/Khan', 'required|greater_than[0]');
            //$this->form_validation->set_rules('commune_sangkat_id', 'Commune/Sangkat', 'required|greater_than[0]');

            if ($this->form_validation->run())
            {
                $recruiter_model = new Contact_model();
                Model_base::map_objects($recruiter_model, $_POST);
                $recruiter_model->contact_type = $this->contact_type;

                //update photo
                if(!$this->upload_image($recruiter_model))
                {
                    $message = $this->create_message('Cannot upload photo', 'Error');
                    $result = new Message_result();
                    $result->message = json_encode($message);
                    echo json_encode($result);
                    return false;
                }

                //begin transaction
                $this->db->trans_begin();

                if($recruiter_model->contact_id==0) $result = $this->Contact_model->add($recruiter_model);
                else $result = $this->Contact_model->update($recruiter_model);


                if($result->success)
                {
                    $save = $this->save_address($recruiter_model);
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
            $recruiter = new Contact_model();
            $recruiter->photo_path = $this->default_user_image();
            $recruiter->contact_type = $this->contact_type;

            $address = $this->get_address($recruiter);

            $data['recruiter'] = $recruiter;
            $data['url'] = base_url()."recruiter/add";
            $data['address'] = $address;

            $this->load->view('recruiter/new_recruiter', $data);
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

        $this->form_validation->set_rules('contact_id', 'Recruiter ID', 'required|greater_than[0]');

        if ($this->form_validation->run())
        {
            $recruiter_model = new Contact_model();
            $recruiter_model->contact_id = $this->input->post('contact_id');

            $result = $this->Contact_model->delete($recruiter_model);

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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Account extends My_controller
{

    function index()
	{
       $this->manage_user();
	}


    /*
     * Manage user
     */

    function manage_user()
    {
        $this->load_header_view('ManageUsers', 'Manage Users', true);

        $data['Users'] = $this->get_all_accounts('User');
        $this->load->view('admin/manage_user', $data);

        $this->load->view('admin/header_footer/general_script');
        $this->load->view('admin/header_footer/footer');
    }



    private function go_to_manage_user()
    {
        $this->go_to("account/manage_user");
    }

    function new_user($user=null)
    {
        $this->show_user_view('NewUser','Add New User', $user);
    }

    function update_user($account_id, $user=null)
    {
        $account = $user==null? $this->get_account($account_id) : $user;

        $this->show_user_view('UpdateUser', 'Update User', $account);
    }

    private function show_user_view($pate, $title, $user)
    {
        $this->load_header_view($pate, $title);

        $data['User'] = $user==null? $this->initialize_user('User'): $user;
        $this->load->view('admin/new_user', $data);

        $this->load->view('admin/header_footer/general_script');
        $this->load->view('admin/header_footer/footer');
    }

    function initialize_user()
    {
        return $this->initialize_account('User');
    }

    function delete_user($account_id)
    {
        $result= $this->delete_account($account_id);

        $this->go_to_manage_user();

        return $result;
    }

    function activate_user($account_id, $active)
    {
        $result = $this->activate_account($account_id, $active);

        $this->go_to_manage_user();

        return $result;
    }

    function reset_user_password($account_id)
    {
        $result = $this->reset_password($account_id);

        $this->go_to_manage_user();

        return $result;
    }

    /*
    * Manage student
    */

    function manage_student()
    {
        $this->load_header_view('ManageStudents', 'Manage Students', true);

        $data['Students'] = $this->get_all_accounts('Student');
        $this->load->view('admin/manage_student', $data);

        $this->load->view('admin/header_footer/general_script');
        $this->load->view('admin/header_footer/footer');
    }

    function go_to_manage_student()
    {
        $this->go_to("account/manage_student");
    }

    function new_student($student=null)
    {
        $this->show_student_view('NewStudent','Add New Student', $student);
    }

    function update_student($account_id, $student=null)
    {
        $account = $student==null? $this->get_account($account_id) : $student;

        $this->show_student_view('UpdateStudent', 'Update Student', $account);
    }

    private function show_student_view($pate, $title, $student)
    {
        $this->load_header_view($pate, $title);

        $data['Student'] = $student==null? $this->initialize_student('Student'): $student;
        $this->load->view('admin/new_student', $data);

        $this->load->view('admin/header_footer/general_script');
        $this->load->view('admin/header_footer/footer');
    }

    function initialize_student()
    {
        return $this->initialize_account('Student');
    }

    function delete_student($account_id)
    {
        $result= $this->delete_account($account_id);

        $this->go_to_manage_student();

        return $result;
    }

    function activate_student($account_id, $active)
    {
        $result = $this->activate_account($account_id, $active);

        $this->go_to_manage_student();

        return $result;
    }

    function reset_student_password($account_id)
    {
        $result = $this->reset_password($account_id);

        $this->go_to_manage_student();

        return $result;
    }


    /*
    * Manage depositor
    */

    function manage_depositor()
    {
        $this->load_header_view('ManageDepositors', 'Manage Depositors', true);

        $data['Depositors'] = $this->get_all_accounts('Depositor');
        $this->load->view('admin/manage_depositor', $data);

        $this->load->view('admin/header_footer/general_script');
        $this->load->view('admin/header_footer/footer');
    }

    function go_to_manage_depositor()
    {
        $this->go_to("account/manage_depositor");
    }

    function new_depositor($depositor=null)
    {
        $this->show_depositor_view('NewDepositor','Add New Depositor', $depositor);
    }

    function update_depositor($account_id, $depositor=null)
    {
        $account = $depositor==null? $this->get_account($account_id) : $depositor;

        $this->show_depositor_view('UpdateDepositor', 'Update Depositor', $account);
    }

    private function show_depositor_view($pate, $title, $depositor)
    {
        $this->load_header_view($pate, $title);

        $data['Depositor'] = $depositor==null? $this->initialize_depositor('Depositor'): $depositor;
        $this->load->view('admin/new_depositor', $data);

        $this->load->view('admin/header_footer/form_script');
        $this->load->view('admin/header_footer/footer');
    }

    function initialize_depositor()
    {
        return $this->initialize_account('Depositor');
    }

    function delete_depositor($account_id)
    {
        $result= $this->delete_account($account_id);

        $this->go_to_manage_depositor();

        return $result;
    }

    function activate_depositor($account_id, $active)
    {
        $result = $this->activate_account($account_id, $active);

        $this->go_to_manage_depositor();

        return $result;
    }

    function reset_depositor_password($account_id)
    {
        $result = $this->reset_password($account_id);

        $this->go_to_manage_depositor();

        return $result;
    }
    
    
    /*
     *  Manage Account
     * */

    function initialize_account($account_type)
    {
        if(!$this->is_valid_account_type($account_type)) return false;

        $result = new Account_model();
        $result->AccountType = $account_type;
        $result->PhotoFullPath = $this->default_user_image_path();
        $result->ConfirmPassword = $result->Password;
        if($result->AccountType == 'Student') $result->IsActive = 0;

        //echo json_encode($result);

        return $result;
    }

    private function is_valid_account_type($account_type)
    {
        $valid_account_types = array(
            'User' => 'User',
            'Depositor' => 'Depositor',
            'Student' => 'Student'
        );

        return array_key_exists($account_type, $valid_account_types);
    }

    function is_exist_account($account_id)
    {
        //$this->load->model('Account_model', '', true);

        $account = new Account_model();
        $account->AccountId = $account_id;

        $result = $this->Account_model->is_exist_account($account);

        return $result;
    }

    function is_exist_account_number($account_type, $account_number, $account_id=0)
    {
        if(!$this->is_valid_account_type($account_type)) return false;

        //$this->load->model('Account_model', '', true);

        $account = new Account_model();
        $account->AccountType = $account_type;
        $account->AccountNumber = $account_number;
        $account->AccountId = $account_id;

        $result = $this->Account_model->is_exist_account_number($account);

        return $result;
    }

    function is_exist_user_name($account_type, $user_name, $account_id=0)
    {
        if(!$this->is_valid_account_type($account_type)) return false;

        //$this->load->model('Account_model', '', true);

        $account = new Account_model();
        $account->AccountType = $account_type;
        $account->UserName = $user_name;
        $account->AccountId = $account_id;

        $result = $this->Account_model->is_exist_user_name($account);

        return $result;
    }

    function get_accounts($account_type, $current_page=1, $record_per_page= 20)
    {
        if(!$this->is_valid_account_type($account_type)) return false;

        //$this->load->model('Account_model', '', true);

        $input = new Account_model();
        $input->CurrentPage = $current_page > 0 ? $current_page : 1;
        $input->RecordPerPage = $record_per_page > 0?  $record_per_page : 20;
        $input->CurrentRecord = ($input->CurrentPage - 1) * $input->RecordPerPage;
        $input->AccountType = $account_type;

        $data = $this->Account_model->get_accounts($input);


        $result = new Message_result();

        if($data)
        {
            $result->set_success_message($input, $data);
        }
        else
        {
            $result->set_error_message('Search not found');
        }

        echo json_encode($result);
    }

    function get_all_accounts($account_type)
    {
        if(!$this->is_valid_account_type($account_type)) return false;

        //$this->load->model('Account_model', '', true);

        $input = new Account_model();
        $input->AccountType = $account_type;

        $result = $this->Account_model->get_all_accounts($input);

        if(!$result) return false;


        //echo json_encode($result);

        return $result;
    }

    function get_account($account_id)
    {
        //$this->load->model('Account_model', '', true);

        $account = new Account_model();
        $account->AccountId = $account_id;

        $result = $this->Account_model->get_account($account);

        if(!$result) return false;

        if(isset($result->PhotoPath) && $result->PhotoPath!='')
        {
            $result->PhotoFullPath = $this->get_photo_site().$result->PhotoPath;
        }
        else
        {
            $result->PhotoFullPath = $this->default_user_image_path();
        }

        $result->ConfirmPassword = $result->Password;

        return $result;

    }

    function get_account_by_name($user_name)
    {
        //$this->load->model('Account_model', '', true);

        $account = new Account_model();
        $account->UserName = $user_name;

        $result = $this->Account_model->get_account_by_name($account);

        if(!$result) return false;

        if(isset($result->PhotoPath) && $result->PhotoPath!='')
        {
            $result->PhotoFullPath = $this->get_photo_site().$result->PhotoPath;
        }
        else
        {
            $result->PhotoFullPath = $this->default_user_image_path();
        }

        return $result;

    }

    private function upload_user_image(Account_model $account, $delete_if_exist = true)
    {
        if(isset($_FILES['file']) && $_FILES['file']['name'] != '')
        {
            $file_name = $_FILES['file']['name'];
            $file_name = $account->UserName.".".pathinfo($file_name, PATHINFO_EXTENSION);
            $file_path = $this->get_photo_path();

            //delete old file
            if($delete_if_exist && !$this->delete_file($file_path.$file_name)) return false;

            $upload = $this->upload_file($file_path , $file_name);
            if(!$upload) return false;

            $account->PhotoPath = $file_name;
        }

        return true;
    }

    private function go_to_view($success, Account_model $account=null)
    {


        if($success)
        {
            if($account->AccountType == 'User') $this->go_to_manage_user();
            elseif($account->AccountType == 'Student') $this->go_to_manage_student();
            elseif($account->AccountType == 'Depositor') $this->go_to_manage_depositor();
            else $this->go_to_manage_user();
        }
        else
        {
            if(!isset($account->AccountId) || $account->AccountId==0)
            {
                if($account->AccountType == 'User') $this->new_user($account);
                elseif($account->AccountType == 'Student') $this->new_student($account);
                elseif($account->AccountType == 'Depositor') $this->new_depositor($account);
                else $this->new_user();
            }
            else
            {
                if($account->AccountType == 'User') $this->update_user($account->AccountId, $account);
                elseif($account->AccountType == 'Student') $this->update_student($account->AccountId, $account);
                elseif($account->AccountType == 'Depositor') $this->update_depositor($account->AccountId, $account);
                else $this->update_user($account->AccountId, $account);
            }
        }

    }

    function add_account()
    {
        $data = $this->get_json_object();

        if(!isset($data))
        {
            $this->go_to_view(false);
            return false;
        }

        //$this->load->model('Account_model', '', true);

        $account = new Account_model();

        Model_base::map_objects($account, $data);
        $this->map_method($account, $data);

        if(!$this->is_valid_account_type($account->AccountType))
        {
            Model_base::map_objects($account, $data, true);
            $account->Erro = "Account type is not valid!";
            $this->go_to_view(false, $account);
            return false;
        }

        //update photo
        if(!$this->upload_user_image($account))
        {
            Model_base::map_objects($account, $data, true);
            $account->Erro = "Image upload error!";
            $this->go_to_view(false, $account);
            return false;
        }

        $result = $this->Account_model->add_account($account);

        if(!$result)
        {
            Model_base::map_objects($account, $data, true);
            $account->Erro = "Cannot add!";
            $this->go_to_view(false, $account);
            return false;
        }

        $this->go_to_view(true, $account);

        return true;
    }

    function map_method(Account_model $model, $data)
    {
        if(isset($data) && isset($model))
        {
            if(isset($data['WithdrawMethod']))
            {
                if($data['WithdrawMethod'] == 'Bank') $model->WithdrawMethodName = $data['BankMethodName'];
                elseif($data['WithdrawMethod'] == 'Gryp') $model->WithdrawMethodName = $data['GrypMethodName'];
                elseif($data['WithdrawMethod'] == 'Wing') $model->WithdrawMethodName = $data['WingMethodName'];
                elseif($data['WithdrawMethod'] == 'Other') $model->WithdrawMethodName = $data['OtherMethodName'];
                else $model->WithdrawMethodName = $data['GrypMethodName'];
            }
        }
    }

    function update_account()
    {
        $data = $this->get_json_object();

        if(!isset($data))
        {
            $this->go_to_view(false);
            return false;
        }

        //echo print_r($data); return false;

        //$this->load->model('Account_model', '', true);

        $account = new Account_model();

        Model_base::map_objects($account, $data);
        $this->map_method($account, $data);

        if(!$this->is_valid_account_type($account->AccountType))
        {
            Model_base::map_objects($account, $data, true);
            $account->Erro = "Account type is not valid!";
            $this->go_to_view(false, $account);

            return false;
        }

        //update photo
        if(!$this->upload_user_image($account))
        {
            Model_base::map_objects($account, $data, true);
            $account->Erro = "Image upload error!";
            $this->go_to_view(false, $account);

            return false;
        }

        $result = $this->Account_model->update_account($account);

        if(!$result)
        {
            Model_base::map_objects($account, $data, true);
            $account->Erro = "Cannot update!";
            $this->go_to_view(false, $account);

            return false;
        }

        $this->go_to_view(true, $account);

        return $result;
    }

    function delete_account($account_id, $photo_path='')
    {
        //delete old file
        if( isset($photo_path) &&
            $photo_path != '' &&
            !$this->delete_file($this->get_photo_path().$photo_path))
        {
            $this->manage_user();
            return false;
        }

        //$this->load->model('Account_model', '', true);

        $account = new Account_model();
        $account->AccountId = $account_id;

        $result = $this->Account_model->delete_account($account);

        return $result;
    }

    function activate_account($account_id, $active)
    {
        //$this->load->model('Account_model', '', true);

        $account = new Account_model();
        $account->AccountId = $account_id;
        $account->IsActive = $active;

        $result = $this->Account_model->activate_account($account);

        return $result;
    }

    function reset_password($account_id)
    {
        //$this->load->model('Account_model', '', true);

        $account = new Account_model();

        $account->AccountId = $account_id;

        $result = $this->Account_model->reset_password($account);

        return $result;
    }

    function change_password()
    {
        //$this->load->model('Account_model', '', true);

        $account = new Account_model();
        $old_password = isset($_POST['OldPassword'])? $_POST['OldPassword'] : '';
        $new_password = isset($_POST['NewPassword'])? $_POST['NewPassword'] : '';
        $account->UserName = isset($_POST['UserName'])? $_POST['UserName']: '';

        $message = '';

        $account->Password = $old_password;
        $result = $account->login($account);
        if($result)
        {
            $account->Password = $new_password;
            $account->AccountId = $result->AccountId;
            $result = $this->Account_model->change_password($account);
            $message = 'Cannot change password.';
        }
        else
        {
            $message = 'Invalid user name or password.';
        }

        if($result)
        {
            header("location:". base_url().INDEX_FILE."/login");
        }
        else
        {
            $account->OldPassword = $old_password;
            $account->Passowrd = $new_password;
            $account->Message = $message;
            $this->show_change_password($account);
        }
    }

    function show_change_password(Account_model $account=null)
    {
        $this->load->view('admin/change_password', $account);
    }

    function get_user_types()
    {
        $search = strip_tags(trim($_GET['q']));

        if($search!=''){
            //foreach ($list as $key => $value) {
            for($i=0; $i<10; $i++){
                $data[] = array('id' => 'productId'.$i, 'text' => 'productName'.$i);
            }
        } else {
            $data[] = array('id' => '0', 'text' => 'No Products Found');
        }


        echo json_encode($data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
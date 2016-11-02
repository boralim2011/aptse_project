<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Register_model extends Model_base
{

    function __construct()
    {
        parent::__construct();

        if(!isset($this->created_date)) $this->created_date = Date('Y-m-d H:i:s', time());
        if(!isset($this->register_date)) $this->register_date = Date('Y-m-d', time());
    }

    public $worker_id = 0;
    public $worker_code;
    public $register_date;
    public $recruiter_id;
    public $contact_id;
    public $company_id;
    public $agency_id;
    public $service_type_id;
    public $worker_type_id;
    public $id_card_no;
    public $id_card_issue_date;
    public $id_card_expired_date;
    public $to_country_id;

    public $passport_no;
    public $passport_issue_date;
    public $passport_expired_date;
    public $date_of_receive_passport;
    public $date_of_send_ppc_sd;
    public $date_of_mofa; //Ministry of Foreign Affair

    public $date_of_send_document;
    public $document_type_id;
    public $date_of_send_bio_scan;
    public $date_of_send_medical_checkup_sd;

    public $passport_photo_date;
    public $work_permit_date;
    public $name_list_date;
    public $date_of_employer;
    public $employer_name;
    public $employer_address;
    public $employer_address_2;
    public $employer_address_3;
    public $employer_address_4;
    public $employer_address_5;
    public $employer_nirc;
    public $employer_phone;
    public $employer_phone_2;

    public $date_of_visa_rd_confirm;
    public $date_of_visa_rd_receive;
    public $date_of_buy_air_ticket;
    public $date_of_fly;
    public $note;
    public $border_crossing_id = 1;

    public $is_cancel=0;
    public $canceled_date;
    public $cancel_type_id;
    public $canceled_reason;

    public $created_date;

    function gets(Register_model $register, $order="")
    {
        $sql = "SELECT @index := @index + 1 AS 'no', ".
            "TIMESTAMPDIFF(YEAR, rd.date_of_birth, now()) 'age', l.*, ".
            "r.*, rd.*, rt.register_type_name, ra.contact_name 'agency_name', ".
            "rc.contact_name 'recruiter_name', dt.document_type_name, st.service_type_name, pro.location_name 'province_name', ".
            "bc.border_crossing_name, ".
            "a_add.address 'agency_address' ".
            "FROM register r ".
            "JOIN (SELECT @index := 0) row ".
            "JOIN register_type rt on rt.register_type_id=r.worker_type_id ".
            "JOIN service_type st on st.service_type_id=r.service_type_id ".
            "JOIN contact rd on r.contact_id=rd.contact_id and rd.contact_type='Register' ".
            "JOIN contact rc on r.recruiter_id=rc.contact_id and rc.contact_type='Recruiter' ".
            "JOIN contact com on r.company_id=com.contact_id and com.contact_type='Company' ".
            "JOIN location l on r.to_country_id=l.location_id and l.location_type_id=1 ".
            "JOIN border_crossing bc on bc.border_crossing_id = r.border_crossing_id ".
            "LEFT JOIN contact ra on r.agency_id=ra.contact_id and ra.contact_type='Agency' ".
            "LEFT JOIN cancel_type ct on ct.cancel_type_id=r.cancel_type_id ".
            "LEFT JOIN document_type dt on dt.document_type_id=r.document_type_id ".
            "LEFT JOIN contact_address c_add on rd.contact_id=c_add.contact_id and c_add.address_key='contact' ".
            "LEFT JOIN location pro on pro.location_id=c_add.province_city_id and pro.location_type_id in(2,3) ".
            "LEFT JOIN contact_address a_add on r.agency_id=a_add.contact_id and a_add.address_key='contact' ".
            "WHERE (($register->all_date && ".
                    "('$register->date_of' !='date_of_fly' || r.date_of_fly is not null) && ".
                    "('$register->date_of' !='canceled_date' || r.is_cancel=1)  )".
                    "|| r.$register->date_of BETWEEN '$register->from_date 00:00:00' and '$register->to_date 23:59:59') ".
            "AND '$register->worker_type_id' in ('', 0, r.worker_type_id) ".
            "AND '$register->service_type_id' in ('', 0, r.service_type_id ) ".
            "AND '$register->agency_id' in ('', 0, r.agency_id) ".
            "AND '$register->company_id' in ('', 0, r.company_id) ".
            "AND '$register->to_country_id' in ('', 0, r.to_country_id) ".
            "AND '$register->agency_type_id' in ('', 0, ra.agency_type_id) ".
            "AND '$register->document_type_id' in ('', 0, r.document_type_id) ".
            "AND '$register->cancel_type_id' in ('', 0, r.cancel_type_id) ".
            "AND ('$register->contact_code'='' || ('$register->search_option'='exact' && rd.contact_code='$register->contact_code') || ('$register->search_option'='start_with' && rd.contact_code LIKE '$register->contact_code%' ESCAPE '!') || ('$register->search_option'='like' && rd.contact_code LIKE '%$register->contact_code%' ESCAPE '!')) ".
            "AND ('$register->worker_code'='' || ('$register->search_option'='exact' && r.worker_code='$register->worker_code') || ('$register->search_option'='start_with' && r.worker_code LIKE '$register->worker_code%' ESCAPE '!') || ('$register->search_option'='like' && r.worker_code LIKE '%$register->worker_code%' ESCAPE '!')) ".
            "AND ('$register->contact_name'='' || ('$register->search_option'='exact' && rd.contact_name='$register->contact_name') || ('$register->search_option'='start_with' && rd.contact_name LIKE '$register->contact_name%' ESCAPE '!') || ('$register->search_option'='like' && rd.contact_name LIKE '%$register->contact_name%' ESCAPE '!')) ".
            "AND ('$register->first_name'='' || ('$register->search_option'='exact' && rd.first_name='$register->first_name') || ('$register->search_option'='start_with' && rd.first_name LIKE '$register->first_name%' ESCAPE '!') || ('$register->search_option'='like' && rd.first_name LIKE '%$register->first_name%' ESCAPE '!')) ".
            "AND ('$register->last_name'='' || ('$register->search_option'='exact' && rd.last_name='$register->last_name') || ('$register->search_option'='start_with' && rd.last_name LIKE '$register->last_name%' ESCAPE '!') || ('$register->search_option'='like' && rd.last_name LIKE '%$register->last_name%' ESCAPE '!')) ".
            "AND ('$register->contact_name_kh'='' || ('$register->search_option'='exact' && rd.contact_name_kh='$register->contact_name_kh') || ('$register->search_option'='start_with' && rd.contact_name_kh LIKE '$register->contact_name_kh%' ESCAPE '!') || ('$register->search_option'='like' && rd.contact_name_kh LIKE '%$register->contact_name_kh%' ESCAPE '!')) ".
            "AND ('$register->first_name_kh'='' || ('$register->search_option'='exact' && rd.first_name_kh='$register->first_name_kh') || ('$register->search_option'='start_with' && rd.first_name_kh LIKE '$register->first_name_kh%' ESCAPE '!') || ('$register->search_option'='like' && rd.first_name_kh LIKE '%$register->first_name_kh%' ESCAPE '!')) ".
            "AND ('$register->last_name_kh'='' || ('$register->search_option'='exact' && rd.last_name_kh='$register->last_name_kh') || ('$register->search_option'='start_with' && rd.last_name_kh LIKE '$register->last_name_kh%' ESCAPE '!') || ('$register->search_option'='like' && rd.last_name_kh LIKE '%$register->last_name_kh%' ESCAPE '!')) ".
            "AND ('$register->id_card_no'='' || ('$register->search_option'='exact' && r.id_card_no='$register->id_card_no') || ('$register->search_option'='start_with' && r.id_card_no LIKE '$register->id_card_no%' ESCAPE '!') || ('$register->search_option'='like' && r.id_card_no LIKE '%$register->id_card_no%' ESCAPE '!')) ".
            "AND ('$register->passport_no'='' || ('$register->search_option'='exact' && r.passport_no='$register->passport_no') || ('$register->search_option'='start_with' && r.passport_no LIKE '$register->passport_no%' ESCAPE '!') || ('$register->search_option'='like' && r.passport_no LIKE '%$register->passport_no%' ESCAPE '!')) ".
            "AND ('$register->phone_number'='' || ('$register->search_option'='exact' && '$register->phone_number' in (rd.phone_number, rd.phone_number_2)) ".
                       "|| ('$register->search_option'='start_with' && (rd.phone_number LIKE '$register->phone_number%' ESCAPE '!' || rd.phone_number_2 LIKE '$register->phone_number%' ESCAPE '!')) ".
                       "|| ('$register->search_option'='like' && (rd.phone_number LIKE '%$register->phone_number%' ESCAPE '!' || rd.phone_number_2 LIKE '%$register->phone_number%' ESCAPE '!'))) ".
            $order
        ;

        $query = $this->db->query($sql);

        //echo $this->db->last_query();

        if(!$query || $query->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', null, $query->result('Register_model'));
        }

    }

    function get(Register_model $register)
    {
        $sql= "SELECT r.*, rd.*, rt.register_type_name, st.service_type_name, bc.border_crossing_name, ".
            "rc.contact_name 'recruiter_name', ra.contact_name 'agency_name', ".
            "com.contact_name 'company_name', l.location_name 'to_country_name', ".
            "ct.cancel_type_name, dt.document_type_name, n.nationality_name, rt.register_type_name ".
            "FROM register r ".
            "JOIN register_type rt on rt.register_type_id=r.worker_type_id ".
            "JOIN service_type st on st.service_type_id=r.service_type_id ".
            "JOIN contact rd on r.contact_id=rd.contact_id and rd.contact_type='Register' ".
            "JOIN contact rc on r.recruiter_id=rc.contact_id and rc.contact_type='Recruiter' ".
            "JOIN contact com on r.company_id=com.contact_id and com.contact_type='Company' ".
	        "JOIN location l on r.to_country_id=l.location_id and l.location_type_id=1 ".
            "JOIN nationality n on rd.nationality_id=n.nationality_id ".
            "JOIN border_crossing bc on bc.border_crossing_id = r.border_crossing_id ".
            "LEFT JOIN contact ra on r.agency_id=ra.contact_id and ra.contact_type='Agency' ".
            "LEFT JOIN cancel_type ct on ct.cancel_type_id=r.cancel_type_id ".
            "LEFT JOIN document_type dt on dt.document_type_id=r.document_type_id ".
            "Where r.worker_id='$register->worker_id' ";
        ;

        $result =$this->db->query($sql);

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Register_model'));
        }
    }

    function is_exist(Register_model $register)
    {
        $this->db->where('worker_id', $register->worker_id);

        $result =$this->db->get('register');

        return $result && $result->num_rows()> 0;
    }

    function is_exist_code(Register_model $register)
    {
        $this->db->where('worker_code', $register->worker_code);
        $this->db->where('worker_id !=', $register->worker_id);

        $result =$this->db->get('register');

        return $result && $result->num_rows()> 0;
    }

    function generate_code(Register_model &$model)
    {
        if(isset($model->worker_code) && $model->worker_code!='') return $model->worker_code;

        $model->prefix = isset($model->prefix)? $model->prefix:'REG';
        $prefix = strtoupper($model->prefix);
        $prefix .= Date('ym-');
        //$prefix = $prefix==""?"": $prefix."-";
        $digits = "0001";
        $code = $prefix.$digits;

        $sql = "select worker_code from register where worker_code LIKE '$prefix%' order by worker_code desc limit 1";

        $result = $this->db->query($sql);

        if($result && $result->num_rows()>0)
        {

            $number = (int) substr($result->first_row()->worker_code, strlen($prefix));
            $number ++;

            $code = $prefix.str_pad($number, strlen($digits) , "0", 0);
        }

        $model->worker_code = $code;

        return $model->worker_code;
    }

    function add(Register_model &$register)
    {
        //$this->generate_code($register);

        if(isset($register->worker_code) && $register->worker_code!='' && $this->is_exist_code($register))
        {
            return Message_result::error_message('Register code is exist. Add::'.$register->worker_id);
        }

        //for mysqli driver
        if(isset($register->worker_id)) unset($register->worker_id);
        if($register->created_date=='') $register->created_date = Date('Y-m-d H:i:s', time());

        if($register->agency_id=='') $register->agency_id = null;
        if($register->passport_issue_date=='') $register->passport_issue_date = null;
        if($register->passport_expired_date=='') $register->passport_expired_date = null;
        if($register->date_of_receive_passport=='') $register->date_of_receive_passport = null;
        if($register->date_of_send_ppc_sd=='') $register->date_of_send_ppc_sd = null;
        if($register->date_of_mofa=='') $register->date_of_mofa = null;
        if($register->date_of_send_document=='') $register->date_of_send_document = null;
        if($register->document_type_id=='') $register->document_type_id =  null;
        if($register->date_of_send_bio_scan=='') $register->date_of_send_bio_scan = null;
        if($register->date_of_send_medical_checkup_sd=='') $register->date_of_send_medical_checkup_sd = null;
        if($register->date_of_employer=='') $register->date_of_employer = null;
        if($register->date_of_visa_rd_confirm=='') $register->date_of_visa_rd_confirm = null;
        if($register->date_of_visa_rd_receive=='') $register->date_of_visa_rd_receive = null;
        if($register->date_of_buy_air_ticket=='')   $register->date_of_buy_air_ticket = null;
        if($register->date_of_fly=='')  $register->date_of_fly = null;
        if($register->canceled_date=='')  $register->canceled_date = null;
        if($register->cancel_type_id=='')  $register->cancel_type_id = null;
        if($register->id_card_issue_date=='') $register->id_card_issue_date = null;
        if($register->id_card_expired_date=='') $register->id_card_expired_date = null;
        if($register->passport_photo_date=='') $register->passport_photo_date = null;
        if($register->work_permit_date=='') $register->work_permit_date = null;
        if($register->name_list_date=='') $register->name_list_date = null;

        try{
            $result=$this->db->insert('register', $register);
        }catch (Exception $ex){
            return Message_result::error_message('Cannot add');
        }

        if(!$result )
        {
            return Message_result::error_message('Cannot add');
        }
        else
        {
            $register->worker_id = $this->db->insert_id();
            return Message_result::success_message('Add success', $register);
        }

    }

    function update(Register_model $register)
    {
        //$this->generate_code($register);

        if(isset($register->worker_code) && $register->worker_code!='' && $this->is_exist_code($register))
        {
            return Message_result::error_message('Register code is exist. Update::'. $register->worker_id);
        }

        if($register->created_date=='') $register->created_date = Date('Y-m-d H:i:s', time());

        if($register->agency_id=='') $register->agency_id = null;
        if($register->passport_issue_date=='') $register->passport_issue_date = null;
        if($register->passport_expired_date=='') $register->passport_expired_date = null;
        if($register->date_of_receive_passport=='') $register->date_of_receive_passport = null;
        if($register->date_of_send_ppc_sd=='') $register->date_of_send_ppc_sd = null;
        if($register->date_of_mofa=='') $register->date_of_mofa = null;
        if($register->date_of_send_document=='') $register->date_of_send_document = null;
        if($register->document_type_id=='') $register->document_type_id =  null;
        if($register->date_of_send_bio_scan=='') $register->date_of_send_bio_scan = null;
        if($register->date_of_send_medical_checkup_sd=='') $register->date_of_send_medical_checkup_sd = null;
        if($register->date_of_employer=='') $register->date_of_employer = null;
        if($register->date_of_visa_rd_confirm=='') $register->date_of_visa_rd_confirm = null;
        if($register->date_of_visa_rd_receive=='') $register->date_of_visa_rd_receive = null;
        if($register->date_of_buy_air_ticket=='')   $register->date_of_buy_air_ticket = null;
        if($register->date_of_fly=='')  $register->date_of_fly = null;
        if($register->canceled_date=='')  $register->canceled_date = null;
        if($register->cancel_type_id=='')  $register->cancel_type_id = null;
        if($register->id_card_issue_date=='') $register->id_card_issue_date = null;
        if($register->id_card_expired_date=='') $register->id_card_expired_date = null;
        if($register->passport_photo_date=='') $register->passport_photo_date = null;
        if($register->work_permit_date=='') $register->work_permit_date = null;
        if($register->name_list_date=='') $register->name_list_date = null;

        $this->db->where('worker_id', $register->worker_id);

        try{
            $result = $this->db->update('register', $register);
        }catch (Exception $ex){
            return Message_result::error_message('Cannot update');
        }

        if(!$result )
        {
            return Message_result::error_message('Cannot update');
        }
        else
        {
            return Message_result::success_message('Update success', $register);
        }
    }

    function delete(Register_model $register)
    {
        //$result = $this->get($register);
        //if(!$result->success || $result->model->is_deletable==0) return Message_result::error_message('Register cannot be delete');

        $this->db->where('worker_id', $register->worker_id);

        $result=$this->db->delete('register');

        if(!$result )
        {
            return Message_result::error_message('Cannot delete');
        }
        else
        {
            return Message_result::success_message('Delete success',$register);
        }
    }

    function get_combobox_items(Register_model $model)
    {
        $sql = "select worker_id as 'id', worker_code as 'text' from register where worker_code like'%$model->worker_code%'";
        $query = $this->db->query($sql);

        if(!$query || $query->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', null, $query->result());
        }
    }


}
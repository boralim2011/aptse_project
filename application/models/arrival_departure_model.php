<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Arrival_departure_model extends Model_base
{

    function __construct()
    {
        parent::__construct();

        if(!isset($this->arrival_departure_date)) $this->arrival_departure_date= Date("Y-m-d");
        if(!isset($this->created_date)) $this->created_date= Date("Y-m-d H:i:s");
        if(!isset($this->modified_date)) $this->modified_date = Date("Y-m-d H:i:s");
    }

    public $arrival_departure_id = 0;
    public $document_ref = '';
    public $arrival_departure_date;
    public $register_id;
    public $travel_method;
    public $from_location_id;
    public $to_location_id;
    public $visa_issue_location_id;
    public $travel_purpose;
    public $length_of_stay;
    public $from_address;
    public $to_address;
    public $created_by;
    public $created_date;
    public $modified_by;
    public $modified_date;
    public $is_deletable = 1;
    public $visa_no;

    function gets(Arrival_departure_model $model)
    {
        $sql = "SELECT @index := @index + 1 AS 'no', ".
            "TIMESTAMPDIFF(YEAR, rd.date_of_birth, now()) 'age', l.*, ad.*, ".
            "r.*, rd.*, rt.register_type_name, ra.contact_name 'agency_name', ".
            "rc.contact_name 'recruiter_name', dt.document_type_name, st.service_type_name, pro.location_name 'province_name', ".
            "bc.border_crossing_name, ".
            "a_add.address 'agency_address' ".
            "FROM register r ".
            "JOIN (SELECT @index := 0) row ".
            "JOIN arrival_departure ad on ad.register_id=r.worker_id ".
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
            "WHERE ($model->all_date || ad.arrival_departure_date BETWEEN '$model->from_date 00:00:00' and '$model->to_date 23:59:59') ".
            "AND '$model->worker_type_id' in ('', 0, r.worker_type_id) ".
            "AND '$model->service_type_id' in ('', 0, r.service_type_id ) ".
            "AND '$model->agency_id' in ('', 0, r.agency_id) ".
            "AND '$model->company_id' in ('', 0, r.company_id) ".
            "AND '$model->to_country_id' in ('', 0, r.to_country_id) ".
            "AND '$model->agency_type_id' in ('', 0, ra.agency_type_id) ".
            "AND '$model->document_type_id' in ('', 0, r.document_type_id) ".
            "AND '$model->cancel_type_id' in ('', 0, r.cancel_type_id) ".
            "AND ('$model->contact_code'='' || ('$model->search_option'='exact' && rd.contact_code='$model->contact_code') || ('$model->search_option'='start_with' && rd.contact_code LIKE '$model->contact_code%' ESCAPE '!') || ('$model->search_option'='like' && rd.contact_code LIKE '%$model->contact_code%' ESCAPE '!')) ".
            "AND ('$model->worker_code'='' || ('$model->search_option'='exact' && r.worker_code='$model->worker_code') || ('$model->search_option'='start_with' && r.worker_code LIKE '$model->worker_code%' ESCAPE '!') || ('$model->search_option'='like' && r.worker_code LIKE '%$model->worker_code%' ESCAPE '!')) ".
            "AND ('$model->contact_name'='' || ('$model->search_option'='exact' && rd.contact_name='$model->contact_name') || ('$model->search_option'='start_with' && rd.contact_name LIKE '$model->contact_name%' ESCAPE '!') || ('$model->search_option'='like' && rd.contact_name LIKE '%$model->contact_name%' ESCAPE '!')) ".
            "AND ('$model->first_name'='' || ('$model->search_option'='exact' && rd.first_name='$model->first_name') || ('$model->search_option'='start_with' && rd.first_name LIKE '$model->first_name%' ESCAPE '!') || ('$model->search_option'='like' && rd.first_name LIKE '%$model->first_name%' ESCAPE '!')) ".
            "AND ('$model->last_name'='' || ('$model->search_option'='exact' && rd.last_name='$model->last_name') || ('$model->search_option'='start_with' && rd.last_name LIKE '$model->last_name%' ESCAPE '!') || ('$model->search_option'='like' && rd.last_name LIKE '%$model->last_name%' ESCAPE '!')) ".
            "AND ('$model->contact_name_kh'='' || ('$model->search_option'='exact' && rd.contact_name_kh='$model->contact_name_kh') || ('$model->search_option'='start_with' && rd.contact_name_kh LIKE '$model->contact_name_kh%' ESCAPE '!') || ('$model->search_option'='like' && rd.contact_name_kh LIKE '%$model->contact_name_kh%' ESCAPE '!')) ".
            "AND ('$model->first_name_kh'='' || ('$model->search_option'='exact' && rd.first_name_kh='$model->first_name_kh') || ('$model->search_option'='start_with' && rd.first_name_kh LIKE '$model->first_name_kh%' ESCAPE '!') || ('$model->search_option'='like' && rd.first_name_kh LIKE '%$model->first_name_kh%' ESCAPE '!')) ".
            "AND ('$model->last_name_kh'='' || ('$model->search_option'='exact' && rd.last_name_kh='$model->last_name_kh') || ('$model->search_option'='start_with' && rd.last_name_kh LIKE '$model->last_name_kh%' ESCAPE '!') || ('$model->search_option'='like' && rd.last_name_kh LIKE '%$model->last_name_kh%' ESCAPE '!')) ".
            "AND ('$model->id_card_no'='' || ('$model->search_option'='exact' && r.id_card_no='$model->id_card_no') || ('$model->search_option'='start_with' && r.id_card_no LIKE '$model->id_card_no%' ESCAPE '!') || ('$model->search_option'='like' && r.id_card_no LIKE '%$model->id_card_no%' ESCAPE '!')) ".
            "AND ('$model->passport_no'='' || ('$model->search_option'='exact' && r.passport_no='$model->passport_no') || ('$model->search_option'='start_with' && r.passport_no LIKE '$model->passport_no%' ESCAPE '!') || ('$model->search_option'='like' && r.passport_no LIKE '%$model->passport_no%' ESCAPE '!')) ".
            "AND ('$model->phone_number'='' || ('$model->search_option'='exact' && '$model->phone_number' in (rd.phone_number, rd.phone_number_2)) ".
            "|| ('$model->search_option'='start_with' && (rd.phone_number LIKE '$model->phone_number%' ESCAPE '!' || rd.phone_number_2 LIKE '$model->phone_number%' ESCAPE '!')) ".
            "|| ('$model->search_option'='like' && (rd.phone_number LIKE '%$model->phone_number%' ESCAPE '!' || rd.phone_number_2 LIKE '%$model->phone_number%' ESCAPE '!'))) ".
            "order by ad.arrival_departure_date"
        ;

        $query = $this->db->query($sql);

        //echo $this->db->last_query(); exit;

        if(!$query || $query->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', null, $query->result('Register_model'));
        }
    }

    function get(Arrival_departure_model $model)
    {
        $sql= "select ad.*, r.*, con.*, n.nationality_name, fl.location_name 'from_location_name', con_l.location_name 'address', ".
            "tl.location_name 'to_location_name', vl.location_name 'visa_issue_location_name', rgt.register_type_name, ".
            "com.contact_name 'company_name', com_add.address 'company_address', com.phone_number 'company_phone', ".
            "agc.contact_name 'agency_name', agc_add.address 'agency_address', agc.phone_number 'agency_phone' ".
            "From arrival_departure ad ".
            "JOIN register r on r.worker_id=ad.register_id ".
            "JOIN contact con on con.contact_id=r.contact_id ".
            "JOIN contact com on com.contact_id=r.company_id ".
            "JOIN contact agc on agc.contact_id=r.agency_id ".
            "JOIN nationality n on n.nationality_id=con.nationality_id ".
            "JOIN location fl on fl.location_id=ad.from_location_id ".
            "JOIN location tl on tl.location_id=ad.to_location_id ".
            "JOIN location vl on vl.location_id=ad.visa_issue_location_id ".
            "JOIN register_type rgt on rgt.register_type_id=r.worker_type_id ".
            "Left Join contact_address com_add on com_add.contact_id = com.contact_id ".
            "Left Join contact_address agc_add on agc_add.contact_id = agc.contact_id ".
            "Left Join contact_address con_add on con_add.contact_id = con.contact_id and con_add.address_key='contact' ".
            "left Join location con_l on con_l.location_id=con_add.province_city_id ".
            "Where ad.arrival_departure_id='$model->arrival_departure_id' ";
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


    function is_exist(Arrival_departure_model $arrival_departure)
    {
        $this->db->where('arrival_departure_id', $arrival_departure->arrival_departure_id);

        $result =$this->db->get('arrival_departure');

        return $result && $result->num_rows()> 0;
    }

    function add(Arrival_departure_model &$model)
    {

        //for mysqli driver
        unset($model->arrival_departure_id);

        $result=$this->db->insert('arrival_departure', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot add');
        }
        else
        {
            $model->arrival_departure_id = $this->db->insert_id();
            return Message_result::success_message('Add success', $model);
        }

    }

    function update(Arrival_departure_model $model)
    {

        $this->db->where('arrival_departure_id', $model->arrival_departure_id);

        unset($model->created_by);
        unset($model->created_date);

        $result = $this->db->update('arrival_departure', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot update');
        }
        else
        {
            return Message_result::success_message('Update success', $model);
        }
    }

    function delete(Arrival_departure_model $model)
    {
        $result = $this->get($model);
        if(!$result->success || $result->model->is_deletable==0) return Message_result::error_message('Arrival departure cannot be delete');

        $this->db->where('arrival_departure_id', $model->arrival_departure_id);

        $result=$this->db->delete('arrival_departure');

        if(!$result )
        {
            return Message_result::error_message('Cannot delete');
        }
        else
        {
            return Message_result::success_message('Delete success',$model);
        }
    }


}
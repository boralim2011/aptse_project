<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Agency_type_model extends Model_base
{

    function __construct()
    {
        parent::__construct();
    }

    public $agency_type_id = 0;
    public $agency_type_name = '';
    public $agency_type_name_kh = '';
    public $is_deletable = 1;

    function gets(Agency_type_model $model)
    {
        $this->db->select("*");
        $this->db->like("agency_type_name", "$model->agency_type_name");
        $query = $this->db->get('agency_type');

        if(!$query || $query->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', null, $query->result('Agency_type_model'));
        }
    }

    function get(Agency_type_model $model)
    {
        $this->db->where('agency_type_id', $model->agency_type_id);

        $result =$this->db->get('agency_type');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Agency_type_model'));
        }
    }

    function get_by_name(Agency_type_model $model)
    {
        $this->db->where('agency_type_name', $model->agency_type_name);

        $result =$this->db->get('agency_type');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Agency_type_model'));
        }
    }

    function is_exist(Agency_type_model $agency_type)
    {
        $this->db->where('agency_type_id', $agency_type->agency_type_id);

        $result =$this->db->get('agency_type');

        return $result && $result->num_rows()> 0;
    }

    function is_exist_name(Agency_type_model $agency_type)
    {
        $this->db->where('agency_type_name', $agency_type->agency_type_name);
        $this->db->where('agency_type_id !=', $agency_type->agency_type_id);

        $result =$this->db->get('agency_type');

        return $result && $result->num_rows()> 0;
    }

    function add(Agency_type_model &$model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Agency_type name is exist');
        }

        //for mysqli driver
        unset($model->agency_type_id);

        $result=$this->db->insert('agency_type', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot add');
        }
        else
        {
            $model->agency_type_id = $this->db->insert_id();
            return Message_result::success_message('Add success', $model);
        }

    }

    function update(Agency_type_model $model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Agency_type name is exist');
        }

        $this->db->where('agency_type_id', $model->agency_type_id);

        $result = $this->db->update('agency_type', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot update');
        }
        else
        {
            return Message_result::success_message('Update success', $model);
        }
    }

    function delete(Agency_type_model $model)
    {
        $result = $this->get($model);
        if(!$result->success || $result->model->is_deletable==0) return Message_result::error_message('Agency_type cannot be delete');

        $this->db->where('agency_type_id', $model->agency_type_id);

        $result=$this->db->delete('agency_type');

        if(!$result )
        {
            return Message_result::error_message('Cannot delete');
        }
        else
        {
            return Message_result::success_message('Delete success',$model);
        }
    }

    function get_combobox_items(Agency_type_model $model)
    {
        $sql = "select agency_type_id as 'id', agency_type_name as 'text' from agency_type where agency_type_name like'%$model->agency_type_name%'";
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
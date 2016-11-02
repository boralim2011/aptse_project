<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Cancel_type_model extends Model_base
{

    function __construct()
    {
        parent::__construct();
    }

    public $cancel_type_id = 0;
    public $cancel_type_name = '';
    public $is_deletable = 1;

    function gets(Cancel_type_model $model)
    {
        $this->db->select("cancel_type.*");
        $this->db->like("cancel_type_name", "$model->cancel_type_name");
        $query = $this->db->get('cancel_type');

        if(!$query || $query->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', null, $query->result('Cancel_type_model'));
        }
    }

    function get(Cancel_type_model $model)
    {
        $this->db->where('cancel_type_id', $model->cancel_type_id);

        $result =$this->db->get('cancel_type');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Cancel_type_model'));
        }
    }

    function get_by_name(Cancel_type_model $model)
    {
        $this->db->where('cancel_type_name', $model->cancel_type_name);

        $result =$this->db->get('cancel_type');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Cancel_type_model'));
        }
    }

    function is_exist(Cancel_type_model $cancel_type)
    {
        $this->db->where('cancel_type_id', $cancel_type->cancel_type_id);

        $result =$this->db->get('cancel_type');

        return $result && $result->num_rows()> 0;
    }

    function is_exist_name(Cancel_type_model $cancel_type)
    {
        $this->db->where('cancel_type_name', $cancel_type->cancel_type_name);
        $this->db->where('cancel_type_id !=', $cancel_type->cancel_type_id);

        $result =$this->db->get('cancel_type');

        return $result && $result->num_rows()> 0;
    }

    function add(Cancel_type_model &$model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Cancel type name is exist');
        }

        //for mysqli driver
        unset($model->cancel_type_id);

        $result=$this->db->insert('cancel_type', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot add');
        }
        else
        {
            $model->cancel_type_id = $this->db->insert_id();
            return Message_result::success_message('Add success', $model);
        }

    }

    function update(Cancel_type_model $model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Cancel type name is exist');
        }

        $this->db->where('cancel_type_id', $model->cancel_type_id);

        $result = $this->db->update('cancel_type', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot update');
        }
        else
        {
            return Message_result::success_message('Update success', $model);
        }
    }

    function delete(Cancel_type_model $model)
    {
        $result = $this->get($model);
        if(!$result->success || $result->model->is_deletable==0) return Message_result::error_message('Cancel type cannot be delete');

        $this->db->where('cancel_type_id', $model->cancel_type_id);

        $result=$this->db->delete('cancel_type');

        if(!$result )
        {
            return Message_result::error_message('Cannot delete');
        }
        else
        {
            return Message_result::success_message('Delete success',$model);
        }
    }

    function get_combobox_items(Cancel_type_model $model)
    {
        $sql = "select cancel_type_id as 'id', cancel_type_name as 'text' from cancel_type where cancel_type_name like'%$model->cancel_type_name%'";
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
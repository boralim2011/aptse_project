<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Register_type_model extends Model_base
{

    function __construct()
    {
        parent::__construct();
    }

    public $register_type_id = 0;
    public $register_type_name = '';
    public $is_deletable = 1;

    function gets(Register_type_model $model)
    {
        $this->db->select("register_type.*");
        $this->db->like("register_type_name", "$model->register_type_name");
        $query = $this->db->get('register_type');

        if(!$query || $query->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', null, $query->result('Register_type_model'));
        }
    }

    function get(Register_type_model $model)
    {
        $this->db->where('register_type_id', $model->register_type_id);

        $result =$this->db->get('register_type');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Register_type_model'));
        }
    }

    function get_by_name(Register_type_model $model)
    {
        $this->db->where('register_type_name', $model->register_type_name);

        $result =$this->db->get('register_type');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Register_type_model'));
        }
    }

    function is_exist(Register_type_model $register_type)
    {
        $this->db->where('register_type_id', $register_type->register_type_id);

        $result =$this->db->get('register_type');

        return $result && $result->num_rows()> 0;
    }

    function is_exist_name(Register_type_model $register_type)
    {
        $this->db->where('register_type_name', $register_type->register_type_name);
        $this->db->where('register_type_id !=', $register_type->register_type_id);

        $result =$this->db->get('register_type');

        return $result && $result->num_rows()> 0;
    }

    function add(Register_type_model &$model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Register type name is exist');
        }

        //for mysqli driver
        unset($model->register_type_id);

        $result=$this->db->insert('register_type', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot add');
        }
        else
        {
            $model->register_type_id = $this->db->insert_id();
            return Message_result::success_message('Add success', $model);
        }

    }

    function update(Register_type_model $model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Register type name is exist');
        }

        $this->db->where('register_type_id', $model->register_type_id);

        $result = $this->db->update('register_type', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot update');
        }
        else
        {
            return Message_result::success_message('Update success', $model);
        }
    }

    function delete(Register_type_model $model)
    {
        $result = $this->get($model);
        if(!$result->success || $result->model->is_deletable==0) return Message_result::error_message('Register type cannot be delete');

        $this->db->where('register_type_id', $model->register_type_id);

        $result=$this->db->delete('register_type');

        if(!$result )
        {
            return Message_result::error_message('Cannot delete');
        }
        else
        {
            return Message_result::success_message('Delete success',$model);
        }
    }

    function get_combobox_items(Register_type_model $model)
    {
        $sql = "select register_type_id as 'id', register_type_name as 'text' from register_type where register_type_name like'%$model->register_type_name%'";
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
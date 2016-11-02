<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Nationality_model extends Model_base
{

    function __construct()
    {
        parent::__construct();
    }

    public $nationality_id = 0;
    public $nationality_name = '';
    public $nationality_name_kh = '';
    public $is_deletable = 1;

    function gets(Nationality_model $model)
    {
        $this->db->select("*");
        $this->db->like("nationality_name", "$model->nationality_name");
        $query = $this->db->get('nationality');

        if(!$query || $query->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', null, $query->result('Nationality_model'));
        }
    }

    function get(Nationality_model $model)
    {
        $this->db->where('nationality_id', $model->nationality_id);

        $result =$this->db->get('nationality');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Nationality_model'));
        }
    }

    function get_by_name(Nationality_model $model)
    {
        $this->db->where('nationality_name', $model->nationality_name);

        $result =$this->db->get('nationality');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Nationality_model'));
        }
    }

    function is_exist(Nationality_model $nationality)
    {
        $this->db->where('nationality_id', $nationality->nationality_id);

        $result =$this->db->get('nationality');

        return $result && $result->num_rows()> 0;
    }

    function is_exist_name(Nationality_model $nationality)
    {
        $this->db->where('nationality_name', $nationality->nationality_name);
        $this->db->where('nationality_id !=', $nationality->nationality_id);

        $result =$this->db->get('nationality');

        return $result && $result->num_rows()> 0;
    }

    function add(Nationality_model &$model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Nationality name is exist');
        }

        //for mysqli driver
        unset($model->nationality_id);

        $result=$this->db->insert('nationality', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot add');
        }
        else
        {
            $model->nationality_id = $this->db->insert_id();
            return Message_result::success_message('Add success', $model);
        }

    }

    function update(Nationality_model $model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Nationality name is exist');
        }

        $this->db->where('nationality_id', $model->nationality_id);

        $result = $this->db->update('nationality', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot update');
        }
        else
        {
            return Message_result::success_message('Update success', $model);
        }
    }

    function delete(Nationality_model $model)
    {
        $result = $this->get($model);
        if(!$result->success || $result->model->is_deletable==0) return Message_result::error_message('Nationality cannot be delete');

        $this->db->where('nationality_id', $model->nationality_id);

        $result=$this->db->delete('nationality');

        if(!$result )
        {
            return Message_result::error_message('Cannot delete');
        }
        else
        {
            return Message_result::success_message('Delete success',$model);
        }
    }

    function get_combobox_items(Nationality_model $model)
    {
        $sql = "select nationality_id as 'id', nationality_name as 'text' from nationality where nationality_name like'%$model->nationality_name%'";
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
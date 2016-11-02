<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Border_crossing_model extends Model_base
{

    function __construct()
    {
        parent::__construct();
    }

    public $border_crossing_id = 0;
    public $border_crossing_name = '';
    public $border_crossing_name_kh = '';
    public $is_deletable = 1;

    function gets(Border_crossing_model $model)
    {
        $this->db->select("border_crossing.*");
        $this->db->like("border_crossing_name", "$model->border_crossing_name");
        $query = $this->db->get('border_crossing');

        if(!$query || $query->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', null, $query->result('Border_crossing_model'));
        }
    }

    function get(Border_crossing_model $model)
    {
        $this->db->where('border_crossing_id', $model->border_crossing_id);

        $result =$this->db->get('border_crossing');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Border_crossing_model'));
        }
    }

    function get_by_name(Border_crossing_model $model)
    {
        $this->db->where('border_crossing_name', $model->border_crossing_name);

        $result =$this->db->get('border_crossing');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Border_crossing_model'));
        }
    }

    function is_exist(Border_crossing_model $border_crossing)
    {
        $this->db->where('border_crossing_id', $border_crossing->border_crossing_id);

        $result =$this->db->get('border_crossing');

        return $result && $result->num_rows()> 0;
    }

    function is_exist_name(Border_crossing_model $border_crossing)
    {
        $this->db->where('border_crossing_name', $border_crossing->border_crossing_name);
        $this->db->where('border_crossing_id !=', $border_crossing->border_crossing_id);

        $result =$this->db->get('border_crossing');

        return $result && $result->num_rows()> 0;
    }

    function add(Border_crossing_model &$model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Border crossing name is exist');
        }

        //for mysqli driver
        unset($model->border_crossing_id);

        $result=$this->db->insert('border_crossing', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot add');
        }
        else
        {
            $model->border_crossing_id = $this->db->insert_id();
            return Message_result::success_message('Add success', $model);
        }

    }

    function update(Border_crossing_model $model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Border crossing name is exist');
        }

        $this->db->where('border_crossing_id', $model->border_crossing_id);

        $result = $this->db->update('border_crossing', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot update');
        }
        else
        {
            return Message_result::success_message('Update success', $model);
        }
    }

    function delete(Border_crossing_model $model)
    {
        $result = $this->get($model);
        if(!$result->success || $result->model->is_deletable==0) return Message_result::error_message('Border crossing cannot be delete');

        $this->db->where('border_crossing_id', $model->border_crossing_id);

        $result=$this->db->delete('border_crossing');

        if(!$result )
        {
            return Message_result::error_message('Cannot delete');
        }
        else
        {
            return Message_result::success_message('Delete success',$model);
        }
    }

    function get_combobox_items(Border_crossing_model $model)
    {
        $sql = "select border_crossing_id as 'id', border_crossing_name as 'text' from border_crossing where border_crossing_name like'%$model->border_crossing_name%'";
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Border_crossings_model extends Model_base
{

    function __construct()
    {
        parent::__construct();
    }

    public $border_crossings_id = 0;
    public $border_crossings_name = '';
    public $border_crossings_name_kh = '';
    public $is_deletable = 1;

    function gets(Border_crossings_model $model)
    {
        $this->db->select("border_crossings.*");
        $this->db->like("border_crossings_name", "$model->border_crossings_name");
        $query = $this->db->get('border_crossings');

        if(!$query || $query->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', null, $query->result('Border_crossings_model'));
        }
    }

    function get(Border_crossings_model $model)
    {
        $this->db->where('border_crossings_id', $model->border_crossings_id);

        $result =$this->db->get('border_crossings');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Border_crossings_model'));
        }
    }

    function get_by_name(Border_crossings_model $model)
    {
        $this->db->where('border_crossings_name', $model->border_crossings_name);

        $result =$this->db->get('border_crossings');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Border_crossings_model'));
        }
    }

    function is_exist(Border_crossings_model $border_crossings)
    {
        $this->db->where('border_crossings_id', $border_crossings->border_crossings_id);

        $result =$this->db->get('border_crossings');

        return $result && $result->num_rows()> 0;
    }

    function is_exist_name(Border_crossings_model $border_crossings)
    {
        $this->db->where('border_crossings_name', $border_crossings->border_crossings_name);
        $this->db->where('border_crossings_id !=', $border_crossings->border_crossings_id);

        $result =$this->db->get('border_crossings');

        return $result && $result->num_rows()> 0;
    }

    function add(Border_crossings_model &$model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Border crossing name is exist');
        }

        //for mysqli driver
        unset($model->border_crossings_id);

        $result=$this->db->insert('border_crossings', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot add');
        }
        else
        {
            $model->border_crossings_id = $this->db->insert_id();
            return Message_result::success_message('Add success', $model);
        }

    }

    function update(Border_crossings_model $model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Border crossing name is exist');
        }

        $this->db->where('border_crossings_id', $model->border_crossings_id);

        $result = $this->db->update('border_crossings', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot update');
        }
        else
        {
            return Message_result::success_message('Update success', $model);
        }
    }

    function delete(Border_crossings_model $model)
    {
        $result = $this->get($model);
        if(!$result->success || $result->model->is_deletable==0) return Message_result::error_message('Border crossing cannot be delete');

        $this->db->where('border_crossings_id', $model->border_crossings_id);

        $result=$this->db->delete('border_crossings');

        if(!$result )
        {
            return Message_result::error_message('Cannot delete');
        }
        else
        {
            return Message_result::success_message('Delete success',$model);
        }
    }

    function get_combobox_items(Border_crossings_model $model)
    {
        $sql = "select border_crossings_id as 'id', border_crossings_name as 'text' from border_crossings where border_crossings_name like'%$model->border_crossings_name%'";
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
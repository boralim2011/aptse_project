<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Service_type_model extends Model_base
{

    function __construct()
    {
        parent::__construct();
    }

    public $service_type_id = 0;
    public $service_type_name = '';
    public $service_type_code = '';
    public $is_deletable = 1;

    function gets(Service_type_model $model)
    {
        $this->db->select("service_type.*");
        $this->db->like("service_type_name", "$model->service_type_name");
        $query = $this->db->get('service_type');

        if(!$query || $query->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', null, $query->result('Service_type_model'));
        }
    }

    function get(Service_type_model $model)
    {
        $this->db->where('service_type_id', $model->service_type_id);

        $result =$this->db->get('service_type');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Service_type_model'));
        }
    }

    function get_by_name(Service_type_model $model)
    {
        $this->db->where('service_type_name', $model->service_type_name);

        $result =$this->db->get('service_type');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Service_type_model'));
        }
    }

    function is_exist(Service_type_model $service_type)
    {
        $this->db->where('service_type_id', $service_type->service_type_id);

        $result =$this->db->get('service_type');

        return $result && $result->num_rows()> 0;
    }

    function is_exist_name(Service_type_model $service_type)
    {
        $this->db->where('service_type_name', $service_type->service_type_name);
        $this->db->where('service_type_id !=', $service_type->service_type_id);

        $result =$this->db->get('service_type');

        return $result && $result->num_rows()> 0;
    }

    function is_exist_code(Service_type_model $service_type)
    {
        $this->db->where('service_type_code', $service_type->service_type_code);
        $this->db->where('service_type_id !=', $service_type->service_type_id);

        $result =$this->db->get('service_type');

        return $result && $result->num_rows()> 0;
    }

    function add(Service_type_model &$model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Service type name is exist');
        }

        if($this->is_exist_code($model))
        {
            return Message_result::error_message('Service type code is exist');
        }

        //for mysqli driver
        unset($model->service_type_id);

        $result=$this->db->insert('service_type', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot add');
        }
        else
        {
            $model->service_type_id = $this->db->insert_id();
            return Message_result::success_message('Add success', $model);
        }

    }

    function update(Service_type_model $model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Service type name is exist');
        }

        if($this->is_exist_code($model))
        {
            return Message_result::error_message('Service type code is exist');
        }

        $this->db->where('service_type_id', $model->service_type_id);

        $result = $this->db->update('service_type', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot update');
        }
        else
        {
            return Message_result::success_message('Update success', $model);
        }
    }

    function delete(Service_type_model $model)
    {
        $result = $this->get($model);
        if(!$result->success || $result->model->is_deletable==0) return Message_result::error_message('Service type cannot be delete');

        $this->db->where('service_type_id', $model->service_type_id);

        $result=$this->db->delete('service_type');

        if(!$result )
        {
            return Message_result::error_message('Cannot delete');
        }
        else
        {
            return Message_result::success_message('Delete success',$model);
        }
    }

    function get_combobox_items(Service_type_model $model)
    {
        $sql = "select service_type_id as 'id', service_type_name as 'text' from service_type where service_type_name like'%$model->service_type_name%'";
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
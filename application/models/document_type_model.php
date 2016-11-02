<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Document_type_model extends Model_base
{

    function __construct()
    {
        parent::__construct();
    }

    public $document_type_id = 0;
    public $document_type_name = '';
    public $is_deletable = 1;

    function gets(Document_type_model $model)
    {
        $this->db->select("document_type.*");
        $this->db->like("document_type_name", "$model->document_type_name");
        $query = $this->db->get('document_type');

        if(!$query || $query->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', null, $query->result('Document_type_model'));
        }
    }

    function get(Document_type_model $model)
    {
        $this->db->where('document_type_id', $model->document_type_id);

        $result =$this->db->get('document_type');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Document_type_model'));
        }
    }

    function get_by_name(Document_type_model $model)
    {
        $this->db->where('document_type_name', $model->document_type_name);

        $result =$this->db->get('document_type');

        if(!$result || $result->num_rows()== 0)
        {
            return Message_result::error_message('Search not found');
        }
        else
        {
            return Message_result::success_message('', $result->first_row('Document_type_model'));
        }
    }

    function is_exist(Document_type_model $document_type)
    {
        $this->db->where('document_type_id', $document_type->document_type_id);

        $result =$this->db->get('document_type');

        return $result && $result->num_rows()> 0;
    }

    function is_exist_name(Document_type_model $document_type)
    {
        $this->db->where('document_type_name', $document_type->document_type_name);
        $this->db->where('document_type_id !=', $document_type->document_type_id);

        $result =$this->db->get('document_type');

        return $result && $result->num_rows()> 0;
    }

    function add(Document_type_model &$model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Document type name is exist');
        }

        //for mysqli driver
        unset($model->document_type_id);

        $result=$this->db->insert('document_type', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot add');
        }
        else
        {
            $model->document_type_id = $this->db->insert_id();
            return Message_result::success_message('Add success', $model);
        }

    }

    function update(Document_type_model $model)
    {
        if($this->is_exist_name($model))
        {
            return Message_result::error_message('Document type name is exist');
        }

        $this->db->where('document_type_id', $model->document_type_id);

        $result = $this->db->update('document_type', $model);

        if(!$result )
        {
            return Message_result::error_message('Cannot update');
        }
        else
        {
            return Message_result::success_message('Update success', $model);
        }
    }

    function delete(Document_type_model $model)
    {
        $result = $this->get($model);
        if(!$result->success || $result->model->is_deletable==0) return Message_result::error_message('Document type cannot be delete');

        $this->db->where('document_type_id', $model->document_type_id);

        $result=$this->db->delete('document_type');

        if(!$result )
        {
            return Message_result::error_message('Cannot delete');
        }
        else
        {
            return Message_result::success_message('Delete success',$model);
        }
    }

    function get_combobox_items(Document_type_model $model)
    {
        $sql = "select document_type_id as 'id', document_type_name as 'text' from document_type where document_type_name like'%$model->document_type_name%'";
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
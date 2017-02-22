<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Bora
 * Date: 12/17/2015
 * Time: 5:34 AM
 */

class Model_base extends CI_Model
{

    function __construct()
    {
        parent::__construct();

    }

    static function map_objects($object, $data, $full_join = false)
    {
        if(!isset($object)) return $data;
        else if(!isset($data)) return $object;

        foreach($data as $key=>$val)
        {
            if($full_join || property_exists($object, $key)) $object->$key = $val;
        }

        return $object;
    }

    static function encrypt_password($password)
    {
        //return $this->encrypt->encode($password);
        //return md5('P@ssw0rd'.$password);
        return sha1('P@ssw0rd'.$password);
    }

    function check_data(Model_base &$model)
    {
        foreach($model as $key=>$val)
        {
            if (strpos($key, '_id') !== false)
            {
                if(!isset($val) || $val=='' || $val==0 ) $model->$key=null;
            }
            else if(strpos($key, 'date') !== false)
            {
                if(!isset($val) || $val=='' || $val=='0000-00-00' || $val=='00-00-0000' ) $model->$key=null;
            }
        }
    }

}
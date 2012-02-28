<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Loader_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    function  get_all()
    {
        $this->db->select("data_update.*, modules.module_name");
        $this->db->join('modules', 'data_update.data_update_module_id = modules.module_id');
        return $this->db->get('data_update')->result_array();
    }
    function get_settings($id)
    {
        $this->db->where('data_update_id', $id);
        return $this->db->get('data_update')->row_array();
    }
    function get_settings_by_module($module)
    {
        $this->db->where('data_update_module_name', $module);
        return $this->db->get('data_update')->row_array();
    }

    function set_settings($id, $data)
    {
        $this->db->where('data_update_id', $id);
        $this->db->update('data_update', $data);
    }

    function get_elements($sort = '')
    {
        $this->db->order_by('lenses_node');
        $query = $this->db->get('lenses');
        return $query->result_array();
    }
    function set_order_by($sort)
    {
        if (!empty($sort))
            $this->db->order_by($sort['field_name'], $sort['direction']);
        return $this;
    }
	function update_element($data,$id, $lenses_code='', $type='lens')
	{
            switch ($type)
            {
                case "lens":
                    $this->db->where('lenses_id',$id);
                    $this->db->update('lenses',$data);
                    break;
                case "testing":
                    $this->db->where('testing_id',$id);
                    $this->db->where('lenses_code', $lenses_code );
                    $this->db->update('lenses_testing',$data);
            }
	}
    function set_where($name,$value)
    {
        $this->db->where($name,$value == FALSE ? '' : $value);
        return $this;
    }

}

/* End of file lenses_model.php */
/* Location: ./application/modules/lenses/models/lenses_model.php */
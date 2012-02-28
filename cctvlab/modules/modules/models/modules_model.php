<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Modules_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    function get_modules()
    {
            $this->db->join('modules_types','modules_types.module_type_id = modules.module_type_id');
            $this->db->order_by('modules_types.module_type_node'); 
            $this->db->order_by('modules.module_node');
            return $this->db->get('modules')->result_array();
    }
    
    function get_module()
    {
            return $this->db->get('modules')->row_array();
    }

    function set_permissions($group)
    {
            $this->db->like('module_permissions',$group);
            return $this;
    }
    
    function add_element($data)
    {
            $this->db->where('module_type_id',$data['module_type_id']);
            $this->db->select_max('module_node');
            $query = $this->db->get('modules');
            $result = $query->row_array();
            $this->db->set('module_node',$result['module_node'] + 1);
            $this->db->insert('modules',$data);
    }
        
    function get_elements()
    {
            $this->db->join('modules_types','modules_types.module_type_id = modules.module_type_id','right');
            $this->db->order_by('modules_types.module_type_node'); 
            $this->db->order_by('modules.module_node');
            return $this->db->get('modules')->result_array();
    }
    
    function get_element($id)
    {
            $this->db->join('modules_types','modules_types.module_type_id = modules.module_type_id','left');
            $this->db->where('modules.module_id', $id);
            return $query = $this->db->get('modules')->row_array();
    }
    
    function update_element($data,$id)
    {
            $this->db->where('module_id',$id);
            $this->db->update('modules',$data);
    }
    
    function up_element($id)
    {
            $this->db->where('module_id', $id);
            $query = $this->db->get('modules');
            if($query->num_rows() > 0)
            {
		$ford = $query->row_array();
		$row = $query->row();
		$this->db->select_max('module_node');
		$query = $this->db->get('modules');
		$maxord = $query->row_array();
			
		if ($ford['module_node'] == 1) 
		{
			$this->db->set('module_node','module_node-1',FALSE);
			$this->db->update('modules');
			$this->db->where('module_id',$id);
			$this->db->set('module_node',$maxord['module_node']);
			$this->db->update('modules');
		}
		else 	
		{
			$this->db->where('module_node',$ford['module_node']-1);
			$this->db->set('module_node',$ford['module_node']);
			$this->db->update('modules');
			$this->db->where('module_id',$id);
			$this->db->set('module_node',$ford['module_node']-1);
			$this->db->update('modules');
		}
            }
    }
    
    function down_element($id)
    {
            $this->db->where('module_id', $id);
            $query = $this->db->get('modules');
            if($query->num_rows() > 0)
            {
                $ford = $query->row_array();
                $row = $query->row();
                $this->db->select_max('module_node');
		$query = $this->db->get('modules');
		$maxord = $query->row_array();
		
		if ($ford['module_node'] == $maxord['module_node']) 
		{
			$this->db->set('module_node','module_node+1',FALSE);
			$this->db->update('modules');
			$this->db->where('module_id', $id);
			$this->db->set('module_node', 1);
			$this->db->update('modules');
		}
		else 
		{
			$this->db->where('module_node',$ford['module_node']+1);
			$this->db->set('module_node',$ford['module_node']);
			$this->db->update('modules');
			$this->db->where('module_id',$id);
			$this->db->set('module_node',$ford['module_node']+1);
			$this->db->update('modules');
		}
            }
	}
        
    function set_where ($name,$value)
    {
            $this->db->where($name,$value);
            return $this;
    }
}

/* End of file modules.php */
/* Location: ./application/modules/modules/models/module_model.php */
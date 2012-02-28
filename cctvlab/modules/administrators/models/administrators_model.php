<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Administrators_model extends CI_Model {
    
        function __construct()
        {
            parent::__construct();
        }

        function add_element($data)
        {
            $this->db->where('administrator_group',$data['administrator_group']);
            $this->db->select_max('administrator_node');
            $query = $this->db->get('administrators');
            $administrators = $query->row_array();
            $this->db->set('administrator_node',$administrators['administrator_node'] + 1);
            $this->db->insert('administrators',$data);
        }
        
        function get_elements()
        {
            $this->db->order_by('administrator_node');
            $query = $this->db->get('administrators');
            return $query->result_array();
        }
        
        function get_element()
	{
            $query = $this->db->get('administrators');
            return $query->row_array(); 
	}           

	function update_element($data,$id)
	{
            $this->db->where('administrator_id',$id);
            $this->db->update('administrators',$data);
	}
	
        function delete_element($id)
	{
		$this->db->where('administrator_id',$id);
		$query = $this->db->get('administrators');
		if(!$query) { return FALSE; }		
		$result = $query->row_array();
		$this->db->delete('administrators',array('administrator_id' => $id));
		$this->db->where('administrator_group',$result['administrator_group']);
                $this->db->where('administrator_node >',$result['administrator_node']);
               	$this->db->set('administrator_node', 'administrator_node-1',FALSE);
		$this->db->update('administrators');
		return TRUE;
	}
        
	function up_element($id)
	{
		$this->db->where("administrator_id",$id);
		$query = $this->db->get('administrators');
		if($query->num_rows() > 0) {
		$ford = $query->row_array();
		$row = $query->row();
		
                $this->db->where('administrator_group',$ford['administrator_group']);
		$this->db->select_max('administrator_node');
		$query = $this->db->get('administrators');
		$maxord = $query->row_array();
		
		if ($ford['administrator_node'] == 1) 
		{
			$this->db->where('administrator_group',$ford['administrator_group']);
                        $this->db->set('administrator_node', 'administrator_node-1',FALSE);
			$this->db->update('administrators');
			$this->db->where("administrator_id",$id);
			$this->db->set('administrator_node',$maxord['administrator_node']);
			$this->db->update('administrators');
		}
		else 
		{
			$this->db->where('administrator_group',$ford['administrator_group']);
                        $this->db->where("administrator_node",$ford['administrator_node']-1);
			$this->db->set('administrator_node',$ford['administrator_node']);
			$this->db->update('administrators');
			$this->db->where("administrator_id",$id);
			$this->db->set('administrator_node',$ford['administrator_node']-1);
			$this->db->update('administrators');
		}
	  }		
	}
	
	function down_element($id)
	{
		$this->db->where("administrator_id", $id);
		$query = $this->db->get('administrators');
		if($query->num_rows() > 0) {
		$ford = $query->row_array();
		$row = $query->row();
		
                $this->db->where('administrator_group',$ford['administrator_group']);
		$this->db->select_max('administrator_node');
		$query = $this->db->get('administrators');
		$maxord = $query->row_array();
		
		if ($ford['administrator_node'] == $maxord['administrator_node']) 
		{
			$this->db->where('administrator_group',$ford['administrator_group']);
                        $this->db->set('administrator_node', 'administrator_node+1',FALSE);
			$this->db->update('administrators');
			$this->db->where("administrator_id",$id);
			$this->db->set('administrator_node', 1);
			$this->db->update('administrators');
		}
		else 
		{
			$this->db->where('administrator_group',$ford['administrator_group']);
                        $this->db->where("administrator_node", $ford['administrator_node']+1);
			$this->db->set('administrator_node', $ford['administrator_node']);
			$this->db->update('administrators');
			$this->db->where("administrator_id", $id);
			$this->db->set('administrator_node', $ford['administrator_node']+1);
			$this->db->update('administrators');
		}
            }
        }
        
        function set_where($name,$value)
        {           
            $this->db->where($name,$value == FALSE ? '' : $value);          
            return $this;
        }
        
        function set_like($name,$value)
        {           
            $this->db->like($name,$value);          
            return $this;
        }
        
        function set_search($data)
        {           
            if($data)
            {
                foreach($data as $name=>$value)
                $this->db->like($name,$value);          
            }
            
            return $this;
        }
        
        function set_limit($limit,$offset = FALSE)
        {
            $this->db->limit($limit,$offset);
            return $this;            
        }
   
    
}

/* End of file administrators_model.php */
/* Location: ./application/modules/administrators/models/administrators_model.php */
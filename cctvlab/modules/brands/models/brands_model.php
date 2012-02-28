<?php defined('BASEPATH') OR exit('No direct script access allowed');

class brands_model extends CI_Model {
    
        function __construct()
        {
            parent::__construct();
        }

        function add_element($data)
        {
            $this->db->select_max('brands_node');
            $query = $this->db->get('brands');
            $result = $query->row_array();
            $this->db->set('brands_node',$result['brands_node'] + 1);
            $this->db->insert('brands',$data);
        }
        
        function get_elements()
        {
            $this->db->order_by('brands_node');
            $query = $this->db->get('brands');
            return $query->result_array();
        }
        
        function get_element()
	{
            $query = $this->db->get('brands');
            return $query->row_array(); 
	}           

	function update_element($data,$id)
	{
            $this->db->where('brands_id',$id);
            $this->db->update('brands',$data);
	}
	
        function delete_element($id)
	{
		$this->db->where('brands_id',$id);
		$query = $this->db->get('brands');
		if(!$query) { return FALSE; }		
		$result = $query->row_array();
		$this->db->delete('brands',array('brands_id' => $id));
		$this->db->where('brands_node >',$result['brands_node']);
               	$this->db->set('brands_node', 'brands_node-1',FALSE);
		$this->db->update('brands');
		return TRUE;
	}
        
	function up_element($id)
	{
		$this->db->where('brands_id',$id);
		$query = $this->db->get('brands');
		if($query->num_rows() > 0) {
		$ford = $query->row_array();
		$row = $query->row();
		
		$this->db->select_max('brands_node');
		$query = $this->db->get('brands');
		$maxord = $query->row_array();
		
		if ($ford['brands_node'] == 1) 
		{
			$this->db->set('brands_node', 'brands_node-1',FALSE);
			$this->db->update('brands');
			$this->db->where('brands_id',$id);
			$this->db->set('brands_node',$maxord['brands_node']);
			$this->db->update('brands');
		}
		else 
		{
			$this->db->where('brands_node',$ford['brands_node']-1);
			$this->db->set('brands_node',$ford['brands_node']);
			$this->db->update('brands');
			$this->db->where('brands_id',$id);
			$this->db->set('brands_node',$ford['brands_node']-1);
			$this->db->update('brands');
		}
	  }		
	}
	
	function down_element($id)
	{
		$this->db->where('brands_id', $id);
		$query = $this->db->get('brands');
		if($query->num_rows() > 0) {
		$ford = $query->row_array();
		$row = $query->row();
		
		$this->db->select_max('brands_node');
		$query = $this->db->get('brands');
		$maxord = $query->row_array();
		
		if ($ford['brands_node'] == $maxord['brands_node']) 
		{
                        $this->db->set('brands_node', 'brands_node+1',FALSE);
			$this->db->update('brands');
			$this->db->where('brands_id',$id);
			$this->db->set('brands_node', 1);
			$this->db->update('brands');
		}
		else 
		{
                        $this->db->where('brands_node', $ford['brands_node']+1);
			$this->db->set('brands_node', $ford['brands_node']);
			$this->db->update('brands');
			$this->db->where('brands_id', $id);
			$this->db->set('brands_node', $ford['brands_node']+1);
			$this->db->update('brands');
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

/* End of file brands_model.php */
/* Location: ./application/modules/brands/models/brands_model.php */
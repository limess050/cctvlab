<?php

class Users_model extends CI_Model {
    
        function __construct()
        {
            parent::__construct();
        }

        function add_element($data)
        {
            //$this->db->where('administrator_group',$data['administrator_group']);
            $this->db->select_max('user_node');
            $query = $this->db->get('users');
            $users = $query->row_array();
            $this->db->set('user_node',$users['user_node'] + 1);
            $this->db->insert('users',$data);
        }
        
        function get_elements()
        {
            $this->db->order_by('user_node');
            $query = $this->db->get('users');
            return $query->result_array();
        }
        
        function get_element()
	{
            $query = $this->db->get('users');
            return $query->row_array(); 
	}           

	function update_element($data,$id)
	{
            $this->db->where('user_id',$id);
            $this->db->update('users',$data);
	}
        
        function update_social_element($data)
        {
            $this->db->where('user_uid', $data['user_uid']);
            $this->db->where('user_provider', $data['user_provider']);
            $this->db->update('users', $data);
        }
	
        function delete_element($id)
	{
		$this->db->where('user_id',$id);
		$query = $this->db->get('users');
		if(!$query) { return FALSE; }		
		$result = $query->row_array();
		$this->db->delete('users',array('user_id' => $id));
		$this->db->where('user_group',$result['user_group']);
                $this->db->where('user_node >',$result['user_node']);
               	$this->db->set('user_node', 'user_node-1',FALSE);
		$this->db->update('users');
		return TRUE;
	}
        
	function up_element($id)
	{
		$this->db->where("user_id",$id);
		$query = $this->db->get('users');
		if($query->num_rows() > 0) {
		$ford = $query->row_array();
		$row = $query->row();
		
                $this->db->where('user_group',$ford['user_group']);
		$this->db->select_max('user_node');
		$query = $this->db->get('users');
		$maxord = $query->row_array();
		
		if ($ford['user_node'] == 1) 
		{
			$this->db->where('user_group',$ford['user_group']);
                        $this->db->set('user_node', 'user_node-1',FALSE);
			$this->db->update('users');
			$this->db->where("user_id",$id);
			$this->db->set('user_node',$maxord['user_node']);
			$this->db->update('users');
		}
		else 
		{
			$this->db->where('user_group',$ford['user_group']);
                        $this->db->where("user_node",$ford['user_node']-1);
			$this->db->set('user_node',$ford['user_node']);
			$this->db->update('users');
			$this->db->where("user_id",$id);
			$this->db->set('user_node',$ford['user_node']-1);
			$this->db->update('users');
		}
	  }		
	}
	
	function down_element($id)
	{
		$this->db->where("user_id", $id);
		$query = $this->db->get('users');
		if($query->num_rows() > 0) {
		$ford = $query->row_array();
		$row = $query->row();
		
                $this->db->where('user_group',$ford['user_group']);
		$this->db->select_max('user_node');
		$query = $this->db->get('users');
		$maxord = $query->row_array();
		
		if ($ford['user_node'] == $maxord['user_node']) 
		{
			$this->db->where('user_group',$ford['user_group']);
                        $this->db->set('user_node', 'user_node+1',FALSE);
			$this->db->update('users');
			$this->db->where("user_id",$id);
			$this->db->set('user_node', 1);
			$this->db->update('users');
		}
		else 
		{
			$this->db->where('user_group',$ford['user_group']);
                        $this->db->where("user_node", $ford['user_node']+1);
			$this->db->set('user_node', $ford['user_node']);
			$this->db->update('users');
			$this->db->where("user_id", $id);
			$this->db->set('user_node', $ford['user_node']+1);
			$this->db->update('users');
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
?>

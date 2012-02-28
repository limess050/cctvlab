<?php defined('BASEPATH') OR exit('No direct script access allowed');

class images_model extends CI_Model {
    
        function __construct()
        {
            parent::__construct();
        }
        
        function get_goods_images($goods_id,$module_name)
        {
            $this->db->where('images_code', $goods_id);
            $this->db->where('module_name', $module_name);
            $this->db->order_by('images_node');
            $query = $this->db->get('images');
            return $query->result_array();
        }
        
        function add_element($data)
        {
            $this->db->select_max('images_node');
            $query = $this->db->get('images');
            $result = $query->row_array();
            $this->db->set('images_node',$result['images_node'] + 1);
            $this->db->insert('images',$data);
            $this->db->select_max('images_id');
            return $this->set_where('images_id',$this->db->get('images')->row()->images_id)->get_element();
        }
        
        function get_elements()
        {
            $this->db->order_by('images_node');
            $query = $this->db->get('images');
            return $query->result_array();
        }
        
        function get_element()
	{
            $query = $this->db->get('images');
            return $query->row_array(); 
	}           

	function update_element($data,$id)
	{
            $this->db->where('images_id',$id);
            $this->db->update('images',$data);
	}
	function delete_elements($images_code)
        {
            $this->db->delete('images', array('images_code' => $images_code));
        }
        function delete_element($id)
	{
            $result = $this->set_where('images_id',$id)->get_element();
		
            if($result)
            {
                $this->db->delete('images',array('images_id' => $id));
                $this->db->where('images_node >',$result['images_node']);
                $this->db->where('images_code',$result['images_code']);
                $this->db->where('module_name',$result['module_name']);
                $this->db->set('images_node','images_node-1',FALSE);
                $this->db->update('images');
                return $result;
             }
             else
             {
                return FALSE;
             }
	}
        
	function up_element($id)
	{
		$this->db->where('images_id',$id);
		$query = $this->db->get('images');
		if($query->num_rows() > 0) {
		$ford = $query->row_array();
		$row = $query->row();
		
		$this->db->select_max('images_node');
		$query = $this->db->get('images');
		$maxord = $query->row_array();
		
		if ($ford['images_node'] == 1) 
		{
			$this->db->set('images_node', 'images_node-1',FALSE);
			$this->db->update('images');
			$this->db->where('images_id',$id);
			$this->db->set('images_node',$maxord['images_node']);
			$this->db->update('images');
		}
		else 
		{
			$this->db->where('images_node',$ford['images_node']-1);
			$this->db->set('images_node',$ford['images_node']);
			$this->db->update('images');
			$this->db->where('images_id',$id);
			$this->db->set('images_node',$ford['images_node']-1);
			$this->db->update('images');
		}
	  }		
	}
	
	function down_element($id)
	{
		$this->db->where('images_id', $id);
		$query = $this->db->get('images');
		if($query->num_rows() > 0) {
		$ford = $query->row_array();
		$row = $query->row();
		
		$this->db->select_max('images_node');
		$query = $this->db->get('images');
		$maxord = $query->row_array();
		
		if ($ford['images_node'] == $maxord['images_node']) 
		{
                        $this->db->set('images_node', 'images_node+1',FALSE);
			$this->db->update('images');
			$this->db->where('images_id',$id);
			$this->db->set('images_node', 1);
			$this->db->update('images');
		}
		else 
		{
                        $this->db->where('images_node', $ford['images_node']+1);
			$this->db->set('images_node', $ford['images_node']);
			$this->db->update('images');
			$this->db->where('images_id', $id);
			$this->db->set('images_node', $ford['images_node']+1);
			$this->db->update('images');
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

/* End of file images_model.php */
/* Location: ./application/modules/images/models/images_model.php */
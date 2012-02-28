<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Comparing_model extends CI_Model {
    
        function __construct()
        {
            parent::__construct();
        }
        
        function get_lenses()
        {
            $this->db->order_by('lenses_node');
            $this->db->where('lenses_active',1);
            $query = $this->db->get('lenses');
            return $query->result_array();
        }
//        function get_lens($id)
//        {
//            $this->db->where('lenses_id',$id);
//            $this->db->where('lenses_active',1);
//            $query = $this->db->get('lenses');
//            return $query->row_array();
//        }
        function get_lens($name, $value)
        {
            $this->db->where($name, $value);
            $query = $this->db->get('lenses');
            $result = $query->row_array();
            if (!empty ($result))
                return $result;
            else
                return FALSE;
        }
        
}

/* End of file comparing_model.php */
/* Location: ./application/modules/comparing/models/comparing_model.php */

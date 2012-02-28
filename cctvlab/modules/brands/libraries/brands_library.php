<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Brands_library {

	function __construct()
        {
            $this->ci = & get_instance();
            $this->ci->load->model('brands/brands_model');
            $this->ci->lang->load('brands/brands');

            log_message('debug', 'Brands_library Initialized');
        }

        function dropdown()
        {
            $return = array();

            $result = $this->ci->brands_model->get_elements();
            if($result)
            {
                $return[] = '-';
                foreach($result as $row)
                {
                    $return[$row['brands_name']] = $row['brands_name'];
                }
            }

            return $return;
        }
}

/* End of file brands_library.php */
/* Location: ./application/modules/brands/libraries/brands_library.php */
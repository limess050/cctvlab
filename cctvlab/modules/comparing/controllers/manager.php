<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends Manager_Controller {
        
        public function __construct()
	{
  		parent::Manager_Controller();
                $this->lang->load('comparing');
                $this->load->model('comparing_model'); 
                
                $this->template->set('uri_segment',$this->_uri_segment());
 	}
        
        function index()
        {
            $this->template->build('manager/manager_comparing_listing');	
        }
        
        private function _uri_segment($t = FALSE)
        {
           $return['return'] = $this->session->userdata('offset') ? 'manager/images/index/'.$this->session->userdata('offset') : 'manager/images'; 
           $return['root'] = 'manager/images'; 
           return $t ? base_url($return[$t]) : $return;
        }
}

/* End of file manager.php */
/* Location: ./application/modules/comparing/controllers/manager.php */
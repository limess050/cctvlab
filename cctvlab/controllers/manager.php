<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends Manager_Controller {
        
        public function __construct()
	{
  		parent::Manager_Controller(FALSE); 
 	}
        
	public function index()
	{
            $this->form_validation->set_rules('username','lang:manager_username','trim|required|callback__check_login');
            $this->form_validation->set_rules('password','lang:manager_password','trim|required');
            
            if ($this->form_validation->run() || $this->administrators_library->current_administrator())
            {       
                   $this->template->set('mmenu',$this->modules_library->mmenu($this->administrators_library->current_administrator()))
                                  ->set('current_module',$this->current_module)
                                  ->set_layout('default')
                                  ->set_theme('manager_default')
                                  ->build('dashboard');      
            }
            else 
            {
                   $this->template->set_layout(FALSE)
                                  ->set_theme('manager_default')
                                  ->build('login');
            }
	}
        
        public function logout()
        {
            $this->administrators_library->logout();
            redirect(base_url('manager'));
        }
        
        function _check_login()
	{
            if (!$this->administrators_library->login($this->input->post('username',TRUE),$this->input->post('password',TRUE)))
            {
	   	$this->form_validation->set_message('_check_login',$this->administrators_library->errors());
	    	return FALSE;
	    }       
            return TRUE;
	}
        
}

/* End of file manager.php */
/* Location: ./application/controllers/modules.php */
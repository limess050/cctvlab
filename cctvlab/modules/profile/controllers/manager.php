<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends Manager_Controller {
        
        public function __construct()
	{
  		parent::Manager_Controller();              
 	}
   
        public function index()
	{            
            $id = element('administrator_id',$this->administrators_library->current_administrator());
                        
            $this->form_validation->set_rules('administrator_username','lang:administrators_username','trim|required');
            $this->form_validation->set_rules('administrator_password','lang:administrators_password','trim|matches[administrator_password_conf]');
            $this->form_validation->set_rules('administrator_password_conf','lang:administrators_password_conf','trim');
            $this->form_validation->set_rules('administrator_first_name','lang:administrators_first_name','trim|required');
            $this->form_validation->set_rules('administrator_last_name','lang:administrators_last_name','trim');
            $this->form_validation->set_rules('administrator_patronymic','lang:administrators_patronymic','trim');
            $this->form_validation->set_rules('administrator_email','lang:administrators_email','trim|valid_email');
            $this->form_validation->set_rules('administrator_telephone','lang:administrators_telephone','trim');
            $this->form_validation->set_rules('administrator_icq','lang:administrators_icq','trim');
            
            if ($this->form_validation->run())
            {       
                  $data['administrator_password']           = $this->input->post('administrator_password');
		  $data['administrator_username']           = $this->input->post('administrator_username');
                  $data['administrator_first_name']         = $this->input->post('administrator_first_name');
                  $data['administrator_last_name'] 	    = $this->input->post('administrator_last_name');
                  $data['administrator_patronymic'] 	    = $this->input->post('administrator_patronymic');
                  $data['administrator_email'] 		    = $this->input->post('administrator_email');
                  $data['administrator_telephone'] 	    = $this->input->post('administrator_telephone');
                  $data['administrator_icq'] 		    = $this->input->post('administrator_icq');
                  
                  if($this->administrators_library->update_administrator($data,$id))
                  {
                        $this->session->set_flashdata('success',lang('manager_message_success_save'));
                        redirect($this->uri->uri_string());
                  }
                  else
                  {
                        $this->template->set('messages',array('error'=>$this->administrators_library->errors()));
                  }         
            }

            if(!$result = $this->administrators_model->set_where('administrator_id',$id)->get_element())
            {
                 $this->template->set('error',lang('manager_message_undefined'));
            }
            
            $this->template->set('item',$result)
                           ->build('manager/manager_profile_edit');
	}
}

/* End of file manager.php */
/* Location: ./application/modules/profile/controllers/manager.php */
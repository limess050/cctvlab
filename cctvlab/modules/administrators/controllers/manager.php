<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends Manager_Controller {
        
        public function __construct()
	{
  		parent::Manager_Controller();
                $this->load->library('search'); 
                
                $this->template->set('uri_segment',$this->_uri_segment());
 	}
	
        public function index()
	{            
            $search = $this->search->read();
            $pagination = pagination($this->_uri_segment('root'),count($this->administrators_model->set_search($search)->set_where('administrator_group !=','administrator1')->get_elements()));
            
            $this->template->set('listing',$this->administrators_model->set_search($search)->set_where('administrator_group !=','administrator1')->set_limit(element(0,$pagination['limit']),element(1,$pagination['limit']))->get_elements())
                           ->set('pagination',$pagination['links'])
                           ->set('search',$search)
                           ->set_partial('top_content','manager/partials/manager_administrators_search')
                           ->build('manager/manager_administrators_listing');	
	}
        
        public function create()
	{                        
            $this->form_validation->set_rules('administrator_date_register','lang:administrators_date_register','trim|required');
            $this->form_validation->set_rules('administrator_username','lang:administrators_username','trim|required');
            $this->form_validation->set_rules('administrator_password','lang:administrators_password','trim|required|matches[administrator_password_conf]');
            $this->form_validation->set_rules('administrator_password_conf','lang:administrators_password_conf','trim|required');
            $this->form_validation->set_rules('administrator_first_name','lang:administrators_first_name|required','trim');
            $this->form_validation->set_rules('administrator_last_name','lang:administrators_last_name','trim');
            $this->form_validation->set_rules('administrator_patronymic','lang:administrators_patronymic','trim');
            $this->form_validation->set_rules('administrator_email','lang:administrators_email','trim|valid_email');
            $this->form_validation->set_rules('administrator_telephone','lang:administrators_telephone','trim');
            $this->form_validation->set_rules('administrator_icq','lang:administrators_icq','trim');
            $this->form_validation->set_rules('administrator_active','lang:manager_active','trim');
            
            if ($this->form_validation->run())
            {       
                  $data['administrator_group']              = 'administrator2';
                  $data['administrator_password']           = $this->input->post('administrator_password');
		  $data['administrator_date_register']      = date_calendar($this->input->post('administrator_date_register'));
                  $data['administrator_username']           = $this->input->post('administrator_username');
                  $data['administrator_first_name']         = $this->input->post('administrator_first_name');
                  $data['administrator_last_name'] 	    = $this->input->post('administrator_last_name');
                  $data['administrator_patronymic'] 	    = $this->input->post('administrator_patronymic');
                  $data['administrator_email'] 		    = $this->input->post('administrator_email');
                  $data['administrator_telephone'] 	    = $this->input->post('administrator_telephone');
                  $data['administrator_icq'] 		    = $this->input->post('administrator_icq');
                  $data['administrator_active'] 	    = $this->input->post('administrator_active');
                   
                  if($this->administrators_library->registration_administrator($data))
                  {
                     $this->session->set_flashdata('success',lang('manager_message_success_create'));
                     redirect($this->_uri_segment('return')); 
                  }
                  else
                  {
                      $this->template->set('messages',array('error'=>$this->administrators_library->errors()));
                  }         
            }

            $this->template->build('manager/manager_administrators_create');
	}
        
        public function edit()
	{            
            $id = $this->uri->segment(4,0);
            
            $this->form_validation->set_rules('administrator_date_register','lang:administrators_date_register','trim|required');
            $this->form_validation->set_rules('administrator_username','lang:administrators_username','trim|required');
            $this->form_validation->set_rules('administrator_password','lang:administrators_password','trim|matches[administrator_password_conf]');
            $this->form_validation->set_rules('administrator_password_conf','lang:administrators_password_conf','trim');
            $this->form_validation->set_rules('administrator_first_name','lang:administrators_first_name','trim|required');
            $this->form_validation->set_rules('administrator_last_name','lang:administrators_last_name','trim');
            $this->form_validation->set_rules('administrator_patronymic','lang:administrators_patronymic','trim');
            $this->form_validation->set_rules('administrator_email','lang:administrators_email','trim|valid_email');
            $this->form_validation->set_rules('administrator_telephone','lang:administrators_telephone','trim');
            $this->form_validation->set_rules('administrator_icq','lang:administrators_icq','trim');
            $this->form_validation->set_rules('administrator_active','lang:manager_active','trim');
            
            if ($this->form_validation->run())
            {       
                  $data['administrator_group']              = 'administrator2';
                  $data['administrator_password']           = $this->input->post('administrator_password');
		  $data['administrator_date_register']      = date_calendar($this->input->post('administrator_date_register'));
                  $data['administrator_username']           = $this->input->post('administrator_username');
                  $data['administrator_first_name']         = $this->input->post('administrator_first_name');
                  $data['administrator_last_name'] 	    = $this->input->post('administrator_last_name');
                  $data['administrator_patronymic'] 	    = $this->input->post('administrator_patronymic');
                  $data['administrator_email'] 		    = $this->input->post('administrator_email');
                  $data['administrator_telephone'] 	    = $this->input->post('administrator_telephone');
                  $data['administrator_icq'] 		    = $this->input->post('administrator_icq');
                  $data['administrator_active'] 	    = $this->input->post('administrator_active');
                  
                  $data['administrator_date_register'];
                  
                  if($this->administrators_library->update_administrator($data,$id))
                  {
                        $this->session->set_flashdata('success',lang('manager_message_success_save'));
                        redirect($this->_uri_segment('return')); 
                  }
                  else
                  {
                        $this->template->set('messages',array('error'=>$this->administrators_library->errors()));
                  }         
            }

            if($result = $this->administrators_model->set_where('administrator_id',$id)->get_element())
            {
                    $this->template->set('item',$result)
                                   ->build('manager/manager_administrators_edit');
            }
            else
            {
                $this->session->set_flashdata('error',lang('manager_message_undefined'));
                redirect($this->_uri_segment('root'));            
            }
	}
        
        public function delete()
	{
            $id = $this->uri->segment(4,0);
            $this->administrators_model->delete_element($id);
            $this->session->set_flashdata('success',lang('manager_message_success_delete'));
            redirect($this->_uri_segment('return'));
	}
        
        public function up()
	{
            $id = $this->uri->segment(4,0);
            $this->administrators_model->up_element($id);
            redirect($this->_uri_segment('return'));
	}
        
        public function down()
	{
            $id = $this->uri->segment(4,0);
            $this->administrators_model->down_element($id);
            redirect($this->_uri_segment('return'));
	}
        
        public function search()
	{
            $this->uri->segment(4,0) == 'reset' ?  $this->search->write($this->input->post('search')) :  $this->search->reset();
            redirect($this->_uri_segment('root'));
	}
        
        private function _uri_segment($t = FALSE)
        {
           $return['return'] = $this->session->userdata('offset') ? 'manager/administrators/index/'.$this->session->userdata('offset') : 'manager/administrators'; 
           $return['root'] = 'manager/administrators'; 
           return $t ? base_url($return[$t]) : $return;
        }
}

/* End of file manager.php */
/* Location: ./application/modules/administrators/controllers/manager.php */
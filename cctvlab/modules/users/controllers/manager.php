<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends Manager_Controller {
        
        public function __construct()
	{
  		parent::Manager_Controller();
                $this->load->library('search'); 
                $this->load->library('users_library');
                $this->load->model('users_model');
                $this->lang->load('users');
                $this->template->set('uri_segment',$this->_uri_segment());
                               
 	}
	
        public function index()
	{
            $search = $this->search->read();
            $pagination = pagination($this->_uri_segment('root'),count($this->users_model->set_search($search)->set_where('user_group !=','user1')->get_elements()));
            $this->template->set('listing',$this->users_model->set_search($search)->set_limit(element(0,$pagination['limit']),element(1,$pagination['limit']))->get_elements()) //Вырезал set_where('user_group !=','user1')-> непонятен смысл
                           ->set('pagination',$pagination['links'])
                           ->set('search',$search)
                           ->set_partial('top_content','manager/partials/manager_user_search')
                           ->build('manager/manager_user_listing');	
	}
        
        public function create()
	{                        
            $this->form_validation->set_rules('date_register','lang:users_date_register','trim|required');
            $this->form_validation->set_rules('username','lang:users_username','trim|required');
            $this->form_validation->set_rules('password','lang:users_password','trim|required|matches[password_conf]');
            $this->form_validation->set_rules('password_conf','lang:users_password_conf','trim|required');
            $this->form_validation->set_rules('first_name','lang:users_first_name','trim');
            $this->form_validation->set_rules('last_name','lang:users_last_name','trim');
            $this->form_validation->set_rules('patronymic','lang:users_patronymic','trim');
            $this->form_validation->set_rules('email','lang:users_email','trim|valid_email');
            $this->form_validation->set_rules('telephone','lang:users_telephone','trim');
            $this->form_validation->set_rules('icq','lang:users_icq','trim');
            $this->form_validation->set_rules('active','lang:users_active','trim');
            
            if ($this->form_validation->run())
            {       
                  $data['user_group']               = 'user1';
                  $data['user_password']            = $this->input->post('password');
		  $data['user_date_register']       = date_calendar($this->input->post('date_register'));
                  $data['user_username']            = $this->input->post('username');
                  $data['user_first_name']          = $this->input->post('first_name');
                  $data['user_last_name'] 	    = $this->input->post('last_name');
                  $data['user_patronymic'] 	    = $this->input->post('patronymic');
                  $data['user_email'] 		    = $this->input->post('email');
                  $data['user_telephone'] 	    = $this->input->post('telephone');
                  $data['user_icq'] 		    = $this->input->post('icq');
                  $data['user_active'] 	            = $this->input->post('active');
                  
                      if($this->users_library->registration_user($data))
                      {
                         $this->session->set_flashdata('success',lang('manager_message_success_create'));
                         redirect($this->_uri_segment('return')); 
                      }
                      else
                      {
                          $this->template->set('messages',array('error'=>$this->users_library->errors()));
                      }
                  
            }

            $this->template->build('manager/manager_user_create');
	}
        
        public function edit()
	{            
            $id = $this->uri->segment(4,0);
            
            $this->form_validation->set_rules('date_register','lang:date_register','trim|required');
            $this->form_validation->set_rules('username','lang:username','trim|required');
            $this->form_validation->set_rules('password','lang:password','trim|matches[password_conf]');
            $this->form_validation->set_rules('password_conf','lang:password_conf','trim');
            $this->form_validation->set_rules('first_name','lang:first_name','trim');
            $this->form_validation->set_rules('last_name','lang:last_name','trim');
            $this->form_validation->set_rules('patronymic','lang:patronymic','trim');
            $this->form_validation->set_rules('email','lang:email','trim|valid_email');
            $this->form_validation->set_rules('telephone','lang:telephone','trim');
            $this->form_validation->set_rules('icq','lang:icq','trim');
            $this->form_validation->set_rules('active','lang:manager_active','trim');
            
            if ($this->form_validation->run())
            {       
                  $data['user_group']               = 'users1';
                  $password =                       $this->input->post('password');
                  if (!empty($password))
                    $data['user_password']          = $this->input->post('password');
		  $data['user_date_register']       = date_calendar($this->input->post('date_register'));
                  $data['user_username']            = $this->input->post('username');
                  $data['user_first_name']          = $this->input->post('first_name');
                  $data['user_last_name'] 	    = $this->input->post('last_name');
                  $data['user_patronymic'] 	    = $this->input->post('patronymic');
                  $data['user_email'] 		    = $this->input->post('email');
                  $data['user_telephone'] 	    = $this->input->post('telephone');
                  $data['user_icq'] 		    = $this->input->post('icq');
                  $data['user_active']              = $this->input->post('active');
                  
                  $data['user_date_register'];
                  if($this->users_library->update_user($data,$id))
                  {
                        $this->session->set_flashdata('success',lang('manager_message_success_save'));
                        redirect($this->_uri_segment('return')); 
                  }
                  else
                  {
                        $this->template->set('messages',array('error'=>$this->users_library->errors()));
                  }         
            }

            if($result = $this->users_model->set_where('user_id',$id)->get_element())
            {
                    $this->template->set('item',$result)
                                   ->build('manager/manager_user_edit');
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
            $this->users_model->delete_element($id);
            $this->session->set_flashdata('success',lang('manager_message_success_delete'));
            redirect($this->_uri_segment('return'));
	}
        
        public function up()
	{
            $id = $this->uri->segment(4,0);
            $this->users_model->up_element($id);
            redirect($this->_uri_segment('return'));
	}
        
        public function down()
	{
            $id = $this->uri->segment(4,0);
            $this->users_model->down_element($id);
            redirect($this->_uri_segment('return'));
	}
        
        public function search()
	{
            $this->uri->segment(4,0) == 'reset' ?  $this->search->write($this->input->post('search')) :  $this->search->reset();
            redirect($this->_uri_segment('root'));
	}
        
        private function _uri_segment($t = FALSE)
        {
           $return['return'] = $this->session->userdata('offset') ? 'manager/users/index/'.$this->session->userdata('offset') : 'manager/users'; 
           $return['root'] = 'manager/users'; 
           return $t ? base_url($return[$t]) : $return;
        }
}

/* End of file manager.php */
/* Location: ./application/modules/administrators/controllers/manager.php */
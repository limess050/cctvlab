<?php

class Registration extends Public_Controller {
    
        protected $ci;
        
        public function __construct()
	{
  		parent::Public_Controller(FALSE);
                $this->ci =& get_instance();
                $this->ci->load->library('email');
                $this->template->set('keywords',element(0,$this->parameters))
                               ->set('description',element(0,$this->parameters))
                               ->set('title', element(0, $this->parameters))
                               ->set_partial('contentright','public/partials/contentright');
 	}
        
        public function index()
	{
            $this->template->set('breadcrumbs',lang('users_registration'));
            if ($this->current_user)
            {
                redirect(base_url());
            }
            
            $this->form_validation->set_rules('username','lang:users_username','trim|required');
            $this->form_validation->set_rules('password','lang:users_password','trim|required|matches[password_conf]');
            $this->form_validation->set_rules('password_conf','lang:users_password_conf','trim|required');
            $this->form_validation->set_rules('first_name','lang:users_first_name|required','trim');
            $this->form_validation->set_rules('second_name','lang:users_last_name','trim');
            $this->form_validation->set_rules('patronymic','lang:users_patronymic','trim');
            $this->form_validation->set_rules('email','lang:users_email','trim|valid_email|required');
            
            if ($this->form_validation->run())
            {
                $activation_code = md5(time());
                $data['user_username']               = $this->input->post('username',TRUE);
                $data['user_password']               = $this->input->post('password',TRUE);
                $data['user_email']                  = $this->input->post('email',TRUE);
                $data['user_first_name']             = $this->input->post('first_name',TRUE);
                $data['user_last_name']              = $this->input->post('second_name',TRUE);
                $data['user_patronymic']             = $this->input->post('patronymic',TRUE);
                $data['user_group']                  = 'user1';
                $data['user_date_register']          = date('Y-m-d H:i:s');
                $data['user_active']                 = 0;
                $data['user_activation_code']        = $activation_code;
                if($this->_send_email($data, $activation_code))
                {
                    if ($this->users_library->registration_user($data))
                    {
                        $this->session->set_flashdata('success',lang('message_email_activation'));
                        redirect(base_url(''));
                    }
                    else
                    {
                        $this->template->set('messages',array('error'=>$this->users_library->errors()));
                    }
                }
                else
                {
                    $this->session->set_flashdata('error',lang('users_error_not_send_email'));
                    redirect(base_url(''));
                }
                    

                    
            }
            $this->template->build('public/registration');
	}
        
        function activate()
        {
            $activation_code = $this->uri->segment(4, 0);
            if(!empty($activation_code))
            {
                $data = $this->users_library->activate($activation_code);
                if (!empty($data))
                {
                    $this->session->set_flashdata('success',lang('message_success_activation'));
                    $this->users_library->login($data['user_username'], $data['user_password'], FALSE);
                    redirect(base_url());
                }
                $this->session->set_flashdata('error',lang('users_incorrect_activation_code'));
                redirect(base_url());
            }
            redirect(base_url());
        }
        
        private function _send_email($data, $activation_code)
        {
            $message = element(2, $this->parameters);
            $url = base_url('/users/registration/activate/'.$activation_code);
            $message = str_replace('%username%', $data['user_username'], $message);
            $message = str_replace('%url%', $url, $message);
            $this->email->from('flash286@mail.ru');
            $this->email->to($data['user_email']);
            $this->email->subject(element(1, $this->parameters));
            $this->email->message($message);
            if ($this->email->send())
                return TRUE;
            else
                return FALSE;
            
        }
}
?>
<?php
    class Authorization extends Public_Controller {

            public function __construct()
            {
                    parent::Public_Controller(FALSE);
                    $this->template->set('keywords',element(1,$this->parameters))
                                   ->set('description',element(2,$this->parameters))
                                   ->set_partial('contentright','public/partials/contentright');
            }

            public function index()
            {
                $this->template->set('breadcrumbs',element('name',lang('user_authorization')));                
                $this->form_validation->set_rules('users_username','lang:users_username','trim|required|callback__check_login');
                $this->form_validation->set_rules('users_password','lang:users_password','trim|required');

                if ($this->form_validation->run())
                {
                    redirect(base_url());
                }
                redirect(base_url());
                $this->template->build('public/authorization');
            }

            public function logout()
            {
                $this->users_library->logout();
                redirect(base_url(''));
            }


            public function _check_login()
            {
                if (!$this->users_library->login($this->input->post('users_username',TRUE),$this->input->post('users_password',TRUE)))
                {
                    
                    //$this->form_validation->set_message('_check_login',$this->users_library->errors());
                    $this->session->set_flashdata('error',lang('users_error_authorization'));
                    return FALSE;
                }

                return TRUE;
            }

    }
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php

    class Personal_office extends Public_Controller {

            public function __construct()
            {
                    parent::Public_Controller();
                    $this->ci = & get_instance();
                    $this->lang->load('users');
                    $this->load->model('users_model');
                    $this->load->model('comparing/comparing_model');
                    $this->load->library('users/users_library');
                    $this->template->title(element(0,$this->parameters))
                                   ->set('keywords',element(1,$this->parameters))
                                   ->set('description',element(2,$this->parameters))
                                   ->set_partial('contentright','public/partials/contentright');    

            }

            public function index()
            {
                //$this->output->enable_profiler(TRUE);
                if (!$this->current_user)
                    redirect ();
					
                $this->template->set('breadcrumbs',array(lang('users_personal_office')=>'',lang('users_personal_data')))
                               ->set('listing',$this->users_model->set_where('user_id',$this->session->userdata('user_id'))->get_element());
                                   
                
                $this->form_validation->set_rules('users_first_name','lang:users_first_name','trim|required');
                $this->form_validation->set_rules('users_last_name','lang:users_last_name','trim');
                $this->form_validation->set_rules('users_patronymic','lang:users_patronymic','trim');
                $this->form_validation->set_rules('users_email','lang:users_email','trim|valid_email');
                $this->form_validation->set_rules('users_telephone','lang:users_telephone','trim');
                $this->form_validation->set_rules('users_icq','lang:users_icq','trim');
                
                if ($this->form_validation->run())
                {
                    $id = $this->session->userdata('user_id');
                    
                    $data['user_first_name']         = $this->input->post('users_first_name');
                    $data['user_last_name']          = $this->input->post('users_last_name');
                    $data['user_patronymic']         = $this->input->post('users_patronymic');
                    $data['user_email']              = $this->input->post('users_email');
                    $data['user_telephone']          = $this->input->post('users_telephone');
                    $data['user_icq']                = $this->input->post('users_icq');
                    
                    if($this->users_library->update_user($data,$id))
                    {
                          $this->session->set_flashdata('success',lang('message_update'));
                          redirect(base_url('users/personal_office')); 
                    }
                    else
                    {
                          $this->template->set('messages',array('error'=>$this->users_library->errors()));
                    }
                    
                }
                $this->template->build('public/personal_office_edit');	
            }
    }
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends Manager_Controller {
        
        public function __construct()
	{
  		parent::Manager_Controller();
                $this->template->set('uri_segment',$this->_uri_segment())->append_metadata(editor_init());;
 	}

	public function index()
	{
            $this->template->set('listing',$this->modules_model->get_elements())
                           ->set('show_action',TRUE)
                           ->build('manager/manager_modules_listing');
	}
        
        public function create()
	{
            $id = $this->uri->segment(4,0);
            
            $this->form_validation->set_rules('module_code','lang:modules_manager_code','trim|required');
            $this->form_validation->set_rules('module_uname','lang:modules_manager_uname','trim|required');
            $this->form_validation->set_rules('module_name','lang:modules_manager_name','trim|required');
            $this->form_validation->set_rules('module_permissions','lang:modules_manager_permissions','trim|required');
           
            if ($this->form_validation->run())
            {       
                   $data['module_code']             = $this->input->post('module_code',TRUE);
                   $data['module_name']             = $this->input->post('module_name',TRUE);
                   $data['module_uname']            = $this->input->post('module_uname',TRUE);
                   $data['module_permissions']      = $this->input->post('module_permissions',TRUE);
                   $data['module_type_id']          = $id;
                   $data['modules_mmenu_public']     = $this->input->post('modules_manager_users_activate',TRUE);
                   
                   $this->modules_model->add_element($data);
                   
                   $this->session->set_flashdata('success',lang('manager_message_success_create'));
                   redirect($this->_uri_segment('return'));          
            }

            $this->template->build('manager/manager_modules_create');
	}
        
        public function edit()
	{
            $id = $this->uri->segment(4,0);
            
            $this->form_validation->set_rules('module_name','lang:modules_manager_name','trim|required');
            $this->form_validation->set_rules('module_active','lang:modules_manager_active','trim');
            $this->form_validation->set_rules('module_parameters[]');
            
            if ($this->form_validation->run())
            {       
                   $data['module_name']         = $this->input->post('module_name',TRUE);
                   $data['module_parameters']   = serialize($this->input->post('module_parameters',TRUE));
                   $data['module_active']       = $this->input->post('module_active',TRUE);
                   $this->modules_model->update_element($data,$id);
                   
                   $this->session->set_flashdata('success',lang('manager_message_success_save'));
                   redirect($this->_uri_segment('return'));          
            }
            
            if($result = $this->modules_model->get_element($id))
            {
                    $this->template->set('item',$result)
                                   ->set_partial('parameters',$result['module_uname'].'/module_parameters')
                                   ->build('manager/manager_modules_edit');
            }
            else
            {
                $this->session->set_flashdata('error',lang('manager_message_undefined'));
                redirect($this->_uri_segment('return'));             
            }
	}
        
        public function up()
	{
            $id = $this->uri->segment(4,0);
            $this->modules_model->up_element($id);
            redirect($this->_uri_segment('return'));
	}
        
        public function down()
	{
            $id = $this->uri->segment(4,0);
            $this->modules_model->down_element($id);
            redirect($this->_uri_segment('return'));
	}
        
        private function _uri_segment($t = FALSE)
        {
           $return['return'] = $this->session->userdata('offset') ? 'manager/modules/index/'.$this->session->userdata('offset') : 'manager/modules'; 
           $return['root'] = 'manager/modules'; 
           return $t ? base_url($return[$t]) : $return;
        }
}

/* End of file manager.php */
/* Location: ./application/modules/modules/controllers/manager.php */
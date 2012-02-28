<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends Manager_Controller {
        
        public function __construct()
	{
  		parent::Manager_Controller();
                $this->lang->load('brands');
                $this->load->model('brands_model');
                
                $this->template->append_metadata(editor_init())
                               ->set('uri_segment',$this->_uri_segment());
 	}
	
        public function index()
	{            
            $pagination = pagination($this->_uri_segment('root'),count($this->brands_model->get_elements()));
            
            $this->template->set('listing',$this->brands_model->set_limit(element(0,$pagination['limit']),element(1,$pagination['limit']))->get_elements())
                           ->set('pagination',$pagination['links'])
                           ->build('manager/manager_brands_listing');	
	}
        
        public function create()
	{                        
            $this->form_validation->set_rules('brands_name','lang:brands_name','trim|required');
            $this->form_validation->set_rules('brands_active','lang:brands_active','trim');
          
            if ($this->form_validation->run())
            {       
                  $data['brands_name'] = $this->input->post('brands_name',TRUE);
                  $data['brands_active'] = $this->input->post('brands_active',TRUE);
		 
                  $this->brands_model->add_element($data);
                  
                  $this->session->set_flashdata('success',lang('manager_message_success_create'));
                  redirect($this->_uri_segment('return'));
            }

            $this->template->build('manager/manager_brands_create');
	}
        
        public function edit()
	{            
            $id = $this->uri->segment(4,0);
            
            $this->form_validation->set_rules('brands_name','lang:brands_name','trim|required');
            $this->form_validation->set_rules('brands_active','lang:brands_active','trim');
            
            if ($this->form_validation->run())
            {       
                  $data['brands_name'] = $this->input->post('brands_name',TRUE);
                  $data['brands_active'] = $this->input->post('brands_active',TRUE);
                                    
                  $this->brands_model->update_element($data,$id);
                  
                  $this->session->set_flashdata('success',lang('manager_message_success_save'));
                  redirect($this->_uri_segment('return'));     
            }

            if($result = $this->brands_model->set_where('brands_id',$id)->get_element())
            {
                    $this->template->set('item',$result)
                                   ->build('manager/manager_brands_edit');
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
            $uri_segment_return = base_url(element('root',$this->_uri_segment()));
            $this->brands_model->delete_element($id);
            $this->session->set_flashdata('success',lang('manager_message_success_delete'));
            redirect($this->_uri_segment('return'));
	}
        
        public function up()
	{
            $id = $this->uri->segment(4,0);
            $this->brands_model->up_element($id);
            redirect($this->_uri_segment('return'));
	}
        
        public function down()
	{
            $id = $this->uri->segment(4,0);
            $this->brands_model->down_element($id);
            redirect($this->_uri_segment('return'));
	}

        private function _uri_segment($t = FALSE)
        {
           $return['return'] = $this->session->userdata('offset') ? 'manager/brands/index/'.$this->session->userdata('offset') : 'manager/brands'; 
           $return['root'] = 'manager/brands'; 
           return $t ? base_url($return[$t]) : $return;
        }
}

/* End of file manager.php */
/* Location: ./application/modules/brands/controllers/manager.php */
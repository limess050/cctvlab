<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends Manager_Controller {
        
        public function __construct()
	{
  		parent::Manager_Controller();
                $this->lang->load('images');
                $this->load->model('images_model'); 
                $this->template->set('uri_segment',$this->_uri_segment());
 	}
        
        function index()
        {
            $this->template->build('manager/manager_images_listing');	
        }
        
        function action()
        {
            switch ($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                $this->_get($this->uri->segment(4,0),$this->uri->segment(5,0));
                break;
                case 'POST':
                if ($this->uri->segment(4,0) == 'delete')
                {
                    $this->_delete($this->uri->segment(5,0));
                    break;
                }
                $this->_post($this->uri->segment(4,0),$this->uri->segment(5,0));
                break;
            }
        }
        
        function _get($module_name,$images_code)
	{
            $upload_path_url = base_url().'upload/images/';
            
            $result = $this->images_model->set_where('images_code',$images_code)
                                         ->set_where('module_name',$module_name)
                                         ->get_elements();
            
            if($result)
            {
                $i=0;
                foreach($result as $row)
                {
                    $ret_data[$i]['name'] = $row['images_orig_name'];
                    $ret_data[$i]['size'] = $row['images_file_size'];
                    $ret_data[$i]['type'] = $row['images_file_ext'];
                    $ret_data[$i]['url'] = $upload_path_url .$row['images_file_name'];
                    $ret_data[$i]['thumb_url'] = $upload_path_url .$row['images_thumb'];
                    $ret_data[$i]['delete_url'] = $this->_uri_segment('root').'/action/delete/'.$row['images_id'];
                    $ret_data[$i]['delete_type'] = 'POST';
                    $i++;
                }  
                
                echo json_encode(array($ret_data)); 
            }            
        }            
        
	function _post($module_name,$images_code)
	{            
                $upload_path_url = base_url().'upload/images/';

                $config['upload_path'] = './upload/images/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2000';
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload',$config);

                if (!$this->upload->do_upload())
                {
                    $ret_data['error'] = $this->upload->display_errors('','');
                    $ret_data['name']  = $_FILES['userfile']['name'];
                    $ret_data['size']  = $_FILES['userfile']['size'];

                    echo json_encode(array($ret_data));   
                }
                else
                {
                    $data = $this->upload->data();
                    
                    $config['source_image'] = $data['full_path'];
                    $config['width'] = 80;
                    $config['height'] = 80;
                    $config['maintain_ration'] = TRUE;
                    $config['create_thumb'] = TRUE;
                    $config['thumb_marker'] = '_thumb';
                    
                    $this->load->library('image_lib',$config);
                    $this->image_lib->resize();
                    
                    $add_data['images_code'] = $images_code;
                    $add_data['images_file_name'] = $data['file_name'];
                    $add_data['images_orig_name'] = $data['orig_name'];
                    $add_data['images_file_ext'] = $data['file_ext'];
                    $add_data['images_thumb'] = $data['raw_name'].'_thumb'.$data['file_ext'];
                    $add_data['images_file_size'] = $data['file_size'];
                    $add_data['images_active'] = 1;
                    $add_data['module_name'] = $module_name;
                    
                    $result = $this->images_model->set_where('images_code',$images_code)
                                                 ->set_where('module_name',$module_name)
                                                 ->add_element($add_data);
                        
                    $ret_data['name'] = $data['orig_name'];
                    $ret_data['size'] = $data['file_size'];
                    $ret_data['type'] = $data['file_type'];
                    $ret_data['url'] = $upload_path_url .$data['file_name'];
                    $ret_data['thumb_url'] = $upload_path_url .$result['images_thumb'];
                    $ret_data['delete_url'] = $this->_uri_segment('root').'/action/'.$result['images_id'];
                    $ret_data['delete_type'] = 'DELETE';
                    
                    $this->config->load($module_name.'/config'); // загружаем конфигурационный файл модуля из которого берем размеры эскизов для изображения ('имя модуля'_thumb_size)
                    
                    $resize_option['module']            = $module_name;
                    $resize_option['size']              = $this->config->item($module_name.'_thumb_size');
                    $resize_option['filename']          = $data['file_name'];
                    $this->images_library->make_images($resize_option);
   
                    echo json_encode(array($ret_data));
                }
        }
        
        function _delete($images_id)
	{
            $result = $this->images_model->delete_element($images_id);
            
            $this->config->load($result['module_name'].'/config');  // загружаем конфигурационный файл модуля из которого берем размеры эскизов для изображения ('имя модуля'_thumb_size)
            $sizes = $this->config->item($result['module_name'].'_thumb_size');
                    
            foreach($sizes as $size)
            {
                unlink('./upload/images/'.$result['module_name'].'/thumb_'.$size.'/'.$result['images_file_name']);
            }
            unlink('./upload/images/'.$result['images_file_name']);
            unlink('./upload/images/'.$result['images_thumb']);
        } 

        private function _uri_segment($t = FALSE)
        {
           $return['return'] = $this->session->userdata('offset') ? 'manager/images/index/'.$this->session->userdata('offset') : 'manager/images'; 
           $return['root'] = 'manager/images'; 
           return $t ? base_url($return[$t]) : $return;
        }
}

/* End of file manager.php */
/* Location: ./application/modules/images/controllers/manager.php */

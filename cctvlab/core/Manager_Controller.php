<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Manager_Controller extends CI_Controller {

	public function Manager_Controller($check_access = TRUE)
	{
		parent::__construct();
                
                $this->load->library('administrators/administrators_library');
                $this->lang->load('manager');
                $this->load->library('users/users_library');
                
                $this->current_module = $this->uri->segment(2); // текущеий модуль
                $this->current_administrator = $this->administrators_library->current_administrator(); // данные текущего администратора
                $this->parameters = $this->modules_library->parametrs($this->current_module); // параметры текущего модуля
                
                // разрешаем доступ к модулю либо перенаправляем на страницу авторизации 
                if($check_access)
                {
                    if(!$this->modules_library->permissions($this->current_module,$this->current_administrator))
                    {
                        redirect(base_url('manager'));
                    }
                    else
                    {
                        $this->template->set('mmenu',$this->modules_library->mmenu($this->current_administrator))
                                       ->set('current_module',$this->current_module)
                                       ->set_partial('notifications','partials/notifications')
                                       ->set_theme('manager_default')
                                       ->set_layout('default');
                    }
                }
	}
}


/* End of file manager_controller.php */
/* Location: ./application/core/manager_controller.php */
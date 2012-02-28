<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Public_Controller extends CI_Controller {

	public function Public_Controller()
	{
		parent::__construct();

                $this->load->library('modules/modules_library');
                $this->load->library('users/users_library');
                $this->lang->load('public');

                $this->current_module = $this->uri->segment(1,'blog');
                $this->current_user = $this->users_library->current_user();
                //$this->current_social_user = $this->users_library->current_social_user();
                $this->parameters = $this->modules_library->parametrs($this->current_module);
                $this->template->set_theme('public_corona')
                               ->set('breadcrumbs','')
                               ->set('current_module',$this->current_module)
                               ->set_partial('toolbar','partials/toolbar')
                               ->set_partial('search','partials/search')
                               ->set_partial('mmenu','partials/mmenu')
                               ->set_partial('breadcrumbs','partials/breadcrumbs')
                               ->set_partial('notifications','partials/notifications')
                               ->set_partial('mmenu','partials/mmenu')
                               ->set_partial('bottom','partials/bottom')
                               ->set_partial('footer','partials/footer')
                               ->title(element(0,$this->parameters))
                               ->set_layout('default');

        }
}


/* End of file public_controller.php */
/* Location: ./application/core/public_controller.php */
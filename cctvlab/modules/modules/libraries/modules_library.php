<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Modules_library {

        function __construct()
        {
            $this->ci =& get_instance();
            $this->ci->load->model('modules/modules_model');
            $this->ci->lang->load('modules/modules');

            log_message('debug', 'Modules_library Initialized');
        }

        function mmenu ($administrator)
        {
            if(!$administrator) return FALSE;

            return $this->ci->modules_model->set_permissions($administrator['administrator_group'])
                                           ->get_modules();
        }

        function mmenu_public ()
        {
            return $this->ci->modules_model->set_where('modules_mmenu_public',1)
                                           ->get_modules();
        }

        function permissions ($module,$administrator)
        {
            if(!$administrator) return FALSE;

            $result = $this->ci->modules_model->set_permissions($administrator['administrator_group'])
                                              ->set_where ('module_uname',$module)
                                              ->get_modules();

            if($result) return TRUE;
            else return FALSE;
        }

        function parametrs($module,$n = -1)
        {
            $result = $this->ci->modules_model->set_where ('module_uname',$module)
                                              ->get_module();
            
            $return = isset ($result['module_parameters']) ? unserialize($result['module_parameters']) : array();
            $return['name'] = isset($result['module_name']) ? $result['module_name'] : FALSE;
            return $n>-1 ? (isset($return[$n]) ? $return[$n] : FALSE) : $return;
        }
}

/* End of file modules.php */
/* Location: ./application/modules/modules/libraries/modules.php */
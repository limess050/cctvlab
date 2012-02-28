<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search {
	function Search()
	{
            
		$this->ci =& get_instance();
		log_message('debug', "Search Class Initialized");
                if ($this->ci->uri->segment(1,0) == 'manager')
                {
                    $this->module = 'manager/'.$this->ci->uri->segment(2,0);
                }
                else
                {
                    $this->module = $this->ci->uri->segment(1,0);
                }
	}
        
        
	
	function write($input)
	{
                $this->ci->session->set_userdata(array('search'=>array($this->module => $input)));
	}
	
	function read()
	{
		return element($this->module, $this->ci->session->userdata('search'));
	}
	
	function reset()
	{
		$this->ci->session->unset_userdata('search');
	}
	
}


?>
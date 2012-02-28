<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Administrators_library {
	
	function __construct()
        {
            $this->ci = & get_instance();
            $this->ci->load->model('administrators/administrators_model');
            $this->ci->lang->load('administrators/administrators');

            log_message('debug', 'Administrators_library Initialized');
        }

	function login($username,$password)
	{   
                $query = $this->ci->administrators_model->set_where('administrator_username',$username)
                                                        ->set_where('administrator_password',sha1(md5($password)))
                                                        ->set_where('administrator_active',1)
                                                        ->get_element();
                
                if(!$query)
                {
                    $newdata = array('login_administrator'=>FALSE);
                    $this->ci->session->set_userdata($newdata);
                    $this->set_error('administrators_errors_login');
                    return FALSE;
                }
                else
                {
                    $newdata = array('administrator_username'=>$username,'administrator_password'=>sha1(md5($password)),'login_administrator'=>TRUE);
                    $this->ci->session->set_userdata($newdata);
                    return $query;
                }
	}
	
        function logged_in()
	{
		return $this->ci->session->userdata('login_administrator');
	}
        
	function logout()
	{
                $array_items = array('administrator_username'=>FALSE,'administrator_password'=>FALSE,'login_administrator'=>FALSE);
		$this->ci->session->unset_userdata($array_items);               
	}
        
	function current_administrator()
	{   
                 return $this->ci->administrators_model->set_where('administrator_username',$this->ci->session->userdata('administrator_username'))
                                                       ->set_where('administrator_password',$this->ci->session->userdata('administrator_password'))
                                                       ->get_element();               
	}
	
	function registration_administrator($data)
	{
                if($query = $this->ci->administrators_model->set_where('administrator_username',$data['administrator_username'])->get_element())
                {
                    $this->set_error('administrators_error_username');
                    return FALSE;
                }
                else
                {
                    $data['administrator_password'] = $this->hash_password($data['administrator_password']);                
                    $this->ci->administrators_model->add_element($data);
                    return TRUE;
                }
	}
        
        function update_administrator($data,$id)
	{   
                if($this->ci->administrators_model->set_where('administrator_username',$data['administrator_username'])->set_where('administrator_id !=',$id)->get_element())
                {
                    $this->set_error('administrators_error_username');
                    return FALSE;
                }
                else
                {   if($data['administrator_password']) $data['administrator_password'] = $this->hash_password($data['administrator_password']);
                    else unset($data['administrator_password']); 
                    $this->ci->administrators_model->update_element($data,$id);
                    return TRUE;
                }
	}

        public function set_message($message)
	{
		$this->messages[] = $message;
		return $message;
	}

	public function messages()
	{
		$_output = '';
		foreach ($this->messages as $message)
		{
			$_output .= '<p>'.lang($message).'</p>';
		}
		return $_output;
	}

	public function set_error($error)
	{
		$this->errors[] = $error;
		return $error;
	}

	public function errors()
	{
		$_output = '';
		foreach ($this->errors as $error)
		{
			$_output .= '<p>'.lang($error).'</p>';
		}

		return $_output;
	}
        
        public function hash_password($password)
	{
	    if (empty($password))
	    {
	    	return FALSE;
	    }

            return  sha1(md5($password));
	}
}

/* End of file administrators_library.php */
/* Location: ./application/modules/administrators/libraries/administrators_library.php */
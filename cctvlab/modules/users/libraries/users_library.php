<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_library {
	
	function __construct()
        {
            $this->ci = & get_instance();
            $this->ci->load->model('users/users_model');
            $this->ci->lang->load('users/users');

            log_message('debug', 'users_library Initialized');
        }
        
        function isset_username($username)
        {
            if ($this->ci->users_model->set_where('user_username', $username)->set_where('user_id !=',$this->ci->session->userdata('user_id'))->get_element())
            {
                return TRUE;
            }
            return FALSE;
        }
        
        function activate($activation_code)
        {
            if($query = $this->ci->users_model->set_where('user_activation_code', $activation_code)->get_element())
            {
                $query['user_active'] = 1;
                $this->ci->users_model->update_element($query, $query['user_id']);
                return $query;
            }
            else
            {
                return FALSE;
            }
        }

	function login($username,$password, $cryFlag = TRUE)
	{
                if ($cryFlag)
                    $query = $this->ci->users_model->set_where('user_username',$username)
                                                        ->set_where('user_password',sha1(md5($password)))
                                                        ->set_where('user_active',1)
                                                        ->get_element();
                else
                    $query = $this->ci->users_model->set_where('user_username',$username)
                                                        ->set_where('user_password',$password)
                                                        ->set_where('user_active',1)
                                                        ->get_element();
                if(!$query)
                {
                    $newdata = array('user_login'=>FALSE);
                    $this->ci->session->set_userdata($newdata);
                    $this->set_error('errors_login');
                    return FALSE;
                }
                else
                {
                    $user_id = $query['user_id'];
                    $newdata = array('user_id'=>$user_id, 'user_login'=>TRUE);
                    $this->ci->session->set_userdata($newdata);
                    return $query;
                }
	}
        function social_login($data)
        {
            $query = $this->ci->users_model->set_where('user_uid',$data['user_uid'])
                                                        ->set_where('user_provider',$data['user_provider'])
                                                        ->set_where('user_active',1)
                                                        ->get_element();
            $user_id = $query['user_id'];
            if(!$query)
                {
                    $newdata = array('user_login'=>FALSE);
                    $this->ci->session->set_userdata($newdata);
                    $this->set_error('errors_login');
                    return FALSE;
                }
                else
                {
                    $newdata = array('user_id'=>$user_id,'user_login'=>TRUE);
                    $this->ci->session->set_userdata($newdata);
                    return $query;
                }
        }
        
        function get_social_user($data)
        {
            if($this->ci->users_model->set_where('user_uid',$data['user_uid'])->set_where('user_provider', $data['user_provider'])->get_element())
                {
                    return TRUE;
                }
        }
	
        function logged_in()
	{
		return $this->ci->session->userdata('login');
	}
        
	function logout()
	{
                $array_items = array('user_login'=>FALSE, 'user_id'=>FALSE);
		$this->ci->session->unset_userdata($array_items);               
	}
        
	function current_user()
	{   
                 return $this->ci->users_model->set_where('user_id',$this->ci->session->userdata('user_id'))
                                              ->get_element();               
	}
//        function current_social_user()
//        {
//                 return $this->ci->users_model->set_where('user_id',$this->ci->session->userdata('user_id'))
//                                              ->get_element();
//        }


        function registration_user($data)
	{
                if($query = $this->ci->users_model->set_where('user_username',$data['user_username'])->get_element())
                {
                    $this->set_error('users_error_username');
                    return FALSE;
                }
                else
                {
                    $data['user_password'] = $this->hash_password($data['user_password']);                
                    $this->ci->users_model->add_element($data);
                    return TRUE;
                }
	}
        
        function update_user($data,$id)
	{
                if (!empty($data['user_password']))
                    $data['user_password'] = $this->hash_password($data['user_password']); 
                //print_r($data);
//                if($this->ci->users_model->//set_where('user_username',$data['user_username'])
//                                         ->set_where('user_id !=',$id)->get_element())
//                {
//                    $this->set_error('users_error_username');
//                    return FALSE;
//                }
//                else
//                {   
                $this->ci->users_model->update_element($data,$id);
                return TRUE;
//                }
	}
        function update_social_user($data)
        {
            if($this->ci->users_model->set_where('user_uid',$data['user_uid'])->set_where('user_provider', $data['user_provider'])->get_element())
                {
                    $this->ci->users_model->update_social_element($data);
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

/* End of file users_library.php */
/* Location: ./application/modules/users/libraries/users_library.php */

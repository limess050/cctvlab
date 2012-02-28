<?php
    class Social_authorization extends Public_Controller {
        
        public function __construct()
        {
            parent::Public_Controller(FALSE);       
        }
        public function index()
        {
            $token = $this->input->post('token', TRUE);
            $result = file_get_contents("http://loginza.ru/api/authinfo?token=$token");
            $result = json_decode($result, TRUE);
            //print_r($result);
            if (!(isset($result['error_message'])))
            {
                switch ($result['provider'])
                {
                    case "https://www.google.com/accounts/o8/ud": $data = $this->googleAuth($result); break;
                    case "http://vkontakte.ru/": $data = $this->vkontakteAuth($result); break;
                    case "http://twitter.com/": $data = $this->twitterAuth($result); break; 
                }
                $data['user_group']         = 'user1';
                $data['user_provider']           = $result['provider'];
                $data['user_uid']                = (int)$result['uid'];
                $data['user_password']           = NULL;
                $data['user_date_register']      = date('Y-m-d H:i:s');
                
                if (!($this->users_library->get_social_user($data)))
                {
                    if ($this->users_library->registration_user($data))
                    {
                        if($this->users_library->social_login($data))
                        {
                            redirect(base_url('users/personal_office'));
                        }
                    }
                }
                else
                {
                    if($this->users_library->social_login($data)) //Сделать отдельный метод для логина
                        {
                            redirect(base_url());
                        }
                }
            }else
                {
                    echo "ОШИБКА: ".$result['error_message'];
                }

        }
        public function googleAuth($result)
        {
            $data = array();
            if ($result['email'])
                {
                    $data['user_username'] = $result['email'];
                    $data['user_email'] = $result['email'];
                }
            if (isset($result['name']))
                {
                    if (isset($result['name']['first_name']))
                    {
                        $data['user_first_name'] = $result['name']['first_name'];
                        if (isset($result['name']['last_name']))
                        {
                            $data['user_last_name'] = $result['name']['last_name'];
                        }
                    }
                }
            return $data;
        }
        public function vkontakteAuth($result)
        {
            $data = array();
            $data['user_email'] = '';
            $data['user_username'] = $result['name']['first_name'].' '.$result['name']['last_name'];
            if (isset($result['name']))
                {
                    if (isset($result['name']['first_name']))
                    {
                        $data['user_first_name'] = $result['name']['first_name'];
                        if (isset($result['name']['last_name']))
                        {
                            $data['user_last_name'] = $result['name']['last_name'];
                        }
                    }
                }
             return $data;
        }
        public function twitterAuth($result)
        {
            $data = array();
            $data['user_email'] = '';
            $data['user_username'] = $result['nickname'];
            if (isset($result['name']))
                {
                    if (isset($result['name']['first_name']))
                    {
                        $data['user_first_name'] = $result['name']['first_name'];
                        if (isset($result['name']['last_name']))
                        {
                            $data['user_last_name'] = $result['name']['last_name'];
                        }
                    }
                }
             return $data;
        }
    }
?>

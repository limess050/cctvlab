<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lenses_library {


    /**
     * Указатель на статус-файл
     */
    private $status_file = '';

    function __construct()
    {
        $this->ci = & get_instance();
        $this->ci->load->model('lenses/lenses_model');
        $this->ci->lang->load('lenses/lenses');
        $this->ci->load->helper('calculate');
        log_message('debug', 'lenses_library Initialized');

        $this->error_start_delimiter = '';
        $this->error_end_delimiter = '<br />';
        $this->message_start_delimiter = '';
        $this->message_end_delimiter   = '<br />';
    }



    function check_update()
    {
        try
        {
            $this->status_file = parse_ini_file($this->config->item('ftp_adr'));
        }
        catch (Exception $e)
        {
            $this->set_error(lang('lenses_error_status-file_not_open').' ('.$e->getMessage().')');
            return FALSE;
        }
        foreach($this->status_file as $lens)
        {
            if ($lens['status'] == $this->config->item('lenses_download_status'))
            {
                if(isset($lens['filename']) AND !empty($lens['filename']))
                {
                    if($this->update_lenses($lens['filename']))
                    {
                        $lens['status'] = $this->config->item('complete_downloaded');
                    }
                }
                else
                {

                }
            }
        }
    }

    /**
     * Парсит xml документ, с данными о объективах и записывает эти данные в БД
     *
     *  @access public
     *  @param string $filename
     *  @return array $stat
     */
    function update_lenses($filename)
    {
        try
        {
            if(!@$xmlstr = file_get_contents($filename))
            {
               throw new Exception(lang('lenses_error_file_not_open'));
            }
            @$xml = new SimpleXMLElement($xmlstr);
        }
        catch (Exception $e)
        {

            $this->set_error(lang('lenses_error_xml_file_incorrect').' ('.$e->getMessage().')');
            return FALSE;
        }
        $data = array();
        $this->ci->lenses_model->delete_new_flag(); //У всех объективов у которых сейчас стоит статус "новый", статус снимается
        foreach ($xml as $item)
        {
            $group_flag = TRUE;
            $data['lenses_code']                                                = (string) $item->lens_id;
            if ($data['lenses_code'] == 0 OR empty($data['lenses_code']))
            {
                $this->set_error(lang('lenses_error_no_null_lenses_code'));
            }
            $data['lenses_model']                                               = (string) $item->model;
            if (!$this->_data_isset($data['lenses_model']))
            {
                $this->set_error(lang('lenses_error_not_model'));
            }
            $data['lenses_brand']                                               = (string) $item->brands;
            if (!$this->_data_isset($data['lenses_brand']))
            {
                $this->set_error(lang('lenses_error_not_brands'));
            }
            $data['lenses_new']                                                 = 1;
            $data['lenses_added_on']                                            = now();
            foreach ($item->focus as $focus)
            {
                $data_param['lenses_parameters_focal']                          = (string) $focus->focus_type;
                $data_param['lenses_parameters_focal_min']                      = (string) $focus->focus_min;
                $data_param['lenses_parameters_focal_max']                      = (string) $focus->focus_max;
            }
            $data_param['lenses_parameters_matrix']                             = (string) $item->matrix_format;
            $data_param['lenses_parameters_mount']                              = (string) $item->mount_type;
            foreach ($item->aperture as $aperture)
            {
                $data_param['lenses_parameters_aperture']                       = (string) $aperture->aperture_type;
                $data_param['lenses_parameters_aperture_max']                   = (string) $aperture->aperture_max;
                $data_param['lenses_parameters_aperture_min']                   = (string) $aperture->aperture_min;
            }
            foreach ($item->angle as $angle)
            {
                foreach($angle->horizontal_angle as $horizontal_angle)
                {
                    $data_param['lenses_parameters_angle_horizontal_min']             = (string) $horizontal_angle->angle_min;
                    $data_param['lenses_parameters_angle_horizontal_max']             = (string) $horizontal_angle->angle_max;
                }
                foreach($angle->vertical_angle as $vertical_angle)
                {
                    $data_param['lenses_parameters_angle_vertical_min']               = (string) $vertical_angle->angle_min;
                    $data_param['lenses_parameters_angle_vertical_max']               = (string) $vertical_angle->angle_max;
                }
            }
            $data_param['lenses_parameters_weight']                             = (string) $item->weight;
            $data_param['lenses_parameters_dimension']                          = (string) $item->size;
            $data_param['lenses_parameters_correction']                         = (string) $item->if_correction;
            $data_param['lenses_code']                                          = $data['lenses_code'];

            if ($errors = $this->errors())
            {
                return FALSE;
            }
            if (!$this->ci->lenses_model->get_lens('lenses_code', $data['lenses_code']))
            {
                $data['lenses_new'] = 1;
                $insert_id = $this->ci->lenses_model->import($data);
                $this->ci->lenses_model->insert_parameters($data_param, $data['lenses_code']);
                $this->set_message(sprintf(lang('lenses_add_on_site'), $data['lenses_model']));
            }
            else
            {
                $data['lenses_new'] = 0;
                $this->ci->lenses_model->update_element($data, element('lenses_id', $this->ci->lenses_model->get_lens('lenses_code', $data['lenses_code']) ));
                $insert_id = $data['lenses_code'];
                $this->ci->lenses_model->update_parameters($data_param, $data['lenses_code']);
                $this->set_message(sprintf(lang('lenses_update_on_site'), $data['lenses_model']));
            }
            foreach ($item->test_group as $test_group)
            {
                $flag = FALSE;
                if ($this->ci->lenses_model->get_test_group((string) $test_group->group_id))
                {
                    $this->ci->lenses_model->delete_group_test((string) $test_group->group_id);
                    $flag = TRUE;
                }
                if (!$flag)
                {
                    $this->create_test_group((string) $test_group->group_id, (string)$test_group->group_description);
                }
                $testing['lenses_group_id']                     = (string) $test_group->group_id;
                foreach($test_group->tests as $tests)
                {
                    foreach($tests->test as $test)
                    {
                        $testing['lenses_code']                             = $data['lenses_code'];
                        $testing['testing_id']                              = (string) $tests->test->attributes()->id;
                        $testing['lenses_algoritm_version']                 = (string) $test->algoritm_version;
                        $testing['lenses_camera_model']                     = (string) $test->camera_model;
                    }
                    foreach ($tests->test->test_data as $item)
                    {
                        $testing['lenses_testing_value_chart']          = (string) $item->points;
                        $testing['lenses_testing_value_chart_2']        = (string) $item->curvature_points;
                        $testing['lenses_testing_value_aperture']       = (string) $item->aperture;
                        $testing['lenses_testing_value_focal']          = (string) $item->focus;
                        $testing['lenses_code']                         = $data['lenses_code'];

                        if ($this->ci->lenses_model->get_test($testing['lenses_code'], $testing['lenses_group_id']) AND $group_flag )
                        {
                            $this->ci->lenses_model->delete_test($testing['lenses_code']);
                            $group_flag = FALSE;
                        }
                        $this->ci->lenses_model->import($testing, 'testing');
                        $group_flag = FALSE;
                    }
                }
            }
        }
        return TRUE;
    }

    /**
     * Создаем группу тестов
     *
     *  @access public
     *  @param string $group_id
     *  @param string $group_description
     *  @return void
     */

    public function create_test_group($group_id, $group_description)
    {
        $data_test_group['group_id']                    = $group_id;
        $data_test_group['group_description']           = $group_description;
        $this->ci->lenses_model->add_test_group($data_test_group);
    }

    /**
     *
     * Проверка на сушествование данных
     *
     *  @access public
     *  @param mixed $data
     *  @return bool
     */

    private function _data_isset($data)
    {
        if(!empty($data))
            return TRUE;
        else
            return FALSE;
    }

    public function set_error($error)
    {
        $this->errors[] = $error;

        return $error;
    }

    public function errors()
    {
        $_output = '';
        if(isset($this->errors))
        {
            foreach ($this->errors as $error)
            {
                $_output .= $this->error_start_delimiter . $error . $this->error_end_delimiter;
            }
        }
        else
        {
            return FALSE;
        }
        return $_output;
    }
    public function set_message($message)
    {
        $this->messages[] = $message;

        return $message;
    }


    public function messages()
    {
        $_output = '';
        if (isset($this->messages))
        {
            foreach ($this->messages as $message)
            {
                $_output .= $this->message_start_delimiter . $message . $this->message_end_delimiter;
            }

            return $_output;
        }
        else
        {
            return FALSE;
        }
    }


}

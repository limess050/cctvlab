<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends Manager_Controller
{

    public function __construct()
    {
        parent::Manager_Controller();
        $this->lang->load('loader');
        $this->load->model('loader_model');
        $this->load->library('lenses/lenses_library');
        $this->template
            ->set('uri_segment', $this->_uri_segment());
    }

    public function index()
    {
        $this->template
            ->set('listing', $this->loader_model->get_all())
            ->build('manager/manager_loader_listing');

    }

    /*
     * Редактирование настроек загрузки данных
     *
     * @access public
     * @return void
     */

    public function edit()
    {
        $id = $this->uri->segment(4, 0);
        $this->form_validation->set_rules('data_update_status_file', 'lang:loader_adr_status_file', 'trim|required');
        $this->form_validation->set_rules('data_update_upload_interval', 'lang:loader_update_time_interval', 'trim|required');
        if ($this->form_validation->run()) {
            $data['data_update_status_file'] = $this->input->post('data_update_status_file', TRUE);
            $data['data_update_upload_interval'] = $this->input->post('data_update_upload_interval', TRUE);
            $this->loader_model->set_settings($id, $data);
            $this->session->set_flashdata('success', lang('loader_messages_settings_updated'));
            redirect('/manager/loader/');
        }
        $this->template
            ->set('settings', $this->loader_model->get_settings($this->uri->segment(4, 0)))
            ->build('manager/manager_loader_edit');
    }


    /*
     * Загрузка новых данных из настроенного источника
     *
     * @access public
     * @param bool принудительное обновление
     * @return void
     */
    function check_update($forcibly = FALSE)
    {
        $settings = $this->loader_model->get_settings_by_module('lenses'); //Получение настроек загрузки данных для данного модуля
        if ($settings['data_update_last_update'] + $settings['data_update_upload_interval'] * 3600 < now() OR $forcibly) //Если время прошедшее с последнего обновления больше заданного или обновление выполняется принудительно
        {
            $status_file = '';
            try
            {
                if (!@$json = file_get_contents($settings['data_update_status_file'])) //Пробуем открыть статус файл
                {
                    throw new Exception(lang('loader_error_status-file_not_open')); //Если нет, возбуждаем исключение
                }
                if (!$status_file = json_decode($json, TRUE)) //Пробуем считать json данные
                {
                    throw new Exception(lang('loader_error_invalid_json')); //Если json не валидный, возбуждаем исключение
                }
            }
            catch (Exception $e)
            {
                $this->session->set_flashdata('error', $e->getMessage()); //Обрабатываем исключения, пишем ошибки
                redirect('/manager/loader/');
            }
            foreach ($status_file['lenses'] as &$lens)
            {
                if ($lens['status'] == 0) //Если статус = готов к загрузке
                {
                    if (isset($lens['filename']) AND !empty($lens['filename'])) //Проверяем записано ли имя xml документа
                    {
                        if ($this->lenses_library->update_lenses($lens['filename'])) //Загружаем данные из xml
                        {
                            $lens['status'] = 1; //Устанавливаем статус - успешно загружен
                            $lens['upload_datetime'] = now(); //Пишем время последнего обновления
                            $data['data_update_last_update'] = &$lens['upload_datetime'];
                        }
                        else
                        {
                            $this->session->set_flashdata('error', $this->lenses_library->errors());
                            redirect('/manager/loader/');
                        }
                    }
                    else
                    {
                        $this->session->set_flashdata('error', lang('loader_error_file_not_found'));
                        redirect('/manager/loader/');
                    }
                }
                if (isset($data['data_update_last_update']))
                    $this->loader_model->set_settings($settings['data_update_id'], $data);
            }
            $json = json_encode($status_file);
            try
            {
                if (!@file_put_contents($settings['data_update_status_file'], $json)) //Записываем изменения обратно в статус-файл
                    throw new Exception(lang('loader_error_update_success_but_status-file'));
            }
            catch (Exception $e)
            {
                $this->session->set_flashdata('error', $e->getMessage());
                redirect('/manager/loader/');
            }

            $this->session->set_flashdata('success', $this->lenses_library->messages() ? $this->lenses_library->messages() : lang('loader_messages_update_success_not_new'));
            redirect('/manager/lenses/');
        }
    }

    private function _uri_segment($t = FALSE)
    {
        $return['return'] = $this->session->userdata('offset') ? 'manager/loader/index/' . $this->session->userdata('offset') : 'manager/loader';
        $return['root'] = 'manager/loader';
        return $t ? base_url($return[$t]) : $return;
    }
}

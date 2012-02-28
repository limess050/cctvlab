<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lenses extends Public_Controller
{

    public function __construct()
    {
        parent::Public_Controller();
        $this->load->library('search');
        $this->lang->load('lenses');
        $this->load->model('lenses_model');
        $this->load->library('brands/brands_library');
        $this->template->set('uri_segment', $this->_uri_segment());
        $this->template->set('keywords', element(1, $this->parameters))
            ->set('description', element(2, $this->parameters))
            ->append_metadata(css_asset('lenses.css', 'lenses'))
            ->append_metadata(css_asset('jquery/jquery-ui-1.8.16.custom.css', 'lenses'))
            ->append_metadata(js_asset('jquery/jquery-ui-1.8.16.custom.min.js', 'lenses'))
            ->append_metadata(js_asset('search.js', 'lenses'))
            ->append_metadata(js_asset('colorbox.js', 'images'))
            ->append_metadata(js_asset('lenses.js', 'lenses'))
            ->set_partial('contentright', 'public/partials/contentright');
        //$this->output->enable_profiler(TRUE);
    }

    public function index()
    {

        $search = $this->search->read();

        $pagination = pagination('/lenses/', count($this->lenses_model
            ->set_where('lenses_active', 1)
            ->get_elements_search($search)), 3, 12);

        $listing = $this->lenses_model
            ->set_limit($pagination['limit'][0], $pagination['limit'][1])
            ->set_where('lenses_active', 1)
            ->get_elements_search($search);

        foreach ($listing as &$item)
        {
            $item['images'] = $this->images_library->get_images($item['lenses_code'], 'lenses', array(element(1, $this->config->item('lenses_thumb_size'))));
        }

        $this->template->set('breadcrumbs', element('name', $this->parameters))
            ->set('search', $search)
            ->set('listing', $listing)
            ->set('pagination', $pagination['links'])
            ->build('public/public_lenses_listing');
    }

    public function item()
    {
        $search = $this->search->read();

        if ($result = $this->lenses_model->set_where('lenses_active', 1)->get_element($this->uri->segment(3, 0))) {
            $this->template->set('breadcrumbs', array(element('name', $this->parameters) => 'lenses', $result['lenses_model']))
                ->set('search', $search)
                ->set('item', $result)
                ->set('images', $this->images_library->get_images($result['lenses_code'], 'lenses', $this->config->item('lenses_thumb_size'), TRUE))
                ->append_metadata(js_asset('chart.js', 'lenses'))
                ->build('public/public_lenses_item');
        }
        else
        {
            $this->session->set_flashdata('error', lang('public_message_undefined'));
            redirect($this->_uri_segment('root'));
        }
    }

    public function search()
    {
        $this->uri->segment(4, 0) == 'reset' ? $this->search->write($this->input->post('search', TRUE)) : $this->search->reset();
        redirect($this->_uri_segment('root'));
    }


    /**
     * Генерирует json данные для графика
     *
     * @access public
     * @return void
     */

    public function export()
    {
        $lenses_code = $this->input->post('lenses_code', TRUE);
        $lens = $this->lenses_model->get_lens('lenses_code', $lenses_code);
        $tests = $this->lenses_model->number_of_test($lens['lenses_code']);
        $groups = $this->lenses_model->get_groups($lens['lenses_code']);
        if ($this->input->post('test_id', TRUE) != '') {
            $test_id = $this->input->post('test_id', TRUE);
        }
        else
            $test_id = $tests[0]['testing_id'];
        if ($result = $this->lenses_model->export($lenses_code, $test_id, $groups[0]['lenses_group_id'])) {
            $return['charts'] = $result[0];
            $return['items'] = array(count($return['charts']), count($return['charts'][0]));
            $return['status'] = 'success';
            $return['scale'] = $result[1];
        }
        else
        {
            $return = array('status' => 'error');
        }
        echo json_encode($return);
    }

    /**
     * Генерирует html страницу, с двумя графиками для модуля сравнения
     *
     * @access public
     * @return void
     */

    public function comparing()
    {
        //--->>>Получаем id объективов<<<---//

        $lenses_id_left = $this->input->post('lenses_id_left', TRUE);

        $lenses_id_right = $this->input->post('lenses_id_right', TRUE);

        //--->>>Получаем пустые данные для левого графика<<<---//

        $data['data']['left'] = $this->_prepare_data_to_comparing('left');

        //--->>>Получаем пустые данные для правого графика<<<---//

        $data['data']['right'] = $this->_prepare_data_to_comparing('right');

        if ($lens_left = $this->lenses_model->get_element($lenses_id_left)) {

            $data['data']['left'] = $this->_prepare_data_to_comparing('left', $lens_left);       // данные для левого графика

        }
        if ($lens_right = $this->lenses_model->get_element($lenses_id_right)) {

            $data['data']['right'] = $this->_prepare_data_to_comparing('right', $lens_right);    // данные для правого графика

        }
        if (isset($data['data']['right']['max']) AND isset($data['data']['left']['max'])) {

            $data['data']['y_max'] = $data['data']['left']['max'] > $data['data']['right']['max'] ? $data['data']['left']['max'] : $data['data']['right']['max'];   //Находим максимальное значение для обоих графиков(разр. способность)

        }
        if (isset($data['data']['right']['curvature_max']) AND isset($data['data']['left']['curvature_max'])) {

            $data['data']['y_curvature_max'] = $data['data']['left']['curvature_max'] > $data['data']['right']['curvature_max'] ? $data['data']['left']['curvature_max'] : $data['data']['right']['curvature_max'];  //Находим максимальное значение для обоих графиков(кривизна)

        }
        unset($data['data']['left']['description']['lenses_title']);    //Удаляем описание(для того что бы некоторые символы не приводили к ошибке)
        unset($data['data']['right']['description']['lenses_title']);

        //--->>>Формируем ответ клиенту<<<---//

        $return['status'] = "success";
        $return['html'] = $this->load->view('public/public_lenses_comparing', $data, TRUE); // Пропускаем данные через шаблон, получаем html код

        echo json_encode($return);
    }

    /**
     * Подготавливает данные для отображения графика
     *
     * @access private
     * @param сторона
     * @param mixed данные о объективе
     * @return array
     */
    private function _prepare_data_to_comparing($side, $lens = FALSE)
    {
        if (!$lens)
        {
            $data['charts'][0][0]['points'] = '[0,0]';
            $data['charts'][0][0]['curvature_points'] = '[0,0]';
            $data['items'] = array(1, 1);
            $data['scale'] = array('points_max' => 500, 'points_min' => 0, 'curvature_max' => 25, 'curvature_min' => 5);
            $data['image'] = FALSE;
            $data['description'] = FALSE;
            $data['select_testing'] = form_dropdown('test_'.$side, array());
            $data['select_lenses'] = form_dropdown('lenses_'.$side, dropdown_elements($this->lenses_model->set_where('lenses_active', 1)->get_elements(), 'lenses_id', 'lenses_model'));

            return $data;
        }
        $tests = $this->lenses_model->number_of_test($lens['lenses_code']);
        $tes = array();
        $groups = $this->lenses_model->get_groups($lens['lenses_code']);
        foreach ($groups as $item)
        {
            $tes[$item['lenses_group_id']] = $this->lenses_model->get_tests($lens['lenses_code'], $item['lenses_group_id']);
            $tes[$item['lenses_group_id']]['testing_id'] = $item['lenses_group_id'].'-'.$tes[$item['lenses_group_id']]['testing_id'];
        }
        //--->>>Запоминаем id группы и id теста, если они есть, иначе запаминаем первые значения из обшего списка <<<---//
        $post_test_id = $this->input->post('test_id_'.$side, TRUE);
        if($post_test_id != 'null' and !empty($post))      // Если существует id теста
        {
            list($group_id, $test_id) = explode( '-', $post_test_id); //Разбиваем его на группу и номер теста
        }
        else
        {
            //Иначе записываем значения по умолчанию
            $group_id = $groups[0]['lenses_group_id'];
            $test_id  = $tests[0]['testing_id'];
        }
        $buff_group_id = '';
        //TODO: Подумать над другим решением(на стороне клиента)
        foreach($groups as $group)
        {
            if($group_id == $group['lenses_group_id'])            //Проверяем, существует ли переданное имя группы в списке
            {
                $buff_group_id = $group['lenses_group_id'];       //Пишем его в буфер
                break;
            }
            else
            {
                $buff_group_id = $groups[0]['lenses_group_id']; //Если переданный id группы не найден среди групп данного объектива, устанавливается группа по умолчанию
            }
        }
        $group_id = $buff_group_id;
        if ($result = $this->lenses_model->export($lens['lenses_code'], $test_id, $group_id)) {
            //--->>>Получаем эти данные<<<---//
            $data['max'] = $result[1]['points_max'];;
            $data['curvature_max'] = $result[1]['curvature_max'];
            $data['charts'] = $result[0];
            $data['items'] = array(count($data['charts']), count($data['charts'][0]));
            $data['image'] = $this->images_library->get_images($lens['lenses_code'], 'lenses', array(element(1, $this->config->item('lenses_thumb_size'))));
            $data['description'] = $lens;
            $data['select_testing'] = form_dropdown('test_'.$side, group_dropdown_elements($tes, 'testing_id', 'testing_id'), $group_id.'-'.$test_id);
            $data['select_lenses'] = form_dropdown('lenses_'.$side, dropdown_elements($this->lenses_model->set_where('lenses_active', 1)->get_elements(), 'lenses_id', 'lenses_model'), $lens['lenses_id']);

            return $data;
        }
    }

    public function add_to_comparing()
    {
        $lens_id = $this->input->post('lenses_id', TRUE);
        $buf = $this->session->userdata('comparing_id');
        if (!empty($buf))
            $comparing = $this->session->userdata('comparing_id') . ';' . $lens_id;
        else
            $comparing = ';' . $lens_id;
        $this->session->set_userdata('comparing_id', $comparing);
        $data['status'] = 'success';
        echo json_encode($data);
    }

    private function _uri_segment($t = FALSE)
    {
        $return['return'] = $this->session->userdata('offset') ? 'lenses/index/' . $this->session->userdata('offset') : 'lenses';
        $return['root'] = 'lenses';
        return $t ? base_url($return[$t]) : $return;
    }

    public function reset()
    {
        $this->search->reset();
        redirect(base_url('lenses'));
    }
}


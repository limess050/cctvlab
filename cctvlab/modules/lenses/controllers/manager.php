<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends Manager_Controller
{

    public function __construct()
    {
        parent::Manager_Controller();
        $this->lang->load('lenses');
        $this->load->model('lenses_model');
        $this->load->library('search');
        $this->load->library('brands/brands_library');
        $this->load->library('images/images_library');
        $this->load->library('lenses_library');
        $this->load->library('blog/blog_library');

        $this->template->append_metadata(editor_init())
            ->append_metadata(js_asset('lenses.js', 'lenses'))
            ->set('uri_segment', $this->_uri_segment());
    }

    public function index()
    {
        //$this->session->unset_userdata('sort');
        $search = $this->search->read();

        $pagination = pagination($this->_uri_segment('root'), count($this->lenses_model->set_search($search)->set_order_by($this->session->userdata('sort'))->get_elements()));
        $this->template->set('listing', $this->lenses_model->set_search($search)->set_limit(element(0, $pagination['limit']), element(1, $pagination['limit']))->set_order_by($this->session->userdata('sort'))->get_elements())
            ->set('pagination', $pagination['links'])
            ->set('search', $search)
            ->set_partial('top_content', 'manager/partials/manager_lenses_search')
            ->set_partial('top_content_2', 'manager/partials/manager_lenses_update')
            ->build('manager/manager_lenses_listing');

    }

    public function edit()
    {
        $id = $this->uri->segment(4, 0);
        $this->form_validation->set_rules('lenses_description', 'lang:lenses_description', 'trim');
        $this->form_validation->set_rules('lenses_title', 'lang:lenses_title', 'trim|required');
        if ($this->form_validation->run()) {

            $data['lenses_description'] = $this->input->post('lenses_description');
            $data['lenses_active']      = $this->input->post('lenses_active', TRUE);
            $data['lenses_title']       = $this->input->post('lenses_title', TRUE);
            $this->lenses_model->update_element($data, $id);
            $lens = $this->lenses_model->get_element($id);

            if ($on_blog = $this->input->post('post_blog'))
            {
                $image = $this->images_library->get_images($lens['lenses_code'], 'lenses', array(element(1,$this->config->item('lenses_thumb_size'))));
                $href  = $id;
                $this->blog_library->create_post_by_lens( $lens, $image, $href);
                $data['lenses_on_blog'] = "1";
                $this->lenses_model->update_element($data, $id);
            }
            $this->session->set_flashdata('success', lang('manager_message_success_save'));
            redirect($this->_uri_segment('return'));
        }

        if ($result = $this->lenses_model->get_element($id)) {
            $this->template->set('item', $result)
                ->build('manager/manager_lenses_edit');
        }
        else
        {
            $this->session->set_flashdata('error', lang('manager_message_undefined'));
            redirect($this->_uri_segment('root'));
        }
    }


    public function delete()
    {
        $id = $this->uri->segment(4, 0);
        if ($this->lenses_model->delete_element($id)) {
            if ($this->images_library->delete_images($id, $this->config->item('lenses_thumb_size'), 'lenses')) {
                $this->session->set_flashdata('success', lang('manager_message_success_delete'));
            }
        }
        redirect($this->_uri_segment('return'));
    }

    public function images()
    {
        $id = $this->uri->segment(4, 0);

        if ($result = $this->lenses_model->get_element_by_code($id)) {
            $this->template->set('item', $result)
                ->set('module_name', 'lenses')
                ->set('images_code', $id)
                ->set_partial('images_upload', 'images/manager/partials/images_upload')
                ->build('manager/manager_lenses_images');
        }
        else
        {
            $this->session->set_flashdata('error', lang('manager_message_undefined'));
            redirect($this->_uri_segment('root'));
        }
    }

    public function order()
    {
        $field = $this->uri->segment(4, 0);
        $sort = $this->session->userdata('sort');
        if (!empty($sort)) {
            if ($sort['field_name'] == $field) {
                if (element('direction', $this->session->userdata('sort')) == 'ASC') {
                    $sort['direction'] = 'DESC';
                }
                else
                {
                    $sort['direction'] = "ASC";
                }
            }
            else
            {
                $sort['field_name'] = $field;
                $sort['direction'] = 'DESC';
                $this->session->unset_userdata('sort');
            }
        }
        else
        {
            $sort['field_name'] = $field;
            $sort['direction'] = 'DESC';
        }
        $this->session->set_userdata('sort', $sort);
        redirect(base_url('manager/lenses'));
    }

    public function update()
    {
        $config['upload_path'] = './upload/lenses_data/';
        $config['allowed_types'] = 'xml';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            if($stat = $this->lenses_library->update_lenses(element('full_path', $this->upload->data())))
                $this->session->set_flashdata('success', $this->lenses_library->messages());
            else
            {
                $this->session->set_flashdata('error', $this->lenses_library->errors());
                redirect('manager/lenses');
            }
        }
        else
        {
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }
        redirect($this->_uri_segment('root'));
    }

    public function up()
    {
        $id = $this->uri->segment(4, 0);
        $this->lenses_model->up_element($id);
        redirect($this->_uri_segment('return'));
    }

    public function down()
    {
        $id = $this->uri->segment(4, 0);
        $this->lenses_model->down_element($id);
        redirect($this->_uri_segment('return'));
    }

    public function search()
    {
        $this->uri->segment(4, 0) == 'reset' ? $this->search->write($this->input->post('search')) : $this->search->reset();
        redirect($this->_uri_segment('root'));
    }

    private function _uri_segment($t = FALSE)
    {
        $return['return'] = $this->session->userdata('offset') ? 'manager/lenses/index/' . $this->session->userdata('offset') : 'manager/lenses';
        $return['root'] = 'manager/lenses';
        return $t ? base_url($return[$t]) : $return;
    }
}

/* End of file manager.php */
/* Location: ./application/modules/lenses/controllers/manager.php */
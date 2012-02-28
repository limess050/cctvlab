<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends Manager_Controller
{

    public function __construct()
    {
        parent::Manager_Controller();
        $this->lang->load('blog');
        $this->load->model('blog_model');
        $this->load->library('blog_library');

        $this->template->append_metadata(editor_init())
            ->set('uri_segment', $this->_uri_segment());
    }

    public function index()
    {
        $pagination = pagination($this->_uri_segment('root'), count($this->blog_model->get_all()), 3, 20);

        $this->template->set('listing', $this->blog_model->set_limit(element(0, $pagination['limit']), element(1, $pagination['limit']))->get_all('manager'))
            ->set('pagination', $pagination['links'])
            ->build('manager/manager_blog_listing');
    }

    public function create()
    {
        $this->form_validation->set_rules('blog_create_on', 'lang:create_on', 'trim|required');
        $this->form_validation->set_rules('blog_title', 'lang:blog_title', 'trim|required');
        $this->form_validation->set_rules('blog_description', 'lang:blog_description', 'trim|required');
        $this->form_validation->set_rules('blog_body', 'lang:blog_body', 'trim|required');
        $this->form_validation->set_rules('blog_active', 'lang:blog_active', 'trim');


        if ($this->form_validation->run()) {

            $data['blog_title'] = $this->input->post('blog_title', TRUE);
            $data['blog_body'] = $this->input->post('blog_body');
            $data['blog_description'] = $this->input->post('blog_description');
            $data['blog_active'] = $this->input->post('blog_active', TRUE);
            $data['blog_create_on'] = date_calendar($this->input->post('blog_create_on', TRUE));
            $data['blog_last_update'] = $data['blog_create_on'];

            $this->blog_model->add_element($data);
            $last_id = element('last_insert_id()', $this->blog_model->last_insert_id());
            $tags = $this->input->post('tags_tag', TRUE);
            $this->blog_library->set_tags($tags, $last_id);
            $this->session->set_flashdata('success', lang('manager_message_success_create'));
            redirect($this->_uri_segment('return'));
        }

        $this->template->build('manager/manager_blog_create');
    }

    public function edit()
    {
        $id = $this->uri->segment(4, 0);
        $this->form_validation->set_rules('blog_create_on', 'lang:create_on', 'trim|required');
        $this->form_validation->set_rules('blog_title', 'lang:blog_title', 'trim|required');
        $this->form_validation->set_rules('blog_body', 'lang:blog_body', 'trim|required');
        $this->form_validation->set_rules('blog_active', 'lang:blog_active', 'trim');
        $this->form_validation->set_rules('blog_description', 'lang:blog_description', 'trim|required');

        if ($this->form_validation->run()) {
            $data['blog_title'] = $this->input->post('blog_title', TRUE);
            $data['blog_body'] = $this->input->post('blog_body');
            $data['blog_active'] = $this->input->post('blog_active', TRUE);
            $data['blog_last_update'] = date('Y-m-d');
            $data['blog_description'] = $this->input->post('blog_description');
            $data['blog_create_on'] = date_calendar($this->input->post('blog_create_on', TRUE));
            $this->blog_model->update_element($data, $id);
            $tags = $this->input->post('tags_tag', TRUE);
            $this->blog_library->set_tags($tags, $id);
            $this->session->set_flashdata('success', lang('manager_message_success_save'));
            redirect($this->_uri_segment('return'));
        }

        if ($result = $this->blog_model->set_where('blog_id', $id)->get_element()) {

            $this->template
                    ->set('item', $result)
                    ->set('tags', $this->blog_library->get_tags($id))
                    ->build('manager/manager_blog_edit');
        }
        else
        {
            $this->session->set_flashdata('error', lang('manager_message_undefined'));
            redirect($this->_uri_segment('root'));
        }
    }

    public function comments_edit($id, $flag = TRUE)
    {
        if ($flag)
            $id = (int)$this->uri->segment(4);
        $record = $this->blog_model->get_record($id);
        $comments = $this->blog_model->get_comments($id);
        $this->template->set('comments', $comments)
            ->build('manager/manager_comment_edit');
    }

    public function comment_edit()
    {
        $edit_done = FALSE;
        $id = (int)$this->uri->segment(4);
        $record_id = (int)$this->uri->segment(5);
        $comments = $this->blog_model->get_comments($record_id);
        $comment = $this->blog_model->get_comment($id);

        $this->form_validation->set_rules('comment_author', 'lang:comment_author', 'trim|required');
        $this->form_validation->set_rules('comment_body', 'lang:comment_body', 'trim|required');
        if ($this->form_validation->run()) {
            $data = $this->input->post();
            $this->blog_model->update_comment($id, $data);
            $this->comments_edit($record_id, FALSE);
        }
        else
        {

            $this->template->set('comment', $comment);
            $this->template->set('comments', $comments)
                ->build('manager/manager_comment_edit');
        }
    }



    function comment_delete($comment_id, $record_id)
    {
        $comment_id = (int)$comment_id;
        $record_id = (int)$record_id;

        if ($this->blog_model->del_comment($comment_id))
            $this->comments_edit($record_id, FALSE);
    }

    public function delete()
    {
        $id = $this->uri->segment(4, 0);
        $uri_segment_return = base_url(element('root', $this->_uri_segment()));
        $this->blog_model->delete_element($id);
        $this->session->set_flashdata('success', lang('manager_message_success_delete'));
        redirect($this->_uri_segment('return'));
    }

    public function up()
    {
        $id = $this->uri->segment(4, 0);
        $this->blog_model->up_element($id);
        redirect($this->_uri_segment('return'));
    }

    public function down()
    {
        $id = $this->uri->segment(4, 0);
        $this->blog_model->down_element($id);
        redirect($this->_uri_segment('return'));
    }

    private function _uri_segment($t = FALSE)
    {
        $return['return'] = $this->session->userdata('offset') ? 'manager/blog/index/' . $this->session->userdata('offset') : 'manager/blog';
        $return['root'] = 'manager/blog';
        return $t ? base_url($return[$t]) : $return;
    }
}

/* End of file manager.php */
/* Location: ./application/modules/about/controllers/manager.php */
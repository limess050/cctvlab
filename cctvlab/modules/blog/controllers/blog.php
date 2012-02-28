<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends Public_Controller
{
	public $limit = 5; // TODO: PS - Make me a settings option

	public function __construct()
	{
		parent::Public_Controller();
		$this->load->model('blog_model');
		$this->load->helper('text');
        $this->load->helper('xml');
		$this->lang->load('blog');

                $this->template
                            ->set('uri_segment',$this->_uri_segment())
                            ->set('keywords',element(1,$this->parameters))
                            ->set('description',element(2,$this->parameters))
                            ->append_metadata(css_asset('blog.css','blog'))
                            ->set_partial('contentright','public/partials/contentright');

	}
        
        public function index()
        {
            $pagination = pagination('/blog/',count($this->blog_model->get_all()),3, 10);

            $this->template->set('breadcrumbs',element('name',$this->parameters))
                            ->set('listing',$this->blog_model->set_limit(element(0,$pagination['limit']),element(1,$pagination['limit']))->get_all())
                            ->set('pagination',$pagination['links'])
                            ->set_partial('maintop', 'public/partials/maintop')
                            ->set_partial('headerbar', 'public/partials/headerbar')
                            ->build('public/public_blog');

        }
        function comments()
        {
            $id= (int)$this->uri->segment(3);
            if ($this->blog_model->get_record($id))
            {
                $record = $this->blog_model->get_record($id);
                $comments = $this->blog_model->get_comments($id);
                $this->template->set('record', $record)
                               ->set('comments', $comments)
                               ->set('breadcrumbs',array($record['blog_title']))
                               ->build('public/public_comments');
            }
            else
            {
                $this->session->set_flashdata('error',lang('public_message_undefined'));
                redirect ('blog'.$record_id);
            }
        }
        function comment_add()
        {
            $this->form_validation->set_rules('comment_author','lang:comment_author','trim|required');
            $this->form_validation->set_rules('comment_body','lang:comment_body','trim|required');
            
            if ($this->form_validation->run())
            {
                if ($this->users_library->current_user())
                {
                    $user = $this->users_library->current_user();
                }
                else
                {
                    $user = $this->users_library->current_social_user();
                }
                
                $data['comment_author']         = $this->input->post('comment_author', TRUE);
                $data['comment_body']           = $_POST['comment_body'];
                $data['comment_record_id']      = $this->input->post('comment_record_id', TRUE); 
                $data['comment_user']           = $user['user_id'];
                $data['comment_create_on']      = date('Y-m-d H:i:s');
                $data['comment_update_on']      = $data['comment_create_on'];
                $data['comment_body']           = nl2br($data['comment_body']);
                $this->blog_model->add_comment($data);
                redirect('blog/comments/'.$data['comment_record_id'].'#comments');
            }
            else
                $this->session->set_flashdata('error',lang('error_comment_empty'));
                redirect(base_url("blog/comments/{$this->input->post('comment_record_id', TRUE)}#comment")); 
        }
        
        function comment_del($comment_id, $record_id)
        {
            $comment_id = (int)$comment_id;
            $record_id = (int)$record_id;
            $comment = $this->blog_model->get_comment($comment_id);
            if (element('comment_author', $this->blog_model->get_comment($comment_id)) != element('user_username',$this->current_user))
            {
                $this->session->set_flashdata('error',lang('public_message_undefined'));
                redirect ('blog/comments/'.$record_id);
            }
            else
            {
               if($this->blog_model->del_comment($comment_id))
                    redirect ('blog/comments/'.$record_id);
               else
                    $this->session->set_flashdata('error',lang('error_enemy'));
            }
            
            
        }
        public function rss()
        {
            $data['encoding']               = $this->config->item('encoding-8');
            $data['feed_name']              = $this->config->item('feed_name.ru');
            $data['feed_url']               = $this->config->item('feed_url');
            $data['page_description']       = $this->config->item('page_description');
            $data['page_language']          = $this->config->item('page_language');
            $data['creator_email']          = $this->config->item('creator_email');
            $data['posts']                  = $this->blog_model->get_last_records();
            header("Content-Type: application/rss+xml");
            $this->load->view('public/blog_rss', $data);
        }
        function comment_edit($comment_id, $record_id)
        {
            $result = $this->blog_model->get_comments($record_id, $comment_id, FALSE);
        }
        private function _uri_segment($t = FALSE)
        {
           $return['return'] = $this->session->userdata('offset') ? 'blog/index/'.$this->session->userdata('offset') : 'blog'; 
           $return['root'] = 'blog'; 
           return $t ? base_url($return[$t]) : $return;
        }

}
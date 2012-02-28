<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_library {

    function __construct()
    {
        $this->ci = & get_instance();
        $this->ci->load->model('blog/blog_model');
        $this->ci->lang->load('blog/blog');
        log_message('debug', 'lenses_library Initialized');
    }


    /**
     * Создаем сообшени в блоге по шаблону из сущности - "объектив"
     *
     * @access public
     * @param array $data
     * @param array $image
     * @param string $href
     * @return void
     *
     */
    public function create_post_by_lens($data, $image, $href)
    {
        // Создаем контекст шаблона для сообшения в блоге
        $contex['item']     = $data;
        $contex['image']    = $image;
        // Формируем сообшение в блог
        $post['blog_body']              = $this->ci->load->view('blog/public/blog_lens_template', $contex, TRUE); //Пропускаем сообшение через шаблон
        $post['blog_description']       = &$post['blog_body'];
        $post['blog_active']            = '1';
        $post['blog_title']             = $data['lenses_title'];
        $post['blog_create_on']         = date("Y-m-d");
        $post['blog_last_update']       = &$post['blog_create_on'];
        $post['blog_href']              = $href;
        if($records = $this->ci->blog_model->set_where('blog_href', $href)->get_all('manager')) //Проверяем, существует ли уже запись
        {
            $post['blog_last_update'] = date("Y-m-d");
            $this->ci->blog_model->update_element($post, $records[0]['blog_id']); //Если да, то обновляем её
        }
        else
        {
            $this->ci->blog_model->add_element($post); //Иначе, создаем новую
        }
    }


    /**
     * Записываем теги записи в базу
     *
     * @access public
     * @param string $tags
     * @param int $last_id
     * @return void
     */

    public function set_tags($tags, $last_id)
    {
        $tags = explode(',', $tags); // Считываем теги в массив
        foreach ($tags as $tag)
        {
            $tag = trim($tag);
            if(!$this->ci->blog_model->isset_tag($tag)) //Проверяем усть ли уже данные теги в базе
            {
                $data['tag_name'] = $tag;
                $this->ci->blog_model->add_tag($data); //Если нет, добавляем
                unset($data);
            }
            $tag_from_db = $this->ci->blog_model->set_where('tag_name', $tag)->get_tag();
            if(!$this->ci->blog_model->set_where('tag_id', $tag_from_db['tag_id'])->set_where('blog_id', $last_id)->get_writen_tag())
            {
                $data['blog_id'] = $last_id;
                $data['tag_id']  = $tag_from_db['tag_id'];
                $this->ci->blog_model->write_tag($data);
                unset($data);
            }
        }
    }

    /**
     * Получаем все теги записи по id и возврашаем в виде строки
     *
     * @access public
     * @param int id
     * @return string $tags_str
     */

    public function get_tags($id)
    {
        $tags_str = '';
        $tags_arr = $this->ci->blog_model->get_tags_by_blog_id($id);
        for($i = 0; $i < count($tags_arr); $i++)
        {
            if (isset($tags_arr[$i + 1]['tag']))
                $tags_str .= $tags_arr[$i]['tag'].', ';
            else
                $tags_str .= $tags_arr[$i]['tag'];
        }
        return $tags_str;
    }

}

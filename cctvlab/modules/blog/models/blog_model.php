<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model
{

    protected $_table = 'blog';


    function last_element()
    {
        $this->db->select_max('blog_id');
        return $this->db->get('blog')->row_array();
    }

    function last_insert_id()
    {
        return $this->db->query('select last_insert_id()')->row_array();
    }

    function get_tags_by_blog_id($blog_id)
    {
        $this->db->select('tags.tag_name as tag');
        $this->db->where('blog_tags.blog_id', $blog_id);
        $this->db->join('tags', 'blog_tags.tag_id = tags.tag_id');
        return $this->db->get('blog_tags')->result_array();
    }

    function get_last_records()
    {
        $this->db->order_by('blog_last_update');
        $this->db->where('blog_active', 1);
        $this->db->limit(10);
        return $this->db->get('blog')->result_array();
    }

    public function isset_tag($tag)
    {
        if ($this->db->where('tag_name', $tag)->get('tags')->row_array())
            return TRUE;
        else
            FALSE;
    }

    public function get_writen_tag()
    {
        return $this->db->get('blog_tags')->row_array();
    }

    function write_tag($data)
    {
        $this->db->insert('blog_tags', $data);
    }

    function get_tags()
    {
        $this->db->select('tags_tag ,id');
        return $this->db->get('tags')->result_array();
    }

    function add_tag($data)
    {
        $this->db->insert('tags', $data);
    }

    function get_tag()
    {
        return $this->db->get('tags')->row_array();
    }

    function set_limit($limit, $offset = FALSE)
    {
        $this->db->limit($limit, $offset);
        return $this;
    }

    function view_tags()
    {
        $this->db->select('blog.blog_title, blog.blog_id, tags.tag_name as tag');
        $this->db->join('blog_tags', 'blog.blog_id = blog_tags.blog_id', 'left');
        $this->db->join('tags', 'blog_tags.tag_id = tags.tag_id', 'left');
        $result = $this->db->get('blog')->result_array();
//        foreach ($result as $item)
//        {
//            $tags[] = $item['tags_tag'];
//        }
        return $result;
    }

    function get_all($type = "")
    {
        if ($type != 'manager')
            $this->db->where('blog_active', 1);
        $this->db->order_by("blog_node", 'desc');
        return $this->db->get('blog')->result_array();
    }

    function get_record($id)
    {
        $this->db->where('blog_id', $id);
        return $this->db->get('blog')->row_array();
    }

    function set_where($name, $value)
    {
        $this->db->where($name, $value == FALSE ? '' : $value);
        return $this;
    }

    function get_element()
    {
        $query = $this->db->get('blog');
        return $query->row_array();
    }

    function add_comment($data)
    {
        if ($this->db->insert('comments', $data))
            return TRUE;
    }

    function update_element($data, $id)
    {
        $this->db->where('blog_id', $id);
        $this->db->update('blog', $data);
    }

    function add_element($data)
    {
        $this->db->select_max('blog_node');
        $query = $this->db->get('blog');
        $result = $query->row_array();
        $this->db->set('blog_node', $result['blog_node'] + 1);
        $this->db->insert('blog', $data);
    }

    function del_comment($id)
    {
        if ($this->db->delete('comments', array('comment_id' => $id)))
            return TRUE;
        return FALSE;
    }

    function update_comment($id, $data)
    {
        if ($this->db->where('comment_id', $id)->update('comments', $data))
            return TRUE;
        return FALSE;
    }

    function get_comments($id)
    {
        if ($this->db->where('comment_record_id', $id)) {
            $this->db->order_by('comment_create_on');
            return $this->db->get('comments')->result_array();
        }
    }

    function get_comment($id)
    {
        if ($this->db->where('comment_id', $id))
            return $this->db->get('comments')->row_array();
    }

    function delete_element($id)
    {
        $this->db->where('blog_id', $id);
        $query = $this->db->get('blog');
        if (!$query) {
            return FALSE;
        }
        $result = $query->row_array();
        if (!empty($result['blog_href']))
        {
            $this->db->where('lenses_id', $result['blog_href']);
            $data['lenses_on_blog'] = 0;
            $this->db->update('lenses', $data);
        }
        $this->db->delete('blog', array('blog_id' => $id));
        $this->db->delete('comments', array('comment_record_id' => $id));
        $this->db->delete('blog_tags', array('blog_id' => $id));
        $this->db->where('blog_node >', $result['blog_node']);
        $this->db->set('blog_node', 'blog_node-1', FALSE);
        $this->db->update('blog');
        return TRUE;
    }

    function delete_element_by_href($href)
    {
        $this->db->where('blog_href', $href);
        $query = $this->db->get('blog');
        if (!$query) {
            return FALSE;
        }
        $result = $query->row_array();
        $this->db->delete('blog', array('blog_href' => $href));
        $this->db->where('blog_node >', $result['blog_node']);
        $this->db->set('blog_node', 'blog_node-1', FALSE);
        $this->db->update('blog');
        return TRUE;

    }

    function up_element($id)
    {
        $this->db->where("blog_id", $id);
        $query = $this->db->get('blog');
        if ($query->num_rows() > 0) {
            $ford = $query->row_array();
            $row = $query->row();

            //$this->db->where('blog_group',$ford['blog_group']);
            $this->db->select_max('blog_node');
            $query = $this->db->get('blog');
            $maxord = $query->row_array();

            if ($ford['blog_node'] == 1) {
                //$this->db->where('blog_group',$ford['blog_group']);
                $this->db->set('blog_node', 'blog_node-1', FALSE);
                $this->db->update('blog');
                $this->db->where("blog_id", $id);
                $this->db->set('blog_node', $maxord['blog_node']);
                $this->db->update('blog');
            }
            else
            {
                //$this->db->where('blog_group',$ford['blog_group']);
                $this->db->where("blog_node", $ford['blog_node'] - 1);
                $this->db->set('blog_node', $ford['blog_node']);
                $this->db->update('blog');
                $this->db->where("blog_id", $id);
                $this->db->set('blog_node', $ford['blog_node'] - 1);
                $this->db->update('blog');
            }
        }
    }

    function down_element($id)
    {
        $this->db->where("blog_id", $id);
        $query = $this->db->get('blog');
        if ($query->num_rows() > 0) {
            $ford = $query->row_array();
            $row = $query->row();

            //$this->db->where('blog_group',$ford['blog_group']);
            $this->db->select_max('blog_node');
            $query = $this->db->get('blog');
            $maxord = $query->row_array();

            if ($ford['blog_node'] == $maxord['blog_node']) {
                //$this->db->where('blog_group',$ford['blog_group']);
                $this->db->set('blog_node', 'blog_node+1', FALSE);
                $this->db->update('blog');
                $this->db->where("blog_id", $id);
                $this->db->set('blog_node', 1);
                $this->db->update('blog');
            }
            else
            {
                //$this->db->where('blog_group',$ford['blog_group']);
                $this->db->where("blog_node", $ford['blog_node'] + 1);
                $this->db->set('blog_node', $ford['blog_node']);
                $this->db->update('blog');
                $this->db->where("blog_id", $id);
                $this->db->set('blog_node', $ford['blog_node'] + 1);
                $this->db->update('blog');
            }
        }
    }
}
<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


function pagination($uri,$total_rows,$uri_segment = 4,$per_page = 20)
{
	$ci =& get_instance();
	$ci->load->library('pagination');

	$offset = $ci->uri->segment($uri_segment,0);
               
        $ci->session->set_userdata(array('offset'=>$offset));
        
	$config['base_url']		= $uri.'/index';
	$config['total_rows']		= $total_rows;
	$config['per_page']		= $per_page;
	$config['uri_segment']		= $uri_segment;
	$config['num_links']            = 4;

	$config['cur_tag_open'] 	= '<span>';
	$config['cur_tag_close'] 	= '</span>';

	$ci->pagination->initialize($config);
        
        $return['links']                = $ci->pagination->create_links();
        $return['per_page']             = $config['per_page'];
        $return['limit']                = array($config['per_page'],$offset);
        
        return $return;
}


/* End of file pagination_helper.php */
/* Location: ./application/helper/pagination_helper.php */
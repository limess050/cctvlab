<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comparing extends Public_Controller {
        
        public function __construct()
	{
  		parent::Public_Controller();
                $this->lang->load('comparing');
                $this->load->model('comparing_model');
                $this->template->set('uri_segment',$this->_uri_segment());
                $this->template->title(element(0,$this->parameters))
                               ->set('keywords',element(1,$this->parameters))
                               ->set('description',element(2,$this->parameters))
                               ->append_metadata(css_asset('jquery/jquery-ui-1.8.16.custom.css','lenses'))
                               ->append_metadata(css_asset('comparing.css','comparing'))
                               ->append_metadata(js_asset('jquery/jquery-ui-1.8.16.custom.min.js','lenses'))
                               //->append_metadata(js_asset('chart.js','comparing'))
                               ->append_metadata(js_asset('comparing_lenses.js','comparing'))
                               ->set_partial('contentright','public/partials/contentright');
 	}
	
        public function index()
	    {
            $comparing  = explode(';', $this->session->userdata('comparing_id'));
            $comparing_item = array();
            for ($i = 0; $i < count($comparing); $i++)
            {
                if (empty($comparing[$i]))
                {
                    unset($comparing[$i]);
                    continue;
                }
            }
            foreach($comparing as $id)
            {
                $comparing_item[] = $this->comparing_model->get_lens('lenses_id', $id);
            }
            $dropdown = array(''=>'');

            $this->template->set('breadcrumbs',element('name',$this->parameters))
                           ->set('comparing', $comparing_item)
                           ->build('public/public_comparing_view');	
	    }
        
        public function reset()
        {
            $this->session->unset_userdata('comparing_id');
            redirect(base_url('comparing'));
        }
        
        
        private function _uri_segment($t = FALSE)
        {
           $return['return'] = $this->session->userdata('offset') ? 'comparing/index/'.$this->session->userdata('offset') : 'comparing'; 
           $return['root'] = 'comparing'; 
           return $t ? base_url($return[$t]) : $return;
        }
}

/* End of file comparing.php */
/* Location: ./application/modules/comparing/controllers/comparing.php */
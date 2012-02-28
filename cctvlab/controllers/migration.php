<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('migration');
    }

    /**
     * Обновляет базу данных до последней актуальной версии
     * @access public
     * @return void
     * */

    public function current()
    {
        if (!$this->migration->latest())
        {
            show_error($this->migration->error_string());
        }
    }

    /**
     * Обновляет базу данных до заданной версии(не работает)
     * @access public
     * @return void
     * */

    public function version()
    {
        $ver = $this->uri->segment(3,0);
        if ($this->migration->version($ver))
        {
            show_error($this->migration->error_string());
        }
    }
}
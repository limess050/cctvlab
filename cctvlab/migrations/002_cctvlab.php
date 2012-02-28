<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Cctvlab extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'data_update_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'data_update_module_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'data_update_status_file' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'data_update_last_update' => array(
                'type' => 'INT',
            ),
            'data_update_module_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'data_update_upload_interval' => array(
                'type' => 'TINYINT',
                'constraint' => 3,
                'unsigned' => TRUE,
            )
        ));
        $this->dbforge->add_key('data_update_id', TRUE);
        if($this->dbforge->create_table('data_upload', TRUE)) echo "Таблица, data_upload: OK!<br />";

        $this->db->empty_table('data_upload');
        $this->db->query("INSERT INTO `cctvlab_data_update` (`data_update_id`, `data_update_module_id`, `data_update_status_file`, `data_update_last_update`, `data_update_module_name`, `data_update_upload_interval`) VALUES
	      (1, 72, './example.json', 1330398602, 'lenses', 1);");

        $this->db->query("INSERT INTO `cctvlab_modules` (`module_id`, `module_node`, `module_code`, `module_name`, `module_uname`, `module_parameters`, `module_type_id`, `module_permissions`, `modules_mmenu_public`, `module_active`) VALUES
    	  (76, 2, 'P0001', 'Обновление данных', 'loader', 'a:3:{i:0;s:18:\"Объективы\";i:1;s:14:\"./example.json\";i:2;s:1:\"1\";}', '4', 'administrator1,administrator2', 0, 1);");

        $this->session->set_flashdata('success', 'Сайт успешно запушен');
        echo "<center><h2>База данных успешно обновлена<br / ><a href='".base_url()."'>Перейти на сайт</a></h2></center>";
    }
    public function down()
    {
        $this->dbforge->drop_table('data_upload');
    }
}
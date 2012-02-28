<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Cctvlab extends CI_Migration
{
    public function up()
    {

        $this->dbforge->add_field(array(
            'administrator_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'administrator_node' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'administrator_group' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'administrator_username' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'administrator_password' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'administrator_first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'administrator_last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'administrator_patronymic' => array(
                'type' => 'TEXT',
            ),
            'administrator_date_register' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'administrator_email' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'administrator_telephone' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'administrator_icq' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'administrator_status' => array(
                'type' => 'SMALLINT',
                'constraint' => 6,
                'null' => TRUE
            ),
            'administrator_active' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1
            ),

        ));
        $this->dbforge->add_key('administrator_id', TRUE);
        if($this->dbforge->create_table('administrators', TRUE)) echo "Таблица, administrators: OK!<br />";

        $this->dbforge->add_field(array(
            'blog_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'blog_title' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ),
            'blog_body' => array(
                'type' => 'longtext',
            ),
            'blog_active' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1
            ),
            'blog_node' => array(
                'type' => 'INT',
                'constraint' => 10,
                'default' => 1
            ),
            'blog_create_on' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'blog_last_update' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'blog_description' => array(
                'type' => 'TEXT',
            ),
            'blog_href' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            )
        ));
        $this->dbforge->add_key('blog_id', TRUE);
        if($this->dbforge->create_table('blog', TRUE)) echo "Таблица, blog: OK!<br />";

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'blog_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => '0'
            ),
            'tag_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => '0'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        if($this->dbforge->create_table('blog_tags', TRUE)) echo "Таблица, blog: OK!<br />";

        $this->dbforge->add_field(array(
            'brands_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'brands_node' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'brands_name' => array(
                'type' => 'TEXT',
            ),
            'brands_active' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
        ));
        $this->dbforge->add_key('brands_id', TRUE);
        if($this->dbforge->create_table('brands', TRUE)) echo "Таблица, brands: OK!<br />";

        $this->dbforge->add_field(array(
            'comment_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'comment_record_id' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'comment_author' => array(
                'type' => 'VARCHAR',
                'constraint' => 64
            ),
            'comment_body' => array(
                'type' => 'TEXT',
            ),
            'comment_user' => array(
                'type' => 'INT',
                'constraint' => 10,
            ),
        ));
        $this->dbforge->add_key('comment_id', TRUE);
        if($this->dbforge->create_table('comments', TRUE)) echo "Таблица, comments: OK!<br />";

        $this->dbforge->add_field(array(
            'images_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'images_node' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'images_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => TRUE
            ),
            'images_file_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'images_orig_name' => array(
                'type' => 'TEXT',
            ),
            'images_file_ext' => array(
                'type' => 'VARCHAR',
                'constraint' => 5,
            ),
            'images_thumb' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
            ),
            'images_file_size' => array(
                'type' => 'VARCHAR',
                'constraint' => 11,
            ),
            'images_active' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0
            ),
            'module_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
        ));
        $this->dbforge->add_key('images_id', TRUE);
        if($this->dbforge->create_table('images', TRUE)) echo "Таблица, images: OK!<br />";

        $this->dbforge->add_field(array(
            'lenses_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'lenses_node' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'lenses_serial' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'lenses_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'lenses_model' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'lenses_description' => array(
                'type' => 'TEXT',
            ),
            'lenses_active' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0
            ),
            'lenses_new' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0
            ),
            'lenses_brand' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'lenses_added_on' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'lenses_title' => array(
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => TRUE
            ),
            'lenses_on_blog' => array(
                'type' => 'TINYINT',
                'constraint' => 4,
                'default' => 0
            ),
        ));
        $this->dbforge->add_key('lenses_id', TRUE);
        if($this->dbforge->create_table('lenses', TRUE)) echo "Таблица, lenses: OK!<br />";

        $this->dbforge->add_field(array(
            'lenses_code' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'lenses_parameters_focal' => array(
                'type' => 'INT',
                'constraint' => 6,
                'null' => TRUE
            ),
            'lenses_parameters_focal_min' => array(
                'type' => 'double',
                'null' => TRUE
            ),
            'lenses_parameters_focal_max' => array(
                'type' => 'double',
                'null' => TRUE
            ),
            'lenses_parameters_aperture' => array(
                'type' => 'smallint',
                'constraint' => 6,
                'null' => TRUE
            ),
            'lenses_parameters_aperture_min' => array(
                'type' => 'float',
                'null' => TRUE
            ),
            'lenses_parameters_aperture_max' => array(
                'type' => 'double',
                'null' => TRUE
            ),
            'lenses_parameters_mount' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'lenses_parameters_matrix' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'lenses_parameters_weight' => array(
                'type' => 'INT',
                'constraint' => 45,
                'null' => TRUE
            ),
            'lenses_parameters_correction' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'lenses_parameters_dimension' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'lenses_parameters_angle_horizontal_min' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => TRUE
            ),
            'lenses_parameters_angle_horizontal_max' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => TRUE
            ),
            'lenses_parameters_angle_vertical_min' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => TRUE
            ),
            'lenses_parameters_angle_vertical_max' => array(
                'type' => 'INT',
                'constraint' => 10,
                'null' => TRUE
            )
        ));
        $this->dbforge->add_key('lenses_code', TRUE);
        $this->dbforge->add_key(array('lenses_code'));
        if($this->dbforge->create_table('lenses_parameters', TRUE)) echo "Таблица, lenses_parameters: OK!<br />";

        $this->dbforge->add_field(array(

            'lenses_testing_value_chart' => array(
                'type' => 'TEXT',
            ),
            'lenses_testing_value_chart_2' => array(
                'type' => 'TEXT',
            ),
            'lenses_testing_value_aperture' => array(
                'type' => 'float',
                'default' => 0
            ),
            'lenses_testing_value_aperture' => array(
                'type' => 'float',
                'default' => 0
            ),
            'lenses_testing_value_focal' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ),
            'testing_id' => array(
                'type' => 'BIGINT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'lenses_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'lenses_group_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'lenses_algoritm_version' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => TRUE
            ),
            'lenses_camera_model' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => TRUE
            ),
        ));
        if($this->dbforge->create_table('lenses_testing', TRUE)) echo "Таблица, lenses_testing: OK!<br />";

        $this->dbforge->add_field(array(
            'module_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'module_node' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'module_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 30,
            ),
            'module_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'module_uname' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'module_parameters' => array(
                'type' => 'TEXT',
            ),
            'module_type_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 30,
            ),
            'module_permissions' => array(
                'type' => 'TEXT',
            ),
            'modules_mmenu_public' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'module_active' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1
            ),
        ));
        $this->dbforge->add_key('module_id', TRUE);
        if($this->dbforge->create_table('modules', TRUE)) echo "Таблица, modules: OK!<br />";

        $this->dbforge->add_field(array(
            'module_type_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'module_type_node' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'module_type_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
        ));
        $this->dbforge->add_key('module_type_id', TRUE);
        if($this->dbforge->create_table('modules_types', TRUE)) echo "Таблица, modules_types: OK!<br />";

        $this->dbforge->add_field(array(
            'tag_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'tag_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
        ));
        $this->dbforge->add_key('tag_id', TRUE);
        if($this->dbforge->create_table('tags', TRUE)) echo "Таблица, tags: OK!<br />";

        $this->dbforge->add_field(array(
            'group_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
            ),
            'group_description' => array(
                'type' => 'TEXT',
            ),
        ));
        $this->dbforge->add_key('group_id', TRUE);
        if($this->dbforge->create_table('tests_group', TRUE)) echo "Таблица, tests_group: OK!<br />";

        $this->dbforge->add_field(array(
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_node' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'user_group' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'user_username' => array(
                'type' => 'VARCHAR',
                'constraint' => 70,
            ),
            'user_password' => array(
                'type' => 'VARCHAR',
                'constraint' => 70,
                'null' => TRUE
            ),
            'user_first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ),
            'user_last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ),
            'user_patronymic' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ),
            'user_date_register' => array(
                'type' => 'DATE',
            ),
            'user_email' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'user_telephone' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'user_icq' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'user_provider' => array(
                'type' => 'VARCHAR',
                'constraint' => 75,
                'null' => TRUE
            ),
            'user_uid' => array(
                'type' => 'BIGINT',
                'constraint' => 90,
                'null' => TRUE
            ),
            'user_active' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1
            ),
            'user_activation_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 75,
                'null' => TRUE
            ),

        ));
        $this->dbforge->add_key('user_id', TRUE);
        if($this->dbforge->create_table('users', TRUE)) echo "Таблица, users: OK!<br />";

        $this->db->empty_table('administrators');
        if($this->db->query("INSERT INTO `cctvlab_administrators` (`administrator_id`, `administrator_node`, `administrator_group`, `administrator_username`, `administrator_password`, `administrator_first_name`, `administrator_last_name`, `administrator_patronymic`, `administrator_date_register`, `administrator_email`, `administrator_telephone`, `administrator_icq`, `administrator_status`, `administrator_active`) VALUES
        (27, 1, 'administrator1', '1', '0937afa17f4dc08f3c0e5dc908158370ce64df86', 'admin', 'admin', 'admin', '2010-12-24', 'admin@admin.ru', '8-969-696-96-96', '252-696-585', NULL, 1),
        (75, 1, 'administrator2', 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'Иван', 'Иванов', 'Иванович', '2011-10-24', 'mail@mail.ru', '8-903-252-55-55', '256-589-525', NULL, 1);
            "))  echo "Администраторы созданы!<br />";  //Создаем дефолтных администраторов
        $this->db->empty_table('brands');
        if($this->db->query("INSERT INTO `cctvlab_brands` (`brands_id`, `brands_node`, `brands_name`, `brands_active`) VALUES
        (13, 2, 'Nikon', 1),
        (14, 3, 'Canon', 1),
        (15, 1, 'Beward', 1),
        (16, 4, 'Sony', 1);
        "))  echo "Брэнды созданы!<br />"; //Создаем дефолтные брэнды
        $this->db->empty_table('modules');
        if($this->db->query("
            INSERT INTO `cctvlab_modules` (`module_id`, `module_node`, `module_code`, `module_name`, `module_uname`, `module_parameters`, `module_type_id`, `module_permissions`, `modules_mmenu_public`, `module_active`) VALUES
	(55, 2, 'M0001', 'Профиль', 'profile', 'b:0;', '1', 'administrator1,administrator2', 0, 1),
	(37, 2, 'M0001', 'Модули', 'modules', 'b:0;', '1', 'administrator1', 0, 1),
	(38, 2, 'M0001', 'Администраторы', 'administrators', 'b:0;', '1', 'administrator1', 0, 1),
	(63, 3, 'T0001', 'Пользователи', 'users', 'a:3:{i:0;s:24:\"Пользователи\";i:1;s:52:\"Завершение активации (CCTVLAB.ru)\";i:2;s:246:\"<p>\r\n <strong>Привет %username%</strong>,&nbsp;</p>\r\n<p>\r\n <em>Для активации вашей учетной записи, перейдите по ссылке:</em> %url%</p>\r\n<p>\r\n <a href=\"http://cctvlife.ru\">ССTVLAB.ru</a></p>\r\n\";}', '3', 'administrator1,administrator2', 0, 1),
	(70, 1, 'U0001', 'Сравнение', 'comparing', 'a:3:{i:0;s:18:\"Сравнение\";i:1;s:0:\"\";i:2;s:0:\"\";}', '3', 'administrator1,administrator2', 1, 1),
	(65, 2, 'T0001', 'Блог', 'blog', 'a:3:{i:0;s:8:\"Блог\";i:1;s:0:\"\";i:2;s:0:\"\";}', '3', 'administrator1,administrator2', 1, 1),
	(74, 2, 'P0001', 'Производители', 'brands', NULL, '4', 'administrator1,administrator2', 1, 1),
	(72, 1, 'P0001', 'Объективы', 'lenses', 'a:1:{i:0;s:18:\"Объективы\";}', '4', 'administrator1,administrator2', 1, 1),
	(75, 1, 'I0001', 'Изображения', 'images', NULL, '2', 'administrator1,administrator2', 1, 1);
        "))  echo "Модули созданы!<br />"; //Создаем модули
        $this->db->empty_table('modules_types');
        if($this->db->query("INSERT INTO `cctvlab_modules_types` (`module_type_id`, `module_type_node`, `module_type_name`) VALUES
        (1, 4, 'Управление'),
        (2, 1, 'Компоненты'),
        (3, 3, 'Разделы сайта'),
        (4, 2, 'Каталог');")) echo "Разделы созданы!<br />"; //Создаем разделы

        $this->session->set_flashdata('success', 'Сайт успешно запушен');
        echo "<center><h2>База данных успешно обновлена<br / ><a href='".base_url()."'>Перейти на сайт</a></h2></center>";

    }
    public function down()
    {
        $this->dbforge->drop_table('administrators');
        $this->dbforge->drop_table('blog');
        $this->dbforge->drop_table('blog_tags');
        $this->dbforge->drop_table('brands');
        $this->dbforge->drop_table('comments');
        $this->dbforge->drop_table('images');
        $this->dbforge->drop_table('lenses');
        $this->dbforge->drop_table('lenses_parameters');
        $this->dbforge->drop_table('lenses_testing');
        $this->dbforge->drop_table('modules');
        $this->dbforge->drop_table('modules_types');
        $this->dbforge->drop_table('tags');
        $this->dbforge->drop_table('tests_group');
        $this->dbforge->drop_table('users');

    }

}
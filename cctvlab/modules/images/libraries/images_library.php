<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Images_library
{

    function __construct()
    {
        $this->ci = & get_instance();
        $this->ci->load->model('images/images_model');
        $this->ci->lang->load('images/images');
        $this->path_img = './upload/images/';
        log_message('debug', 'Images_library Initialized');
    }

    /**
     *
     * Формирует эскизы изображения по заданным параметрам
     *
     * @access                      public
     * $image_conf['module']    имя модуля к которому относится изображение
     * $image_conf['filename']    имя изображения для которого нужно сформировать эскизы
     * $image_conf['size']        массив размеров эскизов высота/ширина array('50x50','120x120')
     *
     */

    function make_images($image_conf)
    {
        $PATH_IMG = './upload/images/';
        $module = $image_conf['module'];
        $filename = $image_conf['filename'];
        foreach ($image_conf['size'] as $size)
        {
            list($config['width'], $config['height']) = explode('x', $size);
            if (!is_dir($this->path_img . $module)) {
                mkdir($this->path_img . $module);
            }
            if (!is_dir($this->path_img . $module . '/thumb_' . $size)) {
                mkdir($this->path_img . $module . '/thumb_' . $size);
            }
            $config['image_library'] = 'gd2';
            $config['maintain_ratio'] = TRUE;
            $config['source_image'] = 'upload/images/' . $image_conf['filename'];
            $config['new_image'] = $this->path_img . $module . '/thumb_' . $size . '/' . $filename;
            $config['thumb_marker'] = '';
            $this->ci->image_lib->initialize($config);
            if (!$this->ci->image_lib->resize()) {
                echo $this->ci->image_lib->display_errors();
            }
        }
    }


    /**
     *
     * Выводит массив изображений (в виде ссылок) для определенного елемента
     *
     * @access        public
     * $goods_id        идентификатор елемента для которого выводятся изображения
     * $module        имя модуля к которому относится елемент
     * $sizes        массив размеров ширина/высота array('50x50','120x120')
     * $list                тип вывода FALSE - только первое изображение, TRUE - все изображения елемента
     *
     */

    function get_images($goods_id, $module, $sizes, $list = FALSE)
    {
        switch ($module)
        {
            case 'lenses':

                if ($list) // выводим массив всех изображений для елемента
                {
                    $i = 0;
                    if ($result = $this->ci->images_model->get_goods_images($goods_id, $module)) {
                        foreach ($result as $row)
                        {
                            $return[$i]['original'] = base_url($this->path_img . $row['images_file_name']);
                            foreach ($sizes as $size)
                            {
                                $return[$i][$size] = base_url($this->path_img . $module . '/thumb_' . $size . '/' . $row['images_file_name']);
                            }
                            $i++;
                        }
                    }
                    else
                    {
                        $return = FALSE;
                    }
                }
                else // выводим первое изображение для елемента
                {
                    if ($result = $this->ci->images_model->get_goods_images($goods_id, $module)) {
                        $return['original'] = base_url($this->path_img . $result[0]['images_file_name']);

                        foreach ($sizes as $size)
                        {
                            $return[$size] = base_url($this->path_img . $module . '/thumb_' . $size . '/' . $result[0]['images_file_name']);
                        }
                    }
                    else
                    {
                        $return = FALSE;
                    }
                }

                break;
        }

        return $return;

    }

    function delete_images($goods_id, $sizes, $module_name)
    {
        $images = $this->ci->images_model->get_goods_images($goods_id, $module_name);
        $this->ci->images_model->delete_elements($goods_id);
        if (!empty($images)) {
            foreach ($images as $image)
            {
                list($filename, $extension) = explode(".", $image['images_file_name']);
                unlink($this->path_img . $filename . "_thumb." . $extension);
                unlink($this->path_img . $image['images_file_name']);
                foreach ($sizes as $size)
                {
                    unlink($this->path_img . $module_name . '/thumb_' . $size . '/' . $image['images_file_name']);
                }
            }
            return TRUE;
        }
    }

}

/* End of file images_library.php */
/* Location: ./application/modules/images/libraries/images_library.php */
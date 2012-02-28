<?php

    function editor($id,$textarea) 
    {	
            return '<textarea class="ckeditor" cols="80" id="'.$id.'" name="'.$id.'" rows="20">'.$textarea.'</textarea>';
    }

    function editor_init()
    {
            return '<script type="text/javascript" src="/'.APPPATH.'/themes/js/plugins/ckeditor/ckeditor.js"></script>';
    }

?>

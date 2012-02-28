<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>
<?php echo $template['partials']['notifications']; ?>
<?php echo form_open($this->uri->uri_string());?>
<table class="form">
    <tr>
        <td><div class="f_title"><?=lang('loader_adr_status_file');?> *</div><input type="text" name="data_update_status_file"  value="<?=set_value('data_update_status_file',$settings['data_update_status_file']);?>" class="text" /></td>
    </tr>
    <tr>
        <td><div class="f_title"><?=lang('loader_update_time_interval');?> *</div><input type="text" name="data_update_upload_interval" value="<?=set_value('data_update_upload_interval', $settings['data_update_upload_interval'])?>" class="text" /></td>
    </tr>
    <tr>
        <td><div><input type="submit" class="button" value="<?=lang('manager_button_save'); ?>" /> <input type="button" class="button" value="<?=lang('manager_button_cancel'); ?>" value="<?=lang('manager_button_cancel')?>" onClick="location.href = '<?=base_url(element('return',$uri_segment))?>';"/>
            </div></td>
    </tr>
</table>
<?php echo form_close();?>

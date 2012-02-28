<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>
<?php echo $template['partials']['notifications']; ?>
<?php echo form_open($this->uri->uri_string());?>
<table class="form">
<tr>
<td><div class="f_title"><?=lang('brands_name');?> *</div><input type="text" name="brands_name"  value="<?=set_value('brands_name',$item['brands_name']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('manager_on_site');?></div><input type="checkbox" name="brands_active" value="1"  <?=set_checkbox('brands_active','1',$item['brands_active'] ? TRUE : FALSE);?> /></td>
</tr>
<tr>
<td><div><input type="submit" class="button" value="<?=lang('manager_button_save'); ?>" /> <input type="button" class="button" value="<?=lang('manager_button_cancel'); ?>" value="<?=lang('manager_button_cancel')?>" onClick="location.href = '<?=base_url(element('return',$uri_segment))?>';"/></div></td>
</tr>
</table>
<?php echo form_close();?>






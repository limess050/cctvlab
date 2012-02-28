<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>
<?php echo $template['partials']['notifications']; ?>
<?php echo form_open($this->uri->uri_string());?>
<table class="form">
<tr>
<td><div class="f_title"><?=lang('modules_manager_code')?> *</div><input type="text" value="<?=$item['module_code'];?>" class="text"  readonly="true" /></td>
</tr>
<tr>
<td><div class="f_title"><?=$this->lang->line('modules_manager_uname')?> *</div><input type="text" value="<?=set_value('modules_uname',$item['module_uname']);?>" class="text"  readonly="true"/></td>
</tr>
<tr>
<td><div class="f_title"><?=$this->lang->line('modules_manager_name')?> *</div><input type="text" name="module_name"  value="<?=set_value('module_name',$item['module_name']);?>" class="text"/></td>
</tr>
<?php echo $template['partials']['parameters']; ?>
<tr>
<td><div class="f_title"><?=$this->lang->line('manager_on_site');?></div><input type="checkbox" name="module_active" value="1"  <?=set_checkbox('module_active','y',$item['module_active'] ? TRUE : FALSE);?> /></td>
</tr>
<tr>
<td><div><input type="submit" class="button" value="<?=lang('manager_button_save')?>" /> <input type="button" class="button" value="<?=lang('manager_button_cancel')?>" onClick="location.href = '<?=base_url(element('return',$uri_segment))?>';"/></div></td>
</tr>
</table>
<?php echo form_close();?>






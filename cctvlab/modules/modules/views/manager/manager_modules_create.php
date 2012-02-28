<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>
<?php echo $template['partials']['notifications']; ?>
<?php echo form_open($this->uri->uri_string());?>
<table class="form">
<tr>
<td><div class="f_title"><?=lang('modules_manager_code')?> *</div><input type="text" name="module_code" value="<?=set_value('module_code');?>" class="text"  /></td>
</tr>
<tr>
<td><div class="f_title"><?=$this->lang->line('modules_manager_uname')?> *</div><input type="text" name="module_uname" value="<?=set_value('module_uname');?>" class="text"/></td>
</tr>
<tr>
<td><div class="f_title"><?=$this->lang->line('modules_manager_name')?> *</div><input type="text" name="module_name"  value="<?=set_value('module_name');?>" class="text"/></td>
</tr>
<tr>
<td><div class="f_title"><?=$this->lang->line('modules_manager_permissions')?> *</div><input type="text" name="module_permissions"  value="<?=set_value('module_permissions');?>" class="text"/></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('modules_manager_users_activate');?></div><input type="checkbox" name="modules_manager_users_activate" value="1"  <?=set_checkbox('modules_manager_users_activate','1',TRUE);?> /></td>
</tr>
<tr>
<td><div><input type="submit" class="button" value="<?=lang('manager_button_create')?>" /> <input type="button" class="button" value="<?=lang('manager_button_cancel')?>" onClick="location.href = '<?=base_url(element('return',$uri_segment))?>';"/></div></td>
</tr>
</table>
<?php echo form_close();?>






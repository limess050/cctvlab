<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>
<?php echo $template['partials']['notifications']; ?>
<?php echo form_open($this->uri->uri_string());?>
<table class="form">
<tr>
<td width="20%"><div class="f_title"><?=lang('administrators_date_register');?> *</div><input type="text" name="administrator_date_register"  value="<?=set_value('administrator_date_register',date_calendar(mysql_to_unix($item['administrator_date_register']),'calendar'));?>" class="text calendar" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('administrators_username');?> *</div><input type="text" name="administrator_username"  value="<?=set_value('administrator_username',$item['administrator_username']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('administrators_password');?></div><input type="password" name="administrator_password"   value="<?=set_value('administrator_password');?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('administrators_password_conf');?></div><input type="password" name="administrator_password_conf"   value="<?=set_value('administrator_password_conf');?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('administrators_last_name');?></div><input type="text" name="administrator_last_name"  value="<?=set_value('administrator_last_name',$item['administrator_last_name']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('administrators_first_name');?> *</div><input type="text" name="administrator_first_name"  value="<?=set_value('administrator_first_name',$item['administrator_first_name']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('administrators_patronymic');?></div><input type="text" name="administrator_patronymic"  value="<?=set_value('administrator_patronymic',$item['administrator_patronymic']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('administrators_email');?></div><input type="text" name="administrator_email"  value="<?=set_value('administrator_email',$item['administrator_email']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('administrators_telephone');?></div><input type="text" name="administrator_telephone"  value="<?=set_value('administrator_telephone',$item['administrator_telephone']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('administrators_icq');?></div><input type="text" name="administrator_icq"  value="<?=set_value('administrator_icq',$item['administrator_icq']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('administrators_active');?></div><input type="checkbox" name="administrator_active" value="1"  <?=set_checkbox('administrator_active','1',$item['administrator_active'] ? TRUE : FALSE);?> /></td>
</tr>
<tr>
<td><div><input type="submit" class="button" value="<?=lang('manager_button_save'); ?>" /> <input type="button" class="button" value="<?=lang('manager_button_cancel'); ?>" value="<?=lang('manager_button_cancel')?>" onClick="location.href = '<?=base_url(element('return',$uri_segment))?>';"/></div></td>
</tr>
</table>
<?php echo form_close();?>






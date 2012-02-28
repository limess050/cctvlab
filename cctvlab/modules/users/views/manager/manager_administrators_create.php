<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>
<?php echo $template['partials']['notifications']; ?>
<?php echo form_open($this->uri->uri_string());?>
<table class="form">
<tr>
<td width="20%"><div class="f_title"><?=lang('date_register');?> *</div><input type="text" name="date_register"  value="<?=set_value('administrator_date_register',date_calendar(now(),'calendar'));?>" class="text calendar" readonly="true"/></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('username');?> *</div><input type="text" name="username"  value="<?=set_value('username');?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('password');?> *</div><input type="password" name="password"   value="<?=set_value('password');?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('password_conf');?> *</div><input type="password" name="password_conf"   value="<?=set_value('password_conf');?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('last_name');?></div><input type="text" name="last_name"  value="<?=set_value('last_name');?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('first_name');?> *</div><input type="text" name="first_name"  value="<?=set_value('first_name');?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('patronymic');?></div><input type="text" name="patronymic"  value="<?=set_value('patronymic');?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('email');?></div><input type="text" name="email"  value="<?=set_value('email');?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('telephone');?></div><input type="text" name="telephone"  value="<?=set_value('telephone');?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('icq');?></div><input type="text" name="icq"  value="<?=set_value('icq');?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('manager_active');?></div><input type="checkbox" name="active" value="1"  <?=set_checkbox('active','1',TRUE);?> /></td>
</tr>
<tr>
<td><div><input type="submit" class="button" value="<?=lang('manager_button_create'); ?>" /> <input type="button" class="button" value="<?=lang('manager_button_cancel'); ?>" value="<?=lang('manager_button_cancel')?>" onClick="location.href = '<?=base_url(element('return',$uri_segment))?>';"/></div></td>
</tr>
</table>
<?php echo form_close();?>






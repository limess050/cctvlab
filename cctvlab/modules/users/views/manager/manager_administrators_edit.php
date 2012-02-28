<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>
<?php echo $template['partials']['notifications']; ?>
<?php echo form_open($this->uri->uri_string());?>
<table class="form">
<tr>
<td width="20%"><div class="f_title"><?=lang('date_register');?> *</div><input type="text" name="date_register"  value="<?=set_value('date_register',date_calendar(mysql_to_unix($item['user_date_register']),'calendar'));?>" class="text calendar" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('username');?> *</div><input type="text" name="username"  value="<?=set_value('username',$item['user_username']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('password');?></div><input type="password" name="password"   value="<?=set_value('user_password');?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('password_conf');?></div><input type="password" name="password_conf"   value="<?=set_value('user_password_conf');?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('last_name');?></div><input type="text" name="last_name"  value="<?=set_value('last_name',$item['user_last_name']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('first_name');?> *</div><input type="text" name="first_name"  value="<?=set_value('first_name',$item['user_first_name']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('patronymic');?></div><input type="text" name="patronymic"  value="<?=set_value('patronymic',$item['user_patronymic']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('email');?></div><input type="text" name="email"  value="<?=set_value('email',$item['user_email']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('telephone');?></div><input type="text" name="telephone"  value="<?=set_value('telephone',$item['user_telephone']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('icq');?></div><input type="text" name="icq"  value="<?=set_value('icq',$item['user_icq']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('active');?></div><input type="checkbox" name="active" value="1"  <?=set_checkbox('active','1',$item['user_active'] ? TRUE : FALSE);?> /></td>
</tr>
<tr>
<td><div><input type="submit" class="button" value="<?=lang('manager_button_save'); ?>" /> <input type="button" class="button" value="<?=lang('manager_button_cancel'); ?>" value="<?=lang('manager_button_cancel')?>" onClick="location.href = '<?=base_url(element('return',$uri_segment))?>';"/></div></td>
</tr>
</table>
<?php echo form_close();?>






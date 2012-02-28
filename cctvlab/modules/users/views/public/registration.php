<fieldset>
	<legend><?=lang('users_registration')?></legend>
	<div class="registration_form">
		<?php echo form_open('/users/registration');?>
			<table>
				<tr>
					<td width="50%"><?=lang('users_username')?>: *</td>
					<td width="50%"><input type="text" name="username" value="<?=set_value('username')?>" class="input-xlarge"/></td>
				</tr>
				<tr>
					<td><?=lang('users_password')?>: *</td>
					<td><input type="password" name="password" class="input-xlarge" value="" /></td>
				</tr>
				<tr>
					<td><?=lang('users_password_conf')?>: *</td>
					<td><input type="password" name="password_conf" class="input-xlarge" value=""/></td>
				</tr>
				<tr>
					<td><?=lang('users_email')?>: *</td>
					<td><input type="text" name="email" class="input-xlarge" value="<?=set_value('email')?>"/></td>
				</tr>
				<tr>
					<td><?=lang('users_last_name')?>:</td>
					<td><input type="text" name="second_name"class="input-xlarge"  value="<?=  set_value('second_name')?>"/></td>
				</tr>
				<tr>
					<td><?=lang('users_first_name')?>:</td>
					<td><input type="text" name="first_name" class="input-xlarge" value="<?=set_value('first_name')?>"/></td>
				</tr>
				<tr>
					<td><?=lang('users_patronymic')?>:</td>
					<td><input type="text" name="patronymic" class="input-xlarge" value="<?=  set_value('patronymic')?>"/></td>
				</tr>
			</table>
			<p><button type="submit" class="btn btn-primary"><?=lang('public_button_registration')?></button></p>
		<?php echo form_close(); ?>
	</div>
</fieldset>
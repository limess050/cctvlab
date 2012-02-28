<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>

<fieldset>
	<legend><?=lang('users_personal_data')?></legend>
	<div class="registration_form">
        <div class="avatar">
            <>
        </div>
		<?php echo form_open('users/personal_office/');?>
			<table>
				<tr>
					<td width="50%"><?=lang('users_last_name');?>:</td>
					<td width="50%"><input type="text" name="users_last_name"  value="<?=set_value('last_name',$listing['user_last_name']);?>" class="uniform" /></td>
				</tr>
				<tr>
					<td><?=lang('users_first_name');?>:</td>
					<td><input type="text" name="users_first_name"   value="<?=set_value('first_name', $listing['user_first_name'] );?>" class="uniform" /></td>
				</tr>
				<tr>
					<td><?=lang('users_patronymic');?>:</td>
					<td><input type="text" name="users_patronymic"  value="<?=set_value('patronymic',$listing['user_patronymic']);?>" class="uniform" /></td>
				</tr>
				<tr>
					<td><?=lang('users_email');?>:</td>
					<td><input type="text" name="users_email"  value="<?=set_value('email',$listing['user_email']);?>" class="uniform" /></td>
				</tr>
				<tr>
					<td><?=lang('users_telephone');?>:</td>
					<td><input type="text" name="users_telephone"  value="<?=set_value('telephone',$listing['user_telephone']);?>" class="uniform" /></td>
				</tr>
				<tr>
					<td><?=lang('users_icq');?>:</td>
					<td><input type="text" name="users_icq"  value="<?=set_value('icq',$listing['user_icq']);?>" class="uniform" /></td>
				</tr>
			</table>
			<p><button type="submit" class="btn btn-primary"><?php echo lang('public_button_save')?></button></p>
		<?php echo form_close(); ?>
	</div>
</fieldset>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); $this->lang->load('users/users'); ?>
<tr>
<td><div class="f_title"><?=lang('users_module_title')?></div><input type="text" name="module_parameters[]"  value="<?=set_value('module_parameters[]',$this->modules_library->parametrs('users',0));?>" class="text"/></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('users_email_activation_subject')?></div><input type="text" name="module_parameters[]"  value="<?=set_value('module_parameters[]',$this->modules_library->parametrs('users',1));?>" class="text"/></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('users_email_template')?></div><?=editor('module_parameters[]',$this->modules_library->parametrs('users',2))?></td>    
</tr>
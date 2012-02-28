<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); $this->lang->load('comparing/comparing'); ?>
<tr>
<td><div class="f_title"><?=lang('comparing_parameters_0')?></div><input type="text" name="module_parameters[]"  value="<?=set_value('module_parameters[]',$this->modules_library->parametrs('comparing',0));?>" class="text"/></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('comparing_parameters_1')?></div><input type="text" name="module_parameters[]"  value="<?=set_value('module_parameters[]',$this->modules_library->parametrs('comparing',1));?>" class="text"/></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('comparing_parameters_2')?></div><input type="text" name="module_parameters[]"  value="<?=set_value('module_parameters[]',$this->modules_library->parametrs('comparing',2));?>" class="text"/></td>
</tr>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); $this->lang->load('about/about'); ?>
<tr>
<td><div class="f_title"><?=lang('about_parameters_0')?></div><input type="text" name="module_parameters[]"  value="<?=set_value('module_parameters[]',$this->modules_library->parametrs('about',0));?>" class="text"/></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('about_parameters_1')?></div><input type="text" name="module_parameters[]"  value="<?=set_value('module_parameters[]',$this->modules_library->parametrs('about',1));?>" class="text"/></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('about_parameters_2')?></div><input type="text" name="module_parameters[]"  value="<?=set_value('module_parameters[]',$this->modules_library->parametrs('about',2));?>" class="text"/></td>
</tr>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); $this->lang->load('blog/blog'); ?>
<tr>
<td><div class="f_title"><?=lang('about_parameters_0')?></div><input type="text" name="module_parameters[]"  value="<?=set_value('module_parameters[]',$this->modules_library->parametrs('blog',0));?>" class="text"/></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('about_parameters_1')?></div><input type="text" name="module_parameters[]"  value="<?=set_value('module_parameters[]',$this->modules_library->parametrs('blog',1));?>" class="text"/></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('about_parameters_2')?></div><input type="text" name="module_parameters[]"  value="<?=set_value('module_parameters[]',$this->modules_library->parametrs('blog',2));?>" class="text"/></td>
</tr>
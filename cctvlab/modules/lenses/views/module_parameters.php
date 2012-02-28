<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); $this->lang->load('lenses/lenses'); ?>
<tr>
<td><div class="f_title"><?=lang('lenses_parameters_0')?></div><input type="text" name="module_parameters[]"  value="<?=set_value('module_parameters[]',$this->modules_library->parametrs('lenses',0));?>" class="text"/></td>
</tr>
<tr>

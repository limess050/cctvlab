<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); $this->lang->load('loader/loader'); ?>
<tr>
    <td><div class="f_title"><?php echo lang('loader_module_title');?></div><input type="text" name="module_parameters[]"  value="<?=set_value('module_parameters[]',$this->modules_library->parametrs('loader',0));?>" class="text"/></td>
</tr>
<tr>
    <td><div class="f_title"><?php echo lang('loader_adr_status_file');?></div><input type="text" name="module_parameters[]"  value="<?=set_value('module_parameters[]',$this->modules_library->parametrs('loader',1));?>" class="text"/></td>
</tr>
<tr>
    <td><div class="f_title"><?php echo lang('loader_update_time_interval');?></div><input type="text" name="module_parameters[]"  value="<?=set_value('module_parameters[]',$this->modules_library->parametrs('loader',2));?>" class="text"/></td>
</tr>

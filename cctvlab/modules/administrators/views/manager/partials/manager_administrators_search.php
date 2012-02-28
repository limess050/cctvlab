<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>

<?=form_open(base_url(element('root',$uri_segment).'/search')); ?>
<table class="panel">
<tr>
<td width="8%" align="center"><?=lang('administrators_username')?>:</td>
<td width="12%"><input type="text" name="search[administrator_username]"  value="<?=element('administrator_username',$search);?>"  class="text"/></td>
<td width="8%" align="center"><?=lang('administrators_last_name')?>:</td>
<td width="12%"><input type="text" name="search[administrator_last_name]"  value="<?=element('administrator_last_name',$search);?>"  class="text"/></td>
<td width="8%" align="center"><?=lang('administrators_first_name')?>:</td>
<td width="12%"><input type="text" name="search[administrator_first_name]"  value="<?=element('administrator_first_name',$search);?>"  class="text"/></td>
<td width="8%" align="center"><?=lang('administrators_patronymic')?>:</td>
<td width="12%"><input type="text" name="search[administrator_patronymic]"  value="<?=element('administrator_patronymic',$search);?>"  class="text"/></td>
<td width="10%" align="center"><input type="submit" class="button" value="<?=lang('manager_button_search'); ?>" /></td>
<td width="10%" align="center"><input type="button" class="button" value="<?=lang('manager_button_reset'); ?>" onClick="location.href = '<?=base_url(element('root',$uri_segment).'/search/reset')?>';"/></td>
</tr>
</table>
<?php echo form_close();?>


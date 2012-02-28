<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>

<?=form_open(base_url(element('root',$uri_segment).'/search')); ?>
<table class="panel">
<tr>
<td width="8%" align="center"><?=lang('username')?>:</td>
<td width="12%"><input type="text" name="search[user_username]"  value="<?=element('user_username',$search);?>"  class="text"/></td>
<td width="8%" align="center"><?=lang('last_name')?>:</td>
<td width="12%"><input type="text" name="search[user_last_name]"  value="<?=element('user_last_name',$search);?>"  class="text"/></td>
<td width="8%" align="center"><?=lang('first_name')?>:</td>
<td width="12%"><input type="text" name="search[user_first_name]"  value="<?=element('user_first_name',$search);?>"  class="text"/></td>
<td width="8%" align="center"><?=lang('patronymic')?>:</td>
<td width="12%"><input type="text" name="search[user_patronymic]"  value="<?=element('user_patronymic',$search);?>"  class="text"/></td>
<td width="10%" align="center"><input type="submit" class="button" value="<?=lang('manager_button_search'); ?>" /></td>
<td width="10%" align="center"><input type="button" class="button" value="<?=lang('manager_button_reset'); ?>" onClick="location.href = '<?=base_url(element('root',$uri_segment).'/search/reset')?>';"/></td>
</tr>
</table>
<?php echo form_close();?>


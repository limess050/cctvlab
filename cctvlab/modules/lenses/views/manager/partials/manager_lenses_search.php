<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>

<?=form_open(base_url(element('root',$uri_segment).'/search')); ?>
<table class="panel">
<tr>
<td width="10%" align="center"><?=lang('lenses_model')?>:</td>
<td width="70%"><input type="text" name="search[lenses_model]"  value="<?=element('lenses_model',$search);?>"  class="text"/></td>
<td width="10%" align="center"><input type="submit" class="button" value="<?=lang('manager_button_search'); ?>" /></td>
<td width="10%" align="center"><input type="button" class="button" value="<?=lang('manager_button_reset'); ?>" onClick="location.href = '<?=base_url(element('root',$uri_segment).'/search/reset')?>';"/></td>
</tr>
</table>
<?php echo form_close();?>


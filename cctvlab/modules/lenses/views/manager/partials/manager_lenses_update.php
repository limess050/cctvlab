<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>

<?=  form_open_multipart(base_url(element('root',$uri_segment).'/update')); ?>
<table class="panel">
<tr>
<td width="90%"><input type="file" name="userfile"  class="text"/></td>
<td width="10%" align="center"><input type="submit" class="button" value="<?=lang('manager_button_load'); ?>" /></td>
</tr>
</table>
<?php echo form_close();?>


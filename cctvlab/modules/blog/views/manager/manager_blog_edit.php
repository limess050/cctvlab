<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>
<?php echo $template['partials']['notifications']; ?>
<?php echo form_open($this->uri->uri_string());?>
<table class="form">
<tr>
<td width="20%"><div class="f_title"><?=lang('blog_create_on');?> *</div><input type="text" name="blog_create_on"  value="<?=set_value('blog_create_on',date_calendar(mysql_to_unix($item['blog_create_on']),'calendar'));?>" class="text calendar" readonly="true"/></td>
</tr>    
<tr>
<td><div class="f_title"><?=lang('blog_title');?> *</div><input type="text" name="blog_title"  value="<?=set_value('blog_title',$item['blog_title']);?>" class="text" /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('blog_description');?> *</div><?=editor('blog_description',set_value('blog_description', $item['blog_description']))?></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('blog_body');?> *</div><?=editor('blog_body',set_value('blog_body',$item['blog_body']))?></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('blog_record_on_site');?></div><input type="checkbox" name="blog_active" value="1"  <?=set_checkbox('blog_active','1',$item['blog_active'] ? TRUE : FALSE);?> /></td>
</tr>
<tr>
<td><div class="f_title"><?=lang('blog_tags');?></div><input type="text" name="tags_tag" value="<?=set_value('tags_tag', $tags);?>" class="text" /></td>
</tr>
<tr>
<td><div><input type="submit" class="button" value="<?=lang('manager_button_save'); ?>" /> <input type="button" class="button" value="<?=lang('manager_button_cancel'); ?>" value="<?=lang('manager_button_cancel')?>" onClick="location.href = '<?=base_url(element('return',$uri_segment))?>';"/></div></td>
</tr>
</table>
<?php echo form_close();?>






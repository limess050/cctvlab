<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>
<?php echo $template['partials']['notifications']; ?>
<?php echo form_open($this->uri->uri_string());?>
<table class="form">
<tr>
    <td><div class="f_title"><?=lang('lenses_model');?> *</div><input type="text" name="lenses_model"  value="<?=set_value('lenses_model',$item['lenses_model']);?>" class="text" readonly="true" /></td>
</tr>
<tr>
    <td><div class="f_title"><?=lang('lenses_brands');?> *</div><input type="text" name="lenses_brand" value="<?=set_value('lenses_brand', $item['lenses_brand'])?>" class="text" readonly="true" /></td>
</tr>
<tr>
    <td><div class="f_title"><?=lang('lenses_title');?></div><input type="text" name="lenses_title" value="<?=set_value('lenses_title', !empty($item['lenses_title']) ? $item['lenses_title'] : $item['lenses_model'])?>" class="text" /></td>
</tr>
<tr>
    <td><div class="f_title"><?=lang('lenses_description');?></div><?=editor('lenses_description',set_value('lenses_description',!empty($item['lenses_description']) ? $item['lenses_description'] : sprintf(lang('lenses_template_blogpost_message'), $item['lenses_model'])))?></td>
</tr>
</table>
<table class="form">
<tr>
<td>
    <table class="form-sub">
        <tr>
            <td width="33%"><div class="f_title"><?=lang('lenses_parameters_focal_type');?><input type="text" name="lenses_parameters_focal_type" value="<?=set_value('lenses_parameters_focal_type', element($item['lenses_parameters_focal'], lang('lenses_parameters_focal_arr')));?>" readonly="true" class="text" /></div></td>
            <td width="33%"><div id="parameters_focal" class="f_title"><?=lang('lenses_parameters_focal');?><input type="text" name="lenses_parameters_focal" value="<?=set_value('lenses_parameters_focal', $item['lenses_parameters_focal'] == 1 ? $item['lenses_parameters_focal_min'] : $item['lenses_parameters_focal_min'].'-'.$item['lenses_parameters_focal_max'].'mm');?>" readonly="true" class="text"/></div>
            <td width="16.5%"><div class="f_title"><?=lang('lenses_parameters_angle_horizontal');?><input type="text" name="lenses_parameters_angle_horizontal" readonly="true" value="<?=set_value('lenses_parameters_angle_horizontal',$item['lenses_parameters_focal'] == 1 ? $item['lenses_parameters_angle_horizontal_min'] : $item['lenses_parameters_angle_horizontal_min'].'-'.$item['lenses_parameters_angle_horizontal_max']);?>" class="text"/></div></td>
            <td width="16.5%"><div class="f_title"><?=lang('lenses_parameters_angle_vertical');?><input type="text" name="lenses_parameters_angle_vertical_max" readonly="true" value="<?=set_value('lenses_parameters_angle_vertical',$item['lenses_parameters_focal'] == 1 ? $item['lenses_parameters_angle_vertical_min'] : $item['lenses_parameters_angle_vertical_min'].'-'.$item['lenses_parameters_angle_vertical_max']);?>" class="text"/></div></td>
        </tr>
         <tr>
            <td><div class="f_title"><?=lang('lenses_parameters_matrix');?><input type="text" name="lenses_parameters_matrix" value="<?=set_value('lenses_parameters_matrix', $item['lenses_parameters_matrix']);?>" readonly="true" class="text" /></div></td>
            <td><div class="f_title"><?=lang('lenses_parameters_mount');?><input type="text" name="lenses_parameters_mount" value="<?=set_value('lenses_parameters_mount',$item['lenses_parameters_mount']);?>" readonly="true" class="text"/></div></td>
            <td><div class="f_title"><?=lang('lenses_parameters_weight');?><input type="text" name="lenses_parameters_weight" readonly="true" value="<?=set_value('lenses_parameters_weight',$item['lenses_parameters_weight']);?>" class="text"/></div></td>
            <td><div class="f_title"><?=lang('lenses_parameters_dimension');?><input type="text" name="lenses_parameters_dimension" readonly="true" value="<?=set_value('lenses_parameters_dimension',$item['lenses_parameters_dimension']);?>" class="text"/></div></td>
         </tr>
        <tr>
            <td><div class="f_title"><?=lang('lenses_parameters_aperture');?><input type="text" name="lenses_parameters_aperture" value="<?=set_value('lenses_parameters_aperture', element($item['lenses_parameters_aperture'], lang('lenses_parameters_aperture_arr')));?>" readonly="true" class="text" /></div></td>
            <td><div class="f_title"><?=lang('lenses_parameters_aperture_max');?><input type="text" name="lenses_parameters_aperture_max" readonly="true" value="<?=set_value('lenses_parameters_aperture_max',$item['lenses_parameters_aperture_max']);?>" class="text"/></div></td>
        </tr>
    </table>
</td>
</tr>
<tr>
    <td><div class="f_title"><?=lang('manager_on_site');?></div><input type="checkbox" name="lenses_active" value="1"  <?=set_checkbox('lenses_active','1',$item['lenses_active'] ? TRUE : FALSE);?> /></td>
</tr>

<tr>
<td><div><input type="submit" class="button" value="<?=lang('manager_button_save'); ?>" /> <input type="button" class="button" value="<?=lang('manager_button_cancel'); ?>" value="<?=lang('manager_button_cancel')?>" onClick="location.href = '<?=base_url(element('return',$uri_segment))?>';"/>
<input type="submit" name="post_blog" class="button" value="<?=lang('lenses_blog_post'); ?>" /></div></td>
</tr>
</table>
<?php echo form_close();?>






<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>
<?php echo $template['partials']['notifications']; ?>
<?php echo form_open($this->uri->uri_string());?>

<table class="form">
<tr>
<td><div class="f_title"><?=lang('lenses_model');?></div><input type="text" value="<?=$item['lenses_model'];?>" class="text" readonly="true"/></td>
</tr>
<tr>
<td>
    <table class="form-sub">
        <tr>
            <td width="33%"><div class="f_title"><?=lang('lenses_parameters_focal');?><?=form_dropdown('lenses_parameters_focal',lang('lenses_parameters_focal_arr'),$item['lenses_parameters_focal'])?></div></td>
            <td width="33%"><div id="parameters_focal_min" class="f_title"><?=lang('lenses_parameters_focal_min');?><input type="text" name="lenses_parameters_focal_min" value="<?=set_value('lenses_parameters_focal_min',$item['lenses_parameters_focal_min'] == $item['lenses_parameters_focal_max'] ? '': $item['lenses_parameters_focal_min']);?>" class="text"/></div>
            <div id="parameters_focal_const" class="f_title"  style="display: none;"><?=lang('lenses_parameters_focal_const');?><input type="text" name="lenses_parameters_focal_const" value="<?=set_value('lenses_parameters_focal_const',$item['lenses_parameters_focal_min'] == $item['lenses_parameters_focal_max'] ? $item['lenses_parameters_focal_max']: '');?>" class="text"/></div></td>
            <td width="33%"><div id="parameters_focal_max" class="f_title"><?=lang('lenses_parameters_focal_max');?><input type="text" name="lenses_parameters_focal_max" value="<?=set_value('lenses_parameters_focal_max',$item['lenses_parameters_focal_min'] == $item['lenses_parameters_focal_max'] ? '': $item['lenses_parameters_focal_max']);?>" class="text"/></div></td>
        </tr>
         <tr>
            <td width="33%"><div class="f_title"><?=lang('lenses_parameters_matrix');?><?=form_dropdown('lenses_parameters_matrix',lang('lenses_parameters_matrix_arr'),$item['lenses_parameters_matrix'])?></div></td>
            <td width="33%"><div class="f_title"><?=lang('lenses_parameters_mount');?><input type="text" name="lenses_parameters_mount" value="<?=set_value('lenses_parameters_mount',$item['lenses_parameters_mount']);?>" class="text"/></div></td>
            <td width="33%"><div class="f_title"><?=lang('lenses_parameters_angle_horizontal');?><input type="text" name="lenses_parameters_angle_horizontal" value="<?=set_value('lenses_parameters_angle_horizontal',$item['lenses_parameters_angle_horizontal']);?>" class="text"/></div></td>
        </tr>
        <tr>
            <td><div class="f_title"><?=lang('lenses_parameters_aperture');?><?=form_dropdown('lenses_parameters_aperture',lang('lenses_parameters_aperture_arr'),$item['lenses_parameters_aperture'])?></div></td>
            <td><div class="f_title"><?=lang('lenses_parameters_aperture_max');?><input type="text" name="lenses_parameters_aperture_max" value="<?=set_value('lenses_parameters_aperture_max',$item['lenses_parameters_aperture_max']);?>" class="text"/></div></td>
            <td><div class="f_title"><?=lang('lenses_parameters_angle_vertical');?><input type="text" name="lenses_parameters_angle_vertical" value="<?=set_value('lenses_parameters_angle_vertical',$item['lenses_parameters_angle_vertical']);?>" class="text"/></div></td>
        </tr>
         <tr>
            <td><div class="f_title"><?=lang('lenses_parameters_weight');?><input type="text" name="lenses_parameters_weight" value="<?=set_value('lenses_parameters_weight',$item['lenses_parameters_weight']);?>" class="text"/></div></td>
            <td><div class="f_title"><?=lang('lenses_parameters_dimension');?><input type="text" name="lenses_parameters_dimension" value="<?=set_value('lenses_parameters_dimension',$item['lenses_parameters_dimension']);?>" class="text"/></div></td>
        </tr>
    </table>
</td>
</tr>


<tr>
<td><div><input type="submit" class="button" value="<?=lang('manager_button_save'); ?>" /> <input type="button" class="button" value="<?=lang('manager_button_cancel'); ?>" value="<?=lang('manager_button_cancel')?>" onClick="location.href = '<?=base_url(element('return',$uri_segment))?>';"/></div></td>
</tr>
</table>
<?php echo form_close();?>
<?php if ($item['lenses_parameters_focal'] == '1'):?>
    <script type="text/javascript">
        set_focal_type('const')
    </script>
<?php else:?>
    <script type="text/javascript">
        set_focal_type('var')
    </script>
<?php endif;?>






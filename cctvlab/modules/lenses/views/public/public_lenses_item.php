<?php echo form_hidden('lenses_code',$item['lenses_code']); ?>
<div class="lenses-item">
<div class="title" style="width: 600px;">
        <?php echo heading($item['lenses_model'],1);?>
    <?php if($item['lenses_new'] == '1'): ?>
        <span class="label label-success" style="margin-top: 100px; margin-left: 10px">New</span>
    <?php endif;?>
    <div class="right">
        <table class="right">
            <tr>
                <td>
                    <?php if (!strpos($this->session->userdata('comparing_id'), $item['lenses_id'])):?>
                        <div id="to_compare<?=$item['lenses_id']?>" style="display: inline-block" ><a href="javascript: add_to_compare(<?=$item['lenses_id']?>)" id="to_compared<?=$item['lenses_id']?>" class="btn btn-danger" style="color: #fff; margin: 6px;"><?php echo lang('lenses_comparing_compare')?></a></div>
                    <?php else: ?>
                        <div id="complete_compare<?=$item['lenses_id']?>" style=""><a href="javascript: add_to_compare(<?=$item['lenses_id']?>)" id="to_compared<?=$item['lenses_id']?>" class="btn btn-success disabled" style="color: #fff; margin: 6px;"><?php echo lang('lenses_comparing_compared');?></a></div>
                    <?php endif;?>
                    <div id="complete_compare<?=$item['lenses_id']?>" style="display: none"><?php echo img(array('src' =>'/cctvlab/themes/public_corona/images/completed.png','class'=>'add-to-comparing2','title'=>lang('public_completed_comparing')));?></div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="image">
<?php if($images): ?>
    <table class="images" border="0">
        <tr>
            <td class="big">
                <div><?php echo img(array('src' => $images[0][element(2,$this->config->item('lenses_thumb_size'))]));?></div>
            </td>
            <td class="small">
            <?php foreach ($images as $row): ?>
                <div><?php echo anchor($row['original'],img(array('src' => $row[element(0,$this->config->item('lenses_thumb_size'))])),'class="thumbnail" rel="group" ');?></div>
            <?php endforeach; ?>
            </td>
        </tr>
    </table>
<?php endif;?>
</div>
<div class="description">
    <?php echo $item['lenses_description'];?>
</div>
<div class="chart">
    <div id="chart" class="item"></div>
    <ul>
        <li>
            <p><label for="amount"><?php echo lang('lenses_focal');?>:</label> <span id="focal-val" class="val"></span></p>
            <div id="focal-slider"></div>

        <li>
            <p><label for="amount"><?php echo lang('lenses_aperture');?>:</label> <span id="aperture-val" class="val"></span></p>
            <div id="aperture-slider"></div>
        </li>
    </ul>
</div>
<div class="chart">
    <div id="chart2"></div>
</div>

<div class="specification">
    <table class="table table-striped" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
               <td width="50%"><?php echo lang('lenses_parameters_focal');?></td>
               <td width="50%"><b><?php echo $item['lenses_parameters_focal'] ? element($item['lenses_parameters_focal'],lang('lenses_parameters_focal_arr')) : lang('lenses_parameters_none');?></b></td>
            </tr>
            <?php if ($item['lenses_parameters_focal'] == 2):?>
            <tr>
               <td><?php echo lang('lenses_parameters_focal_min');?></td>
               <td><b><?php echo $item['lenses_parameters_focal_min'] !=''  ? $item['lenses_parameters_focal_min'] : lang('lenses_parameters_none');?></b></td>
            </tr>
            <tr>
               <td><?php echo lang('lenses_parameters_focal_max');?></td>
               <td><b><?php echo $item['lenses_parameters_focal_max']  ? $item['lenses_parameters_focal_max'] : lang('lenses_parameters_none');?></b></td>
            </tr>
            <?php else:?>
            <tr>
               <td><?php echo lang('lenses_parameters_focal_const');?></td>
               <td><b><?php echo $item['lenses_parameters_focal_min']  ? $item['lenses_parameters_focal_max'] : lang('lenses_parameters_none');?></b></td>
            </tr>
            <?endif;?>
            <tr>
               <td><?php echo lang('lenses_parameters_aperture');?></td>
               <td><b><?php echo $item['lenses_parameters_aperture'] ? element($item['lenses_parameters_aperture'],lang('lenses_parameters_aperture_arr')) : lang('lenses_parameters_none');?></b></td>
            </tr>
            <tr>
               <td><?php echo lang('lenses_parameters_aperture_max');?></td>
               <td><b><?php echo $item['lenses_parameters_aperture_max']  ? $item['lenses_parameters_aperture_max'] : lang('lenses_parameters_none');?></b></td>
            </tr>
            <tr>
               <td><?php echo lang('lenses_parameters_mount');?></td>
               <td><b><?php echo $item['lenses_parameters_mount'] ? $item['lenses_parameters_mount'] : lang('lenses_parameters_none');?></b></td>
            </tr>
            <tr>
               <td><?php echo lang('lenses_parameters_angle_horizontal');?></td>
               <td><b><?php echo $item['lenses_parameters_focal'] == 1 ? $item['lenses_parameters_angle_horizontal_min'] : $item['lenses_parameters_angle_horizontal_min'].'-'.$item['lenses_parameters_angle_horizontal_max'];?></b></td>
            </tr>
            <tr>
               <td><?php echo lang('lenses_parameters_angle_vertical');?></td>
               <td><b><?php echo $item['lenses_parameters_focal'] == 1 ? $item['lenses_parameters_angle_vertical_min'] : $item['lenses_parameters_angle_vertical_min'].'-'.$item['lenses_parameters_angle_vertical_max'];?></b></td>
            </tr>
            <tr>
               <td><?php echo lang('lenses_parameters_matrix');?></td>
               <td><b><?php echo $item['lenses_parameters_matrix'] ? $item['lenses_parameters_matrix'] : lang('lenses_parameters_none');?></b></td>
            </tr>
            <tr>
               <td><?php echo lang('lenses_parameters_weight');?></td>
               <td><b><?php echo $item['lenses_parameters_weight'] ? $item['lenses_parameters_weight'] : lang('lenses_parameters_none');?></b></td>
            </tr>
            <tr>
               <td><?php echo lang('lenses_parameters_dimension');?></td>
               <td><b><?php echo $item['lenses_parameters_dimension'] ? $item['lenses_parameters_dimension'] : lang('lenses_parameters_none');?></b></td>
            </tr>
        </tbody>
    </table>
</div>
</div>



<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php echo $template['partials']['notifications']; ?>
<table width="100%" class="list">
    <tr>
        <th align="center" class="title" width="60%"><?php echo lang('loader_inputs_subject')?></th>
        <th align="center" class="title" width="20%"><?php echo lang('loader_inputs_how'); ?></th>
        <th width="20%"></th>
    </tr>
    <?php foreach($listing as $item): ?>
        <tr>
            <td align="center"><?php echo $item['module_name'] ?></td>
            <td align="center" class="edit_file"><?php echo anchor('manager/loader/check_update/TRUE', lang('loader_inputs_how'))?></td>
            <td align="center" class="edit_file"><?php echo anchor('manager/loader/edit/'.$item['data_update_id'], lang('loader_inputs_settings'))?></td>
        </tr>
    <?php endforeach; ?>
</table>


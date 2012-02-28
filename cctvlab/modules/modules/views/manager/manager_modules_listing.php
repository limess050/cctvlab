<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>
<?php echo $template['partials']['notifications']; ?>
<table width="100%" class="list">
<?php $module_type_id = 0;  foreach ($listing as $row): ?>
<?php if($row['module_type_id'] != $module_type_id): ?>  
<tr>
<th align="center" class="title" width="10%"><?=lang('manager_on_site');?></th>
<th align="left"   class="title" width="62%"><?=$row['module_type_name']?></th>
<th align="center" class="title" width="4%"></th>
<th align="center" class="title" width="4%"></th>
<th align="center" class="title" width="10%"></th>
<th align="center" class="title" width="10%"><?=$show_action ? anchor(element('root',$uri_segment).'/create/'.$row['module_type_id'],lang('manager_create'))  : '-';  ?></th>
</tr>
<?php endif; $module_type_id = $row['module_type_id'];?>
<?php if($row['module_id']): ?> 
<tr>
<td align="center"><?=$row['module_active'] ? '<span>+</span>' : '-' ?></td>
<td align="left"><?=$row['module_name']?></td>
<td align="center"><?=anchor(element('root',$uri_segment).'/up/'.$row['module_id'],image_asset('manager/up.png',FALSE,array('id'=>'logo','width'=>14,'height'=>14,'class'=>'iePNG','border'=>0)),'title="'.lang('manager_up').'" class="an"')?></td>
<td align="center"><?=anchor(element('root',$uri_segment).'/down/'.$row['module_id'],image_asset('manager/down.png',FALSE,array('id'=>'logo','width'=>14,'height'=>14,'class'=>'iePNG','border'=>0)),'title="'.lang('manager_down').'" class="an"')?></td>
<td align="center"><?=anchor(element('root',$uri_segment).'/edit/'.$row['module_id'],lang('manager_edit'))?></td>
<td align="center"><?=$show_action ? anchor(element('root',$uri_segment).'/delete/'.$row['module_id'],lang('manager_delete'),'class="delete"') : '-'?></td>
</tr>
<?php endif;?>
<?php endforeach; ?>
</table>
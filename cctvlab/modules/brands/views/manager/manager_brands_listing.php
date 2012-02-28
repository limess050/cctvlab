<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php echo $template['partials']['notifications']; ?>
<table width="100%" class="list">
<tr>
<th align="center" class="title" width="10%"><?=lang('manager_on_site')?></th>
<th align="left"   class="title" width="62"><?=lang('brands_about');?></th>
<th align="center" class="title" width="4%"></th>
<th align="center" class="title" width="4%"></th>
<th align="center" class="title" width="10%"></th>
<th align="center" class="title" width="10%"><?=anchor(element('root',$uri_segment).'/create',lang('manager_create'));  ?></th>
</tr>
<?php if($listing): ?> 
<?php foreach ($listing as $row): ?> 			
<tr>
<td align="center"><?=$row['brands_active'] ? '<span>+</span>' : '-' ?></td>
<td align="left"><?=$row['brands_name'];?></td>
<td align="center"><?=anchor(element('root',$uri_segment).'/up/'.$row['brands_id'],image_asset('manager/up.png',FALSE,array('id'=>'logo','width'=>14,'height'=>14,'class'=>'iePNG','border'=>0)),'title="'.lang('manager_up').'" class="an"')?></td>
<td align="center"><?=anchor(element('root',$uri_segment).'/down/'.$row['brands_id'],image_asset('manager/down.png',FALSE,array('id'=>'logo','width'=>14,'height'=>14,'class'=>'iePNG','border'=>0)),'title="'.lang('manager_down').'" class="an"')?></td>
<td align="center"><?=anchor(element('root',$uri_segment).'/edit/'.$row['brands_id'],lang('manager_edit'))?></td>
<td align="center"><?=anchor(element('root',$uri_segment).'/delete/'.$row['brands_id'],lang('manager_delete'),'class="delete"')?></td>
</tr>
<?php endforeach; ?>
<?php endif;?>
</table>
<div class="paggination"><?php echo $pagination; ?></div>


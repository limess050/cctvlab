<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php echo $template['partials']['notifications']; ?>
<table width="100%" class="list">
<tr>
<th align="center" width="4%"><?= form_checkbox()?></th>
<th align="center" class="title" width="10%"><?php echo anchor(element('root',$uri_segment).'/order/lenses_active/', lang('manager_on_site'))?></th>
<th align="center" class="title" width="10%"><?php echo anchor(element('root',$uri_segment).'/order/lenses_new/', lang('manager_new'))?></th>
<th align="center" class="title" width="10%"><?php echo anchor(element('root',$uri_segment).'/order/lenses_on_blog/', lang('lenses_on_blog'))?></th>
<th align="left"   class="title" width="28"><?php echo anchor(element('root',$uri_segment).'/order/lenses_model/', lang('lenses_lenses'))?></th>
<th align="center" class="title" width="10%"><?php echo anchor(element('root',$uri_segment).'/order/lenses_brand/', lang('lenses_brands'))?></th>
<th align="center" class="title" width="4%"></th>
<th align="center" class="title" width="4%"></th>
<th align="center" class="title" width="4%"></th>
<th align="center" class="title" width="10%"><?=anchor(element('root',$uri_segment), lang('lenses_search'),'class="open-top-content"');  ?></th>
<th align="center" class="title" width="10%"><?=anchor(element('root',$uri_segment), lang('lenses_update'),'class="open-top-content-2"');  ?></th>
</tr>
<?php if($listing): ?>
<?php foreach ($listing as $row): ?>
<tr>
<td align="center"><?= form_checkbox()?></td>
<td align="center" class="edit_file"><?=$row['lenses_active'] ? '<span>+</span>' : '-' ?></td>
<td align="center" class="edit_file"><?=$row['lenses_new'] ? '<span>+</span>' : '-' ?></td>
<td align="center" class="edit_file"><?=$row['lenses_on_blog'] ? '<span>+</span>' : '-' ?></td>
<td align="left"><?=$row['lenses_model'];?></td>
<td align="center"><?=$row['lenses_brand']?></td>
<td align="center"><?=anchor(element('root',$uri_segment).'/up/'.$row['lenses_id'],image_asset('manager/up.png',FALSE,array('id'=>'logo','width'=>14,'height'=>14,'class'=>'iePNG','border'=>0)),'title="'.lang('manager_up').'" class="an"')?></td>
<td align="center"><?=anchor(element('root',$uri_segment).'/down/'.$row['lenses_id'],image_asset('manager/down.png',FALSE,array('id'=>'logo','width'=>14,'height'=>14,'class'=>'iePNG','border'=>0)),'title="'.lang('manager_down').'" class="an"')?></td>
<td align="center"><?=anchor(element('root',$uri_segment).'/images/'.$row['lenses_code'],image_asset('manager/image.png', FALSE, array('id' => 'image', 'width'=>14,'height'=>14,'class'=>'iePNG','border'=>0)),'class="an"')?></td>
<td align="center"><?=anchor(element('root',$uri_segment).'/edit/'.$row['lenses_id'],lang('manager_card'))?></td>
<td align="center"><?=anchor(element('root',$uri_segment).'/delete/'.$row['lenses_id'],lang('lenses_delete'))?></td>
</tr>
<?php endforeach; ?>
<?php endif;?>
</table>
<div class="paggination"><?php echo $pagination; ?></div>


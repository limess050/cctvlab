 <?php if($listing): ?> 
    <table cellspacing="0" cellpadding="0" border="0" class="productGrid">
        <tbody>
            <tr>
                <?php $i=1; foreach ($listing as $row): ?> 	
                   <td>

                   <div class="image">

                        <?php if($row['images']): ?>
                         <?php echo anchor('/lenses/item/'.$row['lenses_id'],img(array('src' => $row['images'][element(1,$this->config->item('lenses_thumb_size'))])));?>
                       <?php else:?>
                         <?php echo anchor('/lenses/item/'.$row['lenses_id'],image_asset('none.png','lenses'));?>   
                       <?php endif;?>
                   </div>
                   <div class="name"><?php echo anchor('lenses/item/'.$row['lenses_id'],$row['lenses_model']);?></div>
                    <?php //echo anchor('comparing/'.$row['lenses_id'],img(array('src' =>'/cctvlab/themes/public_corona/images/comparison.png','class'=>'add-to-comparing2','title'=>lang('public_add_to_comparing_and_redirect'))));?>
                    <?php if (!strpos($this->session->userdata('comparing_id'), $row['lenses_id'])):?>
                        <div class="btn-group" id="to_compared<?=$row['lenses_id']?>" style="margin-bottom: 5px" >
                           <a class="btn btn-danger" href="javascript: add_to_compare(<?=$row['lenses_id']?>)" style="color: #fff; margin-left: 33px; margin-bottom: 5px"><?php echo lang('lenses_comparing_compare')?></a>
                           <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#" style="height: 18px;">
                               <span class="caret"></span>
                           </a>
                           <ul class="dropdown-menu">
                               <li><a href="<?php echo base_url('comparing/'.$row['lenses_id'])?>"><?php echo lang('lenses_comparing_to_compare')?></a></li>
                           </ul>
                       </div>
                    <?php else: ?>
                        <div id="complete_compare<?=$row['lenses_id']?>" style=""><a href="javascript: add_to_compare(<?=$row['lenses_id']?>)" id="to_compared<?=$row['lenses_id']?>" class="btn btn-success disabled" style="color: #fff; margin-left: 0px; margin-bottom: 5px"><?php echo lang('lenses_comparing_compared');?></a></div>
                    <?php endif;?>
                    <div></div>
                   </td>
                   <?php if($i%4 == 0): ?></tr><tr><?php endif;?>
                <?php $i++; endforeach; ?>
            </tr>
        </tbody>
    </table>
<div class="paggination"><?php echo $pagination; ?></div>
<?php endif;?>


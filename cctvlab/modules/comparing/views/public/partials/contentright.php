<div class="module mod-line   first ">
    <div class="box-1 deepest">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">Список</span> сравнения</span></span></h3>
    <?php if($comparing): ?>
        <div class="flatlist">
            <table class="zebra">
                <?php foreach($comparing as $item): ?>
                <tr>
                    <td>
                    <?php echo anchor('lenses/item/'.$item['lenses_id'], $item['lenses_model'])?>
                   <div class="right">
                       <a href="#" onClick="javascript: compare(<?php echo $item['lenses_id']?>,'left',<?php echo $item['lenses_code']?>)"  title="<?php echo(lang('comparing_left'));?>"><i class="icon-chevron-left"></i></a>
                       <a href="#" onClick="javascript: compare(<?php echo $item['lenses_id']?>,'right',<?php echo $item['lenses_code']?>)" title="<?php echo(lang('comparing_right'));?>"><i class="icon-chevron-right"></i></a>
                   </div></td>
                </tr>
                <?php endforeach;?>
            </table>
            <br/>
            <div><button class="btn" onClick="location.href='<?=  base_url('comparing/reset')?>'"><?=lang('public_button_reset')?></button></div>
        </div>
    <?php endif;?>
    </div>
</div>
<?php if($breadcrumbs): ?>  
    <div class="breadcrumbs">
        <?php echo anchor(base_url(),lang('public_mmenu_home'));?>
        <?php if(!is_array($breadcrumbs)): ?>
            <strong><?php echo $breadcrumbs;?></strong>
        <?php else: ?>
            <?php foreach ($breadcrumbs as $key=>$val): ?> 
                <?php if($key): ?>
                 <?php echo anchor($val,$key);?>
                <?php else: ?>
                 <strong><?php echo $val;?></strong>
                <?php endif;?>
            <?php endforeach; ?>
       <?php endif;?>
    </div>
<?php endif ?> 
<div class="module mod-line  first ">
    <div class="box-1 deepest">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">ПОИСК</span> ОБЪЕКТИВЫ</span></span></h3>
    <div class="lenses-search">
        <?php echo form_open('/lenses/search/');?>
        <ul>
            <li><?=lang('lenses_brands')?>:</li>
            <li><div><?=form_dropdown('search[lenses_brands]',$this->brands_library->dropdown(), element('lenses_brands', $this->search->read()),'class="uniform"')?></div></li>
            <li><?=lang('lenses_parameters_focal')?>:</li>
            <li><div><?=form_dropdown('search[lenses_parameters_focal]',lang('lenses_parameters_focal_arr'), element('lenses_parameters_focal', $this->search->read()),'class="uniform"')?></div></li>
            <li>
              <div class="input-val">
                от <input type="text" class="input-medium search-query" id="focal_min_val" name="search[focal_min_val]" value="<?=element('focal_min_val', $search) ? element('focal_min_val', $search) : 0;?>" />
                до <input type="text" class="input-medium search-query" id="focal_max_val" name="search[focal_max_val]" value="<?=element('focal_max_val', $search) ? element('focal_max_val', $search) : 200;?>" />
              </div>
            </li>
            <li><div id="focal_slider" class="slider"></div></li>
            <li></li>
            <li>
                <button type="submit" class="btn btn-primary" style="padding: 4px 20px 4px"><?php echo lang('public_button_search');?></button>
                <button type="reset" class="btn" onclick="location.href = '<?php echo base_url('lenses/reset')?>';"><?php echo lang('public_button_reset');?></button>
            </li>
        </ul>
        <?php form_close();?>
    </div>  
</div>  
</div>


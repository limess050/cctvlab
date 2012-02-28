<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<table>
    <tr>
        <td width="20%">
            <?php if($image['125x110']):?>
                <img src="<?php echo $image['125x110']?>"  alt="<?php echo $item['lenses_model']?>" width="120" height="110" align="left" style="margin: 20px"/>
            <?php else: ?>
                <?php echo image_asset('none.png', 'lenses', array('width' => 120, 'height' => 110, 'align' => 'left', 'style' => 'margin: 20px'))?>
            <?php endif;?>
            <?php echo $item['lenses_description'] ?>
        </td>
    </tr>
</table>
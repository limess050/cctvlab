 <?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<table border ="0" width="100%">
    <tr>
        <td width="50%" align="center">
            <div class="lenses">
                <?php echo form_hidden('default_left',$this->uri->segment(2,0));?>
            </div>
        </td>
        <td width="50%" align="center">
            <div class="lenses">
                <?php echo form_hidden('default_right',0);?>
            </div>
        </td>
    </tr>
    <tr>
        <td width="100%" valign="top">
            <div id="charts" class="loading_ajax" style="width: 100%; height: 500px"></div>
        </td>
    </tr>
</table>


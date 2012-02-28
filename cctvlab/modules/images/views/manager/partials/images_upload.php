<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>

<?php $this->lang->load('images/images'); ?>

<?php echo css_asset('manager/images.css');?>
<div id="fileupload">
    <form action="/manager/images/action/<?php echo $module_name;?>/<?php echo $images_code;?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" value="delete" />
        <table class="form">
        <tr>
        <td colspan="2">
            <table class="form-sub">
                <tr>
                    <td>
                        <div class="fileupload-content">
                        <table class="files" border="0" cellspacing="1" cellpadding="1"></table>
                        </div>
                    </td>
                </tr>        
            </table>
        </td>
        </tr>
        <tr>
            <td width="50%">
                <div class="fileupload-buttonbar"> 
                    <input type="submit" class="button start" value="<?=lang('manager_button_load'); ?>" />
                    <input type="reset" class="button cancel" value="<?=lang('manager_button_cancel'); ?>"/>
                    <input type="button" class="button delete" value="<?=lang('manager_button_delete'); ?>"/>
                    <input type="button" class="button" value="<?=lang('manager_button_close'); ?>"  onClick="location.href = '<?=base_url(element('return',$uri_segment))?>';"/>
                </div>
            </td>
            <td width="50%" align="right"><input type="file" name="userfile" multiple class="text"/></td>
        </tr>
        </table>
    </form>
</div>

<script id="template-upload" type="text/x-jquery-tmpl">
   <tr class="template-upload">
        <td width="15%" class="preview"></td>
        <td width="15%" class="name">${name}</td>
        <td width="15%" class="size">${sizef}</td>
        <td width="25%" class="progress"><div></div></td>
        <td width="15%" class="button start"><button><?=lang('manager_button_load'); ?></button></td>
        <td width="15%" class="button cancel"><button><?=lang('manager_button_cancel'); ?></button></td>
    </tr>
</script>

<script id="template-download" type="text/x-jquery-tmpl">
    <tr class="template-download {{if error}}state-error{{/if}}">
        {{if error}}
            <td width="15%"></td>
            <td width="15%" class="name">${name}</td>
            <td width="15%" class="size">${sizef}</td>
            <td width="25%" class="error">${error}</td>
        {{else}}
            <td width="15%" class="preview"><a href="${url}" target="_blank"><img width="80" src="${thumb_url}"/></a></td>
            <td width="15%" class="name"><a href="${url}">${name}</a></td>
            <td width="15%" class="size">${sizef}</td>
            <td width="25%"><div></div></td>
        {{/if}}
        <td width="15%"></td>

        <td width="15%" class="button delete">
<button data-type="${delete_type}" data-url="${delete_url}" class="button"><?=lang('manager_button_delete'); ?></button></td>
    </tr>
</script>
                                
<?php echo js_asset('jquery/jquery-ui.min.js');?>
<?php echo js_asset('jquery/jquery.tmpl.min.js');?>
<?php echo js_asset('jquery/jquery.iframe-transport.js');?>
<?php echo js_asset('jquery/jquery.fileupload.js');?>
<?php echo js_asset('jquery/jquery.fileupload-ui.js');?>
<?php echo js_asset('images.js','images');?>



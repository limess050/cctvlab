<div class="comments">
<?php foreach ($comments as $row): ?>
      <div class="Comment">
          <div class="commentHead">
            <h4><u><?=$row['comment_author']?></u></h4>
          </div>
          <p></p>
          <div class="commentBody">
            <p><?=$row['comment_body']?></p>
          </div>
          <div class="commentFooter">
            <?php echo anchor('manager/blog/comment_delete/'.$row['comment_id'].'/'.$row['comment_record_id'] ,lang('manager_comment_delete'));?>&nbsp&nbsp&nbsp<?php echo anchor('manager/blog/comment_edit/'.$row['comment_id'].'/'.$row['comment_record_id'],  lang('manager_comment_edit'));?>&nbsp&nbsp <i><?=  lang('manager_comment_create_on')?> <?=$row['comment_create_on']?></i>
          </div>          
      </div>
<?php endforeach;?>
</div>
<?php if(empty($comment['comment_id'])) $comment['comment_id'] = '#';   ?>
<?php if(empty($row['comment_record_id'])) $row['comment_record_id'] = '#';   ?>
<?php echo form_open(base_url("manager/blog/comment_edit/{$comment['comment_id']}/{$row['comment_record_id']}"));?>
<div id="comment_edit_form">
    <table class="form">
        <tr>
            <td width="20%"><div class="f_title"><?=lang('manager_comment_author');?></div><input type="text" name="comment_author"  value="<?php if(!empty($comment['comment_author'])) echo $comment['comment_author']; ?>" class="text" /></td>
        </tr>    
        <tr>
            <td><div class="f_title"><?=lang('manager_comment_body');?></div><textarea name="comment_body" rows="10" cols="40" class="text"><?php if(!empty($comment['comment_body'])) echo $comment['comment_body']; ?></textarea></td>
        </tr>
        <tr>
            <td><div><input type="submit" class="button" value="<?=lang('manager_button_save'); ?>" /></div></td>
        </tr>
     </table>
</div>
<?php echo form_close();?>
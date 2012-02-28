<div class="post">
    <div class="postHead"><h2 class="post_title"><?=$record['blog_title'];?></h2></div>
    <div class="postBody"><p><?=$record['blog_body'];?></p></div>
    <div class="postLikes">
        <span class="fb-like" data-send="false" data-layout="button_count"  data-show-faces="false"></span>
        <span><g:plusone size="medium"></g:plusone></span>
        <span><script type="text/javascript"><!--
           document.write(VK.Share.button(false,{type: "round", text: "Сохранить"}));
           --></script></span>
    </div>
</div>
<div id="comments">
    <div class="comments nested no-response">
        <h3 class="comments-meta"><span class="comments-count"><?= lang('blog_comments_head')?></span></h3>
        <ul class="level1">
        <?php foreach ($comments as $row): ?>
               <li>
                  <div id="comment-3" class="comment ">
                      <div class="comment-head">
                          <div class="avatar"><?php echo img('cctvlab/themes/public_corona/images/avatar.png');?></div>
                          <div class="author"><?=$row['comment_author']?></div>
                          <div class="meta">
                            <?php echo date("d.m.Y H:i:s",mysql_to_unix($row['comment_create_on']));?>
                            <?php if ($user = $this->current_user): ?>
                                <?php if ($user['user_id'] == $row['comment_user']) :?>
                                    | <?php echo anchor('blog/comment_del/'.$row['comment_id'].'/'.$row['comment_record_id'].'#comments','X','title="'.lang('comment_delete').'"');?> 
                                <?php endif;?>
                            <?php endif?>
                          </div>
                       </div>
                       <div class="comment-body">
                          <p class="content"><?=$row['comment_body']?></p
                       </div>
                   </div>
               </li>
          <?php endforeach;?>
          </ul>
          <div id="respond">
              <h2><?php echo lang('comment_leave_comment');?></h2>
              <?php if($user = $this->current_user): ?>
              <?php echo form_open('blog/comment_add');?>
              <?php echo form_hidden('comment_record_id', $this->uri->segment(3));?>
              <ul>
                  <li><?php echo lang('blog_comment_username');?></li>
                  <li><input type="text" name="comment_author" value="<?=$user['user_username']?>" readonly="true"/></li>
                  <li><?php echo lang('blog_comment_username_comment');?></li>
                  <li><textarea name="comment_body"></textarea></li>

                  <li><button type="submit" class="btn btn-large"><?=lang('public_button_create')?></button></li>
              </ul>
              <?php echo form_close(); ?>
              <?php else :?>
              <p class="user"><?php echo lang('comment_please_login');?></p>
              <?php endif;?>
           </div>
    </div>
</div>





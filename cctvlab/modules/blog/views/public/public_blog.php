<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
   <?php if($listing): ?>
        <?php foreach ($listing as $row): ?>
        <div class="post">
            <div class="postHead">
                <?php if(empty($row['blog_href'])): ?>
                    <?php echo anchor('blog/comments/'.$row['blog_id'],heading($row['blog_title'],2));?>
                <?php else: ?>
                    <?php echo anchor('lenses/item/'.$row['blog_href'],heading($row['blog_title'],2));?>
                <?php endif;?>
            </div>
            <div class="postBody">
                <?=$row['blog_description'];?><br />
            </div>
            <div class="postFooter">
                  <span> <i class="icon-calendar"></i> <?php echo sprintf(lang('comment_create_on'),date('d.m.Y',mysql_to_unix($row['blog_create_on'])));?></span> |
                <?php if(empty($row['blog_href'])): ?>
                    <i class="icon-comment" style="margin-top: 2px; margin-right: 3px"></i><?php echo anchor('blog/comments/'.$row['blog_id'].'#comments',lang('blog_comments_head'));?> |
                    <?php echo anchor('blog/comments/'.$row['blog_id'], lang('blog_read_more'));?> <i class="icon-arrow-right" style="margin-top: 2px"></i>
                <?php else: ?>
                    <?php echo anchor('lenses/item/'.$row['blog_href'], lang('blog_read_more'));?> <i class="icon-arrow-right" style="margin-top: 2px"></i>
                <?php endif;?>
            </div>
        </div>
        <?php endforeach; ?>
   <?php endif;?>
<div class="paggination"><?php echo $pagination; ?></div>

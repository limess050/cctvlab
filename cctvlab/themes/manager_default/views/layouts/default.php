<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); //print_r($_SESSION); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo lang('manager_title') ?></title>
<script type='text/javascript' src='/cctvlab/themes/manager_default/js/jquery/jquery-1.6.4.min.js'></script>
<script type='text/javascript' src='/cctvlab/themes/manager_default/js/manager/functions.js'></script>
<script type='text/javascript' src='/cctvlab/themes/manager_default/js/manager/calendar.js'></script>
<link rel="stylesheet" type="text/css" href="/cctvlab/themes/manager_default/css/manager/style.css" />
<link rel="stylesheet" type="text/css" href="/cctvlab/themes/manager_default/css/manager/notifications.css" />
<link rel="stylesheet" type="text/css" href="/cctvlab/themes/manager_default/css/manager/calendar.css" />
<link rel="stylesheet" type="text/css" href="/cctvlab/themes/manager_default/css/manager/manager_blog.css" />
<?php echo $template['metadata'];?>
<!--[if lt IE 7]>
<![if gte IE 5.5]>
<script type="text/javascript" src="/cctvlab/themes/manager_default/js/fixpng.js"></script>
<style type="text/css"> 
.iePNG { filter:expression(fixPNG(this)); } 
.iePNG A { position: relative; }
</style>
<![endif]>
<![endif]-->
</head>
<body>
<div id="elapsed">{elapsed_time}</div> 
<div id="mmenu">
<div class="conteiner">
<?php if(!empty($mmenu)): ?>    
    <?php $name = ''; foreach ($mmenu as $row): ?>
    <?php if($name != $row['module_type_name']): ?>
       </ul><?=heading($row['module_type_name'],1);?><ul>
    <?php endif; $name = $row['module_type_name']?>
        <li <?php if($current_module == $row['module_uname']): ?> class="ac"<?php endif; ?>><?=anchor(base_url('manager/'.$row['module_uname']),$row['module_name'])?></li>
    <?php endforeach; ?>
<?php endif; ?>
  <li><?=anchor(base_url(),lang('manager_site'),'target="_blank"')?></li>
  <li><?=anchor(base_url('manager/logout'),lang('manager_logout'))?></li>
</ul>
</div><!-- #conteiner-->
</div><!-- #mmenu-->
<div id="content">
<div id="top-content" class="top-content"><?php echo isset($template['partials']['top_content']) ? $template['partials']['top_content'] : ''; ?></div>
<div id="top-content-2" class="top-content"><?php echo isset($template['partials']['top_content_2']) ? $template['partials']['top_content_2'] : ''; ?></div>
<?php echo $template['body']; ?><br>
&nbsp;
</div><!-- #content-->
</body> 
</html>
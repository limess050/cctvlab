
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="robots" content="index, follow" />
  <meta name="keywords" content="<?php echo $keywords;?>" />
  <meta name="description" content="<?php echo $description;?>" />
  <title><?php echo $template['title'];?></title>
  <link href="<?=base_url('blog/rss')?>" rel="alternate" type="application/rss+xml" title="RSS 2.0" />
<!--  <link href="/demo/themes/joomla/2011/corona/index.php?format=feed&amp;type=atom" rel="alternate" type="application/atom+xml" title="Atom 1.0" />-->
  <link href="/demo/themes/joomla/2011/corona/templates/yoo_corona/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<!--  <link rel="stylesheet" href="/cctvlab/themes/public_corona/css/public/shadowbox.css" type="text/css" />-->
  <link rel="stylesheet" href="/cctvlab/themes/public_corona/css/public/notifications.css" type="text/css" />
  <link rel="stylesheet" href="/cctvlab/themes/public_corona/css/public/style0.css" type="text/css" />
  <link rel="stylesheet" href="/cctvlab/themes/public_corona/css/public/style1.css" type="text/css" />
  <link rel="stylesheet" href="/cctvlab/themes/public_corona/css/public/style2.css" type="text/css" />
  <link rel="stylesheet" href="/cctvlab/themes/public_corona/css/public/style3.css" type="text/css" />
<!--  <link rel="stylesheet" href="/cctvlab/themes/public_corona/css/public/blog.css" type="text/css" />-->
  <link rel="stylesheet" href="/cctvlab/themes/public_corona/css/public/bootstrap.css" type="text/css" />
  <link  rel="icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="/cctvlab/themes/manager_default/plugins/colorbox/colorbox.css" type="text/css" />
  <style type="text/css">
  <?php if($current_module == 'about'): ?>
  <!--
        .wrapper { width: 1020px; }
        #content-shift { margin-right: 318px; }
        #contentright { width: 318px; margin-left: -318px; }
        #menu .dropdown { width: 250px; }
        #menu .columns2 { width: 500px; }
        #menu .columns3 { width: 750px; }
        #menu .columns4 { width: 1000px; }
  -->
  <?php else: ?>
   <!--
        .wrapper { width: 1020px; }
        #content-shift { margin-right: 240px; }
        #contentright { width: 240px; margin-left: -240px; }
        #menu .dropdown { width: 250px; }
        #menu .columns2 { width: 500px; }
        #menu .columns3 { width: 750px; }
        #menu .columns4 { width: 1000px; }
    -->
  <?php endif ?>
  </style>
  <script type="text/javascript" src="/cctvlab/themes/js/jquery/jquery-1.7.1.min.js"></script>
<!--  <script type="text/javascript" src="/cctvlab/themes/public_corona/js/public/js3.js"></script>-->
  <script type="text/javascript" src="/cctvlab/themes/public_corona/js/public/js4.js"></script>
<!--  <script type="text/javascript" src="/cctvlab/themes/public_corona/js/public/search.js"></script>-->
  <script type="text/javascript" src="/cctvlab/themes/public_corona/js/public/notifications.js"></script>
  <script type="text/javascript" src="/cctvlab/themes/js/plugins/colorbox/jquery.colorbox.js"></script>
  <script type="text/javascript" src="/cctvlab/themes/public_corona/js/public/highcharts.js"></script>
  <script type="text/javascript" src="/cctvlab/themes/public_corona/js/public/grid.js"></script>
  <script type="text/javascript" src="/cctvlab/themes/public_corona/js/public/bootstrap-dropdown.js"></script>
  <?php echo $template['metadata'];?>
  <link rel="apple-touch-icon" href="/cctvlab/themes/public_corona/images/apple_touch_icon.png" />
  <script type="text/javascript">
//    $(function(){
//        $(".uniform").uniform();
//      });
  </script>
</head>
<body id="page" class="yoopage  column-contentright   style-default background-default font-default webfonts">
    <div id="absolute"></div>
	<div id="page-body">
            <div class="wrapper">
                <div class="wrapper-1">
                    <div class="wrapper-2">
                        <div class="wrapper-3">
                            <div id="header">
                               <?php echo $template['partials']['toolbar']; ?>
                               <?php echo isset($template['partials']['headerbar']) ? $template['partials']['headerbar'] :'';?>
                               <?php echo $template['partials']['mmenu']; ?>
                                <div class="menushadow"></div>
                                <div id="logo"><a class="logo-icon correct-png" href="/" title="Home"></a></div>
				<?php echo $template['partials']['search']; ?>										
                                <div id="socialbookmarks">
                                    <div class="module mod-blank first last">
                                        <a class="twitter" target="_blank" title="Twitter" href="http://www.twitter.com/yootheme"></a>
                                        <a class="facebook" target="_blank" title="Facebook" href="http://www.facebook.com"></a>
                                        <a class="flickr" target="_blank" title="Flickr" href="http://www.flickr.com"></a>
                                        <a class="linkedin" target="_blank" title="LinkedIn" href="http://www.linkedin.com"></a>
                                        <a class="myspace" target="_blank" title="MySpace" href="http://www.myspace.com"></a>		
                                    </div>							
                                </div>
                            </div>
                            <div id="middle">
                                <div id="middle-expand">
                                    <div id="main">
                                        <div id="main-shift">
                                            <?php echo isset($template['partials']['maintop']) ? $template['partials']['maintop'] :'';?>
                                            <div id="mainmiddle">
                                                <div id="mainmiddle-expand">
                                                    <div id="content"><div id="content-shift">
                                                    <?php echo $template['partials']['breadcrumbs']; ?>
                                                    <div id="component" class="floatbox">
                                                        <?php echo $template['partials']['notifications']; ?>
                                                        <?php echo $template['body']; ?>
                                                        <!-- webim button --><a href="http://www.webim.local/client.php?locale=ru" target="_blank" onclick="if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('http://www.webim.local/client.php?locale=ru&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'webim', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"><img src="http://www.webim.local/b.php?i=webim&amp;lang=ru" border="0" width="163" height="61" alt=""/></a><!-- / webim button -->

                                                    </div>
                                                        </div>
                                                    </div>
                                                     
                                                    <div id="contentright" class="vertical">
                                                        <div class="contentright-1"></div>
                                                        <?php echo $template['partials']['contentright']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="bottom"><?php echo $template['partials']['bottom']; ?></div>
                            <div id="footer"><?php echo $template['partials']['footer']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 </body>
</html>
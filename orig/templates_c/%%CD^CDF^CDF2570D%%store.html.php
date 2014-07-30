<?php /* Smarty version 2.6.22, created on 2014-07-30 07:24:20
         compiled from /home/content/71/7128071/html//templates/store.html */ ?>
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
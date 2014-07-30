<?php /* Smarty version 2.6.22, created on 2014-07-27 09:05:11
         compiled from /home/content/71/7128071/html//templates/purchased_items.html */ ?>
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
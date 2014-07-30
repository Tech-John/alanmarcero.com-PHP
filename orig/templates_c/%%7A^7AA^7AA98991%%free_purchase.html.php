<?php /* Smarty version 2.6.22, created on 2014-07-29 05:07:20
         compiled from /home/content/71/7128071/html//templates/free_purchase.html */ ?>
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
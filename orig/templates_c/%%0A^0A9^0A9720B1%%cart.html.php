<?php /* Smarty version 2.6.22, created on 2014-07-29 07:31:55
         compiled from /home/content/71/7128071/html//templates/cart.html */ ?>
<?php if (count ( $this->_tpl_vars['cart'] ) > 0): ?>
	<table border="0" cellpadding="20px">
		<?php $_from = $this->_tpl_vars['cart']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<tr>
				<td><a href="http://www.alanmarcero.com"><?php echo $this->_tpl_vars['item']['name']; ?>
</td>
				
				<td>
					<form action="index.php" method="GET">
						<input type="hidden" name="item_id" value="<?php echo $this->_tpl_vars['item']['id']; ?>
" />
						<input type="hidden" name="add_to_cart" value="true" />
						
						<?php if ($this->_tpl_vars['item']['price'] == 0.00): ?>	
							$<input type="text" name="price" value="25.00" class="textField" size="3" />
						<?php else: ?>
							$<input type="text" name="price" value="<?php echo $this->_tpl_vars['item']['price']; ?>
" class="textField" size="3" />
						<?php endif; ?>
						<input type="submit" class="buttonSubmit" value="Update Price" />
					</form>
				</td>
				<td>$<?php if (! $this->_tpl_vars['item']['price']): ?>0.00<?php else: ?><?php echo $this->_tpl_vars['item']['price']; ?>
<?php endif; ?></td>
				<td><a href="index.php?remove_from_cart=true&item_id=<?php echo $this->_tpl_vars['item']['id']; ?>
">remove</a></td>
			</tr>
		<?php endforeach; endif; unset($_from); ?>
	</table>
	
	
	<p>&nbsp;</p>
	<h2 class="textCenter"><a href="http://www.alanmarcero.com" />Return to Store</a></h2>
	<hr />
		<div id="subtotal">
			<h1>Subtotal: $<?php echo $this->_tpl_vars['subtotal']; ?>
</h1>
			<p>&nbsp;</p>
			<?php if ($this->_tpl_vars['subtotal'] != 0.00): ?>
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
			<?php else: ?>
				<form action="index.php" method="POST" />
					<input type="hidden" name="free_purchase" value="true" />
					<input type="submit" value="Purchase Items" />
				</form>
			<?php endif; ?>
		</div>
<?php else: ?>
	<p>Your cart is empty! :(</p>
<?php endif; ?>
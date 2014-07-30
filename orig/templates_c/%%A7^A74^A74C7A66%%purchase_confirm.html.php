<?php /* Smarty version 2.6.22, created on 2014-07-27 08:52:06
         compiled from /home/content/71/7128071/html//templates//mail/purchase_confirm.html */ ?>
Thank you for your recent order from AlanMarcero.com

You have purchased the following items:

<?php $_from = $this->_tpl_vars['cart']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	Name: <?php echo $this->_tpl_vars['item']['name']; ?>
 
	Download Link: <?php echo $this->_tpl_vars['item']['full_item_url']; ?>

<?php endforeach; endif; unset($_from); ?>

Your purchased item(s) are ready to be downloaded at the above link(s).  At any point you may login here: http://www.alanmarcero.com/customers.php
with your login and password to redownload the patches or download updates.

Your login email: <?php echo $this->_tpl_vars['email']; ?>

Your login password: <?php echo $this->_tpl_vars['password']; ?>


Alan Marcero
http://www.alanmarcero.com
<?php /* Smarty version 2.6.22, created on 2014-07-28 20:11:49
         compiled from /home/content/71/7128071/html//templates/retrieve_pw.html */ ?>
<form action = 'login.php' method = "GET">
	<?php echo $this->_tpl_vars['message']; ?>

	<p>
		<label>Email:<br /></label>
		<input type="text" name="retrieve_pw_email" class="textField" />
	</p>
	<input type="submit" value="Retreive Password" class="buttonSubmit" />
</form>
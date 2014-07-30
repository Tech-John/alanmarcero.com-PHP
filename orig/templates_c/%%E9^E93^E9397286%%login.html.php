<?php /* Smarty version 2.6.22, created on 2014-07-29 14:14:29
         compiled from /home/content/71/7128071/html//templates/login.html */ ?>
<fieldset>
	<?php if ($this->_tpl_vars['login_failed']): ?><span style="color:red">Your email and/or password do not match my records.</span><?php endif; ?>
	<legend>AlanMarcero.com Account</legend>
	
	<form action="login.php" method="POST" />
		<p>
			<label>Email:<br /></label>
			<input type="text" name="email" class="textField" />
		</p>
		
		<p>
			<label>Password: <br /></label>
			<input type="password" name="password" class="textField" /><br />
			<small><a href="login.php?retrieve_pw=true">Can't Remember Your Password?</a></small>
		</p>
		
		<p>
			<input type="hidden" name="authorize" value="true" />
			<input type="submit" value="Login" class="buttonSubmit" />
		</p>
	</form>
</fieldset>
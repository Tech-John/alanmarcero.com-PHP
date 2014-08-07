<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>--- Alan Marcero  &middot;  Web Programmer  &middot;  Music Producer ---</title>
<link rel="stylesheet" href="http://www.alanmarcero.com/css/main.css" media="screen" type="text/css" />

</head>

<body>
<div id="banner">
    <div id="bannerContent">
        <a href="http://www.alanmarcero.com"><img src="http://www.alanmarcero.com/images/me.png" /></a>
    </div>
</div> <!-- end banner -->

<div id="nav">
    <div id="navContent">
        <ul>
            <li><a href="index.php">Sound Design</li><li><a href="customers.php">Customer's Section</li><li><a href="index.php?page=about">About</li><li><a href="http://www.youtube.com/AlanMarcero">YouTube</a></li><li><a href="http://www.soundcloud.com/AlanMarcero">SoundCloud</a></li>{if $data.session_email}<li style="text-align:right"><a href="logout.php" />Logout</a></li>{/if}
        </ul>
    </div>
</div>

<div id="sectionHeading">
    <div id="sectionHeadingText">
        <div id="cart">
            <?php echo $customer_count; ?> people have purchased <?php echo $purchased_count; ?> patch banks :: Last purchase <?php echo $last_purchase; ?>
        </div>
        <div id="loggedIn">
            {if $data.session_email}Logged in with email: {$data.session_email}{/if}
        </div>
    </div>
</div>

<div id="sectionContent">
    <div id="sectionContentText">

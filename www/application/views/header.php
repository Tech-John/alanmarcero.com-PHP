<!DOCTYPE html>
<html lang="en">
<head>

<title>--- Alan Marcero  &middot;  Web Programmer  &middot;  Music Producer ---</title>
<link rel="stylesheet" href="/assets/css/main.css" media="screen" type="text/css" />

</head>

<body>
<div id="banner">
    <div id="bannerContent">
        <a href="/"><img src="/images/me.png" /></a>
    </div>
</div> <!-- end banner -->

<div id="nav">
    <div id="navContent">
        <ul>
            <li><a href="/">Sound Design</li><li><a href="/customers">Customer's Section</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="http://www.youtube.com/AlanMarcero">YouTube</a></li>
            <li><a href="http://www.soundcloud.com/AlanMarcero">SoundCloud</a></li>
            <?php if (!empty($email)) {
                echo '<li style="text-align:right"><a href="logout.php" />Logout</a></li>';
            } ?>
        </ul>
    </div>
</div>

<div id="sectionHeading">
    <div id="sectionHeadingText">
        <div id="cart">
            <?php echo $customer_count; ?> people have purchased <?php echo $purchased_count; ?> patch banks :: Last purchase <?php echo $last_purchase; ?>
        </div>
        <div id="loggedIn">
            <?php if (!empty($email)) {
                echo "Logged in with email: {$email}";
            } ?>
        </div>
    </div>
</div>

<div id="sectionContent">
    <div id="sectionContentText">

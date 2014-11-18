<!DOCTYPE html>
<html lang="en">
<head>

<title>--- Alan Marcero  &middot;  Web Programmer  &middot;  Music Producer ---</title>
<link rel="stylesheet" href="../assets/css/main.css" media="screen" type="text/css" />

</head>

<body>
<div id="banner">
    <div id="bannerContent">
        <a href="./"><img src="../images/me.png" /></a>
    </div>
</div> <!-- end banner -->

<div id="nav">
    <div id="navContent">
        <ul>
            <li><a href="./admin">Admin Home</li>
            <li><a href="./admin/sendPromoEmail">Send Promo Email</a></li>
            <li><a href="./admin/stats">Graphs and Stats</a></li>
            <li><a href="./admin/dbMaintenance">Database Maintenance</a></li>
            <?php if (!empty($admin_user_id)) {
                echo '<li style="text-align:right"><a href="./logout" />Admin Logout</a></li>';
            } ?>
        </ul>
    </div>
</div>

<div id="sectionHeading">
    <div id="sectionHeadingText">

    </div>
</div>

<div id="sectionContent">
    <div id="sectionContentText">

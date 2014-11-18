<?php
    if ((isset($invalid) && $invalid) || (isset($email_removed) && !$email_removed)) {
        echo "<p style='color:red'>The email address you entered (" . $email . ") is either invalid or was not found.  Please try again.</p>";
    }
?>

<?php if (isset($email_removed) && $email_removed) { ?>
    <h2>You have successfully opted-out of new product notifications.</h2>
    <p>Your email address, <?php echo $email; ?>, will no longer receive new product notifications.</p>
<?php } else { ?>
    <p>To be removed from <a href="http://www.alanmarcero.com">AlanMarcero.com</a> new product notifications, please enter your email address below:</p>
    <form action="./optOut" method="POST" />
        <p>
            <input type="text" name="email" class="textField" value="<?php echo $email; ?>" />
            <input type="submit" value="Remove" class="buttonSubmit" />
        </p>
    </form>
<?php } ?>

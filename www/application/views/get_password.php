<form action = './getPassword' method = "POST">
	<?php
        if (isset($not_found)) {
            echo "I could not find the email you entered: {$email}";
        } elseif (isset($email_sent)) {
            echo "Your password has been sent to {$email}";
        }
    ?>
	<p>
		<label>Email:<br /></label>
		<input type="text" name="email" class="textField" value="<?php echo $email; ?>" />
	</p>
	<input type="submit" value="Retreive Password" class="buttonSubmit" />
</form>

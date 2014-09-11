<?php
    if ($email_sent) {
        echo "<p>Promo email sucessfully sent in ";
        if ($test_mode) {
            echo "test mode to " . ADMIN_EMAIL . ".</p>";
        } else {
            echo "production mode to " . $recipients_sent . " recipients in " . $emails_sent . " emails.</p>";
        }
    }
?>
<form action = '/admin/sendPromoEmail' method="POST">
	<p>
		Email Content<br />
		<textarea cols='85' rows='25' class='textField' name='content'></textarea>
	</p>

	<p>
		<input type="checkbox" name="test_mode" value="true" /> Send Only A Test Email
	</p>

	<input type="submit" value="Send Email" class="buttonSubmit" />
</form>

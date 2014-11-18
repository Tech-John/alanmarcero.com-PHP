<?php if (empty($email)) { ?>
	<p>To complete your purchase, you must first sign up for an account.
	Signing up is very simple!  Just enter your valid email address below:</p>

	<form action="./freePurchase" method="POST" />
		<p>
			<label>Email:<br /></label>
			<input type="text" name="email" class="textField" />
			<input type="submit" value="Give Me the Items!" class="buttonSubmit" />
		</p>
	</form>
<?php } else { ?>
	<h2>Thank you for purchasing the following items:</h2>
	<ul>
    	<?php
            foreach ($cart as $id => $item) {
                echo '<li>' . $item['name'] . '</li>';
            }
        ?>
	</ul>
	<hr />
	Total Paid: $0.00
	<p>&nbsp;</p>
	<strong>You may download your items in the <a href="./customers">Customer's Section</a></strong>
<?php } ?>

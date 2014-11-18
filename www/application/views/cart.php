<?php if (!empty($cart)) { ?>
	<table border="0" cellpadding="20px">
		<?php foreach ($cart as $id => $item) {?>
			<tr>
				<td><?php echo $item['name']; ?></td>
				<td>
					<form action="./addToCart" method="POST">
						<input type="hidden" name="item_id" value="<?php echo $id; ?>" />
						<?php
                            if ($item['price'] === 0.00 || !$item['price']) {
    							echo '$<input type="text" name="price" value="25.00" class="textField" size="3" />';
    						} else {
    							echo '$<input type="text" name="price" value="' . $item['price'] . '" class="textField" size="3" />';
    						}
                        ?>
						<input type="submit" class="buttonSubmit" value="Update Price" />
					</form>
				</td>
				<td>$<?php if ($item['price']) echo $item['price']; else echo '0.00'; ?></td>
				<td>
                    <form action="./removeFromCart" method="POST" />
                        <input type="hidden" name="item_id" value="<?php echo $id; ?>">
                        <input type="submit" class="buttonSubmit" value="Remove Item" />
                    </form>
                </td>
			</tr>
		<?php } // end foreach ?>
	</table>


	<p>&nbsp;</p>
	<h2 class="textCenter"><a href="/" />Return to the Store</a></h2>
	<hr />
		<div id="subtotal">
			<h1>Subtotal: $<?php echo $subtotal; ?> USD</h1>
			<p>&nbsp;</p>
			<?php
                if ($subtotal > 0.00) {
    				echo '<form action="https://www.paypal.com/cgi-bin/webscr/" method="POST">';
            ?>
					<input type="hidden" name="cmd" value="_cart">
					<input type="hidden" name="business" value="<?php echo ADMIN_EMAIL ?>">
					<input type="hidden" name="item_name" value="Item Name">
					<input type="hidden" name="currency_code" value="USD">
					<input type="hidden" name="amount" value="<?php echo $subtotal; ?>">
					<input type="hidden" name="upload" value="1">

					<?php
						$i = 1;
                        foreach ($cart as $id => $item) {
                            echo '<input type = "hidden" name ="item_name_' . $i . '" value="' . $item['name'] . '">';
                            echo '<input type = "hidden" name ="amount_' . $i . '" value="' . $item['price'] . '">';
                            echo '<input type = "hidden" name ="item_number_' . $i . '" value="' . $id . '">';
                            $i++;
                        }
					?>
					<input type="submit" value="Proceed to PayPal" />
				</form>
			<?php } else { ?>
				<form action="./freePurchase" method="POST" />
					<input type="submit" value="Purchase Items" />
				</form>
			<?php } ?>
		</div>
<?php } else { ?>
	<p>Your cart is empty! :(</p>
<?php } ?>

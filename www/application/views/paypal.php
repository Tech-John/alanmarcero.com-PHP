<h2>Thank you for your purchase</h2>
<p>Your purchase encourages me to make my patches available through this website.  You are awesome!
    Any questions may be sent directly to: <a href="mailto:<?php echo ADMIN_EMAIL; ?>"><?php echo ADMIN_EMAIL; ?></a>
</p>

<?php
    if (!empty($cart)) {
?>
    <h2>You have purchased the following item<?php if (count($cart) > 1) echo "s";?>:</h2>
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
    <strong>You may download your items in the <a href="/customers">Customer's Section</a></strong>

<?php } # end if !empty($cart) ?>

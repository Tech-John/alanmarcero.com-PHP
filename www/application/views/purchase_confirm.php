<h2>Thank you for purchasing the following items:</h2>
<ul>
<?php
    foreach ($cart as $id => $item) {
        echo "<li>" . $item['name'] . "</li>";
    }
?>
</ul>
<hr />
Total Paid: $0.00
<p>&nbsp;</p>
<strong>You may download your items in the <a href="/customers">Customer's Section</a></strong>

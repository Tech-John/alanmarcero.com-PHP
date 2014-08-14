<?php
    # only print cart info if we have a cart
    if (!empty($cart)) {
        echo "<h2>Thank you for purchasing the following items:</h2>";
        echo "<ul>";

        # print out each item
        foreach ($cart as $id => $item) {
            echo "<li>" . $item['name'] . "</li>";
        }

        echo "</ul>";
        echo "<hr />";
        echo "Total Paid: $0.00";
    }
?>
<p>&nbsp;</p>
<strong>You may download your items in the <a href="/customers">Customer's Section</a></strong>

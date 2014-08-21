Thank you for your recent order from AlanMarcero.com

You have purchased the following items:

<?php
    foreach ($items as $item) {
        echo "Item: {$item->name}" . "\r\n";
        echo "Link: {$item->full_item_url}" . "\r\n\r\n";
    }
?>
Your purchased<?php if (count($items) > 1) echo " items are "; else echo " item is " ?>ready to be downloaded at the above link<?php if (count($items) > 1) echo "s"; ?>.  At any point you may login here: http://www.alanmarcero.com/customers with your login and password to re-download the patches or download updates.

Your login email: <?php echo $email . "\r\n"; ?>
Your login password: <?php echo $password . "\r\n"; ?>

Alan Marcero
http://www.alanmarcero.com

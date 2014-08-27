<p>If you encounter a problem while downloading an item, you may contact me at <a href="mailto:<?php echo ADMIN_EMAIL ?>"><?php echo ADMIN_EMAIL ?></a>.</p>

<?php
    foreach ($items as $item) {
        echo "
            <p>
                <form action='{$item->full_item_url}' method='POST'>
                    <input type='submit' value='Download {$item->name}' class='buttonSubmit' />
                </form>
            </p>
        ";
    }
?>

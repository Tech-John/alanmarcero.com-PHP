<?php
    if (isset($maintenance_performed) && $maintenance_performed) {
        # before
        echo "<p>Test Accounts Before:<br />";
        foreach ($test_accounts_before as $acct) {
            echo $acct->email . "<br />";
        }
        if (!count($test_accounts_before)) {
            echo "(None)<br />";
        }

        # after
        echo "Test Accounts After:<br />";
        foreach ($test_accounts_after as $acct) {
            echo $acct->email . "<br />";
        }
        if (!count($test_accounts_after)) {
            echo "(None)</p>";
        }

        echo "<p>Stranded Purchases Before: {$stranded_purchases_before}<br />";
        echo "Stranded Purchases After: {$stranded_purchases_after}</p>";
    } else {
?>
        <form action="/admin/dbMaintenance" method="POST" />
            <input type="hidden" name="do_maintenance" value="true" />
            <p>
                <input type="submit" value="Do Maintenance" class="buttonSubmit" />
            </p>
        </form>
<?php
    }
?>

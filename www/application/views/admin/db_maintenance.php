<?php
    if (isset($maintenance_performed) && $maintenance_performed) {
        # before test accounts
        echo "<p>Test Accounts Before:<br />";
        foreach ($test_accounts_before as $acct) {
            echo $acct->email . "<br />";
        }
        if (!count($test_accounts_before)) {
            echo "(None)<br />";
        }

        # after test accounts
        echo "<br />Test Accounts After:<br />";
        foreach ($test_accounts_after as $acct) {
            echo $acct->email . "<br />";
        }
        if (!count($test_accounts_after)) {
            echo "(None)</p>";
        }

        # ------------------------
        echo "<hr />";
        # ------------------------

        echo "<p>Stranded Purchases Before: {$stranded_purchases_before}<br />";
        echo "Stranded Purchases After: {$stranded_purchases_after}</p>";

        # ------------------------
        echo "<hr />";
        # ------------------------

        # before test promo emails
        echo "<p>Test Promo Emails Before:<br />";
        foreach ($promo_emails_before as $email) {
            echo $email->email . "<br />";
        }
        if (!count($promo_emails_before)) {
            echo "(None)<br />";
        }

        # after test promo emails
        echo "<br />Test Promo Emails After:<br />";
        foreach ($promo_emails_after as $email) {
            echo $email->email . "<br />";
        }
        if (!count($test_accounts_after)) {
            echo "(None)</p>";
        }
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

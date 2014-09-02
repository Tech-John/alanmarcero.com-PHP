<fieldset>
    <?php
        if (isset($invalid_login) && $invalid_login) {
            echo "<span style='color:red'>Your login and/or password do not match my records.</span>";
        }
    ?>
    <legend>AlanMarcero.com Admin Login</legend>

    <form action="/admin" method="POST" />
        <p>
            <label>Login:<br /></label>
            <input type="text" name="admin_login" value='<?php if (isset($admin_login)) echo $admin_login; ?>'class="textField" />
        </p>

        <p>
            <label>Password: <br /></label>
            <input type="password" name="password" class="textField" /><br />
        </p>

        <p>
            <input type="submit" value="Login" class="buttonSubmit" />
        </p>
    </form>
</fieldset>

<fieldset>
    <?php
        if (isset($invalid_login) && $invalid_login) {
            echo "<span style='color:red'>Your email and/or password do not match my records.</span>";
        }
    ?>
    <legend>AlanMarcero.com Account</legend>

    <form action="./login" method="POST" />
        <p>
            <label>Email:<br /></label>
            <input type="text" name="email" value='<?php if (isset($email)) echo $email; ?>'class="textField" />
        </p>

        <p>
            <label>Password: <br /></label>
            <input type="password" name="password" class="textField" /><br />
            <small><a href="/getPassword">Can't Remember Your Password?</a></small>
        </p>

        <p>
            <input type="submit" value="Login" class="buttonSubmit" />
        </p>
    </form>
</fieldset>

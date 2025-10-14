<?php
require_once "includes/config_session.php";
require_once "includes/login_view.inc.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Account</title>
        <link href="./css/login.css" rel="stylesheet"/>
    </head>
    <body>
        <main>
            <h1 class="title">Log In</h1>
            <form class="login-form" action="includes/login.inc.php" method="post">
                <label>IBAN:</label><br>
                    <input type="text" name="iban" placeholder="IBAN" required><br>
                <label>PIN:</label><br>
                    <input type="password" inputmode="numeric" pattern="[0-9]*" maxlength=4 name="pin" placeholder="PIN" required><br>
                <input type="submit" value="Submit">
            </form>
            <?php
            check_login_errors();
            ?>
        </main>
    </body>

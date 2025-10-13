<?php
require_once "includes/create_account_view.inc.php";
require_once "includes/config_session.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Account</title>
        <link href="./css/create_account.css" rel="stylesheet"/>
    </head>
    <body>
        <main>
            <h1 class="title">New Account</h1>
            <form class="new-account-form" action="includes/create_account.inc.php" method="post">
                <label>First Name:</label><br>
                    <input type="text" name="fname" placeholder="First Name"><br>
                <label>Last Name:</label><br>
                    <input type="text" name="lname" placeholder="Last Name"><br>
                <label>Date of Birth (YYYY-MM-DD):</label><br>
                    <input type="text" name="dob" placeholder="Date of Birth"><br>
                <label>CNP:</label><br>
                    <input type="text" name="cnp" placeholder="CNP"><br>
                <label>Street Name:</label><br>
                    <input type="text" name="street_name" placeholder="Street Name"><br>
                <label>Street Number:</label><br>
                    <input type="text" name="street_number" placeholder="Street Number"><br>
                <label>County:</label><br>
                    <input type="text" name="county" placeholder="County"><br>
                <label>City:</label><br>
                    <input type="text" name="city" placeholder="City"><br>
                <label>Country:</label><br>
                    <input type="text" name="country" placeholder="Country"><br>
                <label>E-mail:</label><br>
                    <input type="email" name="email" placeholder="E-mail"><br>
                <label>Phone Number:</label><br>
                    <input type="tel" name="phone" placeholder="Phone Number"><br>
                <input type="submit" value="Submit">
            </form>
        </main>
        <?php
        check_signup_errors();
        ?>
    </body>
</html>

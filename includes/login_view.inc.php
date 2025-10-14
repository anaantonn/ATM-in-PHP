<?php

declare(strict_types=1);

function check_login_errors() {
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        echo "<br>";

        foreach ($errors as $error) {
            echo "<p class='login_error'>" . $error . "</p>";
        }

        unset($_SESSION["errors_login"]);
    }
}

function output_full_name() {
    if (isset($_SESSION["user_id"])) {
        echo "Welcome " . $_SESSION['full_name'] . "!";
    }
}

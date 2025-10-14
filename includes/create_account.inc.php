<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fields = [
        "fname" => $_POST['fname'],
        "lname" => $_POST['lname'],
        "dob" => $_POST['dob'],
        "cnp" => $_POST['cnp'],
        "street_name" => $_POST['street_name'],
        "street_number" => $_POST['street_number'],
        "county" => $_POST['county'],
        "city" => $_POST['city'],
        "country" => $_POST['country'],
        "email" => $_POST['email'],
        "phone" => $_POST['phone']
    ];

    try {
        require_once "connect.php";
        require_once "create_account_model.inc.php";
        require_once "create_account_contr.inc.php";

        $errors = [];

        if (is_input_empty($fields)) {
            $errors["empty_input"] = "Fill in all fields!";
        }
        if (is_email_invalid($fields["email"])) {
            $errors["invalid_email"] = "Invalid e-mail used!";
        }
        if (is_email_registered($pdo, $fields["email"])) {
            $errors["registered_email"] = "There is an account with this e-mail!";
        }
        if (is_telefon_registered($pdo, $fields["phone"])) {
            $errors["registered_telefon"] = "There is an account with this pone number!";
        }
        if (is_cnp_registered($pdo, $fields["cnp"])) {
            $errors["registered_cnp"] = "CNP already registered!";
        }

        require_once "config_session.php";

        if ($errors) {
            $_SESSION["error_signup"] = $errors;
            header ("Location: ../create_account.php");
            die();
        }

        try {
            create_user($pdo, $fields);
            echo"<script>alert('Account created! Please proceed to log in.');  window.location.href = '../login.php'; </script>";

            $pdo = NULL;
            $stmt = NULL;

            die();

        } catch (PDOException $e) {
            $pdo->rollBack();
            echo "Transaction failed. Error creating account: " . $e->getMessage();
        }

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../create_account.php");
    die();
}

<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $iban = $_POST['iban'];
    $pin = $_POST['pin'];
    // $hashed_pin = password_hash($pin, PASSWORD_DEFAULT);

    try {
        require_once "connect.php";
        require_once "login_model.inc.php";
        require_once "login_contr.inc.php";

        $errors = [];

        if (is_input_empty($iban, $pin)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $iban, $pin);

        if (is_iban_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        require_once "config_session.php";

        if ($errors) {
            $_SESSION["errors_login"] = $errors;
            echo "<script>alert('Invalid IBAN or PIN.');  window.location.href = '../login.php'; </script>";
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION['full_name'] = $result['nume'] . ' ' . $result['prenume'];

        $_SESSION["last_regeneration"] = time();

        header("Location: ../main_page.php");

        $pdo =NULL;
        $stmt = NULL;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../login.php");
    die();
}

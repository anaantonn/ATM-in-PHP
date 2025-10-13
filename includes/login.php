<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $iban = $_POST['iban'];
    $pin = $_POST['pin'];
    // $hashed_pin = password_hash($pin, PASSWORD_DEFAULT);

    try {
        require_once "./connect.php";

        $query = "SELECT u.id, u.pin, u.nume, u.prenume
                    FROM sold AS s
                    JOIN utilizatori AS u ON s.utilizatorid = u.id
                    WHERE u.pin = :pin AND s.nr_cont = :iban LIMIT 1";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':pin', $pin);
        $stmt->bindParam(':iban', $iban);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['nume'] . ' ' . $user['prenume'];
            $_SESSION['iban'] = $iban;
            header("Location: main_page.php");
            exit;
        }
        echo "<script>alert('Invalid IBAN or PIN.');  window.location.href = 'login.html'; </script>";

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: login.html");
    die();
}

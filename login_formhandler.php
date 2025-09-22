<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $iban = $_POST['iban'];
    $pin = $_POST['pin'];

    try {
        require_once "./connect.php";

        $query = "SELECT 1 FROM sold AS s JOIN utilizatori AS u ON s.utilizatorid = u.id WHERE u.pin = :pin AND s.nr_cont = :iban LIMIT 1";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':pin', $pin);
        $stmt->bindParam(':iban', $iban);

        $stmt->execute();

        $results = $stmt->fetchColumn();

        if ($results) {
            header("Location: main_page.php?iban=" . urlencode($iban));
            exit;
        } else {
            echo "<script>alert('Invalid IBAN or PIN.');  window.location.href = 'login.html'; </script>";
        }

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: login.html");
    exit();
}

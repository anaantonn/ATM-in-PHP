<?php

declare(strict_types=1);

function get_user($pdo, $iban, $pin) {
    $query = "SELECT u.id, u.pin, u.nume, u.prenume
            FROM sold AS s
            JOIN utilizatori AS u ON s.utilizatorid = u.id
            WHERE u.pin = :pin AND s.nr_cont = :iban LIMIT 1";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':pin', $pin);
    $stmt->bindParam(':iban', $iban);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

<?php
declare(strict_types=1);

function get_email($pdo, $email) {
    $query = "SELECT adresa_email from email where adresa_email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function get_telefon($pdo, $telefon) {
    $query = "SELECT nr_telefon from telefon where nr_telefon = :telefon;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":telefon", $telefon);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function get_cnp($pdo, $cnp) {
    $query = "SELECT cnp from utilizatori where cnp = :cnp;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":cnp", $cnp);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function set_user($pdo, $fields) {
        $success = true;

        $query_utilizatori = "INSERT INTO utilizatori (nume, prenume, data_nasterii, cnp) VALUES
        (:fname, :lname, :dob, :cnp);";
        $query_adrese = "INSERT INTO adrese (utilizatorid, strada, numar, judet_sector, oras, tara) VALUES
        (:utilizatorid, :street_name, :street_number, :county, :city, :country);";
        $query_email = "INSERT INTO email (utilizatorid, adresa_email) VALUES (:utilizatorid, :email);";
        $query_telefon = "INSERT INTO telefon (utilizatorid, nr_telefon) VALUES (:utilizatorid, :phone);";
        $query_logs = "INSERT INTO logs (utilizatorid, data_ora, selectia, cont_destinatar, reusita) VALUES
        (:utilizatorid, NOW(), :selectia, :cont_destinatar, :reusita);";

        $pdo->beginTransaction();

        $stmt_utilizatori = $pdo->prepare($query_utilizatori);
        $stmt_adrese = $pdo->prepare($query_adrese);
        $stmt_email = $pdo->prepare($query_email);
        $stmt_telefon = $pdo->prepare($query_telefon);
        $stmt_logs = $pdo->prepare($query_logs);
        // $options = [
        //     "cost" => 12
        // ];
        // $hashed_pin = password_hash($pin, PASSWORD_BCRYPT, $options);
        $stmt_utilizatori->bindParam(':fname', $fields["fname"]);
        $stmt_utilizatori->bindParam(':lname', $fields["lname"]);
        $stmt_utilizatori->bindParam(':dob', $fields["dob"]);
        $stmt_utilizatori->bindParam(':cnp', $fields["cnp"]);
        $stmt_utilizatori->execute();
        $utilizatorid = $pdo->lastInsertId();
        $stmt_adrese->bindParam(':utilizatorid', $utilizatorid);
        $stmt_adrese->bindParam(':street_name', $fields["street_name"]);
        $stmt_adrese->bindParam(':street_number', $fields["street_number"]);
        $stmt_adrese->bindParam(':county', $fields["county"]);
        $stmt_adrese->bindParam(':city', $fields["city"]);
        $stmt_adrese->bindParam(':country', $fields["country"]);
        $stmt_adrese->execute();
        $stmt_email->bindParam(':utilizatorid', $utilizatorid);
        $stmt_email->bindParam(':email', $fields["email"]);
        $stmt_email->execute();
        $stmt_telefon->bindParam(':utilizatorid', $utilizatorid);
        $stmt_telefon->bindParam(':phone', $fields["phone"]);
        $stmt_telefon->execute();
        $stmt_logs->execute([
            ':utilizatorid' => $utilizatorid,
            ':selectia' => 1,
            ':cont_destinatar' => 0,
            ':reusita' => $success
        ]);
    $pdo->commit();
}

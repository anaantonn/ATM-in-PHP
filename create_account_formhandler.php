<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $cnp = $_POST['cnp'];
    $street_name = $_POST['street_name'];
    $street_number = $_POST['street_number'];
    $county = $_POST['county'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    try {
        require_once "./connect.php";

        $success = true;

        $query_utilizatori = "INSERT INTO utilizatori (nume, prenume, data_nasterii, cnp) VALUES
        (:fname, :lname, :dob, :cnp);";
        $query_adrese = "INSERT INTO adrese (utilizatorid, strada, numar, judet_sector, oras, tara) VALUES
        (:utilizatorid, :street_name, :street_number, :county, :city, :country);";
        $query_email = "INSERT INTO email (utilizatorid, adresa_email) VALUES (:utilizatorid, :email);";
        $query_telefon = "INSERT INTO telefon (utilizatorid, nr_telefon) VALUES (:utilizatorid, :phone);";
        $query_logs = "INSERT INTO logs (utilizatorid, data_ora, selectia, cont_destinatar, reusita) VALUES
        (:utilizatorid, NOW(), :selectia, :cont_destinatar, :reusita);";

        $stmt_utilizatori = $pdo->prepare($query_utilizatori);
        $stmt_adrese = $pdo->prepare($query_adrese);
        $stmt_email = $pdo->prepare($query_email);
        $stmt_telefon = $pdo->prepare($query_telefon);
        $stmt_logs = $pdo->prepare($query_logs);

        try {
            $pdo->beginTransaction();

            $stmt_utilizatori->bindParam(':fname', $fname);
            $stmt_utilizatori->bindParam(':lname', $lname);
            $stmt_utilizatori->bindParam(':dob', $dob);
            $stmt_utilizatori->bindParam(':cnp', $cnp);

            $stmt_utilizatori->execute();

            $utilizatorid = $pdo->lastInsertId();

            $stmt_adrese->bindParam(':utilizatorid', $utilizatorid);
            $stmt_adrese->bindParam(':street_name', $street_name);
            $stmt_adrese->bindParam(':street_number', $street_number);
            $stmt_adrese->bindParam(':county', $county);
            $stmt_adrese->bindParam(':city', $city);
            $stmt_adrese->bindParam(':country', $country);

            $stmt_adrese->execute();

            $stmt_email->bindParam(':utilizatorid', $utilizatorid);
            $stmt_email->bindParam(':email', $email);

            $stmt_email->execute();

            $stmt_telefon->bindParam(':utilizatorid', $utilizatorid);
            $stmt_telefon->bindParam(':phone', $phone);

            $stmt_telefon->execute();

            $stmt_logs->execute([
                ':utilizatorid' => $utilizatorid,
                ':selectia' => 1,
                ':cont_destinatar' => 0,
                ':reusita' => $success
            ]);

            $pdo->commit();

            header("Location: account.php?id=" . urlencode($utilizatorid));
            exit;

            } catch (PDOException $e) {
                $pdo->rollBack();
                echo "Transaction failed. Error creating account: " . $e->getMessage();
            }

        $pdo = null;
        $stmt_utilizatori = null;
        $stmt_adrese = null;
        $stmt_email = null;
        $stmt_telefon = null;
        $stmt_logs = null;


    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: create_account.html");
    exit();
}

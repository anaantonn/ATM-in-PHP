<?php

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$hostname = $_ENV['HOST_NAME'];
$dbname = $_ENV['DB_NAME'];
$username = $_ENV['USER_NAME'];
$password = $_ENV['PASSWORD'];
$dsn = "pgsql:host=$hostname;dbname=$dbname";
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

<?php
require_once "./config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
$full_name = $_SESSION['full_name'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Account</title>
        <link href="./css/main_page.css" rel="stylesheet"/>
    </head>
    <body>
        <main>
            <h1 class="welcome">Welcome <?= htmlspecialchars($full_name) ?></h1>
            <h2 class="title">MENU</h2>
            <ul class="menu" style="list-style-type:none;">
                <li class="balance"><a href="./check_balance.html">1. Check balance</a></li>
                <li class="deposit"><a href="./deposit.html">2. Deposit</a></li>
                <li class="withdraw"><a href="./withdraw.html">3. Withdraw</a></li>
                <li class="transfer"><a href="./deposit.html">4. Transfer</a></li>
                <li class="logout"><a href="./logout.php">Log Out</a></li>
            </ul>
        </main>
    </body>
</html>

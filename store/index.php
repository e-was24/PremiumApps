<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../pages/auth/signIn.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Apps</title>
    <link rel="stylesheet" href="assets/css/navbarV1.6.css">
    <link rel="stylesheet" href="assets/css/styleV1.css">
    <link rel="stylesheet" href="assets/css/contentV4.2.css">
</head>

<body>
    <canvas id="bg-canvas"></canvas>
    <?php include 'includes/navbar.php' ?>

    <div class="container">
        <?php include
            'includes/content.php'
        ?>

    </div>
</body>
<script src="assets/js/animate.js"></script>

</html>
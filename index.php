<?php
// Start session
session_start();

// Jika user sudah login, langsung arahkan ke pasar member
if (isset($_SESSION['user'])) {
    header("Location: pages/market/member.php");
    exit;
}

// Jika user memilih mode guest, arahkan ke pasar guest
if (isset($_GET['guest'])) {
    $_SESSION['guest'] = true;
    header("Location: pages/market/guest.php");
    exit;
}

// Load config dan template jika diperlukan
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $app['title'] ?> - Welcome</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <?php include 'includes/landingPage.php';?>
    
    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../pages/auth/signIn.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="assets/css/profile-style.css">
</head>

<body>
    <div class="header">
        <img src="" alt="">
        <div class="desc">
            <div class="cover">
                <p>username : </p>
                <h2 class="value"><?= htmlspecialchars($user['username']) ?></h2>
            </div>
            <div class="cover">
                <p>email : </p>
                <h3 class="value"><?= htmlspecialchars($user['email']) ?></h3>
            </div>
            <div class="cover">
                <p>status : </p>
                <p class="value"><?= htmlspecialchars($user['role']) ?></p>
            </div>



        </div>

    </div>
</body>
<script src="assets/js/profile.js"></script>

</html>
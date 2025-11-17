<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $app['title'] ?> - Welcome</title>
    <link rel="stylesheet" href="assets/css/styleV1.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="assets/css/navbarV1.0.1.0.css">
    <link rel="stylesheet" href="assets/css/landingPageV1.css">
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
</head>

<body>

    <!-- NAVBAR DI ATAS, LANGSUNG DI BODY -->
    <div class="navbar">
        <?php include __DIR__ . '/includes/navbar.php'; ?>
    </div>


    <!-- KONTEN UTAMA -->
    <div class="container">
        <div class="landing">
            <?php include __DIR__ . '/includes/landingPage.php'; ?>
        </div>

        <br>

        <div class="footer">
            <?php include __DIR__ . '/includes/footer.php'; ?>
        </div>
    </div>

    <script>
        AOS.init();
    </script>

</body>

</html>
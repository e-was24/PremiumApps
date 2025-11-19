<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($app['title'] ?? 'Premium Apps') ?> | Welcome</title>

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/styleV1.0.5.css">

    <!-- AOS ANIMATION -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- COMPONENTS -->
    <link rel="stylesheet" href="assets/css/navbarV1.0.30.css">
    <link rel="stylesheet" href="assets/css/landingPageV1.0.20.css">
</head>

<body>

    <!-- WebGL Background -->
    <canvas id="bg-canvas"></canvas>

    <!-- FIXED NAVBAR -->
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <!-- MAIN CONTENT -->
    <main class="container">

        <section class="landing" data-aos="fade-up">
            <?php include __DIR__ . '/includes/landingPage.php'; ?>
        </section>

        <footer class="footer">
            <?php include __DIR__ . '/includes/footer.php'; ?>
        </footer>

    </main>
    
</body>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 600,
        once: true
    });
</script>

<!-- JS NAVBAR -->
<script src="assets/js/navbarV1.0.3.js"></script>

</html>

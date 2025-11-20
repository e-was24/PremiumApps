<?php include "../../includes/header.php"; ?>
<?php include "../../includes/signIn-navbar.php"; ?>
<link rel="stylesheet" href="../../assets/css/navbarV1.0.31.css">
<link rel="stylesheet" href="../../assets/css/SignInV1.0.0.css">
<link rel="stylesheet" href="../../assets/css/styleV1.0.7.css">

<canvas id="bg-canvas"></canvas>

<div class="cover">
    <div class="registration-sheet">
        <h2>Sign In</h2>
        <form id="signInForm" autocomplete="off">
            <label>
                <p>Username / Email :</p>
                <input type="text" id="login_id" placeholder="example@gmail.com" required>
            </label>

            <label>
                <p>Password :</p>
                <input type="password" id="password" placeholder="password" required>
            </label>

            <p class="mantion">
                Ensure your password is correct.
            </p>

            <!-- Element untuk menampilkan error -->
            <p id="error-msg" style="color:#ff4d4d; font-size:14px; margin-top:10px; display:none;"></p>

            <button id="btn-signIn" type="submit">Sign In</button>
        </form>
    </div>
</div>

<script src="../../assets/js/auth/SignInV1.0.js"></script>
<script src="../../assets/js/navbarV1.0.4.js"></script>

<?php include "../../includes/footer.php"; ?>

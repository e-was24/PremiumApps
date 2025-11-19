<?php include "../../includes/header.php"; ?>
<?php include "../../includes/signUp-navbar.php"; ?>
<link rel="stylesheet" href="../../assets/css/navbarV1.0.30.css">
<link rel="stylesheet" href="../../assets/css/SignUpV1.0.2.css">
<link rel="stylesheet" href="../../assets/css/styleV1.0.6.css">

<!-- WebGL Background -->
<canvas id="bg-canvas"></canvas>


<div class="cover">
    <div class="registration-sheet">
        <h2>Register Now</h2>

        <form id="signupForm">
            <label>
                <p>Username :</p>
                <input type="text" placeholder="username" id="username" name="username" required>
            </label>

            <label>
                <p>Email :</p>
                <input type="email" placeholder="example@gmail.com" id="email" name="email" required>
            </label>

            <div class="password">
                <label>
                    <p>Password :</p>
                    <input type="password" placeholder="password" id="password" name="password" required>
                </label>

                <label>
                    <p>Confirm :</p>
                    <input type="password" placeholder="password" id="confirm-password" required>
                </label>
            </div>

            <button id="btn-signUp" type="submit">Sign Up</button>
        </form>
    </div>
</div>

<script src="../../assets/js/auth/SignUp.js?v=7"></script>
<script src="../../assets/js/navbarV1.0.3.js"></script>

<?php include "../../includes/footer.php"; ?>
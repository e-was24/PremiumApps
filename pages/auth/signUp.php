<?php include "../../includes/header.php"; ?>
<?php include "../../includes/navbar.php"; ?>
<link rel="stylesheet" href="../../assets/css/navbarV1.0.29.css">
<link rel="stylesheet" href="../../assets/css/SignUpV1.0.0.css">

<div class="cover">
    <div class="registration-sheet">
        <h2>Register Now</h2>

        <form id="signupForm">
            <label>
                <p>Username :</p>
                <input type="text" id="username" name="username" required>
            </label>

            <label>
                <p>Email :</p>
                <input type="email" id="email" name="email" required>
            </label>

            <div class="password">
                <label>
                    <p>Password :</p>
                    <input type="password" id="password" name="password" required>
                </label>

                <label>
                    <p>Confirm :</p>
                    <input type="password" id="confirm-password" required>
                </label>
            </div>

            <button id="btn-signUp" type="submit">Sign Up</button>
        </form>
    </div>
</div>

<script src="../../assets/js/auth/signUp.js?v=7"></script>

<?php include "../../includes/footer.php"; ?>

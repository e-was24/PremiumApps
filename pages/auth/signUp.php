<?php include "../../includes/header.php"; ?>
<?php include "../../includes/navbar.php"; ?>

<div class="cover">
    <div class="registration-sheet">
        <h2>Register Now</h2>

        <form id="signupForm" >
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
                    <input type="password" placeholder="confirm password" id="confirm-password" required>
                </label>
            </div>

            <p class="mantion">
                We will keep your account confidential. Make sure your password meets security requirements.
            </p>

            <button id="btn-signUp" type="submit">Sign Up</button>
        </form>
    </div>
</div>

<script src="../../assets/js/auth/SignUp.js"></script>
<?php include "../../includes/footer.php"; ?>

document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("signupForm");
    const btn = document.getElementById("btn-signUp");

    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        // Disable button while processing
        btn.disabled = true;
        btn.innerText = "Processing...";

        const username = document.getElementById("username").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm-password").value;

        // ===== FRONT-END VALIDATION =====
        if (username.length < 3) {
            alert("Username must be at least 3 characters.");
            return resetBtn();
        }

        if (!email.includes("@") || !email.includes(".")) {
            alert("Invalid email format.");
            return resetBtn();
        }

        if (password.length < 6) {
            alert("Password must be at least 6 characters.");
            return resetBtn();
        }

        if (password !== confirmPassword) {
            alert("Password confirmation does not match.");
            return resetBtn();
        }

        // ===== PREPARE DATA =====
        const formData = new FormData();      // <-- DEKLARASI DI SINI (AMAN)
        formData.append("username", username);
        formData.append("email", email);
        formData.append("password", password);

        // ===== SEND TO API =====
        try {
            const res = await fetch("../../api/SignUp.php", {
                method: "POST",
                body: formData
            });

            const data = await res.json();

            if (data.status === "success") {
                alert("Account created successfully! Please Sign In.");
                window.location.href = "SignIn.php";
            } else {
                alert(data.msg || "Registration failed.");
            }

        } catch (error) {
            console.error(error);
            alert("Network error. Please try again.");
        }

        resetBtn();
    });

    // ===== RESET BUTTON FUNCTION =====
    function resetBtn() {
        btn.disabled = false;
        btn.innerText = "Sign Up";
    }

});

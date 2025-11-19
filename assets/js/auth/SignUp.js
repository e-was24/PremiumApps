document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("signupForm");
    const btn = document.getElementById("btn-signUp");

    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        btn.disabled = true;
        btn.innerText = "Processing...";

        const username = document.getElementById("username").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm-password").value;

        // ===== VALIDASI =====
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

        // ===== KITA GUNAKAN JSON, BUKAN FormData =====
        const payload = {
            username: username,
            email: email,
            password: password
        };

        try {
            const res = await fetch("../../api/SignUp.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(payload)
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

    function resetBtn() {
        btn.disabled = false;
        btn.innerText = "Sign Up";
    }

});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signupForm");
    const btn = document.getElementById("btn-signUp");

    function resetBtn() {
        btn.disabled = false;
        btn.innerText = "Sign Up";
    }

    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        btn.disabled = true;
        btn.innerText = "Processing...";

        const username = document.getElementById("username").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm-password").value;

        // ===== VALIDASI FRONT-END =====
        if (username.length < 3) { alert("Username must be at least 3 characters."); return resetBtn(); }
        if (!email.includes("@") || !email.includes(".")) { alert("Invalid email format."); return resetBtn(); }
        if (password.length < 6) { alert("Password must be at least 6 characters."); return resetBtn(); }
        if (password !== confirmPassword) { alert("Passwords do not match."); return resetBtn(); }

        const payload = { username, email, password };

        try {
            // ✅ Sesuaikan path relatif ke api
            const res = await fetch("../../api/SignUp.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(payload)
            });

            if (!res.ok) {
                throw new Error(`HTTP error! Status: ${res.status}`);
            }

            const data = await res.json();

            if (data.status === "success") {
                alert("Account created successfully!");
                window.location.href = "SignIn.php"; // relatif terhadap pages/auth/
            } else {
                alert(data.msg || "Registration failed.");
            }
        } catch (err) {
            console.error(err);
            alert("Network error. Please try again.");
        } finally {
            resetBtn();
        }
    });
});

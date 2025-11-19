document.getElementById("signupForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    const btn = document.getElementById("btn-signUp");
    btn.disabled = true;
    btn.innerText = "Processing...";

    const username = document.getElementById("username").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    // ==== FRONT-END VALIDATION ====
    if (username.length < 3) {
        alert("Username must be at least 3 characters.");
        resetBtn();
        return;
    }

    if (!email.includes("@") || !email.includes(".")) {
        alert("Invalid email format.");
        resetBtn();
        return;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters.");
        resetBtn();
        return;
    }

    if (password !== confirmPassword) {
        alert("Password confirmation does not match.");
        resetBtn();
        return;
    }

    // ==== INIT FORM DATA (INI BAGIAN YANG ERROR KEMARIN) ====
    const formData = new FormData();
    formData.append("username", username);
    formData.append("email", email);
    formData.append("password", password);

    // ==== SEND TO API ====
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

// Restore button state
function resetBtn() {
    const btn = document.getElementById("btn-signUp");
    btn.disabled = false;
    btn.innerText = "Sign Up";
}

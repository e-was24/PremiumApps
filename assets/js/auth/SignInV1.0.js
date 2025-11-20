document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("signInForm");
    const btn = document.getElementById("btn-signIn");
    const errorMsg = document.getElementById("error-msg");

    function showError(message) {
        errorMsg.style.display = "block";
        errorMsg.textContent = message;
    }

    function clearError() {
        errorMsg.style.display = "none";
        errorMsg.textContent = "";
    }

    function setBtn(disabled, text) {
        btn.disabled = disabled;
        btn.innerText = text;
    }

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        clearError();
        setBtn(true, "Processing...");

        const login_id = document.getElementById("login_id").value.trim();
        const password = document.getElementById("password").value.trim();

        if (login_id.length < 3) {
            showError("Invalid username/email");
            return setBtn(false, "Sign In");
        }

        if (password.length < 6) {
            showError("Password must be at least 6 characters");
            return setBtn(false, "Sign In");
        }

        const payload = { login_id, password };

        try {
            const res = await fetch("../../api/signIn.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(payload)
            });

            const data = await res.json().catch(() => {
                showError("Server returned invalid JSON");
                return null;
            });

            if (!data) return setBtn(false, "Sign In");

            if (data.status === "success") {
                // REDIRECT KE store/index.php
                window.location.href = "../../store/index.php";
                return;
            }

            // Tampilkan error dari backend
            showError(data.msg || "Login failed");

        } catch (err) {
            console.error(err);
            showError("Network error");
        }

        setBtn(false, "Sign In");
    });
});

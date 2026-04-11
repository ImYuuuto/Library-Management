document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    const nameInput = document.querySelector("input[name='name']");
    const emailInput = document.querySelector("input[name='email']");
    const passwordInput = document.querySelector("input[name='password']");

    function setError(input, message) {
        input.classList.add("error");
        input.classList.remove("success");
        input.nextElementSibling.textContent = message;
    }

    function setSuccess(input) {
        input.classList.remove("error");
        input.classList.add("success");
        input.nextElementSibling.textContent = "";
    }

    function isEmailValid(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function isPasswordStrong(password) {
        return /^(?=.*[A-Za-z])(?=.*\d).{6,}$/.test(password);
    }

    nameInput?.addEventListener("input", () => {
        if (nameInput.value.trim().length >= 4) {
            setSuccess(nameInput);
        }
    });

    emailInput?.addEventListener("input", () => {
        if (isEmailValid(emailInput.value)) {
            setSuccess(emailInput);
        }
    });

    passwordInput?.addEventListener("input", () => {
        if (isPasswordStrong(passwordInput.value)) {
            setSuccess(passwordInput);
        }
    });

    form.addEventListener("submit", (e) => {
        let valid = true;

        if (nameInput) {
            if (nameInput.value.trim().length < 4) {
                setError(nameInput, "Name must be at least 4 characters");
                valid = false;
            } else {
                setSuccess(nameInput);
            }
        }

        if (emailInput) {
            if (!isEmailValid(emailInput.value)) {
                setError(emailInput, "Enter a valid email address");
                valid = false;
            } else {
                setSuccess(emailInput);
            }
        }

        if (passwordInput) {
            if (!isPasswordStrong(passwordInput.value)) {
                setError(passwordInput, "Password must be 6+ chars with letters & numbers");
                valid = false;
            } else {
                setSuccess(passwordInput);
            }
        }

        if (!valid) {
            e.preventDefault();
        }
    });
});
// ---------- LOGIN FORM VALIDATION ----------
function validateLoginForm(event) {
    const username = document.getElementById("username");
    const password = document.getElementById("password");

    // username check
    if (username.value.trim() === "") {
        alert("Please enter your username");
        username.focus();
        event.preventDefault();
        return false;
    }

    // pass check
    if (password.value.trim() === "") {
        alert("Please enter your password");
        password.focus();
        event.preventDefault();
        return false;
    }

    // password check
    if (password.value.trim().length < 5) {
        alert("Password must be at least 5 characters long");
        password.focus();
        event.preventDefault();
        return false;
    }

    return true;
}

// ---------- PASSWORD SHOW / HIDE ----------
function togglePassword() {
    const password = document.getElementById("password");
    const toggleIcon = document.getElementById("toggleIcon");

    if (password.type === "password") {
        password.type = "text";
        toggleIcon.innerText = " ";
    } else {
        password.type = "password";
        toggleIcon.innerText = " ";
    }
}

// ---------- REAL-TIME USERNAME VALIDATION ----------
function validateUsername(input) {
    const username = input.value;
    const message = document.getElementById("usernameMessage");

    if (username.length < 3) {
        message.style.color = "red";
        message.innerText = "Username must be at least 3 characters!";
    } else if (username.length > 20) {
        message.style.color = "red";
        message.innerText = "Username is too long!";
    } else {
        message.style.color = "green";
        message.innerText = "Username looks good!";
    }
}
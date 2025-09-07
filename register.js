// ---------- FORM VALIDATION ----------
function validateRegisterForm(event) {
    const name = document.getElementById("name");
    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");
    const photo = document.getElementById("photo");

    // Name check
    if (name.value.trim() === "") {
        alert("Please enter your full name");
        name.focus();
        event.preventDefault();
        return false;
    }

    // Username check
    if (username.value.trim().length < 3) {
        alert("Username must be at least 3 characters");
        username.focus();
        event.preventDefault();
        return false;
    }

    // Email validation
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.value.match(emailPattern)) {
        alert("Please enter a valid email address");
        email.focus();
        event.preventDefault();
        return false;
    }

    // Password strength check
    if (password.value.length < 6) {
        alert("Password must be at least 6 characters");
        password.focus();
        event.preventDefault();
        return false;
    }

    // Confirm password match check
    if (password.value !== confirmPassword.value) {
        alert("Passwords do not match!");
        confirmPassword.focus();
        event.preventDefault();
        return false;
    }

    // Photo check
    if (photo.value === "") {
        alert("Please upload your profile photo");
        photo.focus();
        event.preventDefault();
        return false;
    }

    return true;
}

// ---------- PASSWORD STRENGTH CHECKER ----------
function checkPasswordStrength() {
    const password = document.getElementById("password");
    const strength = document.getElementById("strength");

    if (password.value.length === 0) {
        strength.innerHTML = "";
        return;
    }

    if (password.value.length < 6) {
        strength.style.color = "red";
        strength.innerHTML = "Weak";
    } else if (password.value.length < 10) {
        strength.style.color = "orange";
        strength.innerHTML = "Medium";
    } else {
        strength.style.color = "green";
        strength.innerHTML = "Strong";
    }
}

// ---------- CONFIRM PASSWORD MATCH ----------
function checkPasswordMatch() {
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");
    const matchMsg = document.getElementById("matchMsg");

    if (confirmPassword.value.length === 0) {
        matchMsg.innerHTML = "";
        return;
    }

    if (password.value === confirmPassword.value) {
        matchMsg.style.color = "green";
        matchMsg.innerHTML = "Passwords match ✅";
    } else {
        matchMsg.style.color = "red";
        matchMsg.innerHTML = "Passwords do not match ❌";
    }
}

// ---------- IMAGE PREVIEW ----------
function previewImage(event) {
    const image = document.getElementById("preview");
    image.src = URL.createObjectURL(event.target.files[0]);
    image.style.display = "block";
}

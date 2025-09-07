// Form Validation
function validateForm(event) {
    const name = document.getElementById("name").value.trim();
    const roll = document.getElementById("roll").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const profilePhoto = document.getElementById("profile_photo").value;

    // Name validation
    if (name.length < 3) {
        alert("Name must be at least 3 characters long.");
        event.preventDefault();
        return false;
    }

    // Roll validation
    if (roll.length < 2 || isNaN(roll)) {
        alert("Roll number must be numeric and at least 2 digits.");
        event.preventDefault();
        return false;
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        event.preventDefault();
        return false;
    }

    // Password validation (optional)
    if (password.length > 0 && password.length < 4) {
        alert("Password must be at least 4 characters.");
        event.preventDefault();
        return false;
    }

    // Image size validation (optional)
    if (profilePhoto) {
        const file = document.getElementById("profile_photo").files[0];
        if (file.size > 2 * 1024 * 1024) { // 2MB limit
            alert("Profile photo must be less than 2MB.");
            event.preventDefault();
            return false;
        }
    }

    return true;
}

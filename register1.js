// register1.js
document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");

  const username = form.querySelector("input[name='username']");
  const password = form.querySelector("input[name='password']");
  const fullname = form.querySelector("input[name='name']");
  const roll = form.querySelector("input[name='roll']");
  const email = form.querySelector("input[name='email']");
  const department = form.querySelector("select[name='department'], input[name='department']");
  const photo = form.querySelector("input[name='profile_photo']");

  form.addEventListener("submit", (e) => {
    let errors = [];

    // Username validation
    if (username.value.trim().length < 3) {
      errors.push("Username must be at least 3 characters.");
    }

    // Password validation
    if (password.value.length < 6) {
      errors.push("Password must be at least 6 characters.");
    }

    // Full name
    if (fullname.value.trim().length < 2) {
      errors.push("Full name is required.");
    }

    // Roll number
    if (roll.value.trim() === "") {
      errors.push("Roll number is required.");
    }

    // Email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email.value.trim())) {
      errors.push("Invalid email address.");
    }

    // Department
    if (department && department.value.trim() === "") {
      errors.push("Please select or enter a department.");
    }

    // Photo validation
    if (photo.files.length === 0) {
      errors.push("Profile photo is required.");
    } else {
      const file = photo.files[0];
      const allowedTypes = ["image/jpeg", "image/png", "image/gif"];
      if (!allowedTypes.includes(file.type)) {
        errors.push("Only JPG, PNG or GIF images allowed.");
      }
      if (file.size > 2 * 1024 * 1024) {
        errors.push("Image must be less than 2 MB.");
      }
    }

    // If errors found
    if (errors.length > 0) {
      e.preventDefault();
      alert("Please fix the following:\n\n" + errors.join("\n"));
    }
  });
});

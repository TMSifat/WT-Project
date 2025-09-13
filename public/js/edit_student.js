// Profile photo preview
document.getElementById("photoInput").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("preview").src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

// Form validation (extra JS feature)
document.getElementById("editForm").addEventListener("submit", function (e) {
    const name = document.querySelector("input[name='name']").value.trim();
    const email = document.querySelector("input[name='email']").value.trim();
    if (name.length < 3) {
        alert("Name must be at least 3 characters!");
        e.preventDefault();
    } else if (!email.includes("@")) {
        alert("Enter a valid email!");
        e.preventDefault();
    }
});

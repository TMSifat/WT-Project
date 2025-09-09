<?php
$conn = mysqli_connect("localhost", "root", "", "student_db");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Create uploads folder if not exists
if (!is_dir("uploads")) {
    mkdir("uploads");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username   = trim($_POST['username']);
    $password   = md5(trim($_POST['password']));
    $name       = trim($_POST['name']);
    $roll       = trim($_POST['roll']);
    $email      = trim($_POST['email']);
    $department = trim($_POST['department']);

    // Photo upload setup
    $photo_name = $_FILES['profile_photo']['name'];
    $photo_tmp  = $_FILES['profile_photo']['tmp_name'];
    $photo_path = "uploads/" . time() . "_" . $photo_name;

    // Check if username exists
    $check_user = "SELECT * FROM students WHERE username='$username'";
    $result = mysqli_query($conn, $check_user);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username already exists! Try another.'); window.location='register.php';</script>";
        exit();
    } else {
        // Move uploaded photo to uploads folder
        if (move_uploaded_file($photo_tmp, $photo_path)) {
            // Insert new student with photo path
            $sql = "INSERT INTO students (username, password, name, roll, email, department, profile_photo)
                    VALUES ('$username', '$password', '$name', '$roll', '$email', '$department', '$photo_path')";
            
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Registration Successful! Please Login.'); window.location='login.php';</script>";
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Failed to upload photo!'); window.location='register.php';</script>";
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <!-- External CSS Link -->
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="reg-box">
        <h2>Student Registration</h2>
        <form action="register.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Enter Username" required><br>
            <input type="password" name="password" placeholder="Enter Password" required><br>
            <input type="text" name="name" placeholder="Enter Full Name" required><br>
            <input type="text" name="roll" placeholder="Enter Roll Number" required><br>
            <input type="email" name="email" placeholder="Enter Email" required><br>
            
            <select name="department" required>
                <option value="">-- Select Department --</option>
                <option value="CSE">CSE</option>
                <option value="BBA">BBA</option>
                <option value="EEE">EEE</option>
                <option value="LAW">LAW</option>
                <option value="ENGLISH">ENGLISH</option>
            </select><br>

            <input type="file" name="profile_photo" accept="image/*" required><br>
            <button type="submit">Register</button>
        </form>

        <script src="register1.js"></script>
        <a href="login.php">Already have an account? Login</a>
    </div>
</body>
</html>

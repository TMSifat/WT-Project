<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "student_db");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username   = trim($_POST['username']);
    $password   = md5(trim($_POST['password'])); 
    $login_type = isset($_POST['login_type']) ? $_POST['login_type'] : "student"; // student/admin

    $sql = "SELECT * FROM students WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // 🔹 Role check 
        if ($login_type == "admin" && $row['role'] != "admin") {
            echo "<script>alert('Access denied! Please use the Student Login'); window.location='login.php';</script>";
            exit();
        } elseif ($login_type == "student" && $row['role'] != "student") {
            echo "<script>alert('Access denied! Please use the Admin Login'); window.location='login.php';</script>";
            exit();
        }

        // 🔹 Session
        $_SESSION['student'] = $row;

        // 🔹 Redirect
        if ($row['role'] == "admin") {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: profile.php");
        }
        exit();

    } else {
        echo "<script>alert('Invalid username or password'); window.location='login.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="style.css"> <!-- Optional CSS -->
</head>
<body>
    <div class="container">
        <h1>Student Login</h1>
        <form action="login.php" method="POST" onsubmit="return validateLoginForm(event)">

            <input type="hidden" name="login_type" value="student">

            <label>Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required onkeyup="validateUsername(this)">
            <small id="usernameMessage"></small>

            <label>Password</label>
            <div style="display: flex; align-items: center;">
                <input type="password" id="password" name="password" placeholder="Enter your password" required style="flex: 1;">
                <span id="toggleIcon" onclick="togglePassword()" style="cursor:pointer; margin-left:5px;"></span>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>

        <div class="extra-links">
            <a href="register.php">Create Account</a>
            <a href="home.php">🏠 Home</a>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>

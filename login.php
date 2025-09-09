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
            echo "<script>alert('Access denied! Please use the Student Login'); window.location='login.html';</script>";
            exit();
        } elseif ($login_type == "student" && $row['role'] != "student") {
            echo "<script>alert('Access denied! Please use the Admin Login'); window.location='admin_login.html';</script>";
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
    if ($login_type == "admin") {
        echo "<script>alert('Invalid username or password'); window.location='admin_login.html';</script>";
    } else {
        echo "<script>alert('Invalid username or password'); window.location='login.html';</script>";
    }
}
}
?>

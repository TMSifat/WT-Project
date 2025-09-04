<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "student_db");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = md5(trim($_POST['password']));

    $sql = "SELECT * FROM students WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['student'] = $row;

        // **New Part: Check role**
        if ($row['role'] === 'admin') {
            header("Location: admin_dashboard.php"); // Admin page
        } else {
            header("Location: profile.php"); // Student page
        }
        exit();
    } else {
        echo "<script>alert('Invalid username or password'); window.location='login.html';</script>";
    }
}
?>

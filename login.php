<?php
<<<<<<< HEAD
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
=======

session_start();

error_reporting(E_ALL);

ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "", "student_db");


if (!$conn) {

    die("Database connection failed: " . mysqli_connect_error());

}

$username = $_POST['username'];

$password = md5($_POST['password']);

$sql = "SELECT * FROM students WHERE username='$username' AND password='$password'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {

    $row = mysqli_fetch_assoc($result);

    $_SESSION['student'] = $row;

    header("Location: profile.php");

    exit();

} else {

    echo "<script>alert('Invalid Username or Password'); window.location='login.html';</script>";

}

?>
>>>>>>> b6d6d55a7693666d4b976f6810b8b8a1238b18b0

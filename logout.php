<?php
session_start();

// student session 
$role = isset($_SESSION['student']['role']) ? $_SESSION['student']['role'] : 'student';


session_unset();
session_destroy();

// role redirect
if ($role === 'admin') {
    header("Location: admin_login.php");
} else {
    header("Location: login.php");
}
exit();
?>

<?php
session_start();

// রোল বের করি student session এর ভেতর থেকে
$role = isset($_SESSION['student']['role']) ? $_SESSION['student']['role'] : 'student';

// সব session বন্ধ করি
session_unset();
session_destroy();

// রোল অনুযায়ী redirect
if ($role === 'admin') {
    header("Location: admin_login.html");
} else {
    header("Location: login.html");
}
exit();
?>

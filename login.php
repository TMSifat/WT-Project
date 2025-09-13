<?php
require __DIR__ . '/app/bootstrap.php';
$controller = new AuthController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->login($_POST['login_type'] ?? 'student');
} else {
    $controller->showStudentLogin();
}


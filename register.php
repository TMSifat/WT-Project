<?php
require __DIR__ . '/app/bootstrap.php';
$controller = new RegisterController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->register();
} else {
    $controller->showForm();
}

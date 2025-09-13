<?php
require __DIR__ . '/app/bootstrap.php';
$controller = new AuthController();
$controller->showAdminLogin();

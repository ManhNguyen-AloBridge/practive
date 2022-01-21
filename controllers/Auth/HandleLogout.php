<?php
require_once $_SERVER['DOCUMENT_ROOT']  . '/controllers/Auth/AuthController.php';
$authController = new AuthController();

$login = $authController->logout($data);
<?php
require_once('AuthController.php');
$authController = new AuthController();

$login = $authController->logout($data);
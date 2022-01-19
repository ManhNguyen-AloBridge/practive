<?php
require_once('AuthController.php');
$authController = new AuthController();

if (!isset($_POST)) {
  return false;
}
$data = [
  'email' => $_POST['email'],
  'password' => $_POST['password']
];

$login = $authController->checkLogin($data);

if (!$login) {
  include_once('../views/pages/login.php');
}

include_once('../views/pages/index.php');
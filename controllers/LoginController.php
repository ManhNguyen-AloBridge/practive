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

$authController->checkLogin($data);
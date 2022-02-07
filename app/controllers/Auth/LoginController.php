<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'app/controllers/Auth/AuthController.php';
$authController = new AuthController();

if (!isset($_POST)) {
  return false;
}
// $data = [
//   'email' => $_POST['email'],
//   'password' => $_POST['password']
// ];

// $authController->checkLogin($data);
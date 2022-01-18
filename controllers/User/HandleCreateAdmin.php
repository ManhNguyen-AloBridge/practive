<?php

require_once('UserController.php');

$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data = [
    $_POST['name'],
    $_POST['email'],
    empty($_POST['password']) ? null : $_POST['password'],
    empty($_POST['birthday']) ? null : $_POST['birthday'],
    $_POST['address'],
    $_POST['phone'],
    $_POST['role'],
    $_POST['position'],
    $_POST['created_at'] ?? date('Y-m-d'),
    $_POST['updated_at'] ?? date('Y-m-d'),
    $_POST['deleted_at'],
  ];

  $controller->storeAdmin($data);
}
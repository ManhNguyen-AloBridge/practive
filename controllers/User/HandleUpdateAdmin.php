<?php

require_once('UserController.php');

$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data = [
    'id' => $_POST['id'],
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'birthday' => empty($_POST['birthday']) ? null : $_POST['birthday'],
    'address' => $_POST['address'],
    'phone' => $_POST['phone'],
    'role' => $_POST['role'],
    'position' => $_POST['position'],
    'updated_at' => $_POST['updated_at'] ?? date('Y-m-d'),
  ];

  $controller->updateAdmin($data);
}
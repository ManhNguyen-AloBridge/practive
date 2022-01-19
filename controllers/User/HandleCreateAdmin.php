<?php

require_once('UserController.php');

$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data = [
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'password' => empty($_POST['password']) ? null : $_POST['password'],
    'birthday' => empty($_POST['birthday']) ? null : $_POST['birthday'],
    'address' => $_POST['address'],
    'phone' => $_POST['phone'],
    'role' => $_POST['role'],
    'position' => $_POST['position'],
    'created_at' => $_POST['created_at'] ?? date('Y-m-d'),
    'updated_at' => $_POST['updated_at'] ?? date('Y-m-d'),
    'deleted_at' => $_POST['deleted_at'],
  ];

  $controller->storeAdmin($data);
}
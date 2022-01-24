<?php

require_once('UserController.php');

$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data = [
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'confirm_email' => $_POST['confirm_email'],
    'password' => $_POST['password'],
    'confirm_password' =>  $_POST['confirm_password'],
    'birthday' => $_POST['birthday'],
    'address' => $_POST['address'],
    'phone' => $_POST['phone'],
    'role' => $_POST['role'],
    'position' => $_POST['position'],
    'created_at' => $_POST['created_at'] ?? null,
    'updated_at' => $_POST['updated_at'] ?? null,
    'deleted_at' => $_POST['deleted_at'] ?? null,
  ];

  $controller->storeUser($data);
}
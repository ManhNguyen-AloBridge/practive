<?php

require_once('UserController.php');

$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $controller->deleteUser(intval($_POST['id']));
}
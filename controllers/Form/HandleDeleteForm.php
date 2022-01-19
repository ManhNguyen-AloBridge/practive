<?php
require_once('FormController.php');
$controller = new FormController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $controller->deleteForm(intval($_POST['id']));
}
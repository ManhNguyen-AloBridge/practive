<?php
require_once('FormController.php');
$controller = new FormController();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $data = [
    'form_type_id' => $_POST['form_type'],
    'reason' => $_POST['reason'],
    'extend_inlate_early' =>  $_POST['extend_inlate_early'] ?? null,
    'extend_absence' => $_POST['extend_absence'],
    'start_date' => $_POST['start_date'],
    'end_date' => $_POST['end_date'],
    'detail_time' => $_POST['detail_time'],
    'created_at' => $_POST['created_at'] ?? date('Y-m-d H:i'),
    'deleted_at' => $_POST['deleted_at'],
  ];

  $controller->store($data);
}
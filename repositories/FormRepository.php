<?php
require_once(dirname(__DIR__) . '/connection.php');

class FormRepository
{

  function __construct()
  {
    $conn = new DB();
    $this->conn = $conn;
  }

  public function store(array $data)
  {
    $query = $this->conn->getInstance()->prepare('INSERT INTO register_forms (user_id, form_type_id, extend_inlate_early_id, extend_absence_id, reason, status_id, start_date, end_date, detail_time, created_at, deleted_at) VALUE (?,?,?,?,?,?,?,?,?,?,?) ');
    return $query->execute($data);
  }

  public function storeInlateEarly(array $data)
  {
    $query = $this->conn->getInstance()->prepare('INSERT INTO register_forms (user_id, form_type_id, extend_inlate_early_id, extend_absence_id, reason, status_id, start_date, end_date, detail_time, created_at, deleted_at) VALUE (?,?,?,?,?,?,?,?,?,?,?) ');
    return $query->execute($data);
  }

  public function storeRemote(array $data)
  {
    $query = $this->conn->getInstance()->prepare('INSERT INTO register_forms (user_id, form_type_id, extend_inlate_early_id, extend_absence_id, reason, status_id, start_date, end_date, detail_time, created_at, deleted_at) VALUE (?,?,?,?,?,?,?,?,?,?,?) ');
    return $query->execute($data);
  }
}
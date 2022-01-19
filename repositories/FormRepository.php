<?php
require_once(dirname(__DIR__) . '/connection.php');

class FormRepository
{

  function __construct()
  {
    $this->conn = new DB();
  }

  public function store(array $data)
  {
    $query = $this->conn->getInstance()->prepare('INSERT INTO register_forms (form_type_id, reason, extend_inlate_early_id, extend_absence_id , start_date, end_date, detail_time, created_at, deleted_at, user_id, status_id) VALUE (?,?,?,?,?,?,?,?,?,?,?) ');
    return $query->execute($data);
  }

  public function getListForm()
  {
    $query = $this->conn->getInstance()->query("
    SELECT users.phone, register_forms.deleted_at, form_types.name AS name_form_type, states.name AS name_status, users.name AS user_name, positions.name AS name_position 
    FROM register_forms 
    JOIN form_types ON  form_types.id =  register_forms.form_type_id 
    JOIN states ON states.id = register_forms.status_id 
    JOIN users ON users.id = register_forms.user_id 
    JOIN positions ON positions.id = users.position_id
    WHERE register_forms.deleted_at IS NULL
    AND users.deleted_at IS NULL
    ");
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getListExtendInlateEarly()
  {
    $query = $this->conn->getInstance()->query('SELECT * FROM extend_inlate_early');
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getListExtendAbsence()
  {
    $query = $this->conn->getInstance()->query('SELECT * FROM extend_absence');
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
}
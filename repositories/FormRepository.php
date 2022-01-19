<?php
require_once(dirname(__DIR__) . '/connection.php');
class FormPosition
{
  public $conn;

  function __construct()
  {
    $conn = new DB();
    $this->conn = $conn;
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
}
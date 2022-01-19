<?php
require_once(dirname(__DIR__) . '/connection.php');
require_once(dirname(__DIR__) . '/models/User.php');
class UserRepository
{
  public $conn;

  function __construct()
  {
    $conn = new DB();
    $this->conn = $conn;
    $user = new User();
    $this->model = $user;
  }

  public function store(array $data)
  {
    $query = $this->conn->getInstance()->prepare('INSERT INTO users (name, email, password, birthday, address, phone, role_id, position_id, created_at, updated_at, deleted_at) values (?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?)');
    return $query->execute($data);
  }

  public function getListAdmin()
  {
    $query = $this->conn->getInstance()->query("
    SELECT users.phone, users.deleted_at, users.name AS user_name, roles.name AS role_name, positions.name AS position_name 
    FROM users  
    JOIN roles ON roles.id = users.role_id 
    JOIN positions ON positions.id = users.position_id 
    WHERE users.role_id =" . $this->model::ADMIN . " 
    AND users.deleted_at IS NULL
    LIMIT 10
    ");
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }


  public function getListStaff()
  {
    $query = $this->conn->getInstance()->query("
    SELECT users.phone, users.deleted_at, users.name AS user_name, roles.name AS role_name, positions.name AS position_name 
    FROM users  
    JOIN roles ON roles.id = users.role_id 
    JOIN positions ON positions.id = users.position_id 
    WHERE users.role_id =" . $this->model::USER . "
    AND users.deleted_at IS NULL
    LIMIT 10
    ");
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
}
<?php
require_once(dirname(__DIR__) . '/connection.php');
class UserRepository
{

  function __construct()
  {
    $conn = new DB();
    $this->conn = $conn;
  }

  public function store(array $data)
  {
    $query = $this->conn->getInstance()->prepare('INSERT INTO users (name, email, password, birthday, address, phone, role_id, position_id, created_at, updated_at, deleted_at) values (?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?)');
    return $query->execute($data);
  }
}
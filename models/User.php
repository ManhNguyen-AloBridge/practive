<?php
class User
{
  public $id;
  public $name;
  public $password;
  public $birthday;
  public $address;
  public $phone;
  public $role_id;
  public $position_id;
  public $created_at;
  public $updated_at;
  public $deleted_at;

  const ADMIN = 1;
  const USER = 2;

  function __construct()
  {
  }
}
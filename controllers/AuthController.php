<?php
require_once('../services/AuthService.php');

class AuthController
{
  public $authService;

  function __construct()
  {
    $authService = new AuthService();
    $this->authService = $authService;
  }

  public function checkLogin(array $data)
  {
    return $this->authService->checkLogin($data);
  }

  public function logout()
  {
    unset($_SESSION['user']);
    include_once('../views/pages/login.php');
  }
}
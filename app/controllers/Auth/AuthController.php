<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'app/services/AuthService.php';

if (empty(session_id())) session_start();
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
    $user = $this->authService->checkLogin($data);

    if (!$user) {
      return header('Location: /views/pages/login.php');
    }

    // session_start();
    $_SESSION['user_id'] = $user['id'];

    return header('Location: /views/pages/index.php');
  }

  public function logout()
  {
    unset($_SESSION['user']);
    return header('Location: /views/pages/login.php');
  }
}
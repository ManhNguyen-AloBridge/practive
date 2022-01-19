<?php
require_once('../repositories/UserRepository.php');

class AuthService
{
  public $userRepository;

  function __construct()
  {
    $userRepository = new UserRepository();
    $this->userRepository = $userRepository;
  }

  public function checkLogin(array $data)
  {
    $result = $this->userRepository->findByEmail($data['email']);
    if (!$result) {
      return false;
    }

    if ($result['password'] != md5($data['password'])) {
      $_SESSION['error_login'] = 'Thông tin đăng nhập không chính xác!';
      return false;
    }

    unset($_SESSION['error_login']);

    $_SESSION['user'] = $result['email'];

    return true;
  }
}
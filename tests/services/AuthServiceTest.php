<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'app/services/AuthService.php';

use PHPUnit\Framework\TestCase;


class AuthServiceTest extends TestCase
{

  public $authService;

  public function setUp(): void
  {
    $this->authService = new AuthService();
  }

  public function testLoginInvalidUserPassword(): void
  {
    $data = ['email' => 'admin@gmail.com', 'password' => '12311123123'];
    $result = $this->authService->checkLogin($data);
    $this->assertFalse($result);
  }

  public function testLoginValidUser()
  {
    $data = ['email' => 'admin@gmail.com', 'password' => '123123123'];
    $result = $this->authService->checkLogin($data);
    $this->assertIsArray($result);
  }

  public function testEmptyAllInfoLogin()
  {
    $data = ['email' => '', 'password' => ''];
    $result = $this->authService->checkLogin($data);
    $this->assertFalse($result);
  }
}
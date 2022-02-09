<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'app/controllers/Auth/AuthController.php';

use PHPUnit\Framework\TestCase;

class AuthControllerTest extends TestCase
{
  public $authController;

  public function setUp(): void
  {
    $_SESSION['user_id'] = 1;
    $this->authController = new AuthController();
  }

  /**
    * @runInSeparateProcess
    */
  public function testCheckLoginWithValidData(){
    $data = [
      'email' => 'admin@gmail.com',
      'password' => '123123123'
    ];

    $result = $this->authController->checkLogin($data);
    $this->assertNull($result);
  }

  /**
    * @runInSeparateProcess
    */
  public function testCheckLoginWithInValidData(){
    $data = [
      'email' => 'invalid@gmail.com',
      'password' => '123123123'
    ];

    $result = $this->authController->checkLogin($data);
    $this->assertNull($result);
  }

  /**
    * @runInSeparateProcess
    */
  public function testLogout(){
    $result = $this->authController->logout();
    $this->assertNull($result);
  }
}
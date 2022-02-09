<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'app/services/UserService.php';

use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
  public $userService;

  public function setUp(): void
  {
    $this->userService = new UserService();
  }

  public function testCreateNewUser()
  {
    $data = [
      'name' => 'Ho va ten',
      'email' => 'email@gmail.com',
      'password' => '123123123',
      'birthday' => '1990-12-11',
      'address' => 'Ha Noi',
      'phone' => '123456789',
      'role' => '1',
      'position' => '1',
      'created_at' => '2020-01-01',
      'updated_at' => '2020-01-01',
      'deleted_at' => null,
    ];

    $result = $this->userService->store($data);
    $this->assertTrue($result);
  }

  public function testGetListAdmin()
  {
    $result = $this->userService->getListAdmin();
    $this->assertIsArray($result);
  }

  public function testGetListStaff()
  {
    $result = $this->userService->getListStaff();
    $this->assertIsArray($result);
  }

  public function testFindWithValidEmail()
  {
    $email = 'abc@gmail.com';
    $result = $this->userService->findByEmail($email);
    $this->assertIsArray($result);
  }

  public function testGetListPosition()
  {
    $result = $this->userService->getListPosition();
    $this->assertIsArray($result);
  }

  public function testGetListRole()
  {
    $result = $this->userService->getListRole();
    $this->assertIsArray($result);
  }

  public function testFindByIdWithValidId()
  {
    $id = 1;
    $result = $this->userService->findById($id);
    $this->assertIsArray($result);
  }

  public function testFindByIdWithInValidId()
  {
    $id = -1;
    $result = $this->userService->findById($id);
    $this->assertIsArray($result);
  }

  public function testDeleteSoft()
  {
    $id = 33;
    $result = $this->userService->deleteSoft($id);
    $this->assertTrue($result);
  }
}
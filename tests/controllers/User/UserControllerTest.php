<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'app/controllers/User/UserController.php';

use PHPUnit\Framework\TestCase;

// if (isset($_SESSION)) $_SESSION = [];

class UserControllerTest extends TestCase
{

  public $userController;


  public function setUp(): void
  {
    $_SESSION['user_id'] = 1;
    $this->userController = new UserController();
  }

  public function testGetDetailInfoWithIdValid()
  {
    $id = 216;

    $result = $this->userController->detailInfo($id);
    $this->assertIsArray($result);
  }

  public function testShowInfoWithIdValid()
  {
    $result = $this->userController->show();
    $this->assertIsArray($result);
  }

  public function testCreateNewAdminWithDataValid()
  {
    $email = uniqid() . '@gmail1.com';

    $data = [
      'name' => 'test test',
      'email' => $email,
      'password' => '123123123',
      'confirm_password' => '123123123',
      'birthday' => '1999-01-01',
      'address' => 'address test',
      'phone' => '123456789',
      'role' => '1',
      'position' => '2',
      'created_at' => '2020-01-01',
      'updated_at' => '2020-01-01',
      'deleted_at' => null,

    ];

    $result = $this->userController->storeAdmin($data);

    $this->assertNull($result);
  }

  public function testCreateNewUserWithDataValid()
  {
    $email = uniqid() . '@gmail2.com';

    $data = [
      'name' => 'test test',
      'email' => $email,
      'password' => '123123123',
      'confirm_password' => '123123123',
      'birthday' => '1999-01-01',
      'address' => 'address test',
      'phone' => '123456789',
      'role' => '2',
      'position' => '2',
      'created_at' => '2020-01-01',
      'updated_at' => '2020-01-01',
      'deleted_at' => null,

    ];

    $result = $this->userController->storeUser($data);

    $this->assertNull($result);
  }

  public function testDeleteAdmin()
  {
    $id = 233;
    $result = $this->userController->deleteAdmin($id);
    $this->assertNull($result);
  }

  public function testDeleteUser()
  {
    $id = 253;
    $result = $this->userController->deleteUser($id);
    $this->assertNull($result);
  }

  public function testGetListAdmin()
  {
    $result = $this->userController->getListAdmin();
    $this->assertIsArray($result);
  }

  public function testGetListUser()
  {
    $result = $this->userController->getListAdmin();
    $this->assertIsArray($result);
  }
}
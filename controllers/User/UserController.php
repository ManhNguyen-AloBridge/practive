<?php
require_once('../../../services/UserService.php');
class UserController
{
  public $userService;

  function __construct()
  {
    $userService = new UserService();
    $this->userService = $userService;
  }

  public function getListAdmin()
  {
    return $this->userService->getListAdmin();
  }

  public function getListStaff()
  {
    return $this->userService->getListStaff();
  }

  function show()
  {
  }

  function update()
  {
  }

  function delete()
  {
  }
}
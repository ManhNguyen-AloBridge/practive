<?php
require_once(dirname(__DIR__) . '/repositories/UserRepository.php');

class UserService
{
  public $userRepository;

  function __construct()
  {
    $userRepository = new UserRepository();
    $this->userRepository = $userRepository;
  }

  public function getListAdmin()
  {

    $listAdmin = $this->userRepository->getListAdmin();
    return $listAdmin;
  }


  public function getListStaff()
  {
    $listStaff = $this->userRepository->getListStaff();
    return $listStaff;
  }
}
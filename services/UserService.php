<?php
require_once(dirname(__DIR__) . '/repositories/UserRepository.php');
class UserService
{

  function __construct()
  {
    $userRepository = new UserRepository();
    $this->userRepository = $userRepository;
  }

  public function store(array $data)
  {
    $dataInsert = [
      $data['name'],
      $data['email'],
      $data['password'],
      $data['birthday'],
      $data['address'],
      $data['phone'],
      $data['role'],
      $data['position'],
      $data['created_at'],
      $data['updated_at'],
      $data['deleted_at'],
    ];

    return $this->userRepository->store($dataInsert);
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

  public function findByEmail(string $email)
  {
    return $this->userRepository->findByEmail($email);
  }

  public function getListPosition()
  {
    return $this->userRepository->getListPosition();
  }

  public function getListRole()
  {
    return $this->userRepository->getListRole();
  }
}
<?php
require_once $_SERVER['DOCUMENT_ROOT']  . '/repositories/UserRepository.php';
require_once $_SERVER['DOCUMENT_ROOT']  . '/models/User.php';
class UserService
{

  function __construct()
  {
    $userRepository = new UserRepository();
    $this->userRepository = $userRepository;
  }

  public function store(array $data)
  {
    $data['created_at'] = date('Y-m-d');
    $data['updated_at'] = date('Y-m-d');

    $dataInsert = [
      $data['name'],
      $data['email'],
      md5($data['password']),
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

  public function findById(int $userId)
  {
    return $this->userRepository->findById($userId);
  }

  public function deleteSoft(int $userId)
  {
    return $this->userRepository->deleteSoft($userId);
  }

  public function updateInfo(int $userRole, array $data)
  {
    $data['updated_at'] = date('Y-m-d');
    unset($data['confirm_password']);
    $currentPassword = $this->findById($data['id'])['password'];
    if ($currentPassword != $data['password']) {
      $data['password'] = md5($data['password']);
    }

    if ($userRole == User::ADMIN) {
      return $this->userRepository->updateInfoForAdmin($data);
    }

    unset($data['role']);
    unset($data['position']);
    unset($data['email']);
    return $this->userRepository->updateInfoForUser($data);
  }
}
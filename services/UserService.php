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
    return $this->userRepository->store($data);
  }
}
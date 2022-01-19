<?php
require_once(dirname('/home/giangtuan/Documents/Code/study/practive/controllers') . '/services/UserService.php');
class UserController
{
  public $userService;

  function __construct()
  {
    $userService = new UserService();
    $this->userService = $userService;
  }

  function show()
  {
  }

  public function storeAdmin(array $data)
  {
    $isAdmin = true;
    session_start();
    $this->store($isAdmin, $data);
  }

  public function storeUser(array $data)
  {
    $isAdmin = false;
    session_start();
    $this->store($isAdmin, $data);
  }

  private function store(bool $isAdmin, array $data)
  {
    $email = $this->userService->findByEmail($data['email']);

    if ($email) {
      $this->errorSession($isAdmin);
    }

    $result = $this->userService->store($data);

    if (!$result) {
      $this->errorSession($isAdmin);
    }
    $_SESSION['success_create'] = $isAdmin ? 'Thêm mới Admin thành công' : 'Thêm mới người dùng thành công';
    return $isAdmin ? header('Location: /views/pages/admin/list-admin.php') : header('Location: /views/pages/staff/list-staff.php');
  }

  private function errorSession(bool $isAdmin)
  {
    $_SESSION['error_create'] = $isAdmin ? 'Thêm mới Admin không thành công' : 'Thêm mới người dùng không thành công';
    var_dump($_SESSION['error_create']);
    die($isAdmin ? header('Location: /views/pages/admin/create.php') : header('Location: /views/pages/staff/create.php'));
  }

  public function getListAdmin()
  {
    return $this->userService->getListAdmin();
  }

  public function getListStaff()
  {
    return $this->userService->getListStaff();
  }

  function update()
  {
  }

  function delete()
  {
  }
}
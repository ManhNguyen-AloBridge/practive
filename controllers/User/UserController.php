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

  public function detailInfo(int $userId)
  {
    $result = $this->userService->findById($userId);

    if (!$result) {
      session_start();
      $_SESSION['error_show'] = 'Thông tin người dùng không tồn tại';
      die(header('Location: /views/pages/admin/list-admin.php'));
    }
    return $result;
  }

  public function show()
  {
    session_start();
    $result = $this->userService->findById($_SESSION['user_id']);
    if (!$result) {
      $_SESSION['error_show'] = 'Thông tin người dùng không tồn tại';
      die(header('Location: /views/pages/index.php'));
    }
    return $result;
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
    die($isAdmin ? header('Location: /views/pages/admin/create.php') : header('Location: /views/pages/staff/create.php'));
  }

  public function getListAdmin()
  {
    $data = $this->userService->getListAdmin();
    return $this->uncheckYourInfoInList($data);
  }

  public function getListStaff()
  {
    $data = $this->userService->getListStaff();
    return $this->uncheckYourInfoInList($data);
  }

  private function uncheckYourInfoInList(array $data)
  {
    $index = array_search(strval($_SESSION['user_id']), array_column($data, 'id'));
    unset($data[$index]);
    return $data;
  }

  function update()
  {
  }

  function delete()
  {
  }
}
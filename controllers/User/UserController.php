<?php
// require_once(dirname(__DIR__) . '/services/UserService.php');
require_once('../../services/UserService.php');

class UserController
{

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
    $result = $this->userService->store($data);
    session_start();

    if (!$result) {
      $_SESSION['error_create_admin'] = 'Thêm mới Admin không thành công';

      return header('Location: /views/pages/admin/create.php');
    }

    if (isset($_SESSION['error_create_admin'])) {
      unset($_SESSION['error_create_admin']);
    }

    $_SESSION['success_create_admin'] = 'Thêm mới Admin thành công';

    header('Location: /views/pages/admin/list-admin.php');
  }

  public function storeUser(array $data)
  {
    $result = $this->userService->store($data);

    session_start();

    if (!$result) {
      $_SESSION['error_create_user'] = 'Thêm mới người dùng không thành công';
      return header('Location: /views/pages/staff/create.php');
    }

    if (isset($_SESSION['error_create_user'])) {
      unset($_SESSION['error_create_user']);
    }


    $_SESSION['success_create_user'] = 'Thêm mới người dùng thành công';
    return header('Location: /views/pages/staff/list-staff.php');
  }


  function update()
  {
  }

  function delete()
  {
  }
}
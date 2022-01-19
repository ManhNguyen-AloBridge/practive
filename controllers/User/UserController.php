<?php
require_once $_SERVER['DOCUMENT_ROOT']  . '/services/UserService.php';
require_once $_SERVER['DOCUMENT_ROOT']  . '/trait/Validate.php';
class UserController
{

  use Validate;

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

    $this->validateCreateUser($isAdmin, $data);

    $this->store($isAdmin, $data);
  }

  public function storeUser(array $data)
  {
    $isAdmin = false;
    session_start();

    $this->validateCreateUser($isAdmin, $data);

    $this->store($isAdmin, $data);
  }

  private function store(bool $isAdmin, array $data)
  {
    $result = $this->userService->store($data);

    if (!$result) {
      $this->errorCreateSession($isAdmin);
    }

    $_SESSION['success_create'] = $isAdmin ? 'Thêm mới Admin thành công' : 'Thêm mới người dùng thành công';
    return $isAdmin ? header('Location: /views/pages/admin/list-admin.php') : header('Location: /views/pages/staff/list-staff.php');
  }

  private function errorCreateSession(bool $isAdmin)
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

  public function updateAdmin(array $data)
  {
    $isAdmin = true;
    $isProfile = false;
    return $this->updateInfo($isAdmin, $isProfile, $data);
  }

  public function updateStaff(array $data)
  {
    $isAdmin = false;
    $isProfile = false;
    return $this->updateInfo($isAdmin, $isProfile, $data);
  }

  public function updateProfile(array $data)
  {
    $userId = $data['id'];
    $isAdmin = false;
    $isProfile = true;
    $user = $this->userService->findById($userId);

    session_start();
    if (!$user) {
      $this->errorUpdateInfo($isAdmin, $isProfile, $userId);
    }

    $result = $this->userService->updateInfo($data);

    if (!$result) {
      $this->errorUpdateInfo($isAdmin, $isProfile, $userId);
    }

    $_SESSION['success_update'] = 'Cập nhật thông tin thành công';
    return header('Location: /views/pages/profile.php');
  }

  private function updateInfo(bool $isAdmin, bool $isProfile, array $data)
  {
    $userId = $data['id'];
    $user = $this->userService->findById($userId);

    session_start();
    if (!$user) {
      $this->errorUpdateInfo($isAdmin, $isProfile, $userId);
    }

    $result = $this->userService->updateInfo($data);

    if (!$result) {
      $this->errorUpdateInfo($isAdmin, $isProfile, $userId);
    }

    $_SESSION['success_update'] = 'Cập nhật thông tin thành công';
    return $isAdmin ? header('Location: /views/pages/admin/detail.php?id=' . $userId) : header('Location: /views/pages/staff/detail.php?id=' . $userId);
  }

  private function errorUpdateInfo(bool $isAdmin, bool $isProfile, int $userId)
  {
    $_SESSION['error_update'] = 'Cập nhật thông tin không thành công';

    if ($isProfile) {
      die(header('Location: /views/pages/edit.php'));
    }

    die($isAdmin ? header('Location: /views/pages/admin/edit.php?id=' . $userId) : header('Location: /views/pages/staff/edit.php?id=' . $userId));
  }

  function deleteAdmin(int $userId)
  {
    $isAdmin = true;
    return $this->delete($isAdmin, $userId);
  }

  function deleteUser(int $userId)
  {
    $isAdmin = false;
    return $this->delete($isAdmin, $userId);
  }

  private function delete(bool $isAdmin, int $userId)
  {
    $user = $this->userService->findById($userId);
    session_start();
    if (!$user) {
      $this->errorDeleteUser($isAdmin);
    }

    $result = $this->userService->deleteSoft($userId);

    if (!$result) {
      $this->errorDeleteUser($isAdmin);
    }

    $_SESSION['success_delete'] = 'Xóa người dùng thành công.';
    return $isAdmin ? header('Location: /views/pages/admin/list-admin.php') : header('Location: /views/pages/staff/list-staff.php');
  }

  private function errorDeleteUser(bool $isAdmin)
  {
    $_SESSION['error_delete'] = 'Xóa người dùng không thành công!';
    die($isAdmin ? header('Location: /views/pages/admin/list-admin.php') : header('Location: /views/pages/staff/list-staff.php'));
  }

  private function validateCreateUser(bool $isAdmin, array $data)
  {
    $errors = [];
    unset($data['deleted_at']);

    $errors['name'] = $this->validateFieldString('Họ tên', 3, 50, $data['name']);

    $errors['email'] = $this->validateFieldRegexSpecial($data['email'], '/\S+@\S+\.\S+/', 'Email không được để trống.', 'Email không đúng định dạng.');

    $email = $this->userService->findByEmail($data['email']);
    if ($email) {
      $errors['email'] = 'Email đã tồn tại.';
    }

    $errors['confirm_email'] = $this->validateConfirm('email', $data['email'], $data['confirm_email']);

    $errors['password'] = $this->validateFieldString('Mật khẩu', 6, 50, $data['password']);

    $errors['confirm_password'] = $this->validateConfirm('mật khẩu', $data['password'], $data['confirm_password']);

    if (empty($data['role'])) {
      $errors['role'] = 'Hãy chọn một quyền.';
    }

    if (empty($data['position'])) {
      $errors['position'] = 'Hãy chọn một chức vụ.';
    }

    $errors['birthday'] = $this->validateBirthday($data['birthday'], 'Hãy chọn ngày sinh.', 'Ngày sinh phải trước ngày hiện tại.');

    $errors['phone'] = $this->validateFieldRegexSpecial($data['phone'], '/^[0-9\-\+]{9,15}$/', 'Số điện thoại không được để trống.', 'Số điện thoại phải có độ dài từ 9 - 15 ký tự số.');

    $errors['address'] = $this->validateFieldString('Địa chỉ', 6, 50, $data['address']);


    if (count(array_filter($errors)) > 0) {
      $_SESSION['old_data'] = $data;
      $_SESSION['errors_validate'] = $errors;
      die($isAdmin ? header('Location: /views/pages/admin/create.php') : header('Location: /views/pages/staff/create.php'));
    }
  }
}
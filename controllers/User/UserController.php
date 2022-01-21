<?php
require_once(dirname('/home/giangtuan/Documents/Code/study/practive/controllers') . '/services/UserService.php');
require_once(dirname('/home/giangtuan/Documents/Code/study/practive/controllers') . '/trait/ValidateName.php');
class UserController
{

  use Validate;

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


    if (count($errors) > 0) {
      $_SESSION['old_data'] = $data;
      $_SESSION['errors_validate'] = $errors;
      die($isAdmin ? header('Location: /views/pages/admin/create.php') : header('Location: /views/pages/staff/create.php'));
    }
  }
}
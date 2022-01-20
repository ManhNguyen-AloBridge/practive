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
    if (empty($data['name'])) {
      $errors['name'] = 'Họ tên không được để trống.';
    } else {
      $checkName = preg_match('/^.{3,50}$/', $data['name']);
      if (!$checkName) {
        $errors['name'] = 'Họ tên tối thiểu phải có 3 ký tự và tối đa 50 ký tự.';
      }
    }

    if (empty($data['email'])) {
      $errors['email'] = 'Email không được để trống.';
    } else {

      $checkEmail = preg_match('/\S+@\S+\.\S+/', $data['email']);
      if (!$checkEmail) {
        $errors['email'] = 'Email không đúng định dạng.';
      }

      $email = $this->userService->findByEmail($data['email']);
      if ($email) {
        $errors['email'] = 'Email đã tồn tại.';
      }
    }

    if (empty($data['password'])) {
      $errors['password'] = 'Mật khẩu không được để trống.';
    } else {
      $checkPassword = preg_match('/^.{6,50}$/', $data['password']);
      if (!$checkPassword) {
        $errors['password'] = 'Mật khẩu tối thiểu phải có 6 ký tự và tối đa 50 ký tự.';
      }
    }

    if (empty($data['role'])) {
      $errors['role'] = 'Hãy chọn một quyền.';
    }

    if (empty($data['position'])) {
      $errors['position'] = 'Hãy chọn một chức vụ.';
    }

    if (empty($data['birthday'])) {
      $errors['birthday'] = 'Hãy chọn ngày sinh.';
    } else {
      if ($data['birthday'] >= date('Y-m-d')) {
        $errors['birthday'] = 'Ngày sinh phải trước ngày hiện tại.';
      }
    }

    if (empty($data['phone'])) {
      $errors['phone'] = 'Số điện thoại không được để trống.';
    } else {
      $checkPhone = preg_match('/^[0-9\-\+]{9,15}$/', $data['phone']);

      if (!$checkPhone) {
        $errors['phone'] = 'Số điện thoại phải có độ dài từ 9 - 15 ký tự số.';
      }
    }
    if (empty($data['address'])) {
      $errors['address'] = 'Địa chỉ không được để trống.';
    } else {
      $checkAddress = preg_match('/^.{6,100}$/', $data['address']);
      if (!$checkAddress) {
        $errors['address'] = 'Địa chỉ tối thiểu phải có 6 ký tự và tối đa 100 ký tự.';
      }
    }

    if (count($errors) > 0) {
      $_SESSION['old_data'] = $data;
      $_SESSION['errors_validate'] = $errors;
      die($isAdmin ? header('Location: /views/pages/admin/create.php') : header('Location: /views/pages/staff/create.php'));
    }
  }
}
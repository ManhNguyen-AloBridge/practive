<?php
require_once $_SERVER['DOCUMENT_ROOT']  . '/services/UserService.php';
$userService = new UserService();

$roles = $userService->getListRole();
$positions = $userService->getListPosition();

session_start();
$error = false;
if (isset($_SESSION['error_create'])) {
  $error = true;
  $messageError = $_SESSION['error_create'];
  unset($_SESSION['error_create']);
}

if (isset($_SESSION['errors_validate']) && isset($_SESSION['old_data'])) {
  $errorsValidate = $_SESSION['errors_validate'];
  $oldData = $_SESSION['old_data'];
  unset($_SESSION['errors_validate']);
  unset($_SESSION['old_data']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
  <link rel="stylesheet" href="../../../assets/css/layout/index.css">
  <link rel="stylesheet" href="../../../assets/css/pages/detail.css">
  <link rel="stylesheet" href="../../../assets/css/pages/create.css">


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <title>Document</title>
</head>

<body>
  <main>
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light sidebar ">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">Menu</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto" id="menu">
        <li class="nav-item">
          <a href="../index.php" class="nav-link link-dark" id="dashboard">
            <svg class="bi me-2" width="16" height="16"></svg>
            Dashboard
          </a>
        </li>
        <li>
          <a href="../admin/list-admin.php" class="nav-link link-dark" id="listAdmin">
            <svg class="bi me-2" width="16" height="16"></svg>
            Danh sách admin
          </a>
        </li>
        <li>
          <a href="list-staff.php" class="nav-link link-dark active" aria-current="page" id="listStaff">
            <svg class="bi me-2" width="16" height="16"></svg>
            Danh sách nhân viên
          </a>
        </li>
        <li>
          <a href="../form/list-form.php" class="nav-link link-dark" id="listForm">
            <svg class="bi me-2" width="16" height="16"></svg>
            Danh sách sách form
          </a>
        </li>
      </ul>
      <hr>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2"
          data-bs-toggle="dropdown" aria-expanded="false">
          <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
          <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
          <li><a class="dropdown-item" href="../profile.php">Profile</a></li>
          <li><a class="dropdown-item" href="../form/create.php">Gửi form</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="../../../controllers/HandleLogout.php">Sign out</a></li>
        </ul>
      </div>
    </div>
    <div class="b-example-divider"></div>
    <div class="content">
      <div class="main-content">
        <form action="../../../controllers/User/HandleCreateUser.php" method="post">
          <h1 class="title-detail pb-3 mb-4">Thêm mới nhân viên</h1>
          <div class="content-detail">
            <div class="row field-info pt-3 pb-3">
              <label for="name" class="name col-3">Họ tên</label>
              <div class="col-9">
                <input class="field-input" type="text" name="name" value="<?php if (isset($oldData['name'])) {
                                                                            echo $oldData['name'];
                                                                          }  ?>">
                <?php if (isset($errorsValidate['name'])) { ?>
                <span class="message-error"><?= $errorsValidate['name']; ?></span>
                <?php
                } ?>
              </div>
            </div>
            <div class="row field-info pt-3 pb-3">
              <label for="email" class="name col-3">Email</label>
              <div class="col-9">
                <input class="field-input" type="email" name="email" value="<?php if (isset($oldData['email'])) {
                                                                              echo $oldData['email'];
                                                                            }  ?>">
                <?php if (isset($errorsValidate['email'])) { ?>
                <span class="message-error"><?= $errorsValidate['email']; ?></span>
                <?php
                } ?>
              </div>
            </div>
            <div class="row field-info pt-3 pb-3">
              <label for="email" class="name col-3">Nhập lại email</label>
              <div class="col-9">
                <input class="field-input" type="email" name="confirm_email" value="<?php if (isset($oldData['confirm_email'])) {
                                                                                      echo $oldData['confirm_email'];
                                                                                    }  ?>">
                <?php if (isset($errorsValidate['confirm_email'])) { ?>
                <span class="message-error"><?= $errorsValidate['confirm_email']; ?></span>
                <?php
                } ?>
              </div>
            </div>
            <div class="row field-info pt-3 pb-3">
              <label for="password" class="name col-3">Mật khẩu</label>
              <div class="col-9">
                <input class="field-input" type="password" name="password" value="<?php if (isset($oldData['password'])) {
                                                                                    echo $oldData['password'];
                                                                                  }  ?>">
                <?php if (isset($errorsValidate['password'])) { ?>
                <span class="message-error"><?= $errorsValidate['password']; ?></span>
                <?php
                } ?>
              </div>
            </div>
            <div class="row field-info pt-3 pb-3">
              <label for="password" class="name col-3">Nhập lại mật khẩu</label>
              <div class="col-9">
                <input class="field-input" type="password" name="confirm_password" value="<?php if (isset($oldData['confirm_password'])) {
                                                                                            echo $oldData['confirm_password'];
                                                                                          }  ?>">
                <?php if (isset($errorsValidate['confirm_password'])) { ?>
                <span class="message-error"><?= $errorsValidate['confirm_password']; ?></span>
                <?php
                } ?>
              </div>
            </div>
            <div class="row field-info pt-3 pb-3">
              <label for="name" class="name col-3">Vai trò</label>
              <div class="col-9">
                <select class="select-role" name="role" id="">
                  <option value="">Chọn quyền</option>
                  <?php foreach ($roles as $role) {
                  ?>
                  <option value="<?= $role['id'] ?>" <?php if (isset($oldData['role']) && $oldData['role'] === $role['id']) {
                                                          echo 'selected="selected"';
                                                        } ?>><?= $role['name'] ?></option>
                  <?php
                  } ?>
                </select>
                <?php if (isset($errorsValidate['role'])) { ?>
                <span class="message-error"><?= $errorsValidate['role']; ?></span>
                <?php
                } ?>
              </div>
            </div>
            <div class="row field-info pt-3 pb-3">
              <label for="name" class="name col-3">Chức vụ</label>
              <div class="col-9">
                <?php foreach ($positions as $item) {
                ?>
                <div class="position">
                  <input class="" type="radio" value="<?= $item['id'] ?>" name="position" <?php if (isset($oldData['position']) && $oldData['position'] == $item['id']) {
                                                                                              echo 'checked';
                                                                                            } ?>>
                  <label><?= $item['name'] ?></label>
                </div>
                <?php
                } ?>
                <?php if (isset($errorsValidate['position'])) { ?>
                <span class="message-error"><?= $errorsValidate['position']; ?></span>
                <?php
                } ?>
              </div>
            </div>
            <div class="row field-info pt-3 pb-3">
              <label for="name" class="name col-3">Ngày sinh </label>
              <div class="col-9">
                <input class="" type="date" name="birthday" value="<?php if (isset($oldData['birthday'])) {
                                                                      echo $oldData['birthday'];
                                                                    }  ?>">
                <?php if (isset($errorsValidate['birthday'])) { ?>
                <span class="message-error"><?= $errorsValidate['birthday']; ?></span>
                <?php
                } ?>
              </div>
            </div>
            <div class="row field-info pt-3 pb-3">
              <label for="name" class="name col-3">Số điện thoại</label>
              <div class="col-9">
                <input class="field-input" type="text" name="phone" value="<?php if (isset($oldData['phone'])) {
                                                                              echo $oldData['phone'];
                                                                            }  ?>">
                <?php if (isset($errorsValidate['phone'])) { ?>
                <span class="message-error"><?= $errorsValidate['phone']; ?></span>
                <?php
                } ?>
              </div>
            </div>
            <div class="row field-info pt-3 pb-3">
              <label for="address" class="name col-3">Địa chỉ</label>
              <div class="col-9">
                <input class="field-input" type="text" name="address" value="<?php if (isset($oldData['address'])) {
                                                                                echo $oldData['address'];
                                                                              }  ?>">
                <?php if (isset($errorsValidate['address'])) { ?>
                <span class="message-error"><?= $errorsValidate['address']; ?></span>
                <?php
                } ?>
              </div>
            </div>
          </div>

          <footer class="footer-detail">
            <div class="footer text-center">
              <a href="../../../views/pages/staff/list-staff.php" class="btn btn-footer-edit btn-back btn-secondary">
                Hủy bỏ
              </a>
              <button type="submit" class="btn btn-footer-edit btn-update btn-primary">
                Tạo mới
              </button>
            </div>
          </footer>
        </form>
      </div>
    </div>

  </main>

</body>

</body>

</html>
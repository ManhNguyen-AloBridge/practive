<?php
require_once $_SERVER['DOCUMENT_ROOT']  . '/services/FormService.php';
session_start();
$formService = new FormService();

$listInlateEarly = $formService->getListExtendInlateEarly();
$listAbsence = $formService->getListExtendAbsence();
$listFormType = $formService->getListFormType();


$error = false;
if (isset($_SESSION['error_create_form'])) {
  $error = true;
  $messageError = $_SESSION['error_create_form'];
  unset($_SESSION['error_create_form']);
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
          <a href="../staff/list-staff.php" class="nav-link link-dark" id="listStaff">
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
          <li><a class="dropdown-item active" href="create.php">Gửi form</a></li>
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
        <form action="../../../controllers/Form/HandleCreateForm.php" method="post">
          <h1 class="title-detail pb-3 mb-4">Gửi form</h1>
          <div class="content-detail">
            <?php if ($error) {
            ?>
            <div class="alert alert-danger" role="alert">
              <?= $messageError ?>
            </div>
            <?php
            } ?>
            <div class="row field-info pt-3 pb-3" id="reason">
              <label for="name" class="name col-3">Yêu cầu</label>
              <div class="col-9">
                <?php foreach ($listFormType as $item) { ?>
                <div class="form-type">
                  <input class="" type="radio" name="form_type" <?php if (isset($oldData['form_type_id']) && $oldData['form_type_id'] == $item['id']) {
                                                                    echo 'checked';
                                                                  } ?> value="<?= $item['id'] ?>"
                    id="<?= $item['id'] ?>">
                  <label for="remote"><?= $item['name'] ?></label>
                </div>
                <?php
                }
                ?>

                <?php if (isset($errorsValidate['form_type'])) { ?>
                <span class="message-error"><?= $errorsValidate['form_type']; ?></span>
                <?php
                } ?>
              </div>
            </div>
            <div class="row field-extend-late-early pt-3 pb-3 <?php if (!empty($oldData['extend_inlate_early']) || isset($errorsValidate['extend_inlate_early'])) {
                                                                echo '';
                                                              } else {
                                                                echo 'd-none';
                                                              } ?>" id="extend-inlate-early">
              <label for="name" class="name col-3">Chi tiết</label>
              <div class="col-9">
                <?php foreach ($listInlateEarly as $item) {
                ?>
                <div class="form-type">
                  <input class="" type="radio" name="extend_inlate_early" value="<?= $item['id'] ?>" <?php if (isset($oldData['extend_inlate_early']) && $oldData['extend_inlate_early'] == $item['id']) {
                                                                                                          echo 'checked';
                                                                                                        } ?>>
                  <label for=""><?= $item['name'] ?></label>
                </div>
                <?php
                } ?> <?php if (isset($errorsValidate['extend_inlate_early'])) { ?>
                <span class="message-error"><?= $errorsValidate['extend_inlate_early']; ?></span>
                <?php
                      } ?>
              </div>
            </div>
            <div class="row field-extend-absence pt-3 pb-3 <?php if (!empty($oldData['extend_absence']) || isset($errorsValidate['extend_absence'])) {
                                                              echo '';
                                                            } else {
                                                              echo 'd-none';
                                                            } ?>" id="extend-absence">
              <label for="name" class="name col-3">Buổi trong ngày</label>
              <div class="col-9">
                <?php foreach ($listAbsence as $item) {
                ?>
                <div class="form-type">
                  <input class="" type="radio" name="extend_absence" value="<?= $item['id'] ?>" <?php if (isset($oldData['extend_absence']) && $oldData['extend_absence'] == $item['id']) {
                                                                                                    echo 'checked';
                                                                                                  } ?>>
                  <label for=""><?= $item['name'] ?></label>
                </div>
                <?php
                } ?> <?php if (isset($errorsValidate['extend_absence'])) { ?>
                <span class="message-error"><?= $errorsValidate['extend_absence']; ?></span>
                <?php
                      } ?>
              </div>
            </div>
            <div class="row field-info pt-3 pb-3">
              <label for="name" class="name col-3">Lý do</label>
              <div class="col-9">
                <input class="field-input" type="text" name="reason" value="<?php if (isset($oldData['reason'])) {
                                                                              echo $oldData['reason'];
                                                                            }  ?>" id="">
                <?php if (isset($errorsValidate['reason'])) { ?>
                <span class="message-error"><?= $errorsValidate['reason']; ?></span>
                <?php
                } ?>
              </div>
            </div>
            <div class="row field-info pt-3 pb-3">
              <label for="name" class="name col-3">Thời gian bắt đầu</label>
              <div class="col-9">
                <input class="" type="date" name="start_date" value="<?php if (isset($oldData['start_date'])) {
                                                                        echo $oldData['start_date'];
                                                                      }  ?>" id="">
                <?php if (isset($errorsValidate['start_date'])) { ?>
                <span class="message-error"><?= $errorsValidate['start_date']; ?></span>
                <?php
                } ?>
              </div>
            </div>
            <div class="row field-info pt-3 pb-3">
              <label for="name" class="name col-3">Thời gian kết thúc</label>
              <div class="col-9">
                <input class="" type="date" name="end_date" value="<?php if (isset($oldData['end_date'])) {
                                                                      echo $oldData['end_date'];
                                                                    }  ?>" id="">
                <?php if (isset($errorsValidate['end_date'])) { ?>
                <span class="message-error"><?= $errorsValidate['end_date']; ?></span>
                <?php
                } ?>
              </div>
            </div>
            <div class="row field-info pt-3 pb-3">
              <label for="name" class="name col-3">Thông tin bổ sung</label>
              <div class="col-9">
                <input class="field-input" type="text" name="detail_time" value="<?php if (isset($oldData['detail_time'])) {
                                                                                    echo $oldData['detail_time'];
                                                                                  } ?>" id="">
                <?php if (isset($errorsValidate['detail_time'])) { ?>
                <span class="message-error"><?= $errorsValidate['detail_time']; ?></span>
                <?php
                } ?>
              </div>
            </div>
          </div>

          <footer class="footer-detail">
            <div class="footer text-center">
              <a href="../index.php" class="btn btn-footer-edit btn-back btn-secondary">
                Hủy bỏ
              </a>
              <button type="submit" class="btn btn-footer-edit btn-send btn-primary">
                Gửi
              </button>
            </div>
          </footer>
        </form>
      </div>
    </div>

  </main>
  <script src="../../../assets/js/pages/create-form.js"></script>
</body>

</body>

</html>
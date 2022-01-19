<?php
require_once("../../../controllers/Form/FormController.php");
$formController = new FormController();

if (isset($_GET['id'])) {
  $formId = $_GET['id'];
  $dataDetail = $formController->show($formId);
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
          <a href="../list-admin.php" class="nav-link link-dark" id="listAdmin">
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
          <a href="form/list-form.php" class="nav-link link-dark active" aria-current="page" id="listForm">
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
          <li><a class="dropdown-item" href="create.php">Gửi form</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
      </div>
    </div>
    <div class="b-example-divider"></div>
    <div class="w-100">
      <div class="main-content">
        <h1 class="title-detail pb-3 mb-4">Thông tin chi tiết form gửi</h1>
        <div class="content-detail">
          <div class="row field-info pt-3 pb-3">
            <label for="name" class="name col-3">Tên người gửi</label>
            <div class="col-9"><?= $dataDetail['user_name'] ?></div>
          </div>
          <div class="row field-info pt-3 pb-3">
            <label for="name" class="name col-3">Chức vụ</label>
            <div class="col-9"><?= $dataDetail['name_position'] ?></div>
          </div>
          <div class="row field-info pt-3 pb-3">
            <label for="name" class="name col-3">Yêu cầu</label>
            <div class="col-9"><?= $dataDetail['name_form_type'] ?></div>
          </div>
          <div class="row field-info pt-3 pb-3">
            <label for="name" class="name col-3">Lý do</label>
            <div class="col-9"><?= $dataDetail['reason'] ?></div>
          </div>
          <div class="row field-info pt-3 pb-3">
            <label for="name" class="name col-3">Trạng thái</label>
            <div class="col-9"><?= $dataDetail['name_status'] ?></div>
          </div>
          <div class="row field-info pt-3 pb-3">
            <label for="name" class="name col-3">Thời gian bắt đầu</label>
            <div class="col-9"><?= $dataDetail['start_date'] ?></div>
          </div>
          <div class="row field-info pt-3 pb-3">
            <label for="name" class="name col-3">Thời gian kết thúc</label>
            <div class="col-9"><?= $dataDetail['end_date'] ?></div>
          </div>
          <div class="row field-info pt-3 pb-3">
            <label for="name" class="name col-3">Thông tin bổ xung</label>
            <div class="col-9"><?= $dataDetail['detail_time'] ?></div>
          </div>
          <div class="row field-info pt-3 pb-3">
            <label for="name" class="name col-3">Thời gian gửi</label>
            <div class="col-9"><?= $dataDetail['created_at'] ?></div>
          </div>
        </div>

        <footer class="footer-detail">
          <div class="footer text-center">
            <a href="list-form.php" class="btn btn-back btn-secondary">
              Quay lại
            </a>
          </div>
        </footer>
      </div>
    </div>

  </main>

</body>

</body>

</html>
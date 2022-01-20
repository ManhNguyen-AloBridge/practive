<?php
require_once('../../../controllers/Form/FormController.php');
session_start();
$formController = new FormController();
$listData = $formController->getListForm();

$success = false;
if (isset($_SESSION['success_create_form'])) {
  $success = true;
  $messageSuccess = $_SESSION['success_create_form'];
  unset($_SESSION['success_create_form']);
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

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
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
        <h1 class="">Danh sách from gửi</h1>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>STT</th>
              <th>Loại form</th>
              <th>Người gửi</th>
              <th>Phone</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
              foreach ($listData as $key => $value) {
              ?>
            <tr>
              <td><?= ++$key ?></td>
              <td><?= $value['name_form_type'] ?></td>
              <td><?= $value['name_position'] ?></td>
              <td><?= $value['phone'] ?></td>
              <td>
                <?= $value['name_status'] ?>
              </td>
              <td class="table-list-action form-list">
                <ul class="p-0 m-0">
                  <li>
                    <a href="detail.php?id=<?= $value['id'] ?>" class="btn table-btn btn-primary">Chi tiết</a>
                    <button data-toggle="modal" data-target="#exampleModal" href=""
                      class="btn table-btn btn-danger">Xóa</button>
                  </li>
                </ul>
              </td>
            </tr>
            <?php
              }
          ?>
          </tbody>
          <div id='container'>
            <?php if ($success) {
            ?>
            <div id='hideMe' class="alert alert-success m-0" role="alert">
              <?= $messageSuccess ?>
            </div>
            <?php
            } ?>
          </div>
        </table>
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>

  </main>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa nhân viên này?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
          <button type="button" class="btn btn-primary">Xóa</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
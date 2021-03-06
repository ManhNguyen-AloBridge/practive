<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
  <link rel="stylesheet" href="../../assets/css/layout/index.css">


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
          <a href="index.php" class="nav-link link-dark active" aria-current="page" id="dashboard">
            <svg class="bi me-2" width="16" height="16"></svg>
            Dashboard
          </a>
        </li>
        <li>
          <a href="../../views/pages/admin/list-admin.php" class="nav-link link-dark" id="listAdmin">
            <svg class="bi me-2" width="16" height="16"></svg>
            Danh sách admin
          </a>
        </li>
        <li>
          <a href="../../views/pages/staff/list-staff.php" class="nav-link link-dark" id="listStaff">
            <svg class="bi me-2" width="16" height="16"></svg>
            Danh sách nhân viên
          </a>
        </li>
        <li>
          <a href="../../views/pages/form/list-form.php" class="nav-link link-dark" id="listForm">
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
          <li><a class="dropdown-item" href="profile.php">Profile</a></li>
          <li><a class="dropdown-item" href="form/create.php">Gửi form</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="../../controllers/LogoutController.php">Sign out</a></li>
        </ul>
      </div>
    </div>
    <div class="b-example-divider"></div>
    <div class="w-100">
      <div class="main-content-dashboard">
        <div class="on-day statistic-day statistic">
          <h1>Thống kê trong ngày</h1>
          <div class="row pt-3 pb-3">
            <label class="col-3 fie">Tổng số form đi muộn/ về sớm</label>
            <label class="col-9 fie">1</label>
          </div>
          <div class="row pt-3 pb-3">
            <label class="col-3 fie">Tổng số form xin remote</label>
            <label class="col-9 fie">1</label>
          </div>
          <div class="row pt-3 pb-3">
            <label class="col-3 fie">Tổng số form xin nghỉ</label>
            <label class="col-9 fie">1</label>
          </div>
        </div>
        <div class="on-week statistic-week statistic">
          <h1>Thống kê trong tuần</h1>
          <div class="row pt-3 pb-3">
            <label class="col-3 fie">Tổng số form đi muộn/ về sớm</label>
            <label class="col-9 fie">1</label>
          </div>
          <div class="row pt-3 pb-3">
            <label class="col-3 fie">Tổng số form xin remote</label>
            <label class="col-9 fie">1</label>
          </div>
          <div class="row pt-3 pb-3">
            <label class="col-3 fie">Tổng số form xin nghỉ</label>
            <label class="col-9 fie">1</label>
          </div>
        </div>
        <div class="on-month statistic-month statistic">
          <h1>Thống kê trong tháng</h1>
          <div class="row pt-3 pb-3">
            <label class="col-3 fie">Tổng số form đi muộn/ về sớm</label>
            <label class="col-9 fie">1</label>
          </div>
          <div class="row pt-3 pb-3">
            <label class="col-3 fie">Tổng số form xin remote</label>
            <label class="col-9 fie">1</label>
          </div>
          <div class="row pt-3 pb-3">
            <label class="col-3 fie">Tổng số form xin nghỉ</label>
            <label class="col-9 fie">1</label>
          </div>
        </div>
      </div>

    </div>

  </main>

</body>

</body>

</html>
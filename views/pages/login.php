<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/css/pages/login.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Login</title>
</head>

<body>

  <div class="container login-page">
    <div class="login-content">
      <form action="../../app/controllers/Auth/HandleLogin.php" class="form-login" method="post">
        <h4 class="text-center pb-4">Login</h4>
        <?php if (isset($_SESSION['error_login'])) {
        ?>
        <div class="alert alert-danger" role="alert">
          <?php
            echo $_SESSION['error_login'];

            ?>
        </div>
        <?php
        }
        ?>
        <div class="row pb-3">
          <label class="col-3 co-form-label">Email</label>
          <div class="col-9">
            <input type="text" name="email" class="w-100">
          </div>
        </div>
        <div class="row pb-3">
          <label class="col-3 co-form-label">Password</label>
          <div class="col-9">
            <input type="password" name="password" class="w-100">
          </div>
        </div>
        <div class="text-center pt-3">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>


</body>

</html>
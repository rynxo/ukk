<?php
include_once 'config.php';

if (isset($_POST['masuk'])) {
  // menambah keamanan login
  $user = $con->real_escape_string($_POST['user']);
  $pass = $con->real_escape_string($_POST['pass']);

  $result = $con->query("SELECT * FROM user WHERE username = '$user'");

  // cek username
  if ($result->num_rows === 1) {
    $data = $result->fetch_assoc();

    // cek password
    if (password_verify($pass, $data['password'])) {

      $_SESSION['login_cafe'] = true;

      header("location:core/dashboard.php");
    } else {
      $_SESSION['alert'] = 'Password anda salah!';
    }
  } else {
    $_SESSION['alert'] = 'Username anda salah!';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CAFE BISA NGOPI</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= BASE ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= BASE ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASE ?>dist/css/adminlte.min.css">
  <style>
    body {
      background-image: url("img/bg.jpg");
      background-position: center;
      background-size: cover;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body text-center login-card-body">
        <img src="img/LOGORT.png" class="mb-3" alt="RESTO KITA" width="200">
        <h3><b>X</b></h3>
        <h1>
          <b>
            CAFEBISANGOPI
          </b>
        </h1>

        <form action="" method="post">
          <?php if (isset($_SESSION['alert'])) { ?>
            <div class="alert alert-danger">
              <?php echo $_SESSION['alert'];
              unset($_SESSION['alert']);
              ?>
            </div>

          <?php } ?>
          <div class="input-group mb-3 mt-4">
            <input type="text" class="form-control" name="user" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="pass" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="d-flex">
            <!-- /.col -->
            <div class="ml-auto mb-3">
              <button name="masuk" type="submit" class=" btn btn-dark btn-block">MASUK</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="row justify-content-start">
          <div class="col-6">
            <p class="mb-1">
              <a href="forgot-password.html" class="text-warning">Lupa Password</a>
            </p>
          </div>
          <div class="col-6">
            <p class="mb-0">
              <a href="reg/registrasi.php" class=" text-warning">Regitrasi Klik Disini!</a>
            </p>
          </div>
        </div>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= BASE ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= BASE ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= BASE ?>dist/js/adminlte.min.js"></script>
</body>

</html>
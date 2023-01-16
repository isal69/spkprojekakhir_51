<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SPK SAW Isal</title>
  <link rel="stylesheet" href="<?php echo base_url('/assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('/assets/css/all.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('/assets/css/style.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('/assets/css/components.css') ?>">
</head>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <!--<div class="login-brand">
              <img src="<?php echo base_url('/assets/img/stisla-fill.svg') ?>" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>-->
            <div class="card card-primary">
              <div class="card-header"><h4>Silahkan Log In Untuk Mengelola Data</h4></div>
              <div class="card-body">
                <form method="post" action="<?php echo base_url('getlogin') ?>" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username Akses Log In" required autofocus>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password Akses Log In" required>
                  </div>
                  <h6 style="text-align: center;">
                    <?php
                    if(session()->getFlashData('gagal')){
                      echo session()->getFlashData('gagal');
                    }
                    ?>
                  </h3>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Log In
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; SPK SAW 2022
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src="<?php echo base_url('/assets/js/jquery-3.3.1.min.js') ?>"></script>
  <script src="<?php echo base_url('/assets/js/popper.min.js') ?>"></script>
  <script src="<?php echo base_url('/assets/js/bootstrap.min.js') ?>"></script>
  <script src="<?php echo base_url('/assets/js/jquery.nicescroll.min.js') ?>"></script>
  <script src="<?php echo base_url('/assets/js/moment.min.js') ?>"></script>
  <script src="<?php echo base_url('/assets/js/stisla.js') ?>"></script>
  <script src="<?php echo base_url('/assets/js/scripts.js') ?>"></script>
  <script src="<?php echo base_url('/assets/js/custom.js') ?>"></script>
</body>
</html>
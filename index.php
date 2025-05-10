<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/FET_logo.png">
  <link rel="icon" type="image/png" href="assets/img/FET_logo.png">
  <title>Repair FET RMUTI</title>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  <style>
    .bg-gradient-primary {
      background: linear-gradient(310deg, #800000, #660000) !important;
    }
    .btn.bg-gradient-primary {
      background: linear-gradient(310deg, #800000, #660000) !important;
    }
    .text-primary {
      color: #800000 !important;
    }
    .input-group-outline {
      position: relative;
      margin-bottom: 1rem;
    }
    .input-group-outline input {
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
      padding: 0.75rem 1.25rem;
      width: 100%;
      box-sizing: border-box;
    }
    .input-group-outline label {
      position: absolute;
      top: 0.75rem;
      left: 1.25rem;
      font-size: 1rem;
      color: #495057;
      background: #fff;
      padding: 0 0.25rem;
      transition: 0.2s ease;
      pointer-events: none;
    }
    .input-group-outline input:focus + label,
    .input-group-outline input:not(:placeholder-shown) + label {
      top: -0.5rem;
      left: 1.25rem;
      font-size: 0.75rem;
      color: #800000;
      background: #fff;
    }
  </style>
</head>

<body class="bg-gray-200">
  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('images/Background_R.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">
                    <img src="images/FET_logo.png" width="250">
                  </h4>
                </div>
              </div>
              <div class="card-body">
                <?php
                if (isset($_GET['check']) && $_GET['check'] == "false") {
                  echo '<div class="alert alert-primary alert-dismissible text-white" role="alert">
                          <span class="text-sm">Username หรือ Password ไม่ถูกต้อง</span>
                          <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>';
                }
                ?>
                <form role="form" class="text-start" action="check.php" method="post">
                  <div class="input-group-outline">
                    <input type="text" id="username" name="username" placeholder=" ">
                    <label for="username">Username</label>
                  </div>
                  <div class="input-group-outline">
                    <input type="password" id="password" name="password" placeholder=" ">
                    <label for="password">Password</label>
                  </div>
                  <div class="text-center">
                    <input type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2" value="เข้าสู่ระบบ" />
                  </div>
                </form>

                <div class="text-center">
                  <form action="register.php" method="post">
                    <input type="hidden" name="per_type" value="0">
                    <input type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2" value="สมัครสมาชิก" />
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 col-md-6 my-auto">
              <div class="copyright text-center text-sm text-white text-lg-start"></div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>

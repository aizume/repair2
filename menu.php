<?php
$menu=basename($_SERVER['PHP_SELF']);;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/FET_logo.png">
  <link rel="icon" type="image/png" href="assets/img/FET_logo.png">
  <title>
    Repair FET RMUTI
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css" rel="stylesheet" />
  <!-- <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" /> -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@300&display=swap" rel="stylesheet">
  
  <style>
    /* Override primary color to be maroon (#800000) */
    .bg-gradient-primary {
      background: linear-gradient(310deg, #800000, #660000) !important;
    }
    .btn.bg-gradient-primary {
      background: linear-gradient(310deg, #800000, #660000) !important;
    }
    .text-primary {
      color: #800000 !important;
    }
    /* ตรวจสอบตารางที่กว้างเกินไป */
    .table-responsive {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
    }

</style>


</head>

<body class="g-sidenav-show  bg-gray-200">
  
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0"  target="_blank">
        <img src="assets/img/FET_logo.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Repair FET RMUTI</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <?php if ($_SESSION["per_type"] == 1) { ?>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($menu=='main.php'?'active bg-gradient-primary':'') ?>" href="main.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">หน้าแรก</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($menu=='personnelList.php' || $menu=='personneEdit.php' || $menu=='personneCreate.php' ?'active bg-gradient-primary':'') ?>" href="personnelList.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">groups_2</i>
            </div>
            <span class="nav-link-text ms-1">บุคลากร</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($menu=='approvalList.php' || $menu=='approvalCreate.php' ?'active bg-gradient-primary':'') ?>" href="approvalList.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">check_circle</i>
            </div>
            <span class="nav-link-text ms-1">การอนุมัติ</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($menu=='repirList.php'  || $menu=='repairEdit.php' || $menu=='repairCreate.php' || $menu=='reportCreate.php'?'active bg-gradient-primary':'')?>" href="repirList.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">build</i>
            </div>
            <span class="nav-link-text ms-1">การซ่อม</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($menu=='repirListUser.php'  || $menu=='repairEdit.php' || $menu=='repairCreate.php' || $menu=='reportCreate.php'?'active bg-gradient-primary':'')?>" href="repirListUser.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">visibility</i>
            </div>
            <span class="nav-link-text ms-1">การแจ้งซ่อม</span>
          </a>
        </li>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($menu=='workSchedule.php'   || $menu=='addSchedule.php'?'active bg-gradient-primary':'')?>" href="workSchedule.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">event</i>
            </div>
            <span class="nav-link-text ms-1">ตารางงาน</span>
          </a>
        </li>


        <?php } ?>


          <?php 
          if ($_SESSION["per_type"] == 2) {
            ?>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($menu=='main.php'?'active bg-gradient-primary':'') ?>" href="main.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">หน้าแรก</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($menu=='repirList.php'  || $menu=='repairEdit.php' || $menu=='repairCreate.php' || $menu=='reportCreate.php'?'active bg-gradient-primary':'')?>" href="repirList.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">build</i>
            </div>
            <span class="nav-link-text ms-1">การซ่อม</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($menu=='workSchedule.php'   || $menu=='addSchedule.php'?'active bg-gradient-primary':'')?>" href="workSchedule.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">event</i>
            </div>
            <span class="nav-link-text ms-1">ตารางงาน</span>
          </a>
        </li>

        <?php } ?>

        <?php 
          if ($_SESSION["per_type"] == 3) {
            ?>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($menu=='repirListUser.php'  || $menu=='repairEdit.php' || $menu=='repairCreate.php' || $menu=='reportCreate.php'?'active bg-gradient-primary':'')?>" href="repirListUser.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">build</i>
            </div>
            <span class="nav-link-text ms-1">การแจ้งซ่อม</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($menu=='workSchedule.php'   || $menu=='addSchedule.php'?'active bg-gradient-primary':'')?>" href="workSchedule.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">event</i>
            </div>
            <span class="nav-link-text ms-1">ตารางงาน</span>
          </a>
        </li>
        
        <?php } ?>

        <?php if ($_SESSION["per_type"] == 4) { ?>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($menu=='main.php'?'active bg-gradient-primary':'') ?>" href="main.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">หน้าแรก</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($menu=='approvalList.php' || $menu=='approvalCreate.php' ?'active bg-gradient-primary':'') ?>" href="approvalList.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">check_circle</i>
            </div>
            <span class="nav-link-text ms-1">การอนุมัติ</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($menu=='repirListManeger.php'  || $menu=='approvalEdit.php'?'active bg-gradient-primary':'')?>" href="repirListManeger.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">edit</i>
            </div>
            <span class="nav-link-text ms-1">แก้ไขการอนุมัติ</span>
          </a>
        </li>


        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php echo ($menu=='workSchedule.php'   || $menu=='addSchedule.php'?'active bg-gradient-primary':'')?>" href="workSchedule.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">event</i>
            </div>
            <span class="nav-link-text ms-1">ตารางงาน</span>
          </a>
        </li>


        <?php } ?>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white  <?php echo ($menu=='profileShow.php'?'active bg-gradient-primary':'')?>" href="profileShow.php?per_id=<?php echo $_SESSION['login']['per_id']; ?>">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">โปรไฟล์</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="logout.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">logout</i>
            </div>
            <span class="nav-link-text ms-1">ออกจากระบบ</span>
          </a>
        </li>
               
      </ul>
    </div>
    
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
      var sidenavToggler = document.getElementById('iconNavbarSidenav');
      var sidenav = document.getElementById('sidenav-main');
      var body = document.body;

      sidenavToggler.addEventListener('click', function () {
        if (sidenav.classList.contains('g-sidenav-pinned')) {
          sidenav.classList.remove('g-sidenav-pinned');
          body.classList.remove('g-sidenav-pinned');
        } else {
          sidenav.classList.add('g-sidenav-pinned');
          body.classList.add('g-sidenav-pinned');
        }
      });
    });
  </script>
</body>
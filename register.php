<?php
$menu = basename($_SERVER['PHP_SELF']);
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
  </style>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

// กำหนดค่าเริ่มต้นของตัวแปรที่จำเป็น
$username = '';
$password = '';
$per_name = '';
$per_lastname = '';
$position_id = '';  
$deptid  = '';
$factid = '';
$per_email = '';
$member_title_id  = '';
$per_id_card = '';
$line_id = '';
$per_tel = '';
$signature_image = '';
$per_type = 0;

?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>บุคลากร</h4>
        </div>
        <div class="row clearfix">
            <!-- Task Info --> 
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        สมัครสมาชิก
                    </div>

                    <div class="card-body"> 
                        <div class="row">
                            <form name="personalAdd" class="col-12" action="personnelInsert.php" method="POST" enctype="multipart/form-data">
                                <?php include_once("registerForm.php"); ?>
                                <div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-10 text-center">
                                        <a href="index.php" class="btn btn-primary">กลับ</a>
                                        <button type="reset" class="btn btn-warning"> ล้างข้อมูล</button>
                                        <button type="submit" class="btn btn-success"> บันทึก</button>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
        </div>
    </div>
</section>
</body>
</html>

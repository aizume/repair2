<?php if (session_status() == PHP_SESSION_NONE) {
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

include("menu.php");
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
                        เพิ่มข้อมูลบุคลากร
                    </div>

                    <div class="card-body"> 
                        <div class="row">
                            <form name="personalAdd" class="col-12" action="personnelInsert.php" method="POST" enctype="multipart/form-data">
                                <?php include_once("personnelForm.php"); ?>
                                <div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-10 text-center">
                                        <button type="submit" class="btn btn-success"> บันทึก</button>
                                        <button type="reset" class="btn btn-warning"> ล้างข้อมูล</button>
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

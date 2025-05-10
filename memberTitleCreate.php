<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

// กำหนดค่าเริ่มต้นของตัวแปรที่จำเป็น
$member_title_name = '';

include("menu.php");
?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>คำนำหน้าชื่อ</h4>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        เพิ่มข้อมูลคำนำหน้าชื่อ
                    </div>
                    <div class="card-body">
                        <form name="memberTitleAdd" action="memberTitleInsert.php" method="POST">
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right">ชื่อคำนำหน้าชื่อ</label>
                                <div class="col-md-6">
                                    <input type="text" name="member_title_name" id="member_title_name" class="form-control">
                                </div>
                            </div>

                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right">ชื่อคำนำหน้าชื่อ ภาษาอังกฤษ</label>
                                <div class="col-md-6">
                                    <input type="text" name="member_title_en" id="member_title_en" class="form-control">
                                </div>
                            </div>
                            <br>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">บันทึก</button>
                                <button type="reset" class="btn btn-warning">ล้างข้อมูล</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>

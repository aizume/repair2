<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

// กำหนดค่าเริ่มต้นของตัวแปรที่จำเป็น
$factid = '';
$factname = '';

include("menu.php");
?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>คณะ</h4>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        เพิ่มข้อมูลคณะ
                    </div>
                    <div class="card-body">
                        <form name="facultyAdd" action="facultyInsert.php" method="POST">
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right">รหัสคณะ (factid) <br> ตั้ง 3 อักษรเช่น f01</label>
                                <div class="col-md-6">
                                    <input type="text" name="factid" id="factid" class="form-control" required placeholder="เช่น f01">
                                </div>
                            </div>
                            <br>

                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right">ชื่อคณะ</label>
                                <div class="col-md-6">
                                    <input type="text" name="factname" id="factname" class="form-control" required>
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

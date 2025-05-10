<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

// กำหนดค่าเริ่มต้นของตัวแปรที่จำเป็น
$position_name = '';

include("menu.php");
?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>ตำแหน่ง</h4>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        เพิ่มข้อมูลตำแหน่ง
                    </div>
                    <div class="card-body">
                        <form name="positionAdd" action="positionInsert.php" method="POST">
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right">ชื่อตำแหน่ง</label>
                                <div class="col-md-6">
                                    <input type="text" name="position_name" id="position_name" class="form-control">
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

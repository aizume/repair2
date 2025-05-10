<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");
?>

<script>
    function confirmedit(){
        return confirm("ยืนยันแก้ไขข้อมูล");
    }
    function confirmdelete(){
        return confirm("ต้องการลบข้อมูลนี้ใช่หรือไม่");
    }
</script>

<?php 
include("menu.php");
?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>ตารางงาน</h4>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        เพิ่มรายละเอียดกำหนดการทำงาน
                    </div>

                    <div class="card-body"> 
                        <div class="row">
                            <form name="personalAdd" class="col-12" action="ScheduleInsert.php" method="POST" enctype="multipart/form-data">
                                <?php 
                                $sch_date = null;
                                $details = null;
                                include_once("ScheduleForm.php"); 
                                ?>
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
        </div>
    </div>
</section>
<?php

?>
</body>
</html>

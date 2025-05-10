<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");
?>

<script>
    function confirmEdit() {
        return confirm("ยืนยันการบันทึกข้อมูล");
    }
</script>

<?php include("menu.php"); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>เพิ่มข้อมูลการแจ้งซ่อม</h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        แบบฟอร์มการขอใช้บริการ ซ่อมแซมอาคารสถานที่ และครุภัณฑ์
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form name="projectAdd" class="col-12" action="reportInsert.php" method="POST" enctype="multipart/form-data">
                                <?php include_once("reportForm.php"); ?>
                                <div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-10 text-center">
                                        <button type="submit" class="btn btn-success" onclick="return confirmEdit();"> บันทึก</button>
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

</body>
</html>

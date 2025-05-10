<?php 
if (session_status() == PHP_SESSION_NONE) {
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

// ดึงข้อมูลกำหนดการจากฐานข้อมูลเพื่อนำมาแสดง
$sch_id = $_GET['sch_id']; // ดึง sch_id จาก URL
$sql = "SELECT * FROM tbl_schedule WHERE sch_id = '$sch_id'";
$result = mysqli_query($conn, $sql);
$schedule = mysqli_fetch_assoc($result);
?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>แก้ไขรายละเอียดกำหนดการทำงาน</h4>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        แก้ไขรายละเอียดกำหนดการทำงาน
                    </div>

                    <div class="card-body"> 
                        <div class="row">
                            <form name="personalEdit" class="col-12" action="ScheduleUpdate.php" method="POST" enctype="multipart/form-data" onsubmit="return confirmedit()">
                                <?php 
                                // ส่งค่า sch_id ไปด้วยสำหรับการอัปเดต
                                echo "<input type='hidden' name='sch_id' value='".$schedule['sch_id']."'>";
                                $sch_date = $schedule['sch_date'];
                                $details = $schedule['details'];
                                include_once("ScheduleFormUpd.php"); 
                                ?>
                                <div class="row">
                                    <div class="col-md-10 text-center">
                                        <button type="submit" class="btn btn-success">บันทึกการแก้ไข</button>
                                        <a href="ScheduleDelete.php?sch_id=<?php echo $schedule['sch_id']; ?>" class="btn btn-danger" onclick="return confirmdelete()">ลบข้อมูล</a>
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

<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

// ฟังก์ชันสำหรับดึงรายละเอียดการซ่อม
function getRepairDetails($rep_ID) {
    global $conn;
    $sql = "SELECT solution FROM tbl_repair WHERE rep_ID = '$rep_ID'";
    $result = mysqli_query($conn, $sql);
    $repair = mysqli_fetch_assoc($result);
    return $repair['solution'] ?? "ไม่มีรายละเอียดการซ่อม";
}

$sch_id = $_GET['id'];

$sql = "SELECT s.sch_date, s.sch_time, s.details, s.sch_topic, p.per_name, p.per_lastname, r.u_date, r.problem, r.rep_ID 
        FROM tbl_schedule s 
        LEFT JOIN tbl_personnel p ON s.per_id = p.per_id 
        LEFT JOIN tbl_repair r ON s.rep_ID = r.rep_ID
        WHERE s.sch_id = '$sch_id'";
$result = mysqli_query($conn, $sql);
$report = mysqli_fetch_assoc($result);
?>

<?php include("menu.php"); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>รายละเอียดกำหนดการทำงาน</h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        รายละเอียดกำหนดการ
                    </div>
                    <br><br>

                    <form action="updateSchedule.php" method="post">
                        <input type="hidden" name="sch_id" value="<?php echo $sch_id; ?>">
                        <input type="hidden" id="rep_id" value="<?php echo $report['rep_ID']; ?>">
                        
                        <div class="row input-group input-group-outline">
                            <label class="col-form-label col-md-3 text-right" for="repair_details">รายละเอียดการแจ้งซ่อม:</label>
                            <div class="col-md-6">
                                <div id="repair_details" class="form-control" readonly></div>
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                updateRepairDetails(); // เรียกฟังก์ชันเมื่อโหลดหน้าจอ
                            });

                            function updateRepairDetails() {
                                var rep_id = document.getElementById("rep_id").value;
                                if (rep_id) {
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function() {
                                        if (this.readyState == 4 && this.status == 200) {
                                            document.getElementById("repair_details").innerHTML = this.responseText;
                                        }
                                    };
                                    xhttp.open("GET", "getRepairDetails.php?rep_id=" + rep_id, true);
                                    xhttp.send();
                                } else {
                                    document.getElementById("repair_details").innerHTML = "";
                                }
                            }
                        </script>
                        <br>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <!-- Display schedule data -->
                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">หัวข้อ</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="sch_topic" value="<?php echo $report['sch_topic']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">วันที่ดำเนินการ</label>
                                        <div class="col-md-6">
                                            <input type="date" class="form-control" name="sch_date" value="<?php echo $report['sch_date']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">เวลาที่ดำเนินการ</label>
                                        <div class="col-md-6">
                                            <input type="time" class="form-control" name="sch_time" value="<?php echo $report['sch_time']; ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">รายละเอียดเบื้องต้น</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" rows="5" name="details" style="resize: none;" disabled><?php echo $report['details']; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">ผู้ปฏิบัติงานซ่อมบำรุง</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" value="<?php echo $report['per_name'] . ' ' . $report['per_lastname']; ?>" disabled>
                                        </div>
                                    </div>

                                    <br><br>
                                    <div class="col-md-10 text-center">
                                        <a href="workSchedule.php" class="btn btn-primary">กลับ</a>
                                        <?php if ($_SESSION['per_type'] == 1 || $_SESSION['per_type'] == 2): ?>
                                            <a href="editSchedule.php?sch_id=<?php echo $sch_id; ?>" class="btn btn-warning">แก้ไข</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>

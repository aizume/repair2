<?php
include("connect.php");

$sch_id = isset($_POST['sch_id']) ? $_POST['sch_id'] : null;
if ($sch_id) {
    $deleteSql = "DELETE FROM tbl_schedule WHERE sch_id = '".$sch_id."'";
    $execute = mysqli_query($conn, $deleteSql);
    header("Location: workSchedule.php");
} else {
    echo '<script>
    alert("ไม่พบข้อมูล กรุณาตรวจสอบ!!!");
    window.location.href = "workSchedule.php";
    </script>';
}
?>

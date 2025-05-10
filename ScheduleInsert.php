<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

// รับค่าจากแบบฟอร์ม
$sch_date = $_POST['sch_date'];
$sch_time = $_POST['sch_time'];
$details = $_POST['details'];
$sch_topic = $_POST['sch_topic'];
$per_id = $_POST['per_id'];
$rep_id = $_POST['rep_id']; // รับค่า rep_id จากแบบฟอร์ม
$sch_datetime = $sch_date . ' ' . $sch_time;

// เริ่มทำการบันทึกข้อมูล
// 1. ดึงรายละเอียดการซ่อมจาก rep_id ที่เลือก
$sql = "SELECT * FROM tbl_repair WHERE rep_ID = '$rep_id'";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // ไม่มีการใช้ equipment_id อีกต่อไปเนื่องจากลบ tbl_equipment

    // 2. บันทึกข้อมูลใน tbl_schedule
    $sql = "INSERT INTO tbl_schedule (sch_date, sch_time, details, sch_topic, per_id, rep_ID) 
            VALUES ('$sch_date', '$sch_time', '$details', '$sch_topic', '$per_id', '$rep_id')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location.href='workSchedule.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('ไม่พบข้อมูลการซ่อมที่เกี่ยวข้อง'); window.history.back();</script>";
}
?>

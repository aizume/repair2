<?php
// ตรวจสอบการล็อกอิน (หรือกรณีที่ผู้ใช้ไม่ล็อกอิน)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['per_type'])) {
    echo '<script>alert("กรุณาล็อกอินก่อน"); window.location.href="index.php";</script>';
    exit();
}
include("connect.php");

$deptid = $_GET['deptid'] ?? '';

if ($deptid) {
    // รับค่าจากฟอร์ม
    $deptname = $_POST['deptname'];
    // เพิ่มฟิลด์อื่นๆ ถ้ามี

    // อัปเดตข้อมูลในฐานข้อมูล
    $sqlUpdate = "UPDATE tbl_department SET 
        deptname='$deptname'
        WHERE deptid='$deptid'";

    if (mysqli_query($conn, $sqlUpdate)) {
        // ถ้าอัปเดตสำเร็จ ให้เปลี่ยนเส้นทางไปที่หน้า departmentList
        echo '<script>alert("อัปเดตข้อมูลสำเร็จ"); window.location.href = "ManageData.php";</script>';
    } else {
        echo '<script>alert("ไม่สามารถอัปเดตข้อมูลได้"); window.history.back();</script>';
    }
} else {
    echo '<script>alert("ไม่พบข้อมูล ID"); window.history.back();</script>';
}
?>

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

$original_factid = $_GET['factid'] ?? '';

if ($original_factid) {
    // รับค่าจากฟอร์ม
    $new_factid = $_POST['factid']; // รับ factid ใหม่
    $factname = $_POST['factname'];

    // ตรวจสอบว่ามี factid ซ้ำหรือไม่
    $checkIdSql = "SELECT * FROM tbl_faculty WHERE factid='$new_factid' AND factid != '$original_factid'";
    $checkIdResult = mysqli_query($conn, $checkIdSql);

    if (mysqli_num_rows($checkIdResult) > 0) {
        echo '<script>alert("factid นี้ถูกใช้ไปแล้ว กรุณาเลือก factid อื่น"); window.history.back();</script>';
        exit();
    }

    // อัปเดตข้อมูลในฐานข้อมูล
    $sqlUpdate = "UPDATE tbl_faculty SET 
        factid='$new_factid', 
        factname='$factname' 
        WHERE factid='$original_factid'";

    if (mysqli_query($conn, $sqlUpdate)) {
        echo '<script>alert("อัปเดตข้อมูลสำเร็จ"); window.location.href = "ManageData.php";</script>';
    } else {
        echo '<script>alert("ไม่สามารถอัปเดตข้อมูลได้"); window.history.back();</script>';
    }
} else {
    echo '<script>alert("ไม่พบข้อมูล ID"); window.history.back();</script>';
}
?>

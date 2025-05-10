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

$position_id = $_GET['position_id'] ?? ''; 

if ($position_id) {
    // รับค่าจากฟอร์ม
    $position_name = $_POST['position_name'];

    // อัปเดตข้อมูลในฐานข้อมูล
    $sqlUpdate = "UPDATE tbl_position SET 
        position_name='$position_name' 
        WHERE position_id='$position_id'"; 

    if (mysqli_query($conn, $sqlUpdate)) {
        // ถ้าอัปเดตสำเร็จ ให้เปลี่ยนเส้นทางไปที่หน้า ManageData
        echo '<script>alert("อัปเดตข้อมูลสำเร็จ"); window.location.href = "ManageData.php";</script>';
    } else {
        echo '<script>alert("ไม่สามารถอัปเดตข้อมูลได้"); window.history.back();</script>';
    }
} else {
    echo '<script>alert("ไม่พบข้อมูล ID"); window.history.back();</script>';
}
?>

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

$member_title_id = $_GET['member_title_id'] ?? ''; // ใช้ member_title_id

if ($member_title_id) {
    // รับค่าจากฟอร์ม
    $member_title_name = $_POST['member_title_name'];
    $member_title_en = $_POST['member_title_en']; // รับค่าจากฟอร์ม

    // อัปเดตข้อมูลในฐานข้อมูล
    $sqlUpdate = "UPDATE tbl_member_title SET 
        member_title_name='$member_title_name',
        member_title_en='$member_title_en' 
        WHERE member_title_id='$member_title_id'"; // ใช้ member_title_id

    if (mysqli_query($conn, $sqlUpdate)) {
        echo '<script>alert("อัปเดตข้อมูลสำเร็จ"); window.location.href = "ManageData.php";</script>';
    } else {
        echo '<script>alert("ไม่สามารถอัปเดตข้อมูลได้"); window.history.back();</script>';
    }
} else {
    echo '<script>alert("ไม่พบข้อมูล ID"); window.history.back();</script>';
}
?>

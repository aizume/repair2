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

$factid = $_GET['factid'] ?? '';

if ($factid) {
    // สร้างคำสั่ง SQL สำหรับการลบข้อมูล
    $sqlDelete = "DELETE FROM tbl_faculty WHERE factid='$factid'";

    if (mysqli_query($conn, $sqlDelete)) {
        echo '<script>alert("ลบข้อมูลคณะสำเร็จ"); window.location.href = "ManageData.php";</script>';
    } else {
        echo '<script>alert("ไม่สามารถลบข้อมูลได้: ' . mysqli_error($conn) . '"); window.history.back();</script>';
    }
} else {
    echo '<script>alert("ไม่พบข้อมูล ID"); window.history.back();</script>';
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>

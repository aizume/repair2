<?php
include("connect.php");

// ดึงค่าของ rep_ID จาก GET parameter
$rep_ID = isset($_GET['rep_ID']) ? $_GET['rep_ID'] : null;

// ดึงประเภทของผู้ใช้จาก session หรือจากที่เก็บข้อมูลอื่น ๆ 
// สมมติว่า per_type อยู่ใน session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$per_type = isset($_SESSION['per_type']) ? $_SESSION['per_type'] : null;

if ($rep_ID) {
    // ลบข้อมูลตาม rep_ID
    $deleteSql = "DELETE FROM tbl_repair WHERE rep_ID='".$rep_ID."'";
    $excute = mysqli_query($conn, $deleteSql);

    // ตรวจสอบ per_type เพื่อเลือกหน้ารีไดเรกต์
    if ($per_type == 1 || $per_type == 2) {
        header("Location: repirList.php");
    } elseif ($per_type == 3) {
        header("Location: repirListUser.php");
    }
} else {
    echo '<script>
    alert("ไม่พบข้อมูล กรุณาตรวจสอบ!!!");
    window.location.href = "repirList.php";
    </script>';
}
?>

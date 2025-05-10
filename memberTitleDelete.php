<?php
include("connect.php");
$member_title_id = isset($_GET['member_title_id']) ? $_GET['member_title_id'] : null; // ใช้ member_title_id

if ($member_title_id) {
    $deleteSql = "DELETE FROM tbl_member_title WHERE member_title_id='".$member_title_id."'"; // ใช้ member_title_id
    $execute = mysqli_query($conn, $deleteSql);
    
    if ($execute) {
        header("Location: ManageData.php");
        exit();
    } else {
        echo '<script>alert("ไม่สามารถลบข้อมูลได้"); window.location.href = "ManageData.php";</script>';
    }
} else {
    echo '<script>alert("ไม่พบข้อมูล กรุณาตรวจสอบ!!!"); window.location.href = "ManageData.php";</script>';
}
?>

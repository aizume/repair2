<?php
include("connect.php");
$position_id = isset($_GET['position_id']) ? $_GET['position_id'] : null; 

if ($position_id) {
    $deleteSql = "DELETE FROM tbl_position WHERE position_id='".$position_id."'";
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

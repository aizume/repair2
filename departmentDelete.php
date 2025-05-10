<?php
include("connect.php");
$deptid = isset($_GET['deptid']) ? $_GET['deptid'] : null;
if ($deptid) {
    $deleteSql = "DELETE FROM tbl_department WHERE deptid='".$deptid."'";
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

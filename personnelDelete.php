<?php
include("connect.php");
$per_id = isset($_GET['per_id']) ? $_GET['per_id'] : null;
if ($per_id) {
    $deleteSql = "DELETE FROM tbl_personnel WHERE per_id='".$per_id."'";
    $excute = mysqli_query($conn, $deleteSql);
    header("Location:personnelList.php");
}else {
    echo '<script>
    a lert("ไม่พบข้อมูล กรุณาตรวจสอบ!!!");
    window. location.href = "personnelList.php";
    </script>' ;
}
?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

$sql = "SELECT * FROM tbl_personnel WHERE username ='" . $_POST['username'] . "' AND password='" . $_POST['password'] . "'";
$result = mysqli_query($conn, $sql);
$numrow = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

if ($numrow == 0) {
    header("Location: index.php?check=false");
} else {
    $_SESSION['login'] = $row;
    $_SESSION['name'] = $row['per_name']; // เปลี่ยนเป็น 'per_name' ตามตาราง
    $_SESSION['per_type'] = $row['per_type'];
    $_SESSION['per_id'] = $row['per_id']; // เพิ่มการเซ็ตค่า per_id

    if ($row['per_type'] == 1) {
        header("Location: main.php?check=success");
    } elseif ($row['per_type'] == 2){
        header("Location: repirList.php?check=success");
    } elseif ($row['per_type'] == 4){
        header("Location: approvalList.php?check=success");
    } else {
        header("Location: repirListUser.php?check=success");
    }
}
?>

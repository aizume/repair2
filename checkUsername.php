<?php
include("connect.php");

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $checkSql = "SELECT * FROM tbl_personnel WHERE username = '".$username."'";
    $checkQuery = mysqli_query($conn, $checkSql);
    $response = array('exists' => mysqli_num_rows($checkQuery) > 0);
    echo json_encode($response);
}
?>

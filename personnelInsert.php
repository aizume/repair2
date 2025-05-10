<?php
include("connect.php");

// ถ้ายังไม่ได้ session_start ให้ session_start
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}


$per_type = $_POST['per_type'];
$username = $_POST['username'];
$password = $_POST['password'];
$per_name = $_POST['per_name'];
$per_lastname = $_POST['per_lastname'];
$position_id = $_POST['position_id'];
$deptid = $_POST['deptid'];
$factid = $_POST['factid'];
$per_email = $_POST['per_email'];
$per_tel = $_POST['per_tel'];
$member_title_id = $_POST['member_title_id'];
$per_id_card = $_POST['per_id_card'];
$line_id = $_POST['line_id'];

// สำหรับการอัปโหลดรูปภาพลายเซ็น
$signature_image = '';
if (!empty($_FILES['signature_image']['name'])) {
    $target_dir = "uploads/signatures/";  // กำหนดโฟลเดอร์ที่เก็บรูปภาพ
    $file_name = basename($_FILES["signature_image"]["name"]);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // ตรวจสอบประเภทไฟล์ (เฉพาะไฟล์ภาพ)
    $allowed_types = array("jpg", "png", "jpeg", "gif");
    if (in_array($imageFileType, $allowed_types)) {
        // ตรวจสอบว่าไฟล์มีชื่อเดียวกันในโฟลเดอร์หรือไม่
        $file_counter = 1;
        while (file_exists($target_file)) {
            // เปลี่ยนชื่อไฟล์โดยเพิ่มตัวเลขที่ด้านหลังของชื่อไฟล์
            $file_name = pathinfo($_FILES["signature_image"]["name"], PATHINFO_FILENAME) . "_" . $file_counter . "." . $imageFileType;
            $target_file = $target_dir . $file_name;
            $file_counter++;
        }
        
        // อัปโหลดไฟล์ไปยังโฟลเดอร์ที่กำหนด
        if (move_uploaded_file($_FILES["signature_image"]["tmp_name"], $target_file)) {
            $signature_image = $target_file;  // เก็บพาธไฟล์ที่อัปโหลดลงในฐานข้อมูล
        } else {
            echo '<script>alert("เกิดข้อผิดพลาดในการอัปโหลดรูปภาพลายเซ็น");</script>';
        }
    } else {
        echo '<script>alert("ประเภทไฟล์รูปภาพไม่ถูกต้อง กรุณาอัปโหลดเฉพาะไฟล์ JPG, PNG, JPEG หรือ GIF เท่านั้น");</script>';
    }
}

// ตรวจสอบว่า username ซ้ำหรือไม่
$checkSql = "SELECT * FROM tbl_personnel WHERE username = '".$username."'";
$checkQuery = mysqli_query($conn, $checkSql);
if(mysqli_num_rows($checkQuery) > 0) {
    echo '<script>
    alert("ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว กรุณาใช้ชื่ออื่น");
    window.history.back();
    </script>';
} else {
    $insertsql = "INSERT INTO tbl_personnel
    (username, password, per_name, per_lastname, position_id, deptid, factid, per_email, per_tel, per_type, member_title_id, per_id_card, line_id, signature_image)
    VALUES
    ('".$username."', '".$password."', '".$per_name."', '".$per_lastname."', '".$position_id."', '".$deptid."', '".$factid."',
    '".$per_email."', '".$per_tel."', '".$per_type."', '".$member_title_id."', '".$per_id_card."', '".$line_id."', '".$signature_image."')";

    $execute = mysqli_query($conn, $insertsql);
    if ($execute) {
        // ตรวจสอบ per_type ของผู้ที่ล็อกอิน
        if ($_SESSION['per_type'] == 1) {
            header("Location: personnelList.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        echo '<script>
        alert("เพิ่มข้อมูลพนักงานไม่สำเร็จ กรุณาตรวจสอบ!!!");
        window.history.back();
        </script>';
    }
}
?>

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

$per_id = $_GET['per_id'] ?? '';

if ($per_id) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $per_name = $_POST['per_name'];
    $per_lastname = $_POST['per_lastname'];
    $position_id = $_POST['position_id'];
    $deptid = $_POST['deptid'];
    $factid = $_POST['factid'];
    $per_email = $_POST['per_email'];
    $member_title_id = $_POST['member_title_id'];
    $per_id_card = $_POST['per_id_card'];
    $line_id = $_POST['line_id'];
    $per_tel = $_POST['per_tel'];
    $signature_image = $_POST['current_signature_image'];
    $per_type = $_POST['per_type'];

    // ตรวจสอบว่ามีการอัปโหลดรูปภาพลายเซ็นใหม่หรือไม่
    if (!empty($_FILES['signature_image']['name'])) {
        $target_dir = "uploads/signatures/";
        $target_file = $target_dir . basename($_FILES["signature_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // ตรวจสอบประเภทไฟล์
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedTypes)) {
            echo '<script>
            alert("รูปแบบไฟล์ไม่ถูกต้อง");
            window.history.back();
            </script>';
            exit;
        }

        // อัพโหลดไฟล์
        if (move_uploaded_file($_FILES["signature_image"]["tmp_name"], $target_file)) {
            $signature_image = $target_file;
        } else {
            echo '<script>
            alert("การอัปโหลดรูปภาพล้มเหลว");
            window.history.back();
            </script>';
            exit;
        }
    } else {
        // ใช้รูปภาพลายเซ็นเดิมหรือบันทึกเป็น "ไม่มีรูป"
        $signature_image = !empty($_POST['current_signature_image']) ? $_POST['current_signature_image'] : 'ไม่มีรูป';
    }

    // อัปเดตข้อมูลในฐานข้อมูล
    $sqlUpdate = "UPDATE tbl_personnel SET 
        username='$username',
        password='$password',
        per_name='$per_name',
        per_lastname='$per_lastname',
        position_id='$position_id',
        deptid='$deptid',
        factid='$factid',
        per_email='$per_email',
        member_title_id='$member_title_id',
        per_id_card='$per_id_card',
        line_id='$line_id',
        per_tel='$per_tel',
        signature_image='$signature_image',
        per_type='$per_type'
        WHERE per_id='$per_id'";

if (mysqli_query($conn, $sqlUpdate)) {
    if ($_SESSION['per_type'] != 1) {
        // ถ้า per_type ไม่ใช่ 1 ให้ไปที่หน้า editprofile
        echo '<script>alert("อัปเดตข้อมูลสำเร็จ"); window.location.href = "editprofile.php?per_id=' . $per_id . '";</script>';
    } else {
        // ถ้า per_type เป็น 1 ให้ไปที่หน้า personnelList
        echo '<script>alert("อัปเดตข้อมูลสำเร็จ"); window.location.href = "personnelList.php";</script>';
    }
} else {
    echo '<script>alert("ไม่สามารถอัปเดตข้อมูลได้"); window.history.back();</script>';
}
} else {
echo '<script>alert("ไม่พบข้อมูล ID"); window.history.back();</script>';
}
?>
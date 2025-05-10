<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่า rep_ID, approval_status, approval_comment, approved_by, และ approved_date จากฟอร์ม
    $rep_ID = filter_input(INPUT_POST, 'rep_ID', FILTER_SANITIZE_STRING);
    $approval_status = filter_input(INPUT_POST, 'approval_status', FILTER_SANITIZE_STRING);
    $approval_comment = isset($_POST['approval_comment']) ? filter_input(INPUT_POST, 'approval_comment', FILTER_SANITIZE_STRING) : null;
    $approved_by = filter_input(INPUT_POST, 'approved_by', FILTER_SANITIZE_STRING);
    $approved_date = filter_input(INPUT_POST, 'approved_date', FILTER_SANITIZE_STRING);

    // ตรวจสอบข้อมูลที่จำเป็น
    if (empty($rep_ID) || empty($approval_status) || empty($approved_by)) {
        echo "กรุณากรอกข้อมูลที่จำเป็นให้ครบถ้วน";
    } else {
        if ($approval_status == 'อนุมัติ') {
            $rep_status = 0; 
        } else {
            $rep_status = -1; 
        }
        
        // อัปเดตข้อมูลการอนุมัติลงในฐานข้อมูล
        $sql = "UPDATE tbl_repair 
                SET approval_status = ?, approval_comment = ?, approved_by = ?, approved_date = ?, rep_status = ? 
                WHERE rep_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisis", $approval_status, $approval_comment, $approved_by, $approved_date, $rep_status, $rep_ID);

        if ($stmt->execute()) {
            // ถ้าอัปเดตสำเร็จ เปลี่ยนเส้นทางไปที่หน้า approvalList.php
            header("Location: approvalList.php");
            exit(); // เพื่อให้แน่ใจว่าโปรแกรมจะหยุดการทำงานหลังจากการเปลี่ยนเส้นทาง
        } else {
            // ถ้าอัปเดตไม่สำเร็จ แสดงข้อผิดพลาดและย้อนกลับไปหน้าก่อนหน้า
            echo "<script>alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8') . "'); history.back();</script>";
        }
        $stmt->close();
    }
}
$conn->close();
?>

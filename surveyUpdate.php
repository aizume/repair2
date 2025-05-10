<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

// รับค่า rep_ID ที่ถูกส่งมาจากฟอร์ม
$rep_ID = $_POST['rep_ID'];

// รับค่าคะแนนจากฟอร์ม
$service_rating = isset($_POST['service_rating']) ? $_POST['service_rating'] : 0;
$quality_rating = isset($_POST['quality_rating']) ? $_POST['quality_rating'] : 0;
$timeliness_rating = isset($_POST['timeliness_rating']) ? $_POST['timeliness_rating'] : 0;
$suggestions = isset($_POST['suggestions']) ? $_POST['suggestions'] : ''; // ข้อเสนอแนะ
$survey_date = date('Y-m-d'); // เก็บวันที่ปัจจุบันเป็นวันที่ประเมิน

// อัปเดตข้อมูลในตาราง tbl_satisfaction_survey
$updatesql = "UPDATE tbl_satisfaction_survey 
              SET service_rating = '$service_rating', 
                  quality_rating = '$quality_rating', 
                  timeliness_rating = '$timeliness_rating', 
                  suggestions = '$suggestions', 
                  survey_date = '$survey_date'
              WHERE rep_ID = '$rep_ID'";

$execute = mysqli_query($conn, $updatesql);

if ($execute) {
    // หากการอัปเดตสำเร็จ ให้เปลี่ยนเส้นทางไปยังหน้ารายการซ่อม (หรือหน้าที่คุณต้องการ)
    header("Location: repirListUser.php");
    exit(); // Ensure that script stops after redirect
} else {
    // หากการอัปเดตไม่สำเร็จ ให้แสดงข้อความแจ้งเตือนและกลับไปยังหน้าฟอร์ม
    echo '<script>
            alert("แก้ไขข้อมูลการประเมินความพึงพอใจไม่สำเร็จ กรุณาตรวจสอบ!");
            window.history.back();
          </script>';
}

mysqli_close($conn);
?>

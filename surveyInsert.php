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

// เพิ่มข้อมูลลงในตาราง tbl_satisfaction_survey
$insertsql = "INSERT INTO tbl_satisfaction_survey (rep_ID, service_rating, quality_rating, timeliness_rating, suggestions, survey_date)
              VALUES ('$rep_ID', '$service_rating', '$quality_rating', '$timeliness_rating', '$suggestions', '$survey_date')";

$execute = mysqli_query($conn, $insertsql);

if ($execute) {
    // หากการบันทึกสำเร็จ ให้เปลี่ยนเส้นทางไปยังหน้ารายการซ่อม (หรือหน้าที่คุณต้องการ)
    header("Location: repirListUser.php");
    exit(); // Ensure that script stops after redirect
} else {
    // หากการบันทึกไม่สำเร็จ ให้แสดงข้อความแจ้งเตือนและกลับไปยังหน้าฟอร์ม
    echo '<script>
            alert("เพิ่มข้อมูลการประเมินความพึงพอใจไม่สำเร็จ กรุณาตรวจสอบ!");
            window.history.back();
          </script>';
}

mysqli_close($conn);
?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

// ดึงหมายเลขแจ้งซ่อมล่าสุด (แยกเฉพาะส่วนตัวเลข xxx และตรวจสอบจากปี พ.ศ. ปัจจุบัน)
$current_year_full = date('Y') + 543; // ปี พ.ศ. ปัจจุบัน
$sql = "SELECT MAX(CAST(SUBSTRING_INDEX(rep_no, '/', 1) AS UNSIGNED)) AS last_id 
        FROM tbl_repair 
        WHERE SUBSTRING_INDEX(rep_no, '/', -1) = '".($current_year_full % 100)."'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$last_id = isset($row['last_id']) ? $row['last_id'] : 0;

// เพิ่มค่าให้กับหมายเลขแจ้งซ่อมล่าสุด
$new_id = $last_id + 1;

// ดึงปีปัจจุบันในรูปแบบสองหลักของ พ.ศ.
$current_year = $current_year_full % 100; // แปลงเป็นรูปแบบสองหลัก

// สร้างหมายเลขแจ้งซ่อมตามรูปแบบ xxx/yy (เช่น 001/67)
$repair_no = sprintf('%03d/%02d', $new_id, $current_year);




// ข้อมูลจาก session และ POST
$per_id = $_SESSION['login']['per_id'];
$u_date = $_POST['u_date'];
$rep_status = isset($_POST['rep_status']) ? $_POST['rep_status'] : '-2';  // ตั้งค่าดีฟอลต์เป็น -2

// หมวดหมู่ของปัญหาต่าง ๆ ที่เก็บจากฟอร์ม
$building_issue = isset($_POST['building_issue']) ? implode(',', $_POST['building_issue']) : ''; // รวมค่า checkbox
$building_other = isset($_POST['building_other']) ? $_POST['building_other'] : ''; // ข้อมูลอื่น ๆ
$building_location = $_POST['building_location'];

$electrical_issue = isset($_POST['electrical_issue']) ? implode(',', $_POST['electrical_issue']) : '';
$electrical_other = isset($_POST['electrical_other']) ? $_POST['electrical_other'] : ''; // ข้อมูลอื่น ๆ
$electrical_location = $_POST['electrical_location'];

$plumbing_issue = isset($_POST['plumbing_issue']) ? implode(',', $_POST['plumbing_issue']) : '';
$plumbing_other = isset($_POST['plumbing_other']) ? $_POST['plumbing_other'] : ''; // ข้อมูลอื่น ๆ
$plumbing_location = $_POST['plumbing_location'];

$aircon_issue = isset($_POST['aircon_issue']) ? implode(',', $_POST['aircon_issue']) : '';
$aircon_other = isset($_POST['aircon_other']) ? $_POST['aircon_other'] : ''; // ข้อมูลอื่น ๆ
$aircon_equipment_no = $_POST['aircon_equipment_no'];
$aircon_location = $_POST['aircon_location'];

$other_issue = isset($_POST['other_issue']) ? $_POST['other_issue'] : '';
$other_equipment_no = $_POST['other_equipment_no'];
$other_location = $_POST['other_location'];

// เพิ่มข้อมูลลงใน tbl_repair พร้อมหมายเลขแจ้งซ่อม
$insertsql = "INSERT INTO tbl_repair (rep_no, u_date, rep_status, per_id, building_issue, building_other, building_location, electrical_issue, electrical_other, electrical_location, plumbing_issue, plumbing_other, plumbing_location, aircon_issue, aircon_other, aircon_equipment_no, aircon_location, other_issue, other_equipment_no, other_location)
              VALUES ('$repair_no', '$u_date', '$rep_status', '$per_id', '$building_issue', '$building_other', '$building_location', '$electrical_issue', '$electrical_other', '$electrical_location', '$plumbing_issue', '$plumbing_other', '$plumbing_location', '$aircon_issue', '$aircon_other', '$aircon_equipment_no', '$aircon_location', '$other_issue', '$other_equipment_no', '$other_location')";

$execute = mysqli_query($conn, $insertsql);

if ($execute) {
    header("Location: repirListUser.php");
    exit(); // Ensure that script stops after redirect
} else {
    echo '<script>
            alert("เพิ่มข้อมูลการแจ้งซ่อมไม่สำเร็จ กรุณาตรวจสอบ!");
            window.history.back();
          </script>';
}

mysqli_close($conn);
?>


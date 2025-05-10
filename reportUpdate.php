<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

$rep_ID = isset($_GET['rep_ID']) ? $_GET['rep_ID'] : null;

if ($rep_ID && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // ใช้ isset เพื่อตรวจสอบว่ามีการตั้งค่าคีย์ใน $_POST หรือไม่
    $u_date = isset($_POST['u_date']) ? mysqli_real_escape_string($conn, $_POST['u_date']) : '';
    
    // ใช้ implode และ array_map เพื่อให้แน่ใจว่าแต่ละค่าปลอดภัย
    $building_issue = isset($_POST['building_issue']) ? implode(',', array_map(function($item) use ($conn) {
        return mysqli_real_escape_string($conn, $item);
    }, $_POST['building_issue'])) : '';
    $building_other = isset($_POST['building_other']) ? mysqli_real_escape_string($conn, $_POST['building_other']) : '';
    $building_location = isset($_POST['building_location']) ? mysqli_real_escape_string($conn, $_POST['building_location']) : '';
    
    $electrical_issue = isset($_POST['electrical_issue']) ? implode(',', array_map(function($item) use ($conn) {
        return mysqli_real_escape_string($conn, $item);
    }, $_POST['electrical_issue'])) : '';
    $electrical_other = isset($_POST['electrical_other']) ? mysqli_real_escape_string($conn, $_POST['electrical_other']) : '';
    $electrical_location = isset($_POST['electrical_location']) ? mysqli_real_escape_string($conn, $_POST['electrical_location']) : '';
    
    $plumbing_issue = isset($_POST['plumbing_issue']) ? implode(',', array_map(function($item) use ($conn) {
        return mysqli_real_escape_string($conn, $item);
    }, $_POST['plumbing_issue'])) : '';
    $plumbing_other = isset($_POST['plumbing_other']) ? mysqli_real_escape_string($conn, $_POST['plumbing_other']) : '';
    $plumbing_location = isset($_POST['plumbing_location']) ? mysqli_real_escape_string($conn, $_POST['plumbing_location']) : '';
    
    $aircon_issue = isset($_POST['aircon_issue']) ? implode(',', array_map(function($item) use ($conn) {
        return mysqli_real_escape_string($conn, $item);
    }, $_POST['aircon_issue'])) : '';
    $aircon_other = isset($_POST['aircon_other']) ? mysqli_real_escape_string($conn, $_POST['aircon_other']) : '';
    $aircon_equipment_no = isset($_POST['aircon_equipment_no']) ? mysqli_real_escape_string($conn, $_POST['aircon_equipment_no']) : '';
    $aircon_location = isset($_POST['aircon_location']) ? mysqli_real_escape_string($conn, $_POST['aircon_location']) : '';
    
    $other_issue = isset($_POST['other_issue']) ? mysqli_real_escape_string($conn, $_POST['other_issue']) : '';
    $other_equipment_no = isset($_POST['other_equipment_no']) ? mysqli_real_escape_string($conn, $_POST['other_equipment_no']) : '';
    $other_location = isset($_POST['other_location']) ? mysqli_real_escape_string($conn, $_POST['other_location']) : '';

    // Update SQL statement
    $updatesql = "UPDATE tbl_repair SET 
        u_date = '$u_date',
        building_issue = '$building_issue',
        building_other = '$building_other',
        building_location = '$building_location',
        electrical_issue = '$electrical_issue',
        electrical_other = '$electrical_other',
        electrical_location = '$electrical_location',
        plumbing_issue = '$plumbing_issue',
        plumbing_other = '$plumbing_other',
        plumbing_location = '$plumbing_location',
        aircon_issue = '$aircon_issue',
        aircon_equipment_no = '$aircon_equipment_no',
        aircon_other = '$aircon_other',
        aircon_location = '$aircon_location',
        other_issue = '$other_issue',
        other_equipment_no = '$other_equipment_no',
        other_location = '$other_location'
        WHERE rep_ID = '$rep_ID'";

    $execute = mysqli_query($conn, $updatesql);

    if ($execute) {
        echo '<script>
            alert("ปรับปรุงข้อมูลการซ่อม สำเร็จ");
            window.location.href="repirListUser.php";
        </script>';
    } else {
        echo '<script>
            alert("ปรับปรุงข้อมูลการซ่อม ไม่สำเร็จ");
            window.history.back();
        </script>';
    }
} else {
    echo '<script>
        alert("ไม่พบข้อมูล");
        window.history.back();
    </script>';
}
?>

<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

$sch_id = isset($_POST['sch_id']) ? $_POST['sch_id'] : null;

if ($sch_id && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบและรับข้อมูลจากฟอร์ม
    $sch_date = isset($_POST['sch_date']) ? $_POST['sch_date'] : '';
    $sch_time = isset($_POST['sch_time']) ? $_POST['sch_time'] : '';
    $details = isset($_POST['details']) ? $_POST['details'] : '';
    $rep_id = isset($_POST['rep_id']) ? $_POST['rep_id'] : null; // ข้อมูลการซ่อม
    $per_id = isset($_POST['per_id']) ? $_POST['per_id'] : null; // ช่างซ่อม

    // ตรวจสอบว่าข้อมูลสำคัญถูกส่งมาครบถ้วนหรือไม่
    if ($sch_date && $sch_time && $rep_id && $per_id) {
        // อัปเดตข้อมูลกำหนดการในฐานข้อมูล
        $updatesql = "UPDATE tbl_schedule SET 
            sch_date = '$sch_date', 
            sch_time = '$sch_time', 
            details = '$details',
            rep_id = '$rep_id',
            per_id = '$per_id'
            WHERE sch_id = '$sch_id'";

        $execute = mysqli_query($conn, $updatesql);

        // ตรวจสอบผลการอัปเดต
        if ($execute) {
            echo '<script>
                alert("ปรับปรุงข้อมูลกำหนดการสำเร็จ");
                window.location.replace("workSchedule.php");
            </script>';
        } else {
            echo '<script>
                alert("ปรับปรุงข้อมูลกำหนดการไม่สำเร็จ กรุณาลองอีกครั้ง");
                window.history.back();
            </script>';
        }
    } else {
        echo '<script>
            alert("กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)");
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

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("connect.php");

// ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // รับค่าจากฟอร์ม
    $position_name = mysqli_real_escape_string($conn, $_POST['position_name']);

    // ตรวจสอบว่าชื่อตำแหน่งไม่ว่าง
    if (!empty($position_name)) {
        
        // สร้างคำสั่ง SQL สำหรับการเพิ่มข้อมูล
        $sqlInsertPosition = "INSERT INTO tbl_position (position_name) VALUES ('$position_name')";

        // ทำการเพิ่มข้อมูล
        if (mysqli_query($conn, $sqlInsertPosition)) {
            // หากสำเร็จ ให้เปลี่ยนเส้นทางไปยังหน้ารายการตำแหน่ง
            $_SESSION['success_message'] = "เพิ่มข้อมูลตำแหน่งเรียบร้อยแล้ว";
            header("Location: ManageData.php");
            exit();
        } else {
            // หากเกิดข้อผิดพลาด
            $_SESSION['error_message'] = "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . mysqli_error($conn);
            header("Location: positionCreate.php");
            exit();
        }

    } else {
        // หากฟอร์มว่าง ให้แจ้งเตือนผู้ใช้
        $_SESSION['error_message'] = "กรุณากรอกชื่อตำแหน่ง";
        header("Location: positionCreate.php");
        exit();
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>

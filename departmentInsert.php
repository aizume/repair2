<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("connect.php");

// ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // รับค่าจากฟอร์ม
    $deptname = mysqli_real_escape_string($conn, $_POST['deptname']);

    // ตรวจสอบว่าชื่อสาขาวิชาไม่ว่าง
    if (!empty($deptname)) {
        
        // สร้างคำสั่ง SQL สำหรับการเพิ่มข้อมูล
        $sqlInsertDept = "INSERT INTO tbl_department (deptname) VALUES ('$deptname')";

        // ทำการเพิ่มข้อมูล
        if (mysqli_query($conn, $sqlInsertDept)) {
            // หากสำเร็จ ให้เปลี่ยนเส้นทางไปยังหน้ารายการสาขาวิชา
            $_SESSION['success_message'] = "เพิ่มข้อมูลสาขาวิชาเรียบร้อยแล้ว";
            header("Location: ManageData.php");
            exit();
        } else {
            // หากเกิดข้อผิดพลาด
            $_SESSION['error_message'] = "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . mysqli_error($conn);
            header("Location: departmentCreate.php");
            exit();
        }
        
    } else {
        // หากฟอร์มว่าง ให้แจ้งเตือนผู้ใช้
        $_SESSION['error_message'] = "กรุณากรอกชื่อสาขาวิชา";
        header("Location: departmentCreate.php");
        exit();
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>

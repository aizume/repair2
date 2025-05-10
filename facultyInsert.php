<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("connect.php");

// ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // รับค่าจากฟอร์ม
    $factid = mysqli_real_escape_string($conn, $_POST['factid']); // รับค่าจาก factid
    $factname = mysqli_real_escape_string($conn, $_POST['factname']); // รับค่าจาก factname

    // ตรวจสอบว่าชื่อคณะและรหัสคณะไม่ว่าง
    if (!empty($factid) && !empty($factname)) {
        
        // สร้างคำสั่ง SQL สำหรับการเพิ่มข้อมูล
        $sqlInsertFaculty = "INSERT INTO tbl_faculty (factid, factname) VALUES ('$factid', '$factname')";

        // ทำการเพิ่มข้อมูล
        if (mysqli_query($conn, $sqlInsertFaculty)) {
            // หากสำเร็จ ให้เปลี่ยนเส้นทางไปยังหน้ารายการคณะ
            $_SESSION['success_message'] = "เพิ่มข้อมูลคณะเรียบร้อยแล้ว";
            header("Location: ManageData.php");
            exit();
        } else {
            // หากเกิดข้อผิดพลาด
            $_SESSION['error_message'] = "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . mysqli_error($conn);
            header("Location: facultyCreate.php");
            exit();
        }
        
    } else {
        // หากฟอร์มว่าง ให้แจ้งเตือนผู้ใช้
        $_SESSION['error_message'] = "กรุณากรอกรหัสคณะและชื่อคณะ";
        header("Location: facultyCreate.php");
        exit();
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("connect.php");

// ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // รับค่าจากฟอร์ม
    $member_title_name = mysqli_real_escape_string($conn, $_POST['member_title_name']);
    $member_title_en = mysqli_real_escape_string($conn, $_POST['member_title_en']);

    // ตรวจสอบว่าข้อมูลไม่ว่าง
    if (!empty($member_title_name) && !empty($member_title_en)) {
        
        // สร้างคำสั่ง SQL สำหรับการเพิ่มข้อมูล
        $sqlInsertMemberTitle = "INSERT INTO tbl_member_title (member_title_name, member_title_en) 
                                 VALUES ('$member_title_name', '$member_title_en')";

        // ทำการเพิ่มข้อมูล
        if (mysqli_query($conn, $sqlInsertMemberTitle)) {
            // หากสำเร็จ ให้เปลี่ยนเส้นทางไปยังหน้ารายการคำนำหน้าชื่อ
            $_SESSION['success_message'] = "เพิ่มข้อมูลคำนำหน้าชื่อเรียบร้อยแล้ว";
            header("Location: ManageData.php");
            exit();
        } else {
            // หากเกิดข้อผิดพลาด
            $_SESSION['error_message'] = "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . mysqli_error($conn);
            header("Location: memberTitleCreate.php");
            exit();
        }

    } else {
        // หากฟอร์มว่าง ให้แจ้งเตือนผู้ใช้
        $_SESSION['error_message'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
        header("Location: memberTitleCreate.php");
        exit();
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>

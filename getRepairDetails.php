<?php
include("connect.php");

if (isset($_GET['rep_id'])) {
    $rep_id = $_GET['rep_id'];
    $sql = "SELECT u_date, problem, building_issue, building_other, building_location,
                   electrical_issue, electrical_other, electrical_location,
                   plumbing_issue, plumbing_other, plumbing_location,
                   aircon_issue, aircon_other, aircon_location, other_issue, other_equipment_no, other_location
            FROM tbl_repair 
            WHERE rep_ID = '$rep_id'";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        echo "<strong>วันที่แจ้งซ่อม :</strong> " . $row['u_date'] . "<br><br>" ;
        
        // แสดงข้อมูลปัญหาที่เกี่ยวข้อง
        if ($row['building_issue']) {
            echo "<span style='font-weight: bold; color: black;'>ปัญหาอาคารสถานที่ :</span> " . $row['building_issue'] . "<br>";
            if ($row['building_other']) {
                echo "อื่นๆ : " . $row['building_other'] . "<br>";
            }
            echo "กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง) : " . $row['building_location'] . "<br><br>";
        }
        
        if ($row['electrical_issue']) {
            echo "<span style='font-weight: bold; color: black;'>ปัญหาระบบไฟฟ้า :</span> " . $row['electrical_issue'] . "<br>";
            if ($row['electrical_other']) {
                echo "อื่นๆ : " . $row['electrical_other'] . "<br>";
            }
            echo "กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง) : " . $row['electrical_location'] . "<br><br>";
        }
        
        if ($row['plumbing_issue']) {
            echo "<span style='font-weight: bold; color: black;'>ปัญหาระบบประปา :</span> " . $row['plumbing_issue'] . "<br>";
            if ($row['plumbing_other']) {
                echo "อื่นๆ : " . $row['plumbing_other'] . "<br>";
            }
            echo "กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง) : " . $row['plumbing_location'] . "<br><br>";
        }
        
        if ($row['aircon_issue']) {
            echo "<span style='font-weight: bold; color: black;'>ปัญหาระบบเครื่องปรับอากาศ :</span> " . $row['aircon_issue'] . "<br>";
            if ($row['aircon_other']) {
                echo "อื่นๆ : " . $row['aircon_other'] . "<br>";
            }
            echo "กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง) : " . $row['aircon_location'] . "<br><br>";
        }

        if ($row['other_issue']) {
            echo "<span style='font-weight: bold; color: black;'>งานครุภัณฑ์อื่นๆ :</span> " . $row['other_issue'] . "<br>";
            if ($row['other_equipment_no']) {
                echo "หมายเลขครุภัณฑ์ : " . $row['other_equipment_no'] . "<br>";
            }
            echo "กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง) : " . $row['other_location'] . "<br><br>";
        }

    } else {
        echo "ไม่พบข้อมูล";
    }
}
?>

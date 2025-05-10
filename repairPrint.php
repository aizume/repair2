<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");
include("menu.php");

// Fetch the repair report details
$rep_ID = $_GET['rep_ID'];
$sqlQuery = "SELECT * FROM tbl_repair WHERE rep_ID='$rep_ID'";
$query = mysqli_query($conn, $sqlQuery);
$row = mysqli_fetch_assoc($query);


$u_date = $row['u_date'];
$rep_status = $row['rep_status'];
$building_issue = explode(',', $row['building_issue']);
$building_location = $row['building_location'];
$building_other = $row['building_other'];
$electrical_issue = explode(',', $row['electrical_issue']);
$electrical_location = $row['electrical_location'];
$electrical_other = $row['electrical_other'];
$plumbing_issue = explode(',', $row['plumbing_issue']);
$plumbing_location = $row['plumbing_location'];
$plumbing_other = $row['plumbing_other'];
$aircon_issue = explode(',', $row['aircon_issue']);
$aircon_equipment_no = $row['aircon_equipment_no'];
$aircon_location = $row['aircon_location'];
$aircon_other = $row['aircon_other'];
$other_issue = $row['other_issue'];
$other_equipment_no = $row['other_equipment_no'];
$other_location = $row['other_location'];
$solution = explode(',', $row['solution']);
$solution_other = $row['solution_other'];
$c_date = $row['c_date'];
$rep_no = $row['rep_no'];
$approval_status = $row['approval_status'];
$approval_comment = $row['approval_comment'];
$approved_by = $row['approved_by'];
$approved_date = $row['approved_date'];


// Fetch the materials used details
$sqlMaterialsQuery = "SELECT * FROM tbl_materials_used WHERE rep_ID='$rep_ID'";
$materialsQuery = mysqli_query($conn, $sqlMaterialsQuery);

// Extract repair data
$u_date = $row['u_date'];
$rep_status = $row['rep_status'];
// (Other existing code...)

// Fetch the materials used details
$sqlMaterialsQuery = "SELECT * FROM tbl_materials_used WHERE rep_ID='$rep_ID'";
$materialsQuery = mysqli_query($conn, $sqlMaterialsQuery);

// Fetch the satisfaction survey details
$sqlSurveyQuery = "SELECT * FROM tbl_satisfaction_survey WHERE rep_ID='$rep_ID'";
$surveyQuery = mysqli_query($conn, $sqlSurveyQuery);
$survey = mysqli_fetch_assoc($surveyQuery);


// Fetch the repair report details
$rep_ID = $_GET['rep_ID'];
$sqlQuery = "SELECT * FROM tbl_repair WHERE rep_ID='$rep_ID'";
$query = mysqli_query($conn, $sqlQuery);
$row = mysqli_fetch_assoc($query);

// Extract repair report details
$u_date = $row['u_date'];
$rep_status = $row['rep_status'];
// (รหัสเดิม...)

// Fetch the personnel details
$per_id = $row['per_id']; // สมมติว่ามีฟิลด์ per_id ใน tbl_repair

$sqlPersonnelQuery = "
    SELECT 
        p.per_id,
        p.per_name,
        p.per_lastname,
        mt.member_title_name,
        pos.position_name,
        dept.deptname,
        p.per_tel
    FROM 
        tbl_personnel p
    JOIN 
        tbl_member_title mt ON p.member_title_id = mt.member_title_id
    JOIN 
        tbl_position pos ON p.position_id = pos.position_id
    JOIN 
        tbl_department dept ON p.deptid = dept.deptid
    WHERE 
        p.per_id = '$per_id'
";

$personnelQuery = mysqli_query($conn, $sqlPersonnelQuery);
$personnelRow = mysqli_fetch_assoc($personnelQuery);

// Extract personnel details
$member_title_name = $personnelRow['member_title_name'];
$per_name = $personnelRow['per_name'];
$per_lastname = $personnelRow['per_lastname'];
$position_name = $personnelRow['position_name'];
$deptname = $personnelRow['deptname'];
$per_tel = $personnelRow['per_tel'];

// Fetch the materials used details
$sqlMaterialsQuery = "SELECT * FROM tbl_materials_used WHERE rep_ID='$rep_ID'";
$materialsQuery = mysqli_query($conn, $sqlMaterialsQuery);

// Fetch the satisfaction survey details
$sqlSurveyQuery = "SELECT * FROM tbl_satisfaction_survey WHERE rep_ID='$rep_ID'";
$surveyQuery = mysqli_query($conn, $sqlSurveyQuery);
$survey = mysqli_fetch_assoc($surveyQuery);

?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<style>
  body {
    font-family: 'TH SarabunPSK', sans-serif;
    margin: 0;
    padding: 20px;
    max-width: 800;
  }
  .header, .footer {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
  }
  .header-address, .footer-address {
    width: 45%;
    line-height: 0.8;
  }
  .repair-form-title {
    text-align: center;
    margin-bottom: 12px;
  }
  .logo {
    width: 80px;
    height: 80px;
  }
  .content {
    margin-top: 20px;
  }
  .right-aligned {
    text-align: right;
  }
  .left-aligned {
    text-align: left;
    margin-bottom: 15px;
  }
  .double-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
  }

.page-break {
    page-break-after: always;  /* หรือเพิ่มการแบ่งหน้าใหม่หลัง */
}

</style>
</head>
<body>

<div class="page">
    <!-- เนื้อหาหน้าแรก -->
     
<div class="header">
  <div class="header-address">
    <p style="font-size: 10pt; line-height: 0.8;">ศูนย์ทดสอบทางวิศวกรรมและห้องปฏิบัติการกลาง</p>
    <p style="font-size: 10pt; line-height: 0.8;">คณะวิศวกรรมศาสตร์และเทคโนโลยี มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน</p>
    <p style="font-size: 10pt; line-height: 0.8;">744 ถ.สุรนารายณ์ ต.ในเมือง อ.เมือง จ.นครราชสีมา</p>
    <p style="font-size: 10pt; line-height: 0.8;">โทร. 0-4423-3040 www.ect.fet.rmuti.ac.th</p>
  </div>
  <div style="text-align: center;" > <!-- เพิ่ม div นี้เพื่อจัดโลโก้ -->
    <img src="assets/img/FET_logo.png" alt="RMUTI logo" class="logo">
  </div>
<div class="footer-address">
  <p style="font-size: 10pt;  line-height: 0.8; margin-left: 180px;">ENGINEERING TESTING CENTER AND CENTRAL LABORATORY : ECT</p>
  <p style="font-size: 10pt;  line-height: 0.8; margin-left: 180px;">RAJAMANGALA UNIVERSITY OF TECHNOLOGY ISAN</p>
  <p style="font-size: 10pt;  line-height: 0.8; margin-left: 180px;">744 Suranarai Rd., Nai Muang, Muang, Nakhon Ratchasima 30000</p>
  <p style="font-size: 10pt;  line-height: 0.8; margin-left: 180px;">Tel. 0-4423-3040 Fax 0-4423-3040 www.ect.fet.rmuti.ac.th</p>
</div>

</div>

<div class="repair-form-title">
  <p style="font-weight: bold; font-size: 24pt; ">ใบขอใช้บริการซ่อมระบบสาธารณูปโภค ครุภัณฑ์</p>
</div>

<div class="double-row">
  <p style="font-size: 20pt;">เลขที่: <?php echo htmlspecialchars($rep_no, ENT_QUOTES, 'UTF-8'); ?></p>
  <p class="right-aligned" style="font-size: 20pt;" >วันที่: <?php echo htmlspecialchars($u_date, ENT_QUOTES, 'UTF-8'); ?></p>
</div>

<p class="left-aligned" style="font-size: 20pt;" >เรียน หัวหน้าศูนย์ทดสอบทางวิศวกรรมและห้องปฏิบัติการกลาง</p>

<div class="left-aligned">
  <p>
    <span style="font-size: 20pt;">ข้าพเจ้า: <?php echo htmlspecialchars($member_title_name, ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($per_name, ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($per_lastname, ENT_QUOTES, 'UTF-8'); ?></span>
    <span style="font-size: 20pt;">ตำแหน่ง: <?php echo htmlspecialchars($position_name, ENT_QUOTES, 'UTF-8'); ?></span>
    <span style="font-size: 20pt;">หน่วยงาน: <?php echo htmlspecialchars($deptname, ENT_QUOTES, 'UTF-8'); ?></span>
  </p>
  <p style="font-size: 20pt;">
    คณะวิศวกรรมศาสตร์และเทคโนโลยี เบอร์โทรศัพท์ติดต่อได้โดยตรง: <?php echo htmlspecialchars($per_tel, ENT_QUOTES, 'UTF-8'); ?> มีความประสงค์ขอความอนุเคราะห์ดังนี้
  </p>
</div>

<div>

                                <!-- หมวดหมู่ ปัญหาต่าง ๆ -->
                                <!-- ปัญหาอาคารสถานที่ -->
                                <?php if (!empty($building_issue) && !empty(array_filter($building_issue))) { ?>
                                <div id="building_details" class="issue-details">
                                    <!-- แสดงรายละเอียดปัญหาอาคารสถานที่ -->
                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">001 ปัญหาอาคารสถานที่</label>
                                        <div class="col-md-6">
                                            <div>
                                                <input type="checkbox" id="door" name="building_issue[]" value="ประตู" <?php echo (in_array('ประตู', $building_issue)) ? 'checked' : ''; ?> disabled> ประตู
                                                <input type="checkbox" id="window" name="building_issue[]" value="หน้าต่าง" <?php echo (in_array('หน้าต่าง', $building_issue)) ? 'checked' : ''; ?> disabled> หน้าต่าง
                                                <input type="checkbox" id="floor" name="building_issue[]" value="พื้น" <?php echo (in_array('พื้น', $building_issue)) ? 'checked' : ''; ?> disabled> พื้น
                                                <input type="checkbox" id="wall" name="building_issue[]" value="ผนัง" <?php echo (in_array('ผนัง', $building_issue)) ? 'checked' : ''; ?> disabled> ผนัง
                                                <input type="checkbox" id="pillar" name="building_issue[]" value="เสา" <?php echo (in_array('เสา', $building_issue)) ? 'checked' : ''; ?> disabled> เสา
                                                <input type="checkbox" id="roof" name="building_issue[]" value="หลังคา" <?php echo (in_array('หลังคา', $building_issue)) ? 'checked' : ''; ?> disabled> หลังคา<br>
                                                <input type="checkbox" id="building_other_checkbox" name="building_issue[]" value="อื่นๆ" <?php echo (in_array('อื่นๆ', $building_issue)) ? 'checked' : ''; ?> disabled> อื่นๆ
                                                <input type="text" class="form-control" id="building_other" name="building_other" placeholder="กรุณาระบุ" value="<?php echo htmlspecialchars($building_other, ENT_QUOTES, 'UTF-8'); ?>"disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" id="building_location" name="building_location" rows="4" style="resize: vertical;" disabled><?php echo htmlspecialchars($building_location, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                                
                                <!-- ระบบไฟฟ้า -->
                                <?php if (!empty($electrical_issue) && !empty(array_filter($electrical_issue))) { ?>
                                <div id="electrical_details" class="issue-details">
                                    <!-- แสดงรายละเอียดปัญหาระบบไฟฟ้า -->
                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">002 ปัญหาระบบไฟฟ้า</label>
                                        <div class="col-md-6">
                                            <div>
                                                <input type="checkbox" id="switch" name="electrical_issue[]" value="สวิทซ์" <?php echo (in_array('สวิทซ์', $electrical_issue)) ? 'checked' : ''; ?> disabled> สวิทซ์
                                                <input type="checkbox" id="plug" name="electrical_issue[]" value="ปลั๊ก" <?php echo (in_array('ปลั๊ก', $electrical_issue)) ? 'checked' : ''; ?> disabled> ปลั๊ก
                                                <input type="checkbox" id="lightbulb" name="electrical_issue[]" value="หลอดไฟ" <?php echo (in_array('หลอดไฟ', $electrical_issue)) ? 'checked' : ''; ?> disabled> หลอดไฟ
                                                <input type="checkbox" id="wiring" name="electrical_issue[]" value="สายไฟ" <?php echo (in_array('สายไฟ', $electrical_issue)) ? 'checked' : ''; ?> disabled> สายไฟ
                                                <input type="checkbox" id="control_box" name="electrical_issue[]" value="ตู้ควบคุม" <?php echo (in_array('ตู้ควบคุม', $electrical_issue)) ? 'checked' : ''; ?> disabled> ตู้ควบคุม<br>
                                                <input type="checkbox" id="electrical_other_checkbox" name="electrical_issue[]" value="อื่นๆ" <?php echo (in_array('อื่นๆ', $electrical_issue)) ? 'checked' : ''; ?> disabled> อื่นๆ
                                                <input type="text" class="form-control" id="electrical_other" name="electrical_other" placeholder="กรุณาระบุ" value="<?php echo htmlspecialchars($electrical_other, ENT_QUOTES, 'UTF-8'); ?>"disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" id="electrical_location" name="electrical_location" rows="4" style="resize: vertical;" disabled><?php echo htmlspecialchars($electrical_location, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php } ?>

                                <!-- ระบบประปา -->
                                <?php if (!empty($plumbing_issue) && !empty(array_filter($plumbing_issue))) { ?>
                                <div id="plumbing_details" class="issue-details">
                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">003 ปัญหาระบบประปา</label>
                                        <div class="col-md-6">
                                                <input type="checkbox" name="plumbing_issue[]" value="ก๊อกน้ำ" <?php echo in_array('ก๊อกน้ำ', $plumbing_issue) ? 'checked' : ''; ?> disabled> ก๊อกน้ำ
                                                <input type="checkbox" name="plumbing_issue[]" value="ท่อน้ำดี" <?php echo in_array('ท่อน้ำดี', $plumbing_issue) ? 'checked' : ''; ?> disabled> ท่อน้ำดี
                                                <input type="checkbox" name="plumbing_issue[]" value="ท่อน้ำเสีย" <?php echo in_array('ท่อน้ำเสีย', $plumbing_issue) ? 'checked' : ''; ?> disabled> ท่อน้ำเสีย
                                                <input type="checkbox" name="plumbing_issue[]" value="สายชำระ" <?php echo in_array('สายชำระ', $plumbing_issue) ? 'checked' : ''; ?> disabled> สายชำระ
                                                <input type="checkbox" name="plumbing_issue[]" value="ชักโครก" <?php echo in_array('ชักโครก', $plumbing_issue) ? 'checked' : ''; ?> disabled> ชักโครก
                                                <input type="checkbox" name="plumbing_issue[]" value="โถปัสสาวะ" <?php echo in_array('โถปัสสาวะ', $plumbing_issue) ? 'checked' : ''; ?> disabled> โถปัสสาวะ<br>
                                                <input type="checkbox" name="plumbing_issue[]" value="อื่นๆ" <?php echo in_array('อื่นๆ', $plumbing_issue) ? 'checked' : ''; ?> disabled> อื่นๆ
                                                <input type="text" class="form-control" id="plumbing_other" name="plumbing_other" placeholder="กรุณาระบุ" value="<?php echo htmlspecialchars($plumbing_other, ENT_QUOTES, 'UTF-8'); ?>"disabled>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" id="plumbing_location" name="plumbing_location" rows="4" style="resize: vertical;" disabled><?php echo htmlspecialchars($plumbing_location, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                                <?php if (!empty($aircon_issue) && !empty(array_filter($aircon_issue))) { ?>
                                <div id="aircon_details" class="issue-details">
                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">004 ปัญหาระบบปรับอากาศ</label>
                                        <div class="col-md-6">
                                            <div>
                                                <input type="checkbox" name="aircon_issue[]" value="เปิดไม่ติด" <?php echo in_array('เปิดไม่ติด', $aircon_issue) ? 'checked' : ''; ?> disabled> เปิดไม่ติด
                                                <input type="checkbox" name="aircon_issue[]" value="แอร์ไม่เย็น" <?php echo in_array('แอร์ไม่เย็น', $aircon_issue) ? 'checked' : ''; ?> disabled> แอร์ไม่เย็น
                                                <input type="checkbox" name="aircon_issue[]" value="เสียงดัง" <?php echo in_array('เสียงดัง', $aircon_issue) ? 'checked' : ''; ?> disabled> เสียงดัง
                                                <input type="checkbox" name="aircon_issue[]" value="น้ำหยด" <?php echo in_array('น้ำหยด', $aircon_issue) ? 'checked' : ''; ?> disabled> น้ำหยด
                                                <input type="checkbox" name="aircon_issue[]" value="รีโมทชำรุด" <?php echo in_array('รีโมทชำรุด', $aircon_issue) ? 'checked' : ''; ?> disabled> รีโมทชำรุด<br>
                                                <input type="checkbox" name="aircon_issue[]" value="อื่นๆ" <?php echo in_array('อื่นๆ', $aircon_issue) ? 'checked' : ''; ?> disabled> อื่นๆ
                                                <input type="text" class="form-control" id="aircon_other" name="aircon_other" placeholder="กรุณาระบุ" value="<?php echo htmlspecialchars($aircon_other, ENT_QUOTES, 'UTF-8'); ?>"disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" id="aircon_location" name="aircon_location" rows="4" style="resize: vertical;" disabled><?php echo htmlspecialchars($aircon_location, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <!-- งานครุภัณฑ์อื่นๆ -->
                                <?php if (!empty($other_issue)) { ?>
                                <div id="other_details" class="issue-details">
                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">005 งานครุภัณฑ์อื่นๆ</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="other_issue" name="other_issue" value="<?php echo htmlspecialchars($other_issue, ENT_QUOTES, 'UTF-8'); ?>" disabled>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" id="other_location" name="other_location" rows="4" style="resize: vertical;" disabled><?php echo htmlspecialchars($other_location, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            <br>
                            </div>

                            <div class="form-group text-center" style="display: flex; justify-content: space-between;">
                              <div>
                                <label style="font-size: 20pt;">ผู้ขอใช้บริการ.....................................................วันที่.....................</label><br>
                                <label style="font-size: 20pt;">(.....................................................)</label><br>
                              </div>
                              <div>
                                <label style="font-size: 20pt;">หัวหน้าหน่วยงาน.....................................................วันที่.....................</label><br>
                                <label style="font-size: 20pt;">(.....................................................)</label><br>
                              </div>
                            </div>
                            <br>
                            <div style="display: flex; justify-content: center; margin-top: 20px;">
                                <button id="printButton" onclick="window.print()" style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px;">print</button>
                            </div>
                            <br>
                            <br>
                            <script>
                            window.onbeforeprint = function() {
                                document.getElementById("printButton").style.display = 'none'; // ซ่อนปุ่มปริ้น
                            };
                            window.onafterprint = function() {
                                document.getElementById("printButton").style.display = 'block'; // แสดงปุ่มปริ้นอีกครั้งหลังจากปริ้นเสร็จ
                            };
                            </script>
</div>
</div>

<!-- CSS สำหรับซ่อนในหน้าเว็บ และแสดงตอนพิมพ์ -->
<style>
.print-only {
    display: none;
}

@media print {
    .print-only {
        display: block;
    }
}
</style>

<div class="page-break"></div>

<div>
<div class="page print-only"> <!-- เพิ่ม class "print-only" -->
    <!-- เนื้อหาหน้าสอง -->
    <div class="header">
        <div class="header-address">
            <p style="font-size: 10pt; line-height: 0.8;">ศูนย์ทดสอบทางวิศวกรรมและห้องปฏิบัติการกลาง</p>
            <p style="font-size: 10pt; line-height: 0.8;">คณะวิศวกรรมศาสตร์และเทคโนโลยี มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน</p>
            <p style="font-size: 10pt; line-height: 0.8;">744 ถ.สุรนารายณ์ ต.ในเมือง อ.เมือง จ.นครราชสีมา</p>
            <p style="font-size: 10pt; line-height: 0.8;">โทร. 0-4423-3040 www.ect.fet.rmuti.ac.th</p>
        </div>
        <div style="text-align: center;"> <!-- เพิ่ม div นี้เพื่อจัดโลโก้ -->
            <img src="assets/img/FET_logo.png" alt="RMUTI logo" class="logo">
        </div>
        <div class="footer-address">
            <p style="font-size: 10pt; line-height: 0.8; margin-left: 180px;">ENGINEERING TESTING CENTER AND CENTRAL LABORATORY : ECT</p>
            <p style="font-size: 10pt; line-height: 0.8; margin-left: 180px;">RAJAMANGALA UNIVERSITY OF TECHNOLOGY ISAN</p>
            <p style="font-size: 10pt; line-height: 0.8; margin-left: 180px;">744 Suranarai Rd., Nai Muang, Muang, Nakhon Ratchasima 30000</p>
            <p style="font-size: 10pt; line-height: 0.8; margin-left: 180px;">Tel. 0-4423-3040 Fax 0-4423-3040 www.ect.fet.rmuti.ac.th</p>
        </div>
    </div>

    <div class="repair-form-title">
        <p style="font-weight: bold; font-size: 24pt; ">ใบขอใช้บริการซ่อมระบบสาธารณูปโภค ครุภัณฑ์</p>
    </div>

    

                                         <!-- ตารางรายงานปัญหา -->
        <table class="table table-bordered">
            <tr>
                <th style="text-align: center;">รายงานปัญหาที่พบ</th>
                <th style="text-align: center;">วิธีการแก้ไขปัญหา</th>
            </tr>
            <tr>
                <td style="vertical-align: top; padding: 10px;">
                    <textarea class="form-control" id="problem" name="problem" rows="5" style="width: 100%; resize: none;" readonly><?php echo htmlspecialchars($row['problem'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                </td>
                <td style="vertical-align: top; padding: 10px;">
                    <input type="checkbox" name="solution[]" value="จัดจ้างบริษัทผู้ผลิตมาซ่อม" <?php echo in_array('จัดจ้างบริษัทผู้ผลิตมาซ่อม', $solution) ? 'checked' : ''; ?> disabled> จัดจ้างบริษัทผู้ผลิตมาซ่อม<br>
                    <input type="checkbox" name="solution[]" value="จัดจ้างร้านค้า/บริษัทภายนอกมาซ่อม" <?php echo in_array('จัดจ้างร้านค้า/บริษัทภายนอกมาซ่อม', $solution) ? 'checked' : ''; ?> disabled> จัดจ้างร้านค้า/บริษัทภายนอกมาซ่อม<br>
                    <input type="checkbox" name="solution[]" value="จัดซื้อวัสดุมาดำเนินการซ่อมเอง" <?php echo in_array('จัดซื้อวัสดุมาดำเนินการซ่อมเอง', $solution) ? 'checked' : ''; ?> disabled> จัดซื้อวัสดุมาดำเนินการซ่อมเอง<br>
                    <input type="checkbox" name="solution[]" value="อื่นๆ" <?php echo in_array('อื่นๆ', $solution) ? 'checked' : ''; ?> disabled> อื่นๆ
                    <input type="text" class="form-control" id="solution_other" name="solution_other" placeholder="กรุณาระบุ" value="<?php echo in_array('อื่นๆ', $solution) ? $row['solution_other'] : ''; ?>" readonly>
                </td>
            </tr>
        </table>
                                <!-- วันที่ดำเนินการซ่อมแล้วเสร็จ -->
                                <div class="row input-group input-group-outline">
                                    <label class="col-form-label col-md-3 text-right" for="c_date">วันที่ดำเนินการซ่อมแล้วเสร็จ</label>
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" id="c_date" name="c_date" value="<?php echo $c_date; ?>" readonly>
                                    </div>
                                </div>
                                <br>

                                <!-- วัสดุ/อุปกรณ์ที่ใช้ -->
                                <div class="row">
                                    <div class="col-md-12">
                                    <h4>วัสดุ/อุปกรณ์ที่ใช้</h4>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ชื่อวัสดุ/อุปกรณ์</th>
                                                    <th>ขนาด</th>
                                                    <th>จำนวน</th>
                                                    <th>หน่วยนับ</th>
                                                    <th>หมายเหตุ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($material = mysqli_fetch_assoc($materialsQuery)) { ?>
                                                <tr>
                                                    <td><?php echo $material['material_name']; ?></td>
                                                    <td><?php echo $material['material_size']; ?></td>
                                                    <td><?php echo $material['material_quantity']; ?></td>
                                                    <td><?php echo $material['material_unit']; ?></td>
                                                    <td><?php echo $material['material_notes']; ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- ข้อมูลแบบสำรวจ -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>การประเมินความพึงพอใจ</h4>
                                        <?php if ($survey) { ?>
                                                <table class="table table-bordered" >
                                                    <thead>
                                                        <tr>
                                                            <th>หัวข้อการประเมิน</th>
                                                            <th>ดีเยี่ยม (5)</th>
                                                            <th>ดี (4)</th>
                                                            <th>พอใช้ (3)</th>
                                                            <th>ปรับปรุง (2)</th>
                                                            <th>ไม่พอใจ (1)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="font-size: 10pt;">การให้บริการของเจ้าหน้าที่ การให้คำแนะนำ การแต่งกาย กิริยามรรยาท อัธยาศัย ความเอาใจใส่</td>
                                                            <td ><input type="radio" disabled <?php if ($survey['service_rating'] == 5) echo 'checked'; ?>></td>
                                                            <td><input type="radio" disabled <?php if ($survey['service_rating'] == 4) echo 'checked'; ?>></td>
                                                            <td><input type="radio" disabled <?php if ($survey['service_rating'] == 3) echo 'checked'; ?>></td>
                                                            <td><input type="radio" disabled <?php if ($survey['service_rating'] == 2) echo 'checked'; ?>></td>
                                                            <td><input type="radio" disabled <?php if ($survey['service_rating'] == 1) echo 'checked'; ?>></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-size: 10pt;">ความเหมาะสมของขั้นตอนการให้บริการ ความสะดวก รวดเร็ว วิธีการให้บริการ ความชัดเจน</td>
                                                            <td><input type="radio" disabled <?php if ($survey['quality_rating'] == 5) echo 'checked'; ?>></td>
                                                            <td><input type="radio" disabled <?php if ($survey['quality_rating'] == 4) echo 'checked'; ?>></td>
                                                            <td><input type="radio" disabled <?php if ($survey['quality_rating'] == 3) echo 'checked'; ?>></td>
                                                            <td><input type="radio" disabled <?php if ($survey['quality_rating'] == 2) echo 'checked'; ?>></td>
                                                            <td><input type="radio" disabled <?php if ($survey['quality_rating'] == 1) echo 'checked'; ?>></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-size: 10pt;">ระยะเวลาในการดำเนินงาน</td>
                                                            <td><input type="radio" disabled <?php if ($survey['timeliness_rating'] == 5) echo 'checked'; ?>></td>
                                                            <td><input type="radio" disabled <?php if ($survey['timeliness_rating'] == 4) echo 'checked'; ?>></td>
                                                            <td><input type="radio" disabled <?php if ($survey['timeliness_rating'] == 3) echo 'checked'; ?>></td>
                                                            <td><input type="radio" disabled <?php if ($survey['timeliness_rating'] == 2) echo 'checked'; ?>></td>
                                                            <td><input type="radio" disabled <?php if ($survey['timeliness_rating'] == 1) echo 'checked'; ?>></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- ข้อเสนอแนะและวันที่ประเมิน -->
                                            <div class="row">
                                                <div class="row input-group input-group-outline">
                                                    <label class="col-form-label col-md-3 text-right">ข้อเสนอแนะ</label>
                                                    <div class="col-md-6">
                                                        <textarea class="form-control" rows="4" readonly><?php echo htmlspecialchars($survey['suggestions'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            



                                                <div class="row input-group input-group-outline">
                                                    <label class="col-form-label col-md-3 text-right">วันที่ประเมิน</label>
                                                     <div class="col-md-6">
                                                        <input type="date" class="form-control" value="<?php echo $survey['survey_date']; ?>" readonly>
                                                    </div>
                                                </div>
                                        <?php } else { ?>
                                            <p>ยังไม่มีการทำแบบสำรวจความพึงพอใจ</p>
                                        <?php } ?>
                                    </div>
                                </div>

</div>
</div>
</div>
</script>
</body>
</html>
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

// Fetch the repair report details
$rep_ID = $_GET['rep_ID'];
$sqlQuery = "SELECT * FROM tbl_repair WHERE rep_ID='$rep_ID'";
$query = mysqli_query($conn, $sqlQuery);
$row = mysqli_fetch_assoc($query);

$u_date = $row['u_date'];
$rep_status = $row['rep_status'];
$building_issue = explode(',', $row['building_issue']);
$building_location = $row['building_location'];
$electrical_issue = explode(',', $row['electrical_issue']);
$electrical_location = $row['electrical_location'];
$plumbing_issue = explode(',', $row['plumbing_issue']);
$plumbing_location = $row['plumbing_location'];
$aircon_issue = explode(',', $row['aircon_issue']);
$aircon_equipment_no = $row['aircon_equipment_no'];
$aircon_location = $row['aircon_location'];
$other_issue = $row['other_issue'];
$other_equipment_no = $row['other_equipment_no'];
$other_location = $row['other_location'];
$rep_no = $row['rep_no'];
$building_other = $row['building_other'];
$electrical_other = $row['electrical_other'];
$plumbing_other = $row['plumbing_other'];
$aircon_other = $row['aircon_other'];

?>
<style>
    .select-arrow {
        position: relative;
        width: 100%;
    }

    .select-arrow:after {
        content: '▼';
        font-size: 12px;
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .form-control {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        position: relative;
        background-color: transparent;
    }
</style>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดการซ่อม</title>
    <!-- Include your CSS and JS files here -->
    <style>
        .section-title {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        .block-header h5 {
            font-size: 1.2rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }
        .card {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #fff;
        }
        .form-control[readonly] {
            background-color: #f1f1f1;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>

<?php 
$statuslist = array(
    '-2' => "รอการอนุมัติ",
    '-1' => "ไม่อนุมัติ",
    '0' => "อนุมัติแล้ว",
    '1' => "อยู่ระหว่างดำเนินการซ่อม",
    '2' => "เสร็จสิ้นการซ่อม"
);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลการซ่อม</title>
    <!-- Include your CSS and JS files here -->
</head>
<body>
<?php include("menu.php"); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>เพิ่มข้อมูลการซ่อม</h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                    แบบฟอร์มการขอใช้บริการ ซ่อมแซมอาคารสถานที่ และครุภัณฑ์
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form name="repairAdd" class="col-12" action="repairInsert.php" method="POST" enctype="multipart/form-data">
                                <!-- Display report data -->

                                <br>
                            <div class="block-header section-title">
                                รายละเอียดการแจ้งซ่อม
                            </div>

                                  
                                <!-- เลขที่(rep_no) -->
                                <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right" for="rep_no">เลขที่</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="rep_no" name="rep_no" value="<?php echo $rep_no; ?>" readonly>
                                        </div>
                                    </div>
                                    <br>

                                <!-- วันที่แจ้งซ่อม -->
                                <div class="row input-group input-group-outline">
                                    <label class="col-form-label col-md-3 text-right" for="u_date">วันที่แจ้งซ่อม</label>
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" id="u_date" name="u_date" value="<?php echo $u_date; ?>" readonly>
                                    </div>
                                </div>
                                <br>

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
                            <div class="block-header section-title">
                                รายละเอียดการซ่อม
                            </div>


                                <br>
                                <div class="row input-group input-group-outline">
                                    <label class="col-form-label col-md-3 text-right" for="rep_status">สถานะการซ่อม</label>
                                    <div class="col-md-6">
                                        <div class="select-arrow">
                                            <select class="form-control" name="rep_status" id="rep_status" required="required">
                                                <?php  
                                                foreach ($statuslist as $key => $value) {
                                                    // ตรวจสอบว่าค่าของ rep_status ตรงกับ key หรือไม่
                                                    $selected = ((string)$report['rep_status'] === $key) ? 'selected' : '';
                                                    echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
                                                }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>


                                <input type="hidden" name="rep_ID" value="<?php echo $rep_ID; ?>">

                                <?php include_once("repairForm.php"); ?>

                                <br>
                                <div class="col-md-10 text-center">
                                    <button type="submit" class="btn btn-success" onclick="return confirmEdit();"> บันทึก</button>
                                    <button type="reset" class="btn btn-warning"> ล้างข้อมูล</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>

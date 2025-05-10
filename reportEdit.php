
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");
include("menu.php");


// ป้องกัน SQL Injection
$rep_ID = mysqli_real_escape_string($conn, $_GET['rep_ID']);

// ดึงข้อมูลการแจ้งซ่อม
$sqlQuery = "SELECT * FROM tbl_repair WHERE rep_ID='$rep_ID'";
$query = mysqli_query($conn, $sqlQuery);

// ตรวจสอบผลลัพธ์จากการดึงข้อมูล
if ($query && mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);

    $u_date = $row['u_date'];
    $rep_status = $row['rep_status'];

    // ตรวจสอบข้อมูลที่ได้รับเพื่อหลีกเลี่ยงข้อผิดพลาด
    $building_issue = isset($row['building_issue']) ? explode(',', $row['building_issue']) : [];
    $building_location = $row['building_location'];
    $building_other = isset($row['building_other']) ? $row['building_other'] : '';


    $electrical_issue = isset($row['electrical_issue']) ? explode(',', $row['electrical_issue']) : [];
    $electrical_location = $row['electrical_location'];
    $electrical_other = isset($row['electrical_other']) ? $row['electrical_other'] : '';

    $plumbing_issue = isset($row['plumbing_issue']) ? explode(',', $row['plumbing_issue']) : [];
    $plumbing_location = $row['plumbing_location'];
    $plumbing_other = isset($row['plumbing_other']) ? $row['plumbing_other'] : '';

    $aircon_issue = isset($row['aircon_issue']) ? explode(',', $row['aircon_issue']) : [];
    $aircon_equipment_no = $row['aircon_equipment_no'];
    $aircon_location = $row['aircon_location'];
    $aircon_other = isset($row['aircon_other']) ? $row['aircon_other'] : '';

    $other_issue = $row['other_issue'];
    $other_equipment_no = $row['other_equipment_no'];
    $other_location = $row['other_location'];
} else {
    // กรณีไม่พบข้อมูล
    echo "ไม่พบข้อมูลการแจ้งซ่อม";
    // คุณสามารถจัดการหรือส่งกลับข้อความผิดพลาดที่เหมาะสมที่นี่
}
?>

<script>
function toggleOtherDetail(checkboxId, inputId) {
    const otherCheckbox = document.getElementById(checkboxId);
    const otherDetailInput = document.getElementById(inputId);
    
    if (otherCheckbox.checked) {
        otherDetailInput.style.display = 'block'; // แสดงช่องกรอกข้อมูลเมื่อเลือก "อื่นๆ"
    } else {
        otherDetailInput.style.display = 'none'; // ซ่อนช่องกรอกข้อมูลเมื่อไม่เลือก
        otherDetailInput.value = ''; // ล้างค่าเมื่อซ่อน
    }
}
</script>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลการแจ้งซ่อม</title>
    <!-- Include your CSS and JS files here -->
</head>
<body>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>แก้ไขข้อมูลการแจ้งซ่อม</h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        แบบฟอร์มการขอใช้บริการ ซ่อมแซมอาคารสถานที่ และครุภัณฑ์
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form name="reportUpdate" class="col-12" action="reportUpdate.php?rep_ID=<?php echo $rep_ID; ?>" method="POST" enctype="multipart/form-data">

                                <!-- วันที่แจ้งซ่อม -->
                                <div class="row input-group input-group-outline">
                                    <label class="col-form-label col-md-3 text-right" for="u_date">วันที่แจ้งซ่อม <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" id="u_date" name="u_date" value="<?php echo $u_date; ?>" required>
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
                                                <input type="checkbox" id="door" name="building_issue[]" value="ประตู" <?php echo (in_array('ประตู', $building_issue)) ? 'checked' : ''; ?>> ประตู
                                                <input type="checkbox" id="window" name="building_issue[]" value="หน้าต่าง" <?php echo (in_array('หน้าต่าง', $building_issue)) ? 'checked' : ''; ?>> หน้าต่าง
                                                <input type="checkbox" id="floor" name="building_issue[]" value="พื้น" <?php echo (in_array('พื้น', $building_issue)) ? 'checked' : ''; ?>> พื้น
                                                <input type="checkbox" id="wall" name="building_issue[]" value="ผนัง" <?php echo (in_array('ผนัง', $building_issue)) ? 'checked' : ''; ?>> ผนัง
                                                <input type="checkbox" id="pillar" name="building_issue[]" value="เสา" <?php echo (in_array('เสา', $building_issue)) ? 'checked' : ''; ?>> เสา
                                                <input type="checkbox" id="roof" name="building_issue[]" value="หลังคา" <?php echo (in_array('หลังคา', $building_issue)) ? 'checked' : ''; ?>> หลังคา<br>
                                                <input type="checkbox" id="building_other_checkbox" name="building_issue[]" value="อื่นๆ" <?php echo (in_array('อื่นๆ', $building_issue)) ? 'checked' : ''; ?> onchange="toggleOtherDetail('building_other_checkbox', 'building_other_detail')"> อื่นๆ
                                                <input type="text" class="form-control" id="building_other_detail" name="building_other" placeholder="กรุณาระบุ" value="<?php echo htmlspecialchars($building_other, ENT_QUOTES, 'UTF-8'); ?>" style="display: none;">
                                                </div>
                                        </div>
                                    </div>
                                    <br>

                                        <!-- กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)(อาคารสถานที่) -->
                                        <div class="row input-group input-group-outline">
                                            <label class="col-form-label col-md-3 text-right">กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)</label>
                                            <div class="col-md-6">
                                                <textarea class="form-control" id="building_location" name="building_location" placeholder="กรุณาระบุรายละเอียดสถานที่ให้ครบถ้วน (อาการ/สถานที่/อาคาร/ชั้น/ห้อง)" rows="4" style="resize: vertical;"><?php echo htmlspecialchars($building_location, ENT_QUOTES, 'UTF-8'); ?></textarea>
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
                                                <input type="checkbox" id="switch" name="electrical_issue[]" value="สวิทซ์" <?php echo (in_array('สวิทซ์', $electrical_issue)) ? 'checked' : ''; ?>> สวิทซ์
                                                <input type="checkbox" id="plug" name="electrical_issue[]" value="ปลั๊ก" <?php echo (in_array('ปลั๊ก', $electrical_issue)) ? 'checked' : ''; ?>> ปลั๊ก
                                                <input type="checkbox" id="lightbulb" name="electrical_issue[]" value="หลอดไฟ" <?php echo (in_array('หลอดไฟ', $electrical_issue)) ? 'checked' : ''; ?>> หลอดไฟ
                                                <input type="checkbox" id="wiring" name="electrical_issue[]" value="สายไฟ" <?php echo (in_array('สายไฟ', $electrical_issue)) ? 'checked' : ''; ?>> สายไฟ
                                                <input type="checkbox" id="control_box" name="electrical_issue[]" value="ตู้ควบคุม" <?php echo (in_array('ตู้ควบคุม', $electrical_issue)) ? 'checked' : ''; ?>> ตู้ควบคุม<br>
                                                <input type="checkbox" id="electrical_other_checkbox" name="electrical_issue[]" value="อื่นๆ" <?php echo (in_array('อื่นๆ', $electrical_issue)) ? 'checked' : ''; ?> onchange="toggleOtherDetail('electrical_other_checkbox', 'electrical_other_detail')"> อื่นๆ
                                                <input type="text" class="form-control" id="electrical_other_detail" name="electrical_other" placeholder="กรุณาระบุ" value="<?php echo htmlspecialchars($electrical_other, ENT_QUOTES, 'UTF-8'); ?>" style="display: none;">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <!-- กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง) (ระบบไฟฟ้า) -->
                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" id="electrical_location" name="electrical_location" placeholder="กรุณาระบุ" rows="4" style="resize: vertical;"><?php echo (in_array('อื่นๆ', $electrical_issue)) ? htmlspecialchars($row['electrical_location'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
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
                                            <div>
                                                <input type="checkbox" id="hydrant" name="plumbing_issue[]" value="ก๊อกน้ำ" <?php echo (in_array('ก๊อกน้ำ', $plumbing_issue)) ? 'checked' : ''; ?>> ก๊อกน้ำ
                                                <input type="checkbox" id="Bileduct" name="plumbing_issue[]" value="ท่อน้ำดี" <?php echo (in_array('ท่อน้ำดี', $plumbing_issue)) ? 'checked' : ''; ?>> ท่อน้ำดี
                                                <input type="checkbox" id="Wastewaterpipe" name="plumbing_issue[]" value="ท่อน้ำเสีย" <?php echo (in_array('ท่อน้ำเสีย', $plumbing_issue)) ? 'checked' : ''; ?>> ท่อน้ำเสีย
                                                <input type="checkbox" id="Bidethose" name="plumbing_issue[]" value="สายชำระ" <?php echo (in_array('สายชำระ', $plumbing_issue)) ? 'checked' : ''; ?>> สายชำระ
                                                <input type="checkbox" id="flushtoilet" name="plumbing_issue[]" value="ชักโครก" <?php echo (in_array('ชักโครก', $plumbing_issue)) ? 'checked' : ''; ?>> ชักโครก
                                                <input type="checkbox" id="Urinal" name="plumbing_issue[]" value="โถปัสสาวะ" <?php echo (in_array('โถปัสสาวะ', $plumbing_issue)) ? 'checked' : ''; ?>> โถปัสสาวะ<br>
                                                <input type="checkbox" id="plumbing_other_checkbox" name="plumbing_issue[]" value="อื่นๆ" <?php echo (in_array('อื่นๆ', $plumbing_issue)) ? 'checked' : ''; ?> onchange="toggleOtherDetail('plumbing_other_checkbox', 'plumbing_other_detail')"> อื่นๆ
                                                <input type="text" class="form-control" id="plumbing_other_detail" name="plumbing_other" placeholder="กรุณาระบุ" value="<?php echo htmlspecialchars($plumbing_other, ENT_QUOTES, 'UTF-8'); ?>" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                <!-- กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง) (ระบบประปา) -->
                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" id="plumbing_location" name="plumbing_location" rows="4" style="resize: vertical;"><?php echo htmlspecialchars($plumbing_location, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>


                                <!-- ระบบปรับอากาศ -->
                                <?php if (!empty($aircon_issue) && !empty(array_filter($aircon_issue))) { ?>
                                <div id="aircon_details" class="issue-details">
                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">004 ปัญหาระบบปรับอากาศ</label>
                                        <div class="col-md-6">
                                            <div>
                                                <input type="checkbox" id="Can't_turn_on" name="aircon_issue[]" value="เปิดไม่ติด" <?php echo (in_array('เปิดไม่ติด', $aircon_issue)) ? 'checked' : ''; ?>> เปิดไม่ติด
                                                <input type="checkbox" id="not_cool" name="aircon_issue[]" value="แอร์ไม่เย็น" <?php echo (in_array('แอร์ไม่เย็น', $aircon_issue)) ? 'checked' : ''; ?>> แอร์ไม่เย็น
                                                <input type="checkbox" id="loud" name="aircon_issue[]" value="เสียงดัง" <?php echo (in_array('เสียงดัง', $aircon_issue)) ? 'checked' : ''; ?>> เสียงดัง
                                                <input type="checkbox" id="Drop" name="aircon_issue[]" value="น้ำหยด" <?php echo (in_array('น้ำหยด', $aircon_issue)) ? 'checked' : ''; ?>> น้ำหยด
                                                <input type="checkbox" id="remote_broken" name="aircon_issue[]" value="รีโมทชำรุด" <?php echo (in_array('รีโมทชำรุด', $aircon_issue)) ? 'checked' : ''; ?>> รีโมทชำรุด<br>
                                                <input type="checkbox" id="aircon_other_checkbox" name="aircon_issue[]" value="อื่นๆ" <?php echo (in_array('อื่นๆ', $aircon_issue)) ? 'checked' : ''; ?> onchange="toggleOtherDetail('aircon_other_checkbox', 'aircon_other_detail')" > อื่นๆ
                                                <input type="text" class="form-control" id="aircon_other_detail" name="aircon_other" placeholder="กรุณาระบุ" value="<?php echo htmlspecialchars($aircon_other, ENT_QUOTES, 'UTF-8'); ?>" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <!-- กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง) (ระบบปรับอากาศ) -->
                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" id="aircon_location" name="aircon_location" rows="4" style="resize: vertical;"><?php echo htmlspecialchars($aircon_location, ENT_QUOTES, 'UTF-8'); ?></textarea>
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
                                            <input type="text" class="form-control" id="other_issue" name="other_issue" value="<?php echo htmlspecialchars($other_issue, ENT_QUOTES, 'UTF-8'); ?>">
                                        </div>
                                    </div>
                                    <br>

                                    <!-- กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง) (งานครุภัณฑ์อื่นๆ) -->
                                    <div class="row input-group input-group-outline">
                                        <label class="col-form-label col-md-3 text-right">กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" id="other_location" name="other_location" rows="4" style="resize: vertical;"><?php echo htmlspecialchars($other_location, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>


                             

                                <!-- ปุ่มบันทึก -->
                                <br>
                                <div class="row input-group input-group-outline">
                                    <div class="col-md-6 offset-md-3">
                                        <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include your JS here -->
</body>
</html>

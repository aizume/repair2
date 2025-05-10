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


<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="u_date">วันที่แจ้งซ่อม <span class="text-danger">*</span></label>
    <div class="col-md-6">
        <input type="date" class="form-control" id="u_date" name="u_date" required="required">
    </div>
</div>
<br>



<!-- เลือกประเภทปัญหา -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="issue_type">เลือกประเภทปัญหา</label>
    <div class="col-md-6">
        <div class="select-arrow">
            <select class="form-control" id="issue_type" name="issue_type" onchange="showIssueDetails()">
                <option value="">-- เลือกประเภทปัญหา --</option>
                <option value="building">001 ปัญหาอาคารสถานที่</option>
                <option value="electrical">002 ปัญหาระบบไฟฟ้า</option>
                <option value="plumbing">003 ปัญหาระบบประปา/สุขาภิบาล</option>
                <option value="aircon">004 ปัญหาระบบเครื่องปรับอากาศ</option>
                <option value="other">005 งานครุภัณฑ์อื่นๆ</option>
            </select>
        </div>
    </div>
</div>
<br>


<!-- ปัญหาอาคารสถานที่ -->
<div id="building_details" class="issue-details" style="display:none;">    
    <div class="row input-group input-group-outline">
        <label class="col-form-label col-md-3 text-right">001 ปัญหาอาคารสถานที่</label>
        <div class="col-md-6">
            <div>
                <input type="checkbox" id="door" name="building_issue[]" value="ประตู"> ประตู
                <input type="checkbox" id="window" name="building_issue[]" value="หน้าต่าง"> หน้าต่าง
                <input type="checkbox" id="floor" name="building_issue[]" value="พื้น"> พื้น
                <input type="checkbox" id="wall" name="building_issue[]" value="ผนัง"> ผนัง
                <input type="checkbox" id="pillar" name="building_issue[]" value="เสา"> เสา
                <input type="checkbox" id="roof" name="building_issue[]" value="หลังคา"> หลังคา<br>

                <input type="checkbox" id="building_other_checkbox" name="building_issue[]" value="อื่นๆ" onchange="toggleOtherDetail('building_other_checkbox', 'building_other_detail')"> อื่นๆ
                <input type="text" class="form-control" id="building_other_detail" name="building_other" placeholder="กรุณาระบุ" style="display: none;"><br>
            </div>
        </div>
    </div>
    <div class="row input-group input-group-outline">
        <label class="col-form-label col-md-3 text-right">กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)</label>
        <div class="col-md-6">
            <textarea class="form-control" id="building_location" name="building_location" placeholder="กรุณากรอกข้อมูลให้ครบถ้วน" rows="4" style="resize: vertical;"></textarea>
        </div>
    </div>
</div>


<!-- ปัญหาระบบไฟฟ้า -->
<div id="electrical_details" class="issue-details" style="display:none;"> 
    <div class="row input-group input-group-outline">
        <label class="col-form-label col-md-3 text-right">002 ปัญหาระบบไฟฟ้า</label>
        <div class="col-md-6">
            <div>
                <input type="checkbox" id="switch" name="electrical_issue[]" value="สวิทซ์"> สวิทซ์
                <input type="checkbox" id="plug" name="electrical_issue[]" value="ปลั๊ก"> ปลั๊ก
                <input type="checkbox" id="light" name="electrical_issue[]" value="หลอดไฟ"> หลอดไฟ
                <input type="checkbox" id="wire" name="electrical_issue[]" value="สายไฟ"> สายไฟ
                <input type="checkbox" id="control_box" name="electrical_issue[]" value="ตู้ควบคุม"> ตู้ควบคุม<br>

                <input type="checkbox" id="electrical_other_checkbox" name="electrical_issue[]" value="อื่นๆ" onchange="toggleOtherDetail('electrical_other_checkbox', 'electrical_other_detail')"> อื่นๆ
                <input type="text" class="form-control" id="electrical_other_detail" name="electrical_other" placeholder="กรุณาระบุ" style="display: none;"><br>
            </div>
        </div>
    </div>
    <div class="row input-group input-group-outline">
        <label class="col-form-label col-md-3 text-right">กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)</label>
        <div class="col-md-6">
            <textarea class="form-control" id="electrical_location" name="electrical_location" placeholder="กรุณากรอกข้อมูลให้ครบถ้วน" rows="4" style="resize: vertical;"></textarea>
        </div>
    </div>
</div>

<!-- ปัญหาระบบประปา/สุขาภิบาล -->
<div id="plumbing_details" class="issue-details" style="display:none;"> 
    <div class="row input-group input-group-outline">
        <label class="col-form-label col-md-3 text-right">003 ปัญหาระบบประปา/สุขาภิบาล</label>
        <div class="col-md-6">
            <div>
                <input type="checkbox" id="faucet" name="plumbing_issue[]" value="ก๊อกน้ำ"> ก๊อกน้ำ
                <input type="checkbox" id="water_pipe" name="plumbing_issue[]" value="ท่อน้ำดี"> ท่อน้ำดี
                <input type="checkbox" id="drain_pipe" name="plumbing_issue[]" value="ท่อน้ำเสีย"> ท่อน้ำเสีย
                <input type="checkbox" id="spray" name="plumbing_issue[]" value="สายชำระ"> สายชำระ
                <input type="checkbox" id="toilet" name="plumbing_issue[]" value="ชักโครก"> ชักโครก
                <input type="checkbox" id="urinal" name="plumbing_issue[]" value="โถปัสสาวะ"> โถปัสสาวะ<br>
                <input type="checkbox" id="plumbing_other_checkbox" name="plumbing_issue[]" value="อื่นๆ" onchange="toggleOtherDetail('plumbing_other_checkbox', 'plumbing_other_detail')"> อื่นๆ
                <input type="text" class="form-control" id="plumbing_other_detail" name="plumbing_other" placeholder="กรุณาระบุ" style="display: none;"><br>
            </div>
        </div>
    </div>
        <div class="row input-group input-group-outline">
        <label class="col-form-label col-md-3 text-right">กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)</label>
            <div class="col-md-6">
                <textarea class="form-control" id="plumbing_location" name="plumbing_location" placeholder="กรุณากรอกข้อมูลให้ครบถ้วน" rows="4" style="resize: vertical;"></textarea>
        </div>
    </div>
</div>




<!-- ปัญหาระบบเครื่องปรับอากาศ -->
<div id="aircon_details" class="issue-details" style="display:none;"> 
    <div class="row input-group input-group-outline">
        <label class="col-form-label col-md-3 text-right">004 ปัญหาระบบเครื่องปรับอากาศ</label>
        <div class="col-md-6">
            <div>
                <input type="checkbox" id="not_working" name="aircon_issue[]" value="เปิดไม่ติด"> เปิดไม่ติด
                <input type="checkbox" id="not_cold" name="aircon_issue[]" value="แอร์ไม่เย็น"> แอร์ไม่เย็น
                <input type="checkbox" id="noisy" name="aircon_issue[]" value="เสียงดัง"> เสียงดัง
                <input type="checkbox" id="dripping" name="aircon_issue[]" value="น้ำหยด"> น้ำหยด
                <input type="checkbox" id="remote_broken" name="aircon_issue[]" value="รีโมทชำรุด"> รีโมทชำรุด<br>
                <input type="checkbox" id="aircon_other_checkbox" name="aircon_issue[]" value="อื่นๆ" onchange="toggleOtherDetail('aircon_other_checkbox', 'aircon_other_detail')"> อื่นๆ
                <input type="text" class="form-control" id="aircon_other_detail" name="aircon_other" placeholder="กรุณาระบุ" style="display: none;"><br>
            </div>
        </div>
    </div>

    <div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right">หมายเลขครุภัณฑ์</label>
        <div class="col-md-6">
        <input type="text" class="form-control" id="aircon_equipment_no" name="aircon_equipment_no" placeholder="หมายเลขครุภัณฑ์">
        </div>
    </div>
    <div class="row input-group input-group-outline">
        <label class="col-form-label col-md-3 text-right">กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)</label>
            <div class="col-md-6">
                <textarea class="form-control" id="aircon_location" name="aircon_location" placeholder="กรุณากรอกข้อมูลให้ครบถ้วน" rows="4" style="resize: vertical;"></textarea>
            </div>
    </div>
</div>



<!-- งานครุภัณฑ์อื่นๆ -->
<div id="other_details" class="issue-details" style="display:none;"> 
    <div class="row input-group input-group-outline">
        <label class="col-form-label col-md-3 text-right">005 งานครุภัณฑ์อื่นๆ</label>
        <div class="col-md-6">
            <input type="text" class="form-control" id="other_issue" name="other_issue" placeholder="กรุณาระบุ"><br>
        </div>
    </div>
    <div class="row input-group input-group-outline">
        <label class="col-form-label col-md-3 text-right">หมายเลขครุภัณฑ์</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="other_equipment_no" name="other_equipment_no" placeholder="หมายเลขครุภัณฑ์">
            </div>
    </div>
    <div class="row input-group input-group-outline">
        <label class="col-form-label col-md-3 text-right">กรุณากรอกข้อมูลให้ครบถ้วน<br>(อาการ/สถานที่/อาคาร/ชั้น/ห้อง)</label>
            <div class="col-md-6">
                <textarea class="form-control" id="other_location" name="other_location" placeholder="กรุณากรอกข้อมูลให้ครบถ้วน" rows="4" style="resize: vertical;"></textarea>
            </div>
    </div>
</div>



<br>
<?php if ($_SESSION["per_type"] != 3) { ?>
    <div class="row input-group input-group-outline">
        <label class="col-form-label col-md-3 text-right" for="rep_status">สถานะการซ่อม</label>
        <div class="col-md-6">
            <div class="select-arrow">
                <select class="form-control" name="rep_status" id="rep_status">
                    <?php  
                        $statuslist
                        = array('-2' => "รอการอนุมัติ");
                        foreach ($statuslist as $key => $value) {
                            $selected = (isset($rep_status) && $rep_status == $key) ? 'selected' : '';
                            echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <br>

<?php } ?>
<script>
    function setDefaultDate() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('u_date').value = today;
    }

    window.onload = setDefaultDate;

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('image_preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>


<script>
    function showIssueDetails() {
        // ซ่อนทุกรายละเอียด
        var issueSections = document.querySelectorAll('.issue-details');
        issueSections.forEach(function (section) {
            section.style.display = 'none';
        });

        // แสดงเฉพาะรายละเอียดของประเภทปัญหาที่เลือก
        var selectedIssue = document.getElementById('issue_type').value;
        if (selectedIssue) {
            document.getElementById(selectedIssue + '_details').style.display = 'block';
        }
    }

    // ตั้งค่าวันที่ปัจจุบันเมื่อเปิดฟอร์ม
    function setDefaultDate() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('u_date').value = today;
    }

    window.onload = setDefaultDate;
</script>
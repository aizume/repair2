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



<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="rep_id">เลือกข้อมูลการแจ้งซ่อม <br> (เลือกจากการซ่อมที่อนุมัติแล้ว)<span class="text-danger">*</span></label>
    <div class="col-md-6">
        <select class="form-control select-arrow" id="rep_id" name="rep_id" required onchange="updateRepairDetails()">
            <option value="">-- เลือกข้อมูลการแจ้งซ่อม --</option>
            <?php
            $sql = "SELECT r.rep_ID, r.u_date,r.rep_no, p.per_name, p.per_lastname 
                    FROM tbl_repair r 
                    LEFT JOIN tbl_personnel p ON r.per_id = p.per_id 
                    WHERE r.rep_status = 0"; // เลือกเฉพาะการซ่อมที่อนุมัติแล้ว
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['rep_ID'] . "'>" . $row['rep_no'] . " - " . $row['u_date'] . " - " . $row['per_name'] . " " . $row['per_lastname'] . "</option>";
                }
            } else {
                echo "<option value=''>ไม่มีข้อมูลการซ่อม</option>";
            }
            ?>
        </select>
    </div>
</div>
<br>
<br>

<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="repair_details">รายละเอียดการแจ้งซ่อม:</label>
    <div class="col-md-6">
        <div id="repair_details" class="form-control" readonly></div>
    </div>
</div>

<script>
    function updateRepairDetails() {
        var rep_id = document.getElementById("rep_id").value;
        if (rep_id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("repair_details").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "getRepairDetails.php?rep_id=" + rep_id, true);
            xhttp.send();
        } else {
            document.getElementById("repair_details").innerHTML = "";
        }
    }
</script>
<br>

<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right">หัวข้อ</label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="sch_topic" name="sch_topic" placeholder="เช่น ไปซ่อมเครื่องปรับอากาศ">
    </div>
</div>
<br>

<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="sch_date">วันที่ดำเนินการ<span class="text-danger">*</span></label>
    <div class="col-md-6">
        <input type="date" class="form-control" id="sch_date" name="sch_date" required>
    </div>
</div>
<br>

<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="sch_time">เวลาที่ดำเนินการ<span class="text-danger">*</span></label>
    <div class="col-md-6">
        <input type="time" class="form-control" id="sch_time" name="sch_time" required>
    </div>
</div>
<br>


<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="per_id">เลือกผู้ปฏิบัติงานซ่อมบำรุง<span class="text-danger">*</span></label>
    <div class="col-md-6">
        <select class="form-control select-arrow" id="per_id" name="per_id" required>
            <?php
            // ดึงข้อมูลช่างซ่อม พร้อมตำแหน่งและสาขา
            $sql = "SELECT p.per_id, p.per_name, p.per_lastname, pos.position_name, dept.deptname
                    FROM tbl_personnel AS p
                    LEFT JOIN tbl_position AS pos ON p.position_id = pos.position_id
                    LEFT JOIN tbl_department AS dept ON p.deptid = dept.deptid
                    WHERE p.per_type = 2";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $selected = isset($schedule['per_id']) && $schedule['per_id'] == $row['per_id'] ? 'selected' : '';
                    // แสดง ชื่อ-สกุล ตามด้วยตำแหน่งและสาขา
                    echo "<option value='" . $row['per_id'] . "' $selected>" 
                        . $row['per_name'] . " " . $row['per_lastname'] 
                        . " - " . $row['position_name'] 
                        . " (" . $row['deptname'] . ")</option>";
                }
            } else {
                echo "<option value=''>ไม่มีช่างซ่อม</option>";
            }
            ?>
        </select>
    </div>
</div>
<br>

<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="details">รายละเอียดเบื้องต้น</label>
    <div class="col-md-6">
        <textarea class="form-control" id="details" name="details" rows="4"><?php echo isset($details) ? htmlspecialchars($details) : ''; ?></textarea>
    </div>
</div>
<br>
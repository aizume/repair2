<?php
// สมมุติว่าผู้ใช้งานที่ล็อกอินอยู่มีข้อมูลใน session
$loggedInUserId = $_SESSION['per_id']; // รหัสผู้ใช้งานที่ล็อกอินอยู่
?>

<!-- ฟอร์มสำหรับการอนุมัติ -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right">สถานะการอนุมัติ</label>
    <div class="col-md-6">
        <select class="form-control" id="approval_status" name="approval_status" onchange="toggleApprovalComment()">
            <option value="">-- เลือกสถานะ --</option>
            <option value="อนุมัติ">อนุมัติ</option>
            <option value="ไม่อนุมัติ">ไม่อนุมัติ</option>
        </select>
    </div>
</div>
<br>

<!-- ฟอร์มสำหรับความคิดเห็นเมื่อไม่อนุมัติ -->
<div class="row input-group input-group-outline" id="approval_comment_row" >
    <label class="col-form-label col-md-3 text-right">ความคิดเห็น (กรณีไม่อนุมัติ)</label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="approval_comment" name="approval_comment" placeholder="กรอกความคิดเห็น">
    </div>
</div>
<br>

<!-- ฟอร์มสำหรับผู้อนุมัติ -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right">ผู้อนุมัติ</label>
    <div class="col-md-6">
        <select class="form-control" id="approved_by" name="approved_by">
            <option value="">-- เลือกผู้อนุมัติ --</option>
            <?php
            // ดึงข้อมูลจากตาราง tbl_personnel
            $query = "SELECT per_id, per_name, per_lastname FROM tbl_personnel WHERE per_type = 4"; // แก้เป็น per_type = 4 เพื่อกำหนดให้ดึงเฉพาะผู้ที่เป็นหัวหน้า
            $result = mysqli_query($conn, $query);

            // แสดงชื่อและนามสกุลใน select box และเลือก Default เป็นผู้ล็อกอิน
            while ($row = mysqli_fetch_assoc($result)) {
                $selected = ($row['per_id'] == $loggedInUserId) ? 'selected' : ''; // ถ้า per_id ตรงกับผู้ล็อกอินให้ selected
                echo '<option value="' . $row['per_id'] . '" ' . $selected . '>' . $row['per_name'] . ' ' . $row['per_lastname'] . '</option>';
            }
            ?>
        </select>
    </div>
</div>


<!-- ฟอร์มสำหรับวันที่อนุมัติ -->

<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="approved_date">วันที่อนุมัติ <span class="text-danger">*</span></label>
    <div class="col-md-6">
        <input type="date" class="form-control" id="approved_date" name="approved_date" required="required">
    </div>
</div>

<script>
    function setDefaultDate() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('approved_date').value = today;
    }

    window.onload = setDefaultDate;
</script>


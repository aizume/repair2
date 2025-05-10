<!-- ฟอร์มสำหรับเลขที่ซ่อม -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right">เลขที่ซ่อม</label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="rep_no" name="rep_no" value="<?php echo isset($rep_no) ? $rep_no : ''; ?>" placeholder="เช่น 001/67">
    </div>
</div>
<br>




<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right">รายงานปัญหาที่พบ</label>
    <div class="col-md-6">
        <textarea class="form-control" id="problem" name="problem" placeholder="รายงานปัญหาที่พบ" rows="4" style="resize: vertical;"></textarea>
    </div>
</div>
<br>

<!-- วิธีการแก้ไขปัญหา -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right">วิธีการแก้ไขปัญหา</label>
    <div class="col-md-6">
        <div>
            <input type="radio" id="door" name="solution" value="จัดจ้างบริษัทผู้ผลิตมาซ่อม"> จัดจ้างบริษัทผู้ผลิตมาซ่อม<br>
            <input type="radio" id="window" name="solution" value="จัดจ้างร้านค้า/บริษัทภายนอกมาซ่อม"> จัดจ้างร้านค้า/บริษัทภายนอกมาซ่อม<br>
            <input type="radio" id="floor" name="solution" value="จัดซื้อวัสดุมาดำเนินการซ่อมเอง"> จัดซื้อวัสดุมาดำเนินการซ่อมเอง<br>
            <input type="radio" id="solution_other" name="solution" value="อื่นๆ"> อื่นๆ
            <input type="text" class="form-control" id="solution_other_text" name="solution_other" placeholder="กรุณาระบุ">
        </div>
    </div>
</div>
<br>


<!-- ฟอร์มใส่วัสดุ/อุปกรณ์ที่ใช้ -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right">วัสดุ/อุปกรณ์ที่ใช้</label>
    <div class="col-md-9">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>ลำดับที่</th>
                    <th>รายการ</th>
                    <th>ขนาด</th>
                    <th>จำนวน</th>
                    <th>หน่วยนับ</th>
                    <th>หมายเหตุ</th>
                    <th>
                        <!-- ปุ่มเพิ่มอยู่ตรงกลาง -->
                        <button type="button" class="btn btn-success" onclick="addMaterialRow()">เพิ่ม</button>
                    </th>
                </tr>
            </thead>
            <tbody id="materialTableBody">
                <tr>
                    <td>1</td>
                    <td><input type="text" name="material_name[]" class="form-control" placeholder="ชื่อวัสดุ/อุปกรณ์"></td>
                    <td><input type="text" name="material_size[]" class="form-control" placeholder="ขนาดวัสดุ/อุปกรณ์"></td>
                    <td><input type="number" name="material_quantity[]" step="0.01" class="form-control" placeholder="จำนวน"></td>
                    <td><input type="text" name="material_unit[]" class="form-control" placeholder="หน่วยนับ"></td>
                    <td><input type="text" name="material_notes[]" class="form-control" placeholder="หมายเหตุ"></td>
                    <td><button type="button" class="btn btn-danger" onclick="removeMaterialRow(this)">ลบ</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    .table th, .table td {
        vertical-align: middle;
        text-align: center; /* จัดข้อความในตารางให้อยู่ตรงกลาง */
    }

    .table .btn-success {
        display: block;
        margin: 0 auto; /* จัดปุ่มเพิ่มให้อยู่ตรงกลาง */
    }
</style>

<script>
    let materialRowIndex = 2;

    function addMaterialRow() {
        const tableBody = document.getElementById('materialTableBody');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>${materialRowIndex}</td>
            <td><input type="text" name="material_name[]" class="form-control" placeholder="ชื่อวัสดุ/อุปกรณ์"></td>
            <td><input type="text" name="material_size[]" class="form-control" placeholder="ขนาดวัสดุ/อุปกรณ์"></td>
            <td><input type="number" name="material_quantity[]" step="0.01" class="form-control" placeholder="จำนวน"></td>
            <td><input type="text" name="material_unit[]" class="form-control" placeholder="หน่วยนับ"></td>
            <td><input type="text" name="material_notes[]" class="form-control" placeholder="หมายเหตุ"></td>
            <td><button type="button" class="btn btn-danger" onclick="removeMaterialRow(this)">ลบ</button></td>
        `;

        tableBody.appendChild(newRow);
        materialRowIndex++;
    }

    function removeMaterialRow(button) {
        const row = button.parentElement.parentElement;
        row.remove();
        updateRowNumbers();
    }

    function updateRowNumbers() {
        const rows = document.querySelectorAll("#materialTableBody tr");
        rows.forEach((row, index) => {
            row.children[0].textContent = index + 1;
        });
        materialRowIndex = rows.length + 1;
    }
</script>

<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="c_date">วันที่ดำเนินการซ่อมแล้วเสร็จ</label>
    <div class="col-md-6">
        <input type="date" class="form-control" id="c_date" name="c_date" value="<?php echo isset($report['c_date']) ? $report['c_date'] : ''; ?>">
    </div>
</div>





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

<style>
    .password-container {
        position: relative;
    }

    .form-control {
        padding-right: 40px; /* ปรับให้พอเหมาะสำหรับขนาดของไอคอน */
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 24px;
        color: #666; /* ปรับสีให้เข้ากับธีมของคุณ */
        z-index: 1; /* ทำให้ไอคอนอยู่บนฟิลด์กรอกข้อมูล */
    }
</style>

<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="per_type">ประเภทผู้ใช้ <span class="text-danger">*</span></label>
    <div class="col-md-6">
        <div class="select-arrow">
            <select class="form-control" name="per_type" id="per_type" required="required">
                <?php
                    $userTypes = [
                        1 => 'ผู้ดูแลระบบ',
                        2 => 'ช่างซ่อม',
                        3 => 'เจ้าหน้าที่',
                        4 => 'หัวหน้างาน'
                    ];
                    foreach ($userTypes as $key => $value) {
                        echo '<option value="'.$key.'" ' .($per_type==$key ? 'selected' : '').'>'.$value.'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
</div>


<!-- ชื่อผู้ใช้ -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="username">ชื่อผู้ใช้ (Username)<span class="text-danger">*</span></label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="username" name="username" placeholder="กรุณากรอก Username" value="<?php echo htmlspecialchars($username); ?>" required="required" pattern="^(?!root$).*" title="ไม่สามารถใช้ root เป็นชื่อผู้ใช้ได้">
        <small id="usernameError" class="text-danger"></small>
    </div>
</div>

<!-- รหัสผ่าน -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="password">รหัสผ่าน (Password)<span class="text-danger">*</span></label>
    <div class="col-md-6 password-container">
        <input type="password" class="form-control" id="password" name="password" placeholder="กรุณากรอก Password" value="<?php echo htmlspecialchars($password); ?>" required="required">
        <span class="toggle-password" onclick="togglePassword()">
            <i class="material-icons" id="passwordIcon">visibility</i>
        </span>
        <small id="passwordError" class="text-danger"></small>
    </div>
</div>

<!-- ยืนยันรหัสผ่าน -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="confirmPassword">ยืนยันรหัสผ่าน <span class="text-danger">*</span></label>
    <div class="col-md-6 password-container">
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="กรุณากรอก Password อีกครั้ง" required="required">
        <span class="toggle-password" onclick="togglePassword()">
            <i class="material-icons" id="confirmPasswordIcon">visibility</i>
        </span>
        <small id="confirmPasswordError" class="text-danger"></small>
    </div>
</div>

<script>
    // ตรวจสอบการยืนยันรหัสผ่าน
    document.getElementById('confirmPassword').addEventListener('input', function() {
        var password = document.getElementById('password').value;
        var confirmPassword = this.value;
        if (password !== confirmPassword) {
            document.getElementById('confirmPasswordError').textContent = 'รหัสผ่านไม่ตรงกัน';
        } else {
            document.getElementById('confirmPasswordError').textContent = '';
        }
    });

    // ตรวจสอบความยาวของรหัสผ่าน
    document.getElementById('password').addEventListener('input', function() {
        var password = this.value;
        if (password.length < 8) {
            document.getElementById('passwordError').textContent = 'คำแนะนำรหัสผ่านควรมีอย่างน้อย 8 ตัวอักษรเพื่อความปลอดภัย';
        } else if (!/[A-Z]/.test(password)) {
            document.getElementById('passwordError').textContent = 'คำแนะนำรหัสผ่านควรมีอักษรตัวพิมพ์ใหญ่เพื่อให้ปลอดภัยยิ่งขึ้น';
        } else if (!/[0-9]/.test(password)) {
            document.getElementById('passwordError').textContent = 'คำแนะนำรหัสผ่านควรมีตัวเลขเพื่อความปลอดภัย';
        } else {
            document.getElementById('passwordError').textContent = '';
        }
    });

    // แสดง/ซ่อนรหัสผ่าน พร้อมเปลี่ยนไอคอน
    function togglePassword() {
        var passwordInput = document.getElementById('password');
        var confirmPasswordInput = document.getElementById('confirmPassword');
        var passwordIcon = document.getElementById('passwordIcon');
        var confirmPasswordIcon = document.getElementById('confirmPasswordIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            confirmPasswordInput.type = 'text';
            passwordIcon.textContent = 'visibility_off';
            confirmPasswordIcon.textContent = 'visibility_off';
        } else {
            passwordInput.type = 'password';
            confirmPasswordInput.type = 'password';
            passwordIcon.textContent = 'visibility';
            confirmPasswordIcon.textContent = 'visibility';
        }
    }
</script>








<!-- คำนำหน้าชื่อจาก tbl_member_title -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="member_title_id">คำนำหน้าชื่อ</label>
    <div class="col-md-6">
        <div class="select-arrow">
            <select class="form-control" name="member_title_id" id="member_title_id">
                <?php
                    $sqlTitle = "SELECT * FROM tbl_member_title";
                    $resultTitle = mysqli_query($conn, $sqlTitle);
                    while ($rowTitle = mysqli_fetch_assoc($resultTitle)) {
                        echo '<option value="'.$rowTitle['member_title_id'].'" '.($member_title_id == $rowTitle['member_title_id'] ? 'selected' : '').'>'.$rowTitle['member_title_name'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
</div>


<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="per_name">ชื่อ  <span class="text-danger">*</span></label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="per_name" name="per_name" value="<?php echo $per_name; ?>" required="required" >
    </div>
</div>

<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="per_lastname">นามสกุล  <span class="text-danger">*</span></label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="per_lastname" name="per_lastname" value="<?php echo $per_lastname; ?>" required="required" >
    </div>
</div>

<!-- เพิ่มฟิลด์ เลขบัตรประชาชน -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="per_id_card">เลขบัตรประชาชน <span class="text-danger">*</span></label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="per_id_card" name="per_id_card" value="<?php echo $per_id_card; ?>" required="required" pattern="\d{13}" title="กรุณากรอกเลขบัตรประชาชน 13 หลัก">
        <small id="idCardError" class="text-danger"></small> <!-- เพิ่มพื้นที่แสดงข้อความแจ้งเตือน -->
    </div>
</div>


<!-- ตำแหน่งจาก tbl_position -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="position_id">ตำแหน่ง<span class="text-danger">*</span></label>
    <div class="col-md-6">
        <div class="select-arrow">
            <select class="form-control" name="position_id" id="position_id">
                <?php
                    $sqlPosition = "SELECT * FROM tbl_position";
                    $resultPosition = mysqli_query($conn, $sqlPosition);
                    while ($rowPosition = mysqli_fetch_assoc($resultPosition)) {
                        echo '<option value="'.$rowPosition['position_id'].'" '.($position_id==$rowPosition['position_id'] ? 'selected' : '').'>'.$rowPosition['position_name'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
</div>

<!-- แผนก/สาขาจาก tbl_department -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="deptid">แผนก/สาขา<span class="text-danger">*</span></label>
    <div class="col-md-6">
        <div class="select-arrow">
            <select class="form-control" name="deptid" id="deptid">
                <?php
                    $sqlDept = "SELECT * FROM tbl_department";
                    $resultDept = mysqli_query($conn, $sqlDept);
                    while ($rowDept = mysqli_fetch_assoc($resultDept)) {
                        echo '<option value="'.$rowDept['deptid'].'" '.($deptid==$rowDept['deptid'] ? 'selected' : '').'>'.$rowDept['deptname'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
</div>

<!-- ฝ่าย/คณะ -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="factid">คณะ<span class="text-danger">*</span></label>
    <div class="col-md-6">
        <div class="select-arrow">
            <select class="form-control" name="factid" id="factid" required="required">
                <?php
                    // ดึงข้อมูลจาก tbl_faculty
                    $sqlFaculty = "SELECT * FROM tbl_faculty";
                    $resultFaculty = mysqli_query($conn, $sqlFaculty);
                    while ($rowFaculty = mysqli_fetch_assoc($resultFaculty)) {
                        echo '<option value="'.$rowFaculty['factid'].'" ' . ($factid == $rowFaculty['factid'] ? 'selected' : '') . '>'.$rowFaculty['factname'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
</div>


<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="per_email">อีเมล </label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="per_email" name="per_email" value="<?php echo $per_email; ?>" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" title="โปรดกรอกอีเมลในรูปแบบที่ถูกต้อง">
    </div>
</div>

<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="per_tel">เบอร์มือถือ  <span class="text-danger">*</span></label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="per_tel" name="per_tel" value="<?php echo $per_tel; ?>" required="required" >
    </div>
</div>
<!-- เพิ่มฟิลด์ LINE ID -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="line_id">LINE ID</label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="line_id" name="line_id" value="<?php echo $line_id; ?>">
    </div>
</div>

<!-- เพิ่มฟิลด์รูปภาพลายเซ็น -->
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right" for="signature_image">อัปโหลดรูปลายเซ็น(jpeg หรือ png)</label>
    <div class="col-md-6">
        <input type="file" class="form-control" id="signature_image" name="signature_image" accept="image/*" onchange="previewImage(event)">
    </div>
</div>

<br>
<div class="row input-group input-group-outline">
    <label class="col-form-label col-md-3 text-right">ตัวอย่างรูปภาพ</label>
    <div class="col-md-6">
        <img id="image_preview" src="#" alt="รูปภาพตัวอย่าง" style="display:none; max-width: 100%; height: auto;">
    </div>
</div>
<br>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('image_preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>




<script>
    document.getElementById('username').addEventListener('input', function() {
        var username = this.value;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'checkUsername.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.exists) {
                    document.getElementById('usernameError').textContent = 'ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว';
                } else {
                    document.getElementById('usernameError').textContent = '';
                }
            }
        };
        xhr.send('username=' + username);
    });

    document.getElementById('form').addEventListener('submit', function(e) {
        if (document.getElementById('usernameError').textContent !== '') {
            e.preventDefault();
            alert('โปรดเปลี่ยนชื่อผู้ใช้');
        }
    });
</script>


<script>
    // ตรวจสอบเลขบัตรประชาชน
    document.getElementById('per_id_card').addEventListener('input', function() {
        var idCard = this.value;
        var idCardError = document.getElementById('idCardError');

        // ตรวจสอบความยาวและตัวเลขทั้งหมด
        if (idCard.length !== 13 || !/^\d{13}$/.test(idCard)) {
            idCardError.textContent = 'กรุณากรอกเลขบัตรประชาชน 13 หลัก';
        } else {
            idCardError.textContent = '';
        }
    });

    // ตรวจสอบฟอร์มก่อนส่ง
    document.getElementById('form').addEventListener('submit', function(e) {
        if (document.getElementById('usernameError').textContent !== '' || document.getElementById('idCardError').textContent !== '') {
            e.preventDefault();
            alert('โปรดแก้ไขข้อมูลที่ไม่ถูกต้องก่อนส่ง');
        }
    });
</script>


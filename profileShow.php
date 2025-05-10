<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");
?>
<?php 
include("menu.php");

$sqlQuery = "SELECT * FROM tbl_personnel WHERE per_id='" . $_GET['per_id'] . "'";
$query = mysqli_query($conn, $sqlQuery);
$row = mysqli_fetch_assoc($query);

$per_id = $row['per_id'];
$username = $row['username'];
$password = $row['password'];
$per_name = $row['per_name'];
$per_lastname = $row['per_lastname'];
$position_id = $row['position_id'];
$deptid = $row['deptid'];
$factid = $row['factid'];
$per_email = $row['per_email'];
$member_title_id = $row['member_title_id'];
$per_id_card = $row['per_id_card'];
$line_id = $row['line_id'];
$per_tel = $row['per_tel'];
$signature_image = $row['signature_image'];
$per_type = $row['per_type'];
?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>แสดงข้อมูลบุคลากร</h4>
        </div>
        <div class="row clearfix">
            <!-- Profile Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        ข้อมูลบุคลากร
                    </div>
                    <div class="card-body">
                        <form name="profileShow" class="col-12">


                            <!-- ชื่อผู้ใช้ -->
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right" for="username">ชื่อผู้ใช้</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($username); ?>" readonly />
                                </div>
                            </div>

                            <!-- รหัสผ่าน -->
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right" for="password">รหัสผ่าน</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="password" value="<?php echo htmlspecialchars($password); ?>" readonly />
                                </div>
                            </div>

                            <!-- คำนำหน้าชื่อ -->
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right" for="member_title_id">คำนำหน้าชื่อ</label>
                                <div class="col-md-6">
                                    <?php
                                    $sqlTitle = "SELECT * FROM tbl_member_title WHERE member_title_id = $member_title_id";
                                    $resultTitle = mysqli_query($conn, $sqlTitle);
                                    $rowTitle = mysqli_fetch_assoc($resultTitle);
                                    ?>
                                    <input type="text" class="form-control" id="member_title_id" value="<?php echo htmlspecialchars($rowTitle['member_title_name']); ?>" readonly />
                                </div>
                            </div>

                            <!-- ชื่อ-นามสกุล -->
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right" for="per_name">ชื่อ</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="per_name" value="<?php echo htmlspecialchars($per_name); ?>" readonly />
                                </div>
                            </div>

                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right" for="per_lastname">นามสกุล</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="per_lastname" value="<?php echo htmlspecialchars($per_lastname); ?>" readonly />
                                </div>
                            </div>

                            <!-- เลขบัตรประชาชน -->
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right" for="per_id_card">เลขบัตรประชาชน</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="per_id_card" value="<?php echo htmlspecialchars($per_id_card); ?>" readonly />
                                </div>
                            </div>

                            <!-- ตำแหน่ง -->
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right" for="position_id">ตำแหน่ง</label>
                                <div class="col-md-6">
                                    <?php
                                    $sqlPosition = "SELECT * FROM tbl_position WHERE position_id = $position_id";
                                    $resultPosition = mysqli_query($conn, $sqlPosition);
                                    $rowPosition = mysqli_fetch_assoc($resultPosition);
                                    ?>
                                    <input type="text" class="form-control" id="position_id" value="<?php echo htmlspecialchars($rowPosition['position_name']); ?>" readonly />
                                </div>
                            </div>

                            <!-- แผนก/สาขา -->
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right" for="deptid">แผนก/สาขา</label>
                                <div class="col-md-6">
                                    <?php
                                    $sqlDept = "SELECT * FROM tbl_department WHERE deptid = $deptid";
                                    $resultDept = mysqli_query($conn, $sqlDept);
                                    $rowDept = mysqli_fetch_assoc($resultDept);
                                    ?>
                                    <input type="text" class="form-control" id="deptid" value="<?php echo htmlspecialchars($rowDept['deptname']); ?>" readonly />
                                </div>
                            </div>

                            <!-- ฝ่าย/คณะ -->
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right" for="factid">คณะ</label>
                                <div class="col-md-6">
                                    <?php
                                    $sqlFact = "SELECT * FROM tbl_faculty WHERE factid = '$factid'";
                                    $resultFact = mysqli_query($conn, $sqlFact);
                                    $rowFact = mysqli_fetch_assoc($resultFact);
                                    ?>
                                    <input type="text" class="form-control" id="factid" value="<?php echo htmlspecialchars($rowFact['factname']); ?>" readonly />
                                </div>
                            </div>


                            <!-- อีเมล -->
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right" for="per_email">อีเมล</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="per_email" value="<?php echo htmlspecialchars($per_email); ?>" readonly />
                                </div>
                            </div>

                            <!-- เบอร์มือถือ -->
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right" for="per_tel">เบอร์มือถือ</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="per_tel" value="<?php echo htmlspecialchars($per_tel); ?>" readonly />
                                </div>
                            </div>

                            <!-- Line ID -->
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right" for="line_id">LINE ID</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="line_id" value="<?php echo htmlspecialchars($line_id); ?>" readonly />
                                </div>
                            </div>

                            <!-- รูปลายเซ็น -->
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right" for="signature_image">รูปลายเซ็น</label>
                                <div class="col-md-6">
                                    <?php if (!empty($signature_image)): ?>
                                        <div>
                                            <img src="<?php echo htmlspecialchars($signature_image); ?>" alt="รูปภาพลายเซ็น" style="max-width: 200px;">
                                        </div>
                                    <?php else: ?>
                                        <p>ยังไม่มีรูปภาพลายเซ็น</p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- ปุ่มกลับ -->
                            <div class="text-center">
                                <a href="editprofile.php?per_id=<?php echo $per_id; ?>" class="btn btn-warning">แก้ไขข้อมูล</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Profile Info -->
        </div>
    </div>
</section>
</body>
</html>

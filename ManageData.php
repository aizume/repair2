<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>

<script>
    function confirmEdit() {
        return confirm("ยืนยันแก้ไขข้อมูล?");
    }

    function confirmDelete() {
        return confirm("ต้องการลบข้อมูลนี้ใช่หรือไม่?");
    }
</script>

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
    /* เพิ่ม CSS นี้ */
    .table-responsive .btn {
        margin: 0; /* ลบ margin */
    }
    .table-hover {
    table-layout: fixed; /* กำหนดความกว้างของตารางให้คงที่ */
    width: 100%; /* ให้ตารางเต็มพื้นที่ */
}

.table-hover th, 
.table-hover td {
    text-align: left; /* จัดชิดซ้ายในแต่ละเซลล์ */
    padding: 10px; /* เพิ่ม padding */
    vertical-align: middle; /* จัดให้อยู่กลางเซลล์แนวตั้ง */
}

.table-hover td:last-child {
    width: 150px; /* กำหนดความกว้างของคอลัมน์ที่มีปุ่ม */
}

.d-flex.flex-row.justify-content-start {
    gap: 5px; /* เว้นระยะห่างระหว่างปุ่ม */
}

    
</style>


<?php include("menu.php"); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>จัดการข้อมูล</h4>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <a href="departmentCreate.php" class="btn btn-success w-100">
                                    <i class="material-icons text-xl me-2">add</i>เพิ่มข้อมูลสาขาวิชา
                                </a>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <a href="facultyCreate.php" class="btn btn-success w-100">
                                    <i class="material-icons text-xl me-2">add</i>เพิ่มข้อมูลคณะ
                                </a>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <a href="positionCreate.php" class="btn btn-success w-100">
                                    <i class="material-icons text-xl me-2">add</i>เพิ่มข้อมูลตำแหน่ง
                                </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <a href="memberTitleCreate.php" class="btn btn-success w-100">
                                    <i class="material-icons text-xl me-2">add</i>เพิ่มข้อมูลคำนำหน้าชื่อ
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="block-header section-title">
                            ข้อมูลสาขาวิชา
                        </div>

                        <div class="table-responsive">
                            <?php 
                            include("connect.php");

                            // ดึงข้อมูลสาขาวิชา
                            $sqlSelectDept = "SELECT * FROM tbl_department";
                            $resultDept = mysqli_query($conn, $sqlSelectDept);
                            $numrowDept = mysqli_num_rows($resultDept);

                            echo '<table class="table table-hover dashboard-task-infos"> 
                                    <tr>
                                        <th>รหัสสาขาวิชา</th>
                                        <th>ชื่อสาขาวิชา</th>
                                        <th>จัดการ</th>
                                    </tr>';

                            if ($numrowDept > 0) {
                                while ($row = mysqli_fetch_assoc($resultDept)) {
                                    echo "<tr>";
                                    echo "<td>".$row["deptid"]."</td>";
                                    echo "<td>".$row["deptname"]."</td>";
                                    echo "<td>
                                            <div class='d-flex flex-row justify-content-start'>
                                                <a href='departmentEdit.php?deptid=".$row["deptid"]."' class='btn btn-warning me-2' onclick='return confirmEdit();'>
                                                    <i class='material-icons text-xl'>edit</i>
                                                </a>
                                                <a href='departmentDelete.php?deptid=".$row["deptid"]."' class='btn btn-danger' onclick='return confirmDelete();'>
                                                    <i class='material-icons text-xl'>delete</i>
                                                </a>
                                            </div>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2' align='center'>ไม่พบข้อมูล</td></tr>";
                            }

                            echo "</table>";
                            ?>
                        </div>

                        <div class="block-header section-title">
                            ข้อมูลคณะ
                        </div>
                        
                        <div class="table-responsive">
                            <?php 
                            // ดึงข้อมูลคณะ
                            $sqlSelectFac = "SELECT * FROM tbl_faculty";
                            $resultFac = mysqli_query($conn, $sqlSelectFac);
                            $numrowFac = mysqli_num_rows($resultFac);

                            echo '<table class="table table-hover dashboard-task-infos"> 
                                    <tr>
                                        <th>รหัสคณะ</th>
                                        <th>ชื่อคณะ</th>
                                        <th>จัดการ</th>
                                    </tr>';

                            if ($numrowFac > 0) {
                                while ($row = mysqli_fetch_assoc($resultFac)) {
                                    echo "<tr>";
                                    echo "<td>".$row["factid"]."</td>";
                                    echo "<td>".$row["factname"]."</td>";
                                    echo "<td>
                                            <div class='d-flex flex-row justify-content-start'>
                                                <a href='facultyEdit.php?factid=".$row["factid"]."' class='btn btn-warning me-2' onclick='return confirmEdit();'>
                                                    <i class='material-icons text-xl'>edit</i>
                                                </a>
                                                <a href='facultyDelete.php?factid=".$row["factid"]."' class='btn btn-danger' onclick='return confirmDelete();'>
                                                    <i class='material-icons text-xl'>delete</i>
                                                </a>
                                            </div>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2' align='center'>ไม่พบข้อมูล</td></tr>";
                            }

                            echo "</table>";
                            ?>
                        </div>

                        <div class="block-header section-title">
                            ข้อมูลตำแหน่ง
                        </div>
                        
                        <div class="table-responsive">
                            <?php 
                            // ดึงข้อมูลตำแหน่ง
                            $sqlSelectPos = "SELECT * FROM tbl_position";
                            $resultPos = mysqli_query($conn, $sqlSelectPos);
                            $numrowPos = mysqli_num_rows($resultPos);

                            echo '<table class="table table-hover dashboard-task-infos"> 
                                    <tr>
                                        <th>รหัสตำแหน่ง</th>
                                        <th>ชื่อตำแหน่ง</th>
                                        <th>จัดการ</th>
                                    </tr>';

                            if ($numrowPos > 0) {
                                while ($row = mysqli_fetch_assoc($resultPos)) {
                                    echo "<tr>";
                                    echo "<td>".$row["position_id"]."</td>";
                                    echo "<td>".$row["position_name"]."</td>";
                                    echo "<td>
                                            <div class='d-flex flex-row justify-content-start'>
                                                <a href='positionEdit.php?position_id=".$row["position_id"]."' class='btn btn-warning me-2' onclick='return confirmEdit();'>
                                                    <i class='material-icons text-xl'>edit</i>
                                                </a>
                                                <a href='positionDelete.php?position_id=".$row["position_id"]."' class='btn btn-danger' onclick='return confirmDelete();'>
                                                    <i class='material-icons text-xl'>delete</i>
                                                </a>
                                            </div>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2' align='center'>ไม่พบข้อมูล</td></tr>";
                            }

                            echo "</table>";
                            ?>
                        </div>

                        <div class="block-header section-title">
                            ข้อมูลคำนำหน้าชื่อ
                        </div>
                        
                        <div class="table-responsive">
                            <?php 
                            // ดึงข้อมูลคำนำหน้าชื่อ
                            $sqlSelectMT = "SELECT * FROM tbl_member_title";
                            $resultMT = mysqli_query($conn, $sqlSelectMT);
                            $numrowMT = mysqli_num_rows($resultMT);

                            echo '<table class="table table-hover dashboard-task-infos"> 
                                    <tr>
                                        <th>รหัสคำนำหน้าชื่อ</th>
                                        <th>ชื่อคำนำหน้าชื่อ</th>
                                        <th>จัดการ</th>
                                    </tr>';

                            if ($numrowMT > 0) {
                                while ($row = mysqli_fetch_assoc($resultMT)) {
                                    echo "<tr>";
                                    echo "<td>".$row["member_title_id"]."</td>";
                                    echo "<td>".$row["member_title_name"]."</td>";
                                    echo "<td>
                                            <div class='d-flex flex-row justify-content-start'>
                                                <a href='memberTitleEdit.php?member_title_id=".$row["member_title_id"]."' class='btn btn-warning me-2' onclick='return confirmEdit();'>
                                                    <i class='material-icons text-xl'>edit</i>
                                                </a>
                                                <a href='memberTitleDelete.php?member_title_id=".$row["member_title_id"]."' class='btn btn-danger' onclick='return confirmDelete();'>
                                                    <i class='material-icons text-xl'>delete</i>
                                                </a>
                                            </div>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2' align='center'>ไม่พบข้อมูล</td></tr>";
                            }

                            echo "</table>";
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

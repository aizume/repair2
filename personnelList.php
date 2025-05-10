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

<?php include("menu.php"); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>จัดการข้อมูลบุคลากร</h4>
        </div>
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                <div class="card-header">
                    <form name="form1" action="personnelList.php" method="get" class="form-inline">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <a href="personnelCreate.php" class="btn btn-success w-100">
                                    <i class="material-icons text-xl me-2">add</i>เพิ่มข้อมูลบุคลากร
                                </a>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <input type="text" name="search_personnelList" class="form-control" placeholder="ค้นหาบุคลากร" value="<?php echo isset($_GET['search_personnelList']) ? $_GET['search_personnelList'] : ''; ?>" 
                                style="background-color: white; border: 2px solid #ced4da; color: black;">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="material-icons text-xl me-2">search</i>ค้นหา
                                </button>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <a href="ManageData.php" class="btn btn-info w-100">
                                    <i class="material-icons text-xl me-2">library_add</i>เพิ่มข้อมูลคณะ/สาขา
                                </a>
                            </div>
                        </div>
                    </form>
                </div>



                    <div class="card-body">
                        <div class="table-responsive">
                            <?php 
                            include("connect.php");
                            $where = "";

                            if (isset($_GET['search_personnelList'])) {
                                $txt = $_GET['search_personnelList'];
                                // ค้นหาจากทั้ง per_name และ per_lastname
                                $where = " AND (p.per_id='$txt' OR p.per_name LIKE '%".$txt."%' OR p.per_lastname LIKE '%".$txt."%')";
                            }

                            // ดึงข้อมูลจากฐานข้อมูลพร้อมกับ join ตารางที่เกี่ยวข้อง
                            $sqlSelect = "
                            SELECT 
                                p.*, 
                                pos.position_name, 
                                dep.deptname, 
                                fac.factname, 
                                mt.member_title_name
                            FROM tbl_personnel p
                            LEFT JOIN tbl_position pos ON p.position_id = pos.position_id
                            LEFT JOIN tbl_department dep ON p.deptid = dep.deptid
                            LEFT JOIN tbl_faculty fac ON p.factid = fac.factid
                            LEFT JOIN tbl_member_title mt ON p.member_title_id = mt.member_title_id
                            WHERE 1=1 ".$where."
                                ORDER BY 
                                    CASE 
                                        WHEN p.per_type = 1 THEN 1  -- ผู้ดูแลระบบ
                                        WHEN p.per_type = 4 THEN 2  -- หัวหน้างาน
                                        WHEN p.per_type = 2 THEN 3  -- ช่างซ่อม
                                        WHEN p.per_type = 3 THEN 4  -- เจ้าหน้าที่
                                        ELSE 5  -- ไม่ระบุ
                                    END
                            ";   
                            $result = mysqli_query($conn, $sqlSelect);
                            $numrow = mysqli_num_rows($result);

                            echo '<table class="table table-hover dashboard-task-infos"> 
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ประเภทผู้ใช้</th>
                                        <th>คำนำหน้า</th>
                                        <th>ชื่อ</th>
                                        <th>นามสกุล</th>
                                        <th>ตำแหน่ง</th>
                                        <th>แผนก/สาขา</th>
                                        <th>คณะ</th>
                                    </tr>';

                            if ($numrow > 0) {
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>".$i++."</td>";
                                    
                                    // แสดงประเภทผู้ใช้
                                    switch ($row["per_type"]) {
                                        case 1:
                                            echo "<td>ผู้ดูแลระบบ</td>";
                                            break;
                                        case 2:
                                            echo "<td>ช่างซ่อม</td>";
                                            break;
                                        case 3:
                                            echo "<td>เจ้าหน้าที่</td>";
                                            break;
                                        case 4:
                                            echo "<td>หัวหน้างาน</td>";
                                            break;
                                        default:
                                            echo "<td>ไม่ระบุ</td>";
                                    }

                                    // คำนำหน้าชื่อจาก tbl_member_title
                                    echo "<td>".$row["member_title_name"]."</td>";
                                    
                                    echo "<td>".$row["per_name"]."</td>";
                                    echo "<td>".$row["per_lastname"]."</td>";
                                    
                                    // ตำแหน่งจาก tbl_position
                                    echo "<td>".$row["position_name"]."</td>";
                                    
                                    // แผนกจาก tbl_department
                                    echo "<td>".$row["deptname"]."</td>";
                                    
                                    echo "<td>".$row["factname"]."</td>";

                                    echo "<td>
                                    <div class='d-flex flex-row'>
                                        <a href='personnelEdit.php?per_id=".$row["per_id"]."' class='btn btn-warning d-flex align-items-center justify-content-center me-2' onclick='return confirmEdit();'>
                                            <i class='material-icons text-xl'>edit</i>
                                        </a>
                                        <a href='personnelDelete.php?per_id=".$row["per_id"]."' class='btn btn-danger d-flex align-items-center justify-content-center' onclick='return confirmDelete();'>
                                            <i class='material-icons text-xl'>delete</i>
                                        </a>
                                    </div>
                                  </td>";
                            
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9' align='center'>ไม่พบข้อมูล</td></tr>";
                            }

                            echo "</table>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
        </div>
    </div>
</section>
<?php
?>
</body>
</html>

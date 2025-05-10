<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

$statuslist = array(
    '-2' => "รอการอนุมัติ", 
    '-1' => "ไม่อนุมัติ", 
    '0' => "อนุมัติแล้ว", 
    '1' => "อยู่ระหว่างดำเนินการซ่อม", 
    '2' => "เสร็จสิ้นการซ่อม"
);

?>

<script>
    function confirmEdit() {
        return confirm("ยืนยันแก้ไขข้อมูล");
    }
    function confirmDelete() {
        return confirm("ต้องการลบข้อมูลนี้ใช่หรือไม่");
    }
</script>

<?php include("menu.php"); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>ตรวจสอบการซ่อม</h4>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <form name="form1" action="repirList.php" method="get" class="form-inline">
                            <div class="input-group input-group-outline">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <a href="reportCreate.php" class="btn btn-success w-100"><i class="material-icons text-xl me-2">add</i>แจ้งซ่อม</a>
                                </div>
                            </div>
                        </form>  
                    </div>
                    <div class="card-body">
                    <?php 
                    $where = "";

                    $sqlSelect = "SELECT pr.*, p.per_name, p.per_lastname, mt.member_title_name, pos.position_name
                    FROM tbl_repair pr
                    JOIN tbl_personnel p ON pr.per_id = p.per_id
                    LEFT JOIN tbl_position pos ON p.position_id = pos.position_id
                    LEFT JOIN tbl_member_title mt ON p.member_title_id = mt.member_title_id
                    WHERE pr.rep_status != '-2' " . $where . "  -- Add this condition
                    ORDER BY
                    CASE pr.rep_status
                        WHEN '-1' THEN 1
                        WHEN '0' THEN 2
                        WHEN '1' THEN 3
                        WHEN '2' THEN 4
                    END,
                    pr.u_date DESC";          

                    $result = mysqli_query($conn, $sqlSelect);
                    $numrow = mysqli_num_rows($result);
                    ?>

                        <div class="table-responsive">
                            <table class="table table-hover table-vertical-middle nomargin">
                                <thead>
                                    <tr style="width:5%;">
                                        <th class="text-center">ลำดับ</th>
                                        <th>ผู้แจ้งซ่อม</th>
                                        <th>ตำแหน่ง</th>
                                        <th>วันที่แจ้งซ่อม</th>
                                        <th>เลขที่</th>
                                        <th>สถานะการซ่อม</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if ($numrow > 0) {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i++; ?></td>
                                                <!-- แสดงคำนำหน้าชื่อและชื่อผู้แจ้งซ่อม -->
                                                <td><?php echo $row['member_title_name'] . ' ' . $row['per_name'] . ' ' . $row['per_lastname']; ?></td>
                                                <!-- แสดงตำแหน่ง -->
                                                <td><?php echo $row['position_name']; ?></td>
                                                <td><?php echo $row['u_date']; ?></td>
                                                <td><?php echo $row['rep_no']; ?></td>
                                                <td><?php echo $statuslist[$row['rep_status']]; ?></td>

                                                <td class="text-start">
                                                    <?php 
                                                    // ตรวจสอบว่ามีข้อมูลในฐานข้อมูลหรือไม่
                                                    $repairLink = 'approvalCreate.php?rep_ID=' . $row['rep_ID'];
                                                    if ($row['rep_ID']) { // สมมติว่า rep_ID มีข้อมูลถ้ามีการแจ้งซ่อมแล้ว
                                                        $repairLink = 'approvalEdit.php?rep_ID=' . $row['rep_ID'];
                                                    }
                                                    ?>
                                                    <div class="d-flex flex-row">
                                                       <!-- ปุ่มแก้ไข/เพิ่มรายละเอียดการซ่อม -->
                                                        <a href="<?php echo $repairLink; ?>" class="btn <?php echo $row['rep_ID'] ? 'btn-warning' : 'btn-success'; ?> d-flex align-items-center justify-content-center me-2">
                                                            <i class="material-icons text-xl">edit</i>
                                                        </a>

                                                        <!-- ปุ่มดูรายละเอียด -->
                                                        <a href="<?php echo 'repairShow.php?rep_ID=' . $row['rep_ID']; ?>" class="btn btn-info d-flex align-items-center justify-content-center me-2">
                                                            <i class="material-icons text-xl">visibility</i>
                                                        </a>


                                                        <!-- ปุ่มลบ เฉพาะสถานะ "รอการอนุมัติ" -->
                                                        <?php if ($row['rep_status'] == '-2') { ?>
                                                            <a href="<?php echo 'repirDelete.php?rep_ID=' . $row['rep_ID']; ?>" class="btn btn-danger d-flex align-items-center justify-content-center me-2 delete-button" onclick='return confirmDelete();'>
                                                                <i class="material-icons text-xl">delete</i>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php } 
                                    } else { ?>
                                        <tr><td colspan='8' align='center'>ไม่พบข้อมูล</td></tr>
                                    <?php } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>

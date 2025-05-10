<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");
include("menu.php");

$statuslist = array(
    '-2' => "รอการอนุมัติ", 
    '-1' => "ไม่อนุมัติ", 
    '0' => "อนุมัติแล้ว", 
    '1' => "อยู่ระหว่างดำเนินการซ่อม", 
    '2' => "เสร็จสิ้นการซ่อม"
);

// ตรวจสอบประเภทผู้ใช้
$per_type = isset($_SESSION['per_type']) ? $_SESSION['per_type'] : null;
$is_manager = ($per_type == 4);

?>

<script>
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('check') === 'success') {
            alert('เข้าสู่ระบบสำเร็จ');
        }
        if (urlParams.get('warning') === 'not_manager') {
            alert('ต้องเป็นหัวหน้างานจึงจะสามารถอนุมัติได้');
        }
    }
</script>

<style>
    /* Override primary color to be maroon (#800000) */
    .bg-gradient-primary {
        background: linear-gradient(310deg, #800000, #660000) !important;
    }
    .btn.bg-gradient-primary {
        background: linear-gradient(310deg, #800000, #660000) !important;
    }
    .text-primary {
        color: #800000 !important;
    }
</style>

<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-2 pb-1">
                    <h6 class="text-white text-capitalize ps-3">การซ่อมที่รอการอนุมัติ</h6>
                </div>
            </div>
            <div class="card-body">
                <?php 
                    // ดึงข้อมูลการซ่อมที่มีสถานะ 'แจ้งซ่อม' (rep_status = -2)
                    $where = " AND pr.rep_status=-2";
                    if (isset($_GET['search_repair'])) {
                        $where .= " AND (pr.rep_ID='" . $_GET['search_repair'] . "' OR pr.address LIKE '%" . $_GET['search_repair'] . "%')";
                    }
                    $sqlSelect = "
                    SELECT pr.*, p.per_name, p.per_lastname, mt.member_title_name, pos.position_name
                    FROM tbl_repair pr
                    LEFT JOIN tbl_personnel p ON pr.per_id=p.per_id
                    LEFT JOIN tbl_position pos ON p.position_id = pos.position_id
                    LEFT JOIN tbl_member_title mt ON p.member_title_id = mt.member_title_id
                    WHERE pr.rep_status=-2";
                

                    $result = mysqli_query($conn, $sqlSelect);
                    if (!$result) {
                        echo "Error: " . mysqli_error($conn);
                    }
                    $numrow = mysqli_num_rows($result);
                ?>
                <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                    <table class="table table-hover table-vertical-middle nomargin">
                        <thead>
                            <tr>
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
                                while ($row = mysqli_fetch_assoc($result)) { 
                                    if (isset($row['rep_ID'])) {
                            ?>
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
                                            <div class="d-flex flex-row">
                                                <?php if ($is_manager): ?>
                                                    <a href="<?php echo 'approvalCreate.php?rep_ID=' . $row['rep_ID']; ?>" class="btn btn-success d-flex align-items-center justify-content-center me-2">
                                                        <i class="material-icons text-xl">edit</i>
                                                    </a>
                                                <?php else: ?>
                                                    <button class="btn btn-secondary d-flex align-items-center justify-content-center" disabled>
                                                        <i class="material-icons text-xl">edit</i>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>

                                    </tr>
                            <?php
                                    }
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="8" class="text-center">ไม่มีข้อมูล</td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>

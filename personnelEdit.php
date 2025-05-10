<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");
include("menu.php");

$per_id = $_GET['per_id'] ?? '';

if ($per_id) {
    $sqlQuery = "SELECT * FROM tbl_personnel WHERE per_id='$per_id'";
    $query = mysqli_query($conn, $sqlQuery);

    if ($query) {
        $row = mysqli_fetch_assoc($query);

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
    } else {
        echo '<script>alert("ไม่สามารถดึงข้อมูลได้"); window.history.back();</script>';
    }
} else {
    echo '<script>alert("ไม่พบข้อมูล ID"); window.history.back();</script>';
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>บุคลากร</h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        แก้ไขข้อมูลบุคลากร
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <form name="personnelUpdate" class="col-12" action="personnelUpdate.php?per_id=<?php echo $per_id; ?>" method="POST" enctype="multipart/form-data">
                            <?php include_once("personnelFormUpd.php"); ?>
                            <input type="hidden" name="current_signature_image" value="<?php echo htmlspecialchars($signature_image); ?>">
                            <div class="col-md-3"></div>
                            <div class="col-md-10 text-center">
                                <button type="submit" class="btn btn-warning"> แก้ไข</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>

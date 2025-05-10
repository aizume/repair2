<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");
include("menu.php"); 

$position_id = $_GET['position_id'] ?? '';
if ($position_id) {
    $sqlQuery = "SELECT * FROM tbl_position WHERE position_id='$position_id'";
    $query = mysqli_query($conn, $sqlQuery);

    if ($query) {
        $row = mysqli_fetch_assoc($query);

        $position_name = $row['position_name'];
        // เพิ่มฟิลด์อื่นๆ ถ้ามี
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
            <h2>ตำแหน่ง</h2> <!-- เปลี่ยนหัวข้อ -->
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        แก้ไขข้อมูลตำแหน่ง
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <form name="positionUpdate" class="col-12" action="positionUpdate.php?position_id=<?php echo $position_id; ?>" method="POST">
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right">ชื่อตำแหน่ง</label> <!-- เปลี่ยนชื่อฟิลด์ -->
                                <div class="col-md-6">
                                    <input type="text" name="position_name" id="position_name" class="form-control" value="<?php echo htmlspecialchars($position_name); ?>" required>
                                </div>
                            </div>

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

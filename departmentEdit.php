<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");
include("menu.php"); 

$deptid = $_GET['deptid'] ?? '';

if ($deptid) {
    $sqlQuery = "SELECT * FROM tbl_department WHERE deptid='$deptid'";
    $query = mysqli_query($conn, $sqlQuery);

    if ($query) {
        $row = mysqli_fetch_assoc($query);

        $deptname = $row['deptname'];
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
            <h2>สาขาวิชา</h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        แก้ไขข้อมูลสาขาวิชา
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <form name="departmentUpdate" class="col-12" action="departmentUpdate.php?deptid=<?php echo $deptid; ?>" method="POST">
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right">ชื่อสาขาวิชา</label>
                                <div class="col-md-6">
                                    <input type="text" name="deptname" id="deptname" class="form-control" value="<?php echo htmlspecialchars($deptname); ?>" required>
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

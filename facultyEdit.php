<?php
// ตรวจสอบการล็อกอิน (หรือกรณีที่ผู้ใช้ไม่ล็อกอิน)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['per_type'])) {
    echo '<script>alert("กรุณาล็อกอินก่อน"); window.location.href="index.php";</script>';
    exit();
}
include("connect.php");
include("menu.php");

$factid = $_GET['factid'] ?? '';

if ($factid) {
    $sqlQuery = "SELECT * FROM tbl_faculty WHERE factid='$factid'";
    $query = mysqli_query($conn, $sqlQuery);

    if ($query) {
        $row = mysqli_fetch_assoc($query);
        $factname = $row['factname']; // ดึงข้อมูลชื่อคณะ
        $factid = $row['factid'];
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
            <h2>คณะ</h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        แก้ไขข้อมูลคณะ
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <form name="facultyUpdate" class="col-12" action="facultyUpdate.php?factid=<?php echo $factid; ?>" method="POST">
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right">รหัสคณะ (factid) <br> ตั้ง 3 อักษรเช่น f01</label>
                                <div class="col-md-6">
                                    <input type="text" name="factid" id="factid" class="form-control" value="<?php echo htmlspecialchars($factid); ?>" required>
                                </div>
                            </div>

                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right">ชื่อคณะ</label>
                                <div class="col-md-6">
                                    <input type="text" name="factname" id="factname" class="form-control" value="<?php echo htmlspecialchars($factname); ?>" required>
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

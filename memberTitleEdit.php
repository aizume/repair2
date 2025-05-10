<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");
include("menu.php"); 

$member_title_id = $_GET['member_title_id'] ?? ''; // ใช้ member_title_id เพื่อระบุคำนำหน้าชื่อ

if ($member_title_id) {
    $sqlQuery = "SELECT * FROM tbl_member_title WHERE member_title_id='$member_title_id'";
    $query = mysqli_query($conn, $sqlQuery);

    if ($query) {
        $row = mysqli_fetch_assoc($query);
        $member_title_name = $row['member_title_name'];
        $member_title_en = $row['member_title_en']; // เพิ่มฟิลด์ชื่อคำนำหน้าชื่อ ภาษาอังกฤษ
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
            <h4>คำนำหน้าชื่อ</h4>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        แก้ไขข้อมูลคำนำหน้าชื่อ
                    </div>
                    <div class="card-body">
                        <form name="memberTitleUpdate" action="memberTitleUpdate.php?member_title_id=<?php echo $member_title_id; ?>" method="POST">
                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right">ชื่อคำนำหน้าชื่อ</label>
                                <div class="col-md-6">
                                    <input type="text" name="member_title_name" id="member_title_name" class="form-control" value="<?php echo htmlspecialchars($member_title_name); ?>" required>
                                </div>
                            </div>

                            <div class="row input-group input-group-outline">
                                <label class="col-form-label col-md-3 text-right">ชื่อคำนำหน้าชื่อ ภาษาอังกฤษ</label>
                                <div class="col-md-6">
                                    <input type="text" name="member_title_en" id="member_title_en" class="form-control" value="<?php echo htmlspecialchars($member_title_en); ?>" required>
                                </div>
                            </div>

                            <br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-warning">แก้ไข</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>

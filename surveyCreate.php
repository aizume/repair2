<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

$rep_ID = $_GET['rep_ID'];

// เช็คว่ามีข้อมูลการประเมินอยู่แล้วหรือไม่
$sqlSurveyCheck = "SELECT * FROM tbl_satisfaction_survey WHERE rep_ID='$rep_ID'";
$querySurveyCheck = mysqli_query($conn, $sqlSurveyCheck);
$surveyExists = mysqli_num_rows($querySurveyCheck) > 0;

// ถ้ามีข้อมูลการประเมินอยู่แล้ว ให้ดึงข้อมูลมาแสดง
if ($surveyExists) {
    $surveyData = mysqli_fetch_assoc($querySurveyCheck);
}

$sqlQuery = "SELECT * FROM tbl_repair WHERE rep_ID='$rep_ID'";
$query = mysqli_query($conn, $sqlQuery);
$row = mysqli_fetch_assoc($query);

?>

<script>
    // ฟังก์ชันสำหรับการยืนยันการบันทึกแบบสำรวจและตรวจสอบฟอร์ม
    function validateSurvey() {
        var ratings = document.querySelectorAll('input[type="radio"]:checked');
        if (ratings.length < 3) {
            alert("กรุณาให้คะแนนทุกหัวข้อ");
            return false;
        }
        var surveyDate = document.getElementById('survey_date').value;
        if (!surveyDate) {
            alert("กรุณาเลือกวันที่ประเมิน");
            return false;
        }
        return confirm("ยืนยันการบันทึกข้อมูลแบบสำรวจความพึงพอใจ");
    }

    // ฟังก์ชันสำหรับการตั้งค่าวันที่ปัจจุบัน
    document.addEventListener('DOMContentLoaded', function () {
        var completionDateInput = document.getElementById('survey_date');
        if (!completionDateInput.value) {
            completionDateInput.value = new Date().toISOString().split('T')[0];
        }
    });
</script>

<?php include("menu.php"); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>แบบสำรวจความพึงพอใจ</h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        แบบฟอร์มการประเมินความพึงพอใจหลังการรับบริการ
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form name="satisfactionSurvey" class="col-12" action="<?php echo $surveyExists ? 'surveyUpdate.php' : 'surveyInsert.php'; ?>" method="POST">
                                <!-- ส่ง rep_ID ไปพร้อมกับฟอร์ม -->
                                <input type="hidden" name="rep_ID" value="<?php echo $rep_ID; ?>">

                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>หัวข้อการประเมิน</th>
                                                <th>ดีเยี่ยม (5)</th>
                                                <th>ดี (4)</th>
                                                <th>พอใช้ (3)</th>
                                                <th>ปรับปรุง (2)</th>
                                                <th>ไม่พอใจ (1)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>การให้บริการของเจ้าหน้าที่</td>
                                                <td><input type="radio" name="service_rating" value="5" <?php echo (isset($surveyData['service_rating']) && $surveyData['service_rating'] == '5') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="service_rating" value="4" <?php echo (isset($surveyData['service_rating']) && $surveyData['service_rating'] == '4') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="service_rating" value="3" <?php echo (isset($surveyData['service_rating']) && $surveyData['service_rating'] == '3') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="service_rating" value="2" <?php echo (isset($surveyData['service_rating']) && $surveyData['service_rating'] == '2') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="service_rating" value="1" <?php echo (isset($surveyData['service_rating']) && $surveyData['service_rating'] == '1') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>ความเหมาะสมของขั้นตอนการให้บริการ</td>
                                                <td><input type="radio" name="quality_rating" value="5" <?php echo (isset($surveyData['quality_rating']) && $surveyData['quality_rating'] == '5') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="quality_rating" value="4" <?php echo (isset($surveyData['quality_rating']) && $surveyData['quality_rating'] == '4') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="quality_rating" value="3" <?php echo (isset($surveyData['quality_rating']) && $surveyData['quality_rating'] == '3') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="quality_rating" value="2" <?php echo (isset($surveyData['quality_rating']) && $surveyData['quality_rating'] == '2') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="quality_rating" value="1" <?php echo (isset($surveyData['quality_rating']) && $surveyData['quality_rating'] == '1') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>ระยะเวลาในการดำเนินงาน</td>
                                                <td><input type="radio" name="timeliness_rating" value="5" <?php echo (isset($surveyData['timeliness_rating']) && $surveyData['timeliness_rating'] == '5') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="timeliness_rating" value="4" <?php echo (isset($surveyData['timeliness_rating']) && $surveyData['timeliness_rating'] == '4') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="timeliness_rating" value="3" <?php echo (isset($surveyData['timeliness_rating']) && $surveyData['timeliness_rating'] == '3') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="timeliness_rating" value="2" <?php echo (isset($surveyData['timeliness_rating']) && $surveyData['timeliness_rating'] == '2') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="timeliness_rating" value="1" <?php echo (isset($surveyData['timeliness_rating']) && $surveyData['timeliness_rating'] == '1') ? 'checked' : ''; ?>></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row input-group input-group-outline">
                                    <label class="col-form-label col-md-3 text-right">ข้อเสนอแนะ</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" id="suggestions" name="suggestions" placeholder="(โปรดระบุสิ่งที่ควรพัฒนาและปรับปรุงให้ดีขึ้น)"><?php echo isset($surveyData['suggestions']) ? $surveyData['suggestions'] : ''; ?></textarea>
                                    </div>
                                </div>
                                <br>

                                <div class="row input-group input-group-outline">
                                    <label class="col-form-label col-md-3 text-right" for="survey_date">วันที่ประเมิน</label>
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" id="survey_date" name="survey_date" value="<?php echo isset($surveyData['survey_date']) ? $surveyData['survey_date'] : ''; ?>">
                                    </div>
                                </div>
                                <br>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success" onclick="return validateSurvey();">
                                        <?php echo $surveyExists ? 'แก้ไขข้อมูล' : 'บันทึก'; ?>
                                    </button>
                                    <button type="reset" class="btn btn-warning"> ล้างข้อมูล</button>
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

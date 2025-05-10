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


?>

<script>
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('check') === 'success') {
            alert('เข้าสู่ระบบสำเร็จ');
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

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>รายละเอียดการซ่อมทั้งหมด</h4><br>
        </div>

        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <?php
                    // นับจำนวนการซ่อมสถานะ 'รอการอนุมัติ'
                    $sqlSelect = "SELECT COUNT(*) AS num FROM tbl_repair WHERE rep_status = '-2'";
                    $result = mysqli_query($conn, $sqlSelect);
                    if (!$result) {
                        echo "Error: " . mysqli_error($conn);
                    }
                    $row = mysqli_fetch_assoc($result);
                    $numrowRepairPending = $row['num'];
                ?>
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">build</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">จำนวนแจ้งซ่อมที่รอการอนุมัติ</p>
                            <h4 class="mb-0 text-light"><?php echo $numrowRepairPending; ?></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <?php
                    // นับจำนวนการซ่อมสถานะ 'อนุมัติแล้ว'
                    $sqlSelect = "SELECT COUNT(*) AS num FROM tbl_repair WHERE rep_status = '0'";
                    $result = mysqli_query($conn, $sqlSelect);
                    if (!$result) {
                        echo "Error: " . mysqli_error($conn);
                    }
                    $row = mysqli_fetch_assoc($result);
                    $numrowRepairApproved = $row['num'];
                ?>
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">done</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">จำนวนแจ้งซ่อมที่อนุมัติแล้ว</p>
                            <h4 class="mb-0 text-light"><?php echo $numrowRepairApproved; ?></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <?php
                    // นับจำนวนการซ่อมสถานะ 'อยู่ระหว่างดำเนินการซ่อม'
                    $sqlSelect = "SELECT COUNT(*) AS num FROM tbl_repair WHERE rep_status = '1'";
                    $result = mysqli_query($conn, $sqlSelect);
                    if (!$result) {
                        echo "Error: " . mysqli_error($conn);
                    }
                    $row = mysqli_fetch_assoc($result);
                    $numrowRepairInProgress = $row['num'];
                ?>
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">build_circle</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">จำนวนแจ้งซ่อมที่กำลังดำเนินการ</p>
                            <h4 class="mb-0 text-light"><?php echo $numrowRepairInProgress; ?></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <?php
                    // นับจำนวนการซ่อมสถานะ 'เสร็จสิ้นการซ่อม'
                    $sqlSelect = "SELECT COUNT(*) AS num FROM tbl_repair WHERE rep_status = '2'";
                    $result = mysqli_query($conn, $sqlSelect);
                    if (!$result) {
                        echo "Error: " . mysqli_error($conn);
                    }
                    $row = mysqli_fetch_assoc($result);
                    $numrowRepairCompleted = $row['num'];
                ?>
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">check_circle</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">จำนวนแจ้งซ่อมที่เสร็จสิ้น</p>
                            <h4 class="mb-0 text-light"><?php echo $numrowRepairCompleted; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br>


        <?php
$selectedYear = isset($_GET['year']) ? $_GET['year'] : date('Y');
$startMonth = isset($_GET['startMonth']) ? $_GET['startMonth'] : 1;  // ค่าเริ่มต้นเป็นเดือนมกราคม
$endMonth = isset($_GET['endMonth']) ? $_GET['endMonth'] : 12;       // ค่าเริ่มต้นเป็นเดือนธันวาคม

// Query สำหรับดึงข้อมูลจำนวนคำขอที่ได้รับในแต่ละเดือน
$sqlMonthlyRequests = "
    SELECT MONTH(u_date) AS month, COUNT(*) AS request_count 
    FROM tbl_repair 
    WHERE YEAR(u_date) = $selectedYear
    AND MONTH(u_date) BETWEEN $startMonth AND $endMonth
    GROUP BY MONTH(u_date)
";
$resultMonthlyRequests = mysqli_query($conn, $sqlMonthlyRequests);
$monthlyRequests = [];
if ($resultMonthlyRequests) {
    while ($row = mysqli_fetch_assoc($resultMonthlyRequests)) {
        $monthlyRequests[] = $row;
    }
}

// Query สำหรับดึงข้อมูลจำนวนคำขอแยกตามประเภทปัญหา
$sqlIssueTypes = "
    SELECT 'ปัญหาอาคารสถานที่' AS issue_type, COUNT(*) AS request_count 
    FROM tbl_repair 
    WHERE (FIND_IN_SET('ประตู', building_issue) > 0 
       OR FIND_IN_SET('หน้าต่าง', building_issue) > 0 
       OR FIND_IN_SET('พื้น', building_issue) > 0 
       OR FIND_IN_SET('ผนัง', building_issue) > 0
       OR FIND_IN_SET('เสา', building_issue) > 0 
       OR FIND_IN_SET('หลังคา', building_issue) > 0)
       AND YEAR(u_date) = $selectedYear
       AND MONTH(u_date) BETWEEN $startMonth AND $endMonth

    UNION ALL


    SELECT 'ปัญหาระบบไฟฟ้า', COUNT(*) 
    FROM tbl_repair 
    WHERE (FIND_IN_SET('สวิทซ์', electrical_issue) > 0 
       OR FIND_IN_SET('ปลั๊ก', electrical_issue) > 0 
       OR FIND_IN_SET('หลอดไฟ', electrical_issue) > 0 
       OR FIND_IN_SET('สายไฟ', electrical_issue) > 0
       OR FIND_IN_SET('ตู้ควบคุม', electrical_issue) > 0)
       AND YEAR(u_date) = $selectedYear
       AND MONTH(u_date) BETWEEN $startMonth AND $endMonth

    UNION ALL




    SELECT 'ปัญหาระบบประปา/สุขาภิบาล', COUNT(*) 
    FROM tbl_repair 
    WHERE (FIND_IN_SET('ก๊อกน้ำ', plumbing_issue) > 0 
       OR FIND_IN_SET('ท่อน้ำดี', plumbing_issue) > 0 
       OR FIND_IN_SET('ท่อน้ำเสีย', plumbing_issue) > 0 
       OR FIND_IN_SET('สายชำระ', plumbing_issue) > 0
       OR FIND_IN_SET('ชักโครก', plumbing_issue) > 0 
       OR FIND_IN_SET('โถปัสสาวะ', plumbing_issue) > 0)
       AND YEAR(u_date) = $selectedYear
       AND MONTH(u_date) BETWEEN $startMonth AND $endMonth

    UNION ALL

    SELECT 'ปัญหาระบบเครื่องปรับอากาศ', COUNT(*) 
    FROM tbl_repair 
    WHERE (FIND_IN_SET('เปิดไม่ติด', aircon_issue) > 0 
       OR FIND_IN_SET('แอร์ไม่เย็น', aircon_issue) > 0 
       OR FIND_IN_SET('เสียงดัง', aircon_issue) > 0 
       OR FIND_IN_SET('น้ำหยด', aircon_issue) > 0
       OR FIND_IN_SET('รีโมทชำรุด', aircon_issue) > 0)
       AND YEAR(u_date) = $selectedYear
       AND MONTH(u_date) BETWEEN $startMonth AND $endMonth

    UNION ALL

    SELECT 'งานครุภัณฑ์อื่นๆ', COUNT(*) 
    FROM tbl_repair 
    WHERE other_issue IS NOT NULL AND other_issue != ''
    AND YEAR(u_date) = $selectedYear
    AND MONTH(u_date) BETWEEN $startMonth AND $endMonth
";

$resultIssueTypes = mysqli_query($conn, $sqlIssueTypes);
$issueTypesData = [];
if ($resultIssueTypes) {
    while ($row = mysqli_fetch_assoc($resultIssueTypes)) {
        $issueTypesData[] = $row;
    }
}
?>



<form method="GET" action="main.php" style="display: flex; align-items: center; gap: 10px;">
    <label for="year">เลือกปี:</label>
    <select name="year" id="year" style="padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
        <?php
        $currentYear = date("Y");
        $startYear = 2023;
        for ($year = $startYear; $year <= $currentYear + 10; $year++) {
            echo "<option value='$year' " . ($selectedYear == $year ? 'selected' : '') . ">$year</option>";
        }
        ?>
    </select>

    <label for="startMonth">จากเดือน:</label>
    <select name="startMonth" id="startMonth" style="padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
        <?php
        $thaiMonths = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
        for ($i = 1; $i <= 12; $i++) {
            echo "<option value='$i'>" . $thaiMonths[$i-1] . "</option>";
        }
        ?>
    </select>

    <label for="endMonth">ถึงเดือน:</label>
<select name="endMonth" id="endMonth" style="padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
    <?php
    $defaultEndMonth = 12; // ค่าเริ่มต้นเป็นเดือนธันวาคม
    for ($i = 1; $i <= 12; $i++) {
        $selected = ($i == $defaultEndMonth) ? 'selected' : '';
        echo "<option value='$i' $selected>" . $thaiMonths[$i-1] . "</option>";
    }
    ?>
</select>


    <button type="submit" style="padding: 8px 15px; border: none; background-color: #007bff; color: white; border-radius: 5px; cursor: pointer; font-size: 16px;">
        แสดงผล
    </button>
</form>



<style>
    button:hover {
        background-color: #0056b3; /* สีเข้มขึ้นเมื่อ hover */
    }
</style>

<br>

<div class="row clearfix">
    <!-- กราฟจำนวนคำขอที่ได้รับในแต่ละเดือน -->
    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-8">
        <div class="card">
            <div class="card-header">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-2 pb-1">
                    <h6 class="text-white text-capitalize ps-3">จำนวนคำขอที่ได้รับในแต่ละเดือน</h6>
                </div>
            </div>
            
            <div class="card-body">
                <canvas id="monthlyRequestsChart"></canvas>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

                <script>
                    const monthlyRequestsData = <?php echo json_encode($monthlyRequests); ?>;

                    // ฟังก์ชันแปลงเดือนเป็นภาษาไทย
                    const thaiMonths = [
                        'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
                        'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
                    ];
                    
                    // แสดงเดือนเป็นภาษาไทย
                    const thaiMonthLabels = monthlyRequestsData.map(item => `เดือน ${thaiMonths[item.month - 1]}`);

                    const data = {
                        labels: thaiMonthLabels,
                        datasets: [{
                            label: 'จำนวนคำขอที่ได้รับในแต่ละเดือน',
                            data: monthlyRequestsData.map(item => item.request_count),
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    };
                    

                    const config = {
                        type: 'bar',
                            data: data,
                            options: {
                                layout: {
                                    padding: {
                                        top: 30 // เพิ่มช่องว่างด้านบนของกราฟ
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                            plugins: {
                                legend: {
                                    display: false // ซ่อนป้ายชื่อ
                                    },

                                datalabels: {
                                    anchor: 'end', // ตำแหน่งที่จะแสดง
                                    align: 'end',  // ตำแหน่งการจัดการแสดง
                                    color: '#000', // สีของตัวเลข
                                    font: {
                                        weight: 'bold'
                                    },
                                    formatter: function(value, context) {
                                        return value; // แสดงตัวเลขจาก data
                                    }
                                }
                            }
                        },
                        plugins: [ChartDataLabels]
                    };

                    const monthlyRequestsChart = new Chart(
                        document.getElementById('monthlyRequestsChart'),
                        config
                    );
                </script>
            </div>
        </div>
    </div>

    <!-- กราฟจำนวนคำขอที่ได้รับในแต่ละประเภทปัญหา -->
    <div class="col-lg-12 col-md-12 col-sm-8 col-xs-8">
        <div class="card">
            <div class="card-header">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-2 pb-1">
                    <h6 class="text-white text-capitalize ps-3">จำนวนคำขอที่ได้รับในแต่ละประเภทปัญหา</h6>
                </div>
            </div>
            <div class="card-body">
                <canvas id="issueTypesChart"></canvas>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

                <script>
                    const issueTypesData = <?php echo json_encode($issueTypesData); ?>;
                    const issueLabels = issueTypesData.map(item => item.issue_type);
                    const issueCounts = issueTypesData.map(item => item.request_count);
                
                    const issueData = {
                        labels: issueLabels,
                        datasets: [{
                            label: 'จำนวนคำขอในแต่ละประเภทปัญหา',
                            data: issueCounts,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    };

                    const issueConfig = {
                        type: 'pie', // กราฟวงกลม
                        data: issueData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false, // ให้สามารถปรับขนาดได้
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'right', // วาง legend ด้านข้าง
                                    labels: {
                                        boxWidth: 20, // ขนาดกล่องสี
                                        padding: 15 // ช่องว่างระหว่างรายการ
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return `${tooltipItem.label}: ${tooltipItem.raw}`; // แสดงจำนวนคำขอ
                                        }
                                    }
                                },
                                datalabels: {
                                    color: '#000',
                                    font: {
                                        weight: 'bold'
                                    },
                                    formatter: function(value) {
                                        return value; // แสดงจำนวนคำขอ
                                    }
                                }
                            }
                        },
                        plugins: [ChartDataLabels]
                    };

                    const issueTypesChart = new Chart(
                        document.getElementById('issueTypesChart'),
                        issueConfig
                    );
                </script>
            </div>
        </div>
    </div>

</div>




        </div>
    </div>
</section>

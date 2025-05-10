<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");
include("menu.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Schedule</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.10.1/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.1/main.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<style>
    @media only screen and (max-width: 600px) {
        .card {
            margin-bottom: 20px;
        }
        #calendar {
            font-size: 14px; /* ปรับขนาดฟอนต์ */
            width: 100%; /* ปรับความกว้าง */
        }
        .btn {
            font-size: 16px; /* ขยายปุ่ม */
            padding: 10px 20px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: <?php echo json_encode($events); ?>,
            eventClick: function(info) {
                var event = info.event;
                window.location.href = "ScheduleShow.php?id=" + event.id;
            }
        });

        calendar.render();

        // Change view on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth < 600) {
                calendar.changeView('dayGridWeek');
            } else {
                calendar.changeView('dayGridMonth');
            }
        });
    });
</script>



</head>
<body>
    
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h4>กำหนดการทำงาน</h4>
                <div class="row clearfix"></div>
            </div>
            <div class="row clearfix">
                <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <form action="workSchedule.php" method="get" class="form-inline">
                                <div class="input-group input-group-outline">
                                    <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                                        <?php if ($_SESSION['per_type'] == 1 || $_SESSION['per_type'] == 2): ?>
                                            <a href="ScheduleCreate.php" class="btn btn-success"><i class="material-icons text-xl me-2">add</i>เพิ่มรายละเอียด</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: <?php
                    // แก้ไข SQL query เพื่อเลือก sch_topic
                    $sql = "SELECT s.sch_id, s.sch_topic, s.sch_date, s.details, p.per_name, p.per_lastname 
                            FROM tbl_schedule s 
                            LEFT JOIN tbl_repair r ON s.rep_ID = r.rep_ID 
                            LEFT JOIN tbl_personnel p ON s.per_id = p.per_id";
                    $result = mysqli_query($conn, $sql);
                    $events = array();

                    while($row = mysqli_fetch_assoc($result)) {
                        $events[] = array(
                            'id' => $row['sch_id'],
                            'title' => $row['sch_topic'], // ใช้ sch_topic แทน equipment_address
                            'start' => $row['sch_date'],
                            'details' => $row['details'],
                            'per_name' => $row['per_name'] . ' ' . $row['per_lastname']
                        );
                    }
                    echo json_encode($events);
                ?>,
                eventClick: function(info) {
                    var event = info.event;
                    window.location.href = "ScheduleShow.php?id=" + event.id;
                }
            });

            calendar.render();
        });
    </script>
</body>
</html>

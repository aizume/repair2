<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <script>
        alert("ออกจากระบบสำเร็จ");
        window.location.href = "index.php";
    </script>
</head>
<body>
</body>
</html>

<?php
    $server = "localhost";
    $username = "root"; 
    $password = "";
    $dbname = "db_utilities_repair";
    $conn = mysqli_connect($server, $username, $password, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_query($conn, "SET NAMES UTF8");
?>

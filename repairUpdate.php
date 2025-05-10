<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("connect.php");

// Get data from form
$rep_ID = $_POST['rep_ID'];
$problem = $_POST['problem'];
$solution = isset($_POST['solution']) ? $_POST['solution'] : '';
$solution_other = isset($_POST['solution_other']) ? $_POST['solution_other'] : '';
$c_date = $_POST['c_date'];
$rep_no = $_POST['rep_no'];
$rep_status = $_POST['rep_status'];

// Update repair information in tbl_repair
$sqlUpdate = "UPDATE tbl_repair SET 
    problem = '$problem',
    solution = '$solution',
    solution_other = '$solution_other',
    c_date = '$c_date',
    rep_no = '$rep_no',
    rep_status = '$rep_status'
    WHERE rep_ID = '$rep_ID'";

if (mysqli_query($conn, $sqlUpdate)) {
    // Handle materials
    // First, delete existing materials for this repair
    $sqlDeleteMaterials = "DELETE FROM tbl_materials_used WHERE rep_ID = '$rep_ID'";
    mysqli_query($conn, $sqlDeleteMaterials);

    // Insert new materials
    if (isset($_POST['material_name'])) {
        $material_names = $_POST['material_name'];
        $material_sizes = $_POST['material_size'];
        $material_quantities = $_POST['material_quantity'];
        $material_units = $_POST['material_unit'];
        $material_notes = $_POST['material_notes'];

        foreach ($material_names as $index => $name) {
            $size = mysqli_real_escape_string($conn, $material_sizes[$index]);
            $quantity = mysqli_real_escape_string($conn, $material_quantities[$index]);
            $unit = mysqli_real_escape_string($conn, $material_units[$index]);
            $notes = mysqli_real_escape_string($conn, $material_notes[$index]);

            if (!empty($name)) {
                $sqlInsertMaterial = "INSERT INTO tbl_materials_used (rep_ID, material_name, material_size, material_quantity, material_unit, material_notes) VALUES ('$rep_ID', '$name', '$size', '$quantity', '$unit', '$notes')";
                mysqli_query($conn, $sqlInsertMaterial);
            }
        }
    }

    echo "<script>alert('ข้อมูลถูกบันทึกเรียบร้อยแล้ว'); window.location.href='repirList.php';</script>";
} else {
    echo "<script>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล'); window.history.back();</script>";
}

mysqli_close($conn);
?>

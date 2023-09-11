<?php
include("config.php");

$query = "DELETE FROM attendance";
$data = mysqli_query($conn,$query);
echo "Table Data Erased Successfully";
?>
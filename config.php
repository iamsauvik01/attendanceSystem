<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "attendanceSystem";


$conn = mysqli_connect($servername, $username, $password, $dbName);

if($conn){
    // echo "Connected To Database.<p>";
}

else{
    echo "Database Connection Error".mysqli_connect_error();
}


?>



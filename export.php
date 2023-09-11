<?php
include("config.php");

if (isset($_POST['export'])) {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    // Validate and format dates
    $formattedStartDate = date('Y-m-d', strtotime($startDate));
    $formattedEndDate = date('Y-m-d', strtotime($endDate));

    $query = "SELECT list.name, list.category, attendance.id, attendance.entry_time, attendance.exit_time
              FROM attendance
              INNER JOIN list ON attendance.id = list.id
              WHERE DATE(attendance.entry_time) >= ? AND DATE(attendance.exit_time) <= ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $formattedStartDate, $formattedEndDate);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $directory = 'D:/';
        $dateForFile = date('Y-m-d');
        $filename = $directory . $dateForFile . '.csv';
        $file = fopen($filename, 'w');

        if ($file) {
            $header = array('ID', 'Name', 'Category', 'Entry Time', 'Exit Time');
            fputcsv($file, $header);

            while ($row = mysqli_fetch_assoc($result)) {
                $rowData = array(
                    $row['id'],
                    $row['name'],
                    $row['category'],
                    $row['entry_time'],
                    $row['exit_time']
                );
                fputcsv($file, $rowData);
            }

            fclose($file);
            echo "File Saved Successfully at " . $filename;
        } else {
            echo "Failed to open file for writing.";
        }
    } else {
        echo "Query failed: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
?>





<!DOCTYPE html>
<html>
<head>
  <title>Export Attendance</title>
  <style>

  a{
    text-decoration: none;
    color: inherit;
  }

  body {
  height: 100vh;
  background-color: #e0f1f0;
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  display: grid;
  place-items:center;
}

.container{
  height: 20vh;
  width: 100vw;
  display: flex;
  justify-content: space-evenly;
}

.container img{
width: auto;
height: 100px;
}

.logo{
padding-top: 8px;
height: 150px;
width: auto;
}

.container button{
  height: 50px;
  width: 110px;
  margin: 20px 0 0 40px;
  background:  #2ac4aa;
  border: none;
  outline: none;
  border-radius: 20px;
  font-weight: bold;
  color: white;
  cursor: pointer;
}

.container-two {
  width: 600px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}


h1 {
  text-align: center;
}

.form-box {
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 5px;
}

form {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 30px;
}

label {
  margin-bottom: 10px;
}

input[type="date"],
input[type="submit"] {
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin: 10px;
}

input[type="submit"] {
  background-color: #00CAC7;
  color: white;
  cursor: pointer;
}

  </style>
</head>
<body>

<div class="container">
    <img src="./Images/logo l.png">
    <div>
        <a href ="addItems.php">
        <button >Add Student</button>
        </a>

        <a href="delete.php">
            <button>Delete</button>
        </a>

        <a href="import.php">
            <button>Import</button>
        </a>
    </div>

</div> 

  <div class="container-two">
    <h1>Attendance Export</h1>
    <div class="form-box">
      <form method="post" action="">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>
        <input type="submit" name="export" value="Export Attendance">
      </form>
    </div>
  </div>
</body>
</html>


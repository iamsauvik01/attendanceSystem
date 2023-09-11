<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./record.css">
    <title>Attendance Records</title>
</head>
<body>
    <img src="./Images/logo l.png" alt="">
    <?php
    include("config.php");
    // Fetch attendance records
    $query = "SELECT list.name,list.category, attendance.id, attendance.entry_time, attendance.exit_time
              FROM attendance
              INNER JOIN list ON attendance.id = list.id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<h1 class='heading'>Attendance Records</h1>";
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Entry Time</th>
                    <th>Exit Time</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $entry_time = $row['entry_time'];
            $exit_time = $row['exit_time'];
            $name = $row['name'];
            $category = $row['category'];

            echo "<tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$category</td>
                    <td>$entry_time</td>
                    <td>$exit_time</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No attendance records found.</p>";
    }

    mysqli_close($conn);
    ?>
</body>
</html>

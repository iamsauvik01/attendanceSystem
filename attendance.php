<!DOCTYPE html>
<html>
  <head>
    <title>HID Barcode Attendance System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="attendance.css">

    <script>
      function displayPopup() {
        var popup = document.getElementById("popup");
        popup.style.display = "block";
        setTimeout(function () {
          popup.style.display = "none";
        }, 3000);
      }
    </script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

  </head>
  <body>
    <img class="bgImage" src="./Images/bgImages/3.jpeg" alt="">
    <div class="container">
      <img class="logo" src="./Images/logo l.png">
      <h1>Central Library Mangaldai College</h1>
    </div>   

    <form class="form" action="" method="POST">
      <div class="header-container">
        <h2 class="heading">Please Scan Your ID</h2>
      </div>

      <div class="table">
        <tr>
          <td><input class="id-box" name="id" type="text" id="barcode" autofocus /></td> 
          <td><input class="submit-button" type="submit" value="Save" name="submit"></td>
        </tr> 
      </div>

      <h1 class="showAttendance"><a href="record.php">Show Attendance</a></h1>
    </form>

    <?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Check if the ID exists in the database
    $query = "SELECT * FROM attendance WHERE id = $id ORDER BY entry_time DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    // Get the current timestamp with timezone
    date_default_timezone_set('Asia/Kolkata'); // Replace 'Your_Timezone' with your timezone identifier
    $current_time = time();
    $current_datetime = date('Y-m-d H:i:s', $current_time);

    if (mysqli_num_rows($result) === 0) {
        // ID does not exist, create a new entry
        $entry_time = date("Y-m-d H:i:s");
        $exit_time = null;
        $insert_query = "INSERT INTO attendance (id, entry_time, exit_time) VALUES ($id, '$entry_time', NULL)";
        $insert_result = mysqli_query($conn, $insert_query);
        if ($insert_result) {
            echo "<div id='popup' class='popup'><span><h1>Welcome To The<br>CENTRAL LIBRARY <br>MANGALDAI COLLEGE</h1></span></div>";
            echo "<script>displayPopup();</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // ID exists, check if exit_time is empty for the last entry
        $last_entry = mysqli_fetch_assoc($result);
        if (empty($last_entry['exit_time'])) {
            // Exit time is vacant, update the exit time for the last entry
            $exit_time = date("Y-m-d H:i:s");
            $update_query = "UPDATE attendance SET exit_time = '$exit_time' WHERE id = $id AND exit_time IS NULL ORDER BY entry_time DESC LIMIT 1";
            $update_result = mysqli_query($conn, $update_query);
            if ($update_result) {
                echo "<div id='popup' class='popup'><span><h1>Thank You For Visiting<br>CENTRAL LIBRARY <br>MANGALDAI COLLEGE</h1></span></div>";
                echo "<script>displayPopup();</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // Exit time is occupied, create another entry
            $entry_time = date("Y-m-d H:i:s");
            $exit_time = null;
            $insert_query = "INSERT INTO attendance (id, entry_time, exit_time) VALUES ($id, '$entry_time', NULL)";
            $insert_result = mysqli_query($conn, $insert_query);
            if ($insert_result) {
                echo "<div id='popup' class='popup'><span><h1>Welcome To The<br>CENTRAL LIBRARY <br>MANGALDAI COLLEGE</h1></span></div>";
                echo "<script>displayPopup();</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}

mysqli_close($conn);


?>
</body>
</html>

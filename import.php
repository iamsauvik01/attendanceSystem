<!DOCTYPE html>
<html>
<head>
  <title>CSV File Import</title>
  <style>
body {
  height: 100vh;
  background-color: #edfbff;
  overflow: hidden;
  }

a{
  text-decoration: none;
  color: inherit;
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

.container-two{
  margin-top: 150px;
  width: 100vw;
  display: grid;
  place-items: center;
}

    form {
      max-width: 30vw;
      display: flex;
      flex-direction: column;
      align-items: center;
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    input[type="file"] {
      margin-bottom: 10px;
      padding: 10px;
      font-size: 16px;
    }

    input[type="submit"] {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #00CAC7;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #00A9A6;
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
  <form action="import.php" method="post" enctype="multipart/form-data">
    <input type="file" name="csvfile" accept=".csv" multiple>
    <input type="submit" value="Import">
  </form>
</div>

</body>
</html>


<?php

include("config.php");

if (isset($_FILES["csvfile"]) && $_FILES["csvfile"]["error"] == UPLOAD_ERR_OK) {
    $csvfile = $_FILES["csvfile"]["tmp_name"];

    // Open the CSV file
    if (($handle = fopen($csvfile, "r")) !== FALSE) {
        // Skip the header row
        fgetcsv($handle);

        // Process each line in the CSV file
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Retrieve the values from the CSV
            $id = $data[0];
            $name = $data[1];
            $category = $data[2];
            $gender = $data[3];

            // Perform any necessary validation or data manipulation

            // Prepare the SQL statement
            $sql = "INSERT INTO list (id, name, category, gender)
                    VALUES ('$id', '$name', '$category', '$gender')";

            // Execute the SQL statement
            if ($conn->query($sql) !== TRUE) {
                echo "Error inserting data: " ;
                break;
            }
        }

        fclose($handle);
        echo "CSV file imported successfully!";
    } else {
        echo "Error opening CSV file.";
    }
}

$conn->close();
?>
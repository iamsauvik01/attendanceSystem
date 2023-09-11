<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="record.css">
    <link rel="stylesheet" href="addItems.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Martel+Sans&display=swap" rel="stylesheet">
    
</head>
<body>
<div class="container">
  <img src="./Images/logo l.png">
  </div>

  <!DOCTYPE html>
<html>
<head>
  <title>Form Example</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<form action="" method="POST">
  <h2>Enter student details</h2>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="id">ID:</label>
    <input type="text" id="id" name="id" required>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
      <option value="male">Male</option>
      <option value="female">Female</option>
      <option value="other">Other</option>
    </select>

    <label for="category">Category:</label>
    <select id="category" name="category" required>
      <option value="UG">UG</option>
      <option value="PG">PG</option>
      <option value="assistant_professor">Assistant Professor</option>
      <option value="worker">Worker</option>
    </select>

    <input class="submit" type="submit" name="submit"></input>
  </form>

<?php
include("config.php");

if(isset($_POST['submit'])){ // Checking if the form was submitted


  $name = $_POST['name'];
  $id = $_POST['id'];
  $gender = $_POST['gender'];
  $category = $_POST['category'];

  $query = "INSERT INTO `list` (`name`, `id`, `gender`, `category`) VALUES ('$name', '$id', '$gender', '$category')";
  
  if(mysqli_query($conn, $query)){
    echo "Data stored successfully!";
  } else{
    echo "Error: " . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>
</body>
</html>

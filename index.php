<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="record.css">
    <link rel="stylesheet" href="addItems.css"></link>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Martel+Sans&display=swap" rel="stylesheet">

<style>
   form input{
    height: 30px;
    border-radius: 3px;
    font-size: 1rem;
   } 
  .container img{
    height: 150px;
   }
</style>
    
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
    <label for="username">Username</label>
    <input type="text" name="username" required>

    <label for="password">Password</label>
    <input type="password" name="password" required>

    <input class="submit" type="submit" name="submit" value="Login"></input>
  </form>

<?php
include("config.php");

if(isset($_POST['submit'])){ // Checking if the form was submitted


  $username = $_POST['username'];
  $password = $_POST['password'];
  

  // $query = "SELECT * FROM adminTable WHERE username = '$username' AND password = '$password' ";

  // $result = mysqli_query($conn, $query);
  // $data = mysqli_num_rows($result);
  
  // if($data == 1){
  //   $login = false ;
  //   session_start();
  //   $_SESSION['loggedIn'] = true;
  //   header("Location: attendance.php");
  // }
  //   else{
  //       echo "Enter Valid Credentials";
  // }

    if($username == 'user' && $password == '1234'){
      session_start();
      $_SESSION['user'] = true;
      header("Location: attendance.php");
    }
    
    elseif($username == 'admin' && $password == '4321'){
      header("Location: export.php");
    }


}

mysqli_close($conn);
?>
</body>
</html>

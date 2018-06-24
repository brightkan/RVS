<?php 
// This ensures that if the user access the page  without
// loging as the manager the program will redirect the to the manager login page
session_start();
if(!isset($_SESSION["admin"])){
  header("location:admin_login.php");
  exit();
}

//Be sure to check that this manager SESSION value is in the database
$username = preg_replace('#[^A-Za-z0-9]#i','', $_SESSION['admin']);//filter everything but numbers and letters
//filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i','', $_SESSION['password']);//filter everything but numbers and letters

//Run mySQL query to be sure that this person is an admin and that their tokens are qual to the database information
//connect to the database
include '../connect/connect_to_mysql.php';
$sql = mysqli_query($conn,"SELECT * FROM admin WHERE username
 = '$username'AND password = '$password' LIMIT 1");// QUERY THE PERSON

//------MAKE SURE PERSON EXISTS IN THE DATABASE ---

$existCount = mysqli_num_rows($sql); // count the rows
if($existCount==0){//evaluate the count
  echo "Your login session is not in the records";
  exit();
}


include '../connect/connect_to_mysql.php';
include '../functions/functions.php';


?>


<!DOCTYPE html>
<html>
<head>
  <title>View Results</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css?lidgafyuhgfbhegdfuhkgkefhguydkluiwfolafhdl">
    <link rel="stylesheet" type="text/css" href="../css/animate.css">
      <link href="../css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1,     user-scalable=0">
  
    <script src="js/jquery-1.11.0.min.js"></script>
</head>
<style type="text/css">
    .myuser {
        border: 1px solid #fff;
        
        padding: 5px;
    }
</style>
<body>

  <h1 style="text-align: center">View Results </h1>

  <div class="container">
  <a href="index.php"><button class="btn btn-lg btn-success">Back to the landing Page</button></a>
  <center>
  <h3>GRC</h3>
 <?php count_votes_and_render_results_admin($conn,'grc'); ?>

   <h3>PRESIDENT</h3>
 <?php count_votes_and_render_results_admin($conn,'president'); ?>

  <h3>SECRETARY</h3>
 <?php count_votes_and_render_results_admin($conn,'secretary'); ?>

   <h3>CONSTITUTIONAL AFFAIRS</h3>
 <?php count_votes_and_render_results_admin($conn,'constitutional_affairs'); ?>

  </center>
  </div>


</body>
<script src="../js/bootstrap.js"></script>
</html>
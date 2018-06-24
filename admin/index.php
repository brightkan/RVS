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
?>



<!DOCTYPE html>
<html>
<head>
  <title>Admin: Landing Page</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css?lidgafyuhgfbhegdfuhkgkefhguydkluiwfolafhdl">
    <link rel="stylesheet" type="text/css" href="../css/animate.css">
      <link href="../css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1,     user-scalable=0">
  
    <script src="js/jquery-1.11.0.min.js"></script>
</head>
<style type="text/css">

.main button {
	width: 99%;
	margin-left: auto;
	 margin-right: auto;
	 font-size: 20px;
	margin-top: 5px;
}
	
</style>
<body style="background: url(../images/overlays/15.png) top, url(../images/vote.jpg) bottom; background-size: cover; background-repeat: no-repeat; background-position: center; height: 100vh; overflow-y: hidden;">
<div class="container main">
	<center><h1 style="font-size: 100px; color: #fff"><i class="fa fa-gear"></i></h1></center>
	<center><h1 style="color: #fff">Welcome to the administrator site of the RVSUDC</h1></center>
	<div class="panel panel-default animated slideInUp" style="width:80%; margin-left: auto; margin-right: auto; height: 0 auto; display: block;margin-top: auto; margin-bottom: auto; background-color: rgba(255,255,255,0.5);">
	<div class="panel-body">
        <center><img class='img img-responsive img-circle' src="../images/Mak_logo.png" alt="Makerere University logo" style="border: 5px solid white; padding: 5px;"></center>
		<a href="uploadCandidates.php"><button class="btn btn-success">Upload Candidates</button></a>
		<a href="viewCandidates.php"><button class="btn btn-success">View Candidates</button></a>
		<a href="viewVoters.php"><button class="btn btn-success">View Registered Voters</button></a>
		<a href="viewResults.php"><button class="btn btn-success">View Results</button></a>
		<a href="logout.php"><button class="btn btn-success">Log Out</button></a>

	</div>
</div>
</div>

</body>
<script src="js/bootstrap.js"></script>
</html>
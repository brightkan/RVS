<?php

session_start();
if(!isset($_SESSION["voter"])){
	header("location:voter_login.php");
	exit();
}

//Be sure to check that this manager SESSION value is in the database
$voterID = preg_replace('#[^0-9]#i','', $_SESSION['voter']);//filter everything but numbers and letters
//filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i','', $_SESSION['password']);//filter everything but numbers and letters

$username = $_SESSION['username'];

include 'connect/connect_to_mysql.php';
$sql = mysqli_query($conn,"SELECT * FROM voter WHERE id = '$voterID'AND voter_status = 'yes' LIMIT 1");// QUERY THE PERSON
$votedCount = mysqli_num_rows($sql);
if($votedCount < 1){//evaluate the count
  header("location:index.php");
  exit();
}


?>

<!DOCTYPE html>
<html>
<head>
  <title>Vote</title>
  <link rel="stylesheet" type="text/css" href="css/style.css?lidgafyuhgfbhegdfuhkgkefhguydkluiwfolafhdl">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
      <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1,     user-scalable=0">
    <script src="js/jquery-1.11.0.min.js"></script>
</head>

<body>
	<?php include_once("template_nav.php"); ?>
	<h1 style="text-align: center">You have already voted</h1>
	<center><a href="view_results.php"><button class="btn btn-success">View Results</button></a>
		</center>
		<br/>
	<div class="alert alert-warning" style="width: 600px; margin: 0 auto;">
		<em>If you have not voted and you are seeing this screen, contact the adminstrator</em>
		
	</div>
</body>
<script src="js/bootstrap.js"></script>
</html>
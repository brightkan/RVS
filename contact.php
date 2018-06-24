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
?>

<!DOCTYPE html>
<html>
<head>
  <title>Contact Us</title>
  <link rel="stylesheet" type="text/css" href="css/style.css?lidgafyuhgfbhegdfuhkgkefhguydkluiwfolafhdl">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
      <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1,     user-scalable=0">
  
    <script src="js/jquery-1.11.0.min.js"></script>
</head>

<body style="background: url(images/vote.jpg) no-repeat center center fixed; background-size: cover;">
<div class="overlay animated fadeIn" style="position: fixed; height: 100vh; width:100vw; left: 0; top:0; 
  background:url(images/overlays/11.png) repeat; z-index: -1"></div>

<?php include_once("template_nav.php"); ?>

<div class="container">
    <div class="row">
        <div class="bg-white" style="background: #fff; color:#000; padding: 10px;">
          <h1>Group 18</h1>
         <em>Thesis Project, Makerere University</em>
        </div>
    </div>
  </div>

</body>
<script src="js/bootstrap.js"></script>
</html>	
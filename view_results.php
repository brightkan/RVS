<?php 

   session_start();
if(!isset($_SESSION["voter"])){
	header("location:voter_login.php");
	exit();
}

$voterID = preg_replace('#[^0-9]#i','', $_SESSION['voter']);
$username = $_SESSION['username'];

include 'connect/connect_to_mysql.php';
include 'functions/functions.php';


?>


<!DOCTYPE html>
<html>
<head>
  <title>View Results</title>
  <link rel="stylesheet" type="text/css" href="css/style.css?lidgafyuhgfbhegdfuhkgkefhguydkluiwfolafhdl">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
      <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1,     user-scalable=0">
    <script src="js/jquery-1.11.0.min.js"></script>
</head>

<body style="overflow-x: auto;">

  <?php include_once 'template_nav.php';    ?>

  <h1 style="text-align: center">View Results </h1>

  <div class="container">

  <center>
  <h3>GRC</h3>
 <?php count_votes_and_render_results($conn,'grc'); ?>

   <h3>PRESIDENT</h3>
 <?php count_votes_and_render_results($conn,'president'); ?>

  <h3>SECRETARY</h3>
 <?php count_votes_and_render_results($conn,'secretary'); ?>

   <h3>CONSTITUTIONAL AFFAIRS</h3>
 <?php count_votes_and_render_results($conn,'constitutional_affairs'); ?>

  </center>
  </div>


</body>
<script src="js/bootstrap.js"></script>
</html>
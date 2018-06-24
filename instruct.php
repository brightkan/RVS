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
  <title>Instructions</title>
  <link rel="stylesheet" type="text/css" href="css/style.css?lidgafyuhgfbhegdfuhkgkefhguydkluiwfolafhdl">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
      <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1,     user-scalable=0">
    <script src="js/jquery-1.11.0.min.js"></script>
</head>
<style type="text/css">
</style>
<body style="background: url(images/vote.jpg) no-repeat center center fixed; background-size: cover;">
<div class="overlay animated fadeIn loop" style="position: fixed; height: 100vh; width:100vw; left: 0; top:0;background:url(images/overlays/11.png) repeat; z-index: -1"></div>
	<?php include_once("template_nav.php"); ?>
<div class="container">
	<div class="panel panel-default animated slideInDown">
		<div class="panel-heading">
			<h3 class="panel-title"><h2>Instructions</h2></h3>
		</div>
		<div class="panel-body">
			<article class="Instructions" style="font-size: 20px;">
				<ul>
					<li>When you login or click to view the homepage, you are provided a ballot form</li>
					<li>In the ballot form, you are required to recognise your preffered candidate on the right side of the form</li>
					<li>You are required to choose the option on the same line as your preffered candidate details on the left side of the form</li>
					<li>You are required to choose atleast one of the options for every position (The system does not accept invalid votes)</li>
				</ul>
			</article>
		</div>
	</div>
</div>	
</body>
<script src="js/bootstrap.js"></script>
</html>
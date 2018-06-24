<?php

session_start();
if(!isset($_SESSION["voter"])){
	header("location:voter_login.php");
	exit();
}

$voterID = preg_replace('#[^0-9]#i','', $_SESSION['voter']);
$username = $_SESSION['username'];


	$targetID = "";
		$first_name = "";
		$last_name = "";
		$username = "";

		$prog_of_study = "";
		$college = "";
		$voting_status = "";


if(isset($_GET['id']) && $_GET['id'] == $voterID){
    

      $targetID = $_GET['id'];
       
      include 'connect/connect_to_mysql.php';  

      $sql = mysqli_query($conn,"SELECT * FROM voter WHERE id = '$targetID' LIMIT 1"); 
       
      $voterCount = mysqli_num_rows($sql);

       if($voterCount > 0){
	while($row = mysqli_fetch_array($sql)){
		$targetID = $row["id"];
		$first_name = $row["firstname"];
		$last_name = $row['lastname'];
		$username = $row['username'];

		$prog_of_study = $row['programofstudy'];
		$college = $row['college'];
		$voting_status = $row['voter_status'];
		
       
		
	}
} else {
	header('location:index.php');
}



   


 }  








?>


<!DOCTYPE html>
<html>
<head>
  <title>View Profile</title>
  <link rel="stylesheet" type="text/css" href="css/style.css?lidgafyuhgfbhegdfuhkgkefhguydkluiwfolafhdl">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
      <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1,     user-scalable=0">
    <script src="js/jquery-1.11.0.min.js"></script>
</head>

<body>

<?php include_once 'template_nav.php';    ?>

<h1 style="text-align: center">View Your Profile</h1>

<center>
	<table class="voter_details table"   cellpadding="4" style='position: relative; width:60%;  font-size: 2em;' >
      
    <tr><td><b>Student Number</b></td><td><b><?php echo $targetID  ?></b></td></tr>
	<tr><td><b>Name</b></td><td><b><?php echo $first_name." ".$last_name  ?></b></td></tr>
    <tr><td><b>Username</b></td><td><b><?php echo $username  ?></b></td></tr>
    <tr><td><b>Program of study</b></td><td><b><?php echo $prog_of_study ?></b></td></tr>
    <tr><td><b>College</b></td><td><b><?php echo $college ?></b></td></tr>
    <tr><td><b>Voting Status</b></td><td><b><em><?php 
     if($voting_status == 'yes'){
     	echo "You have already voted";
     }else {
     	echo "You have not voted yet";
     }
   
   

    ?></em></b></td></tr>
	</table>

	<a href="<?php echo "edit_voter.php?editid=".$targetID; ?>"><button class="btn btn-success">Edit Your profile</button></a>

</center>


</body>
<script src="js/bootstrap.js"></script>
</html>
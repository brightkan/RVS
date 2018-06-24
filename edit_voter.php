<?php

session_start();
if(!isset($_SESSION["voter"])){
	header("location:voter_login.php");
	exit();
}

$voterID = preg_replace('#[^0-9]#i','', $_SESSION['voter']);
$username = $_SESSION['username'];




if(isset($_GET['editid']) && $_GET['editid'] == $voterID){


       
      $targetID = $_GET['editid'];  
      
      


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
		

		
	}
}







} else {
	header('location:index.php');
}



if(isset($_POST['first_name'])){

$thisID = $_POST['thisID'];
$first_name = mysql_real_escape_string($_POST['first_name']);
$last_name = mysql_real_escape_string($_POST['last_name']);

$username = mysql_real_escape_string($_POST['username']);
$prog_of_study = mysql_real_escape_string($_POST['prog_of_study']);
$college = mysql_real_escape_string($_POST['college']);


 include 'connect/connect_to_mysql.php'; 
// UPDATE THE DATABASE
$sql = mysqli_query($conn,"UPDATE voter SET firstname = '$first_name', lastname = '$last_name', username = '$username', programofstudy = '$prog_of_study' WHERE id = '$thisID' ");



 header('location:index.php?update=success');
     exit();
     
 }





?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit your details</title>
	<link rel="stylesheet" type="text/css" href="css/style.css?lidgafyuhgfbhegdfuhkgkefhguydkluiwfolafhdl">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
      <link href="css/font-awesome.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<meta name="viewport" content="width=device-width, initial-scale=1,     user-scalable=0">
    <script src="js/jquery-1.11.0.min.js"></script>
</head>

<body>
<?php include_once("template_nav.php") ?>

<h1 style="text-align: center">Edit Your Profile</h1>

<form action="edit_voter.php" method="POST" enctype="multipart/form-data" class="voter-form" name="voter-form" id="inventory-form"  >
<center>
<table class="table"   cellpadding="4" style='position: relative; width:60%;' >

<tr><td  style="padding: 20px">First Name</td><td><input type="text" name="first_name" id="first_name" class="form-control active" value = "<?php echo $first_name; ?>"></td></tr>
<br/>
<tr><td style="padding: 20px">Last Name</td><td><input type="text" name="last_name" id="last_name" "    class="form-control" value = "<?php echo $last_name; ?>"></td></tr>

<tr><td style="padding: 20px">UserName</td><td><input type="text" name="username" id="username" "    class="form-control" value = "<?php echo $username; ?>"></td></tr>



<tr><td style="padding: 20px">Program of study</td><td>
<select class="form-control" id="prog_of_study"
 name="prog_of_study"> 

	<option value=""><?php echo $prog_of_study;?></option>
	<option >BIS</option>
	<option >BIT</option>
	<option >BIST</option>
	<option >BSSE</option>
	<option >BSCS</option>
</select>


</td></tr>

<tr><td  style="padding: 20px">College</td><td><input type="text" name="college" id="college" class="form-control active" value = "<?php echo $college; ?>" ></td></tr>

</table>
<input type="hidden" name="thisID" value="<?php echo $_SESSION['voter']; ?>" >

<center><button type = submit class="btn-success btn sucesss md btn-md">SAVE CHANGES</button></center>
</form>

</body>
<script src="js/bootstrap.js"></script>
</html>


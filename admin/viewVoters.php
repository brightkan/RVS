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
include '../functions/functions.php';
$sql = mysqli_query($conn,"SELECT * FROM admin WHERE username
 = '$username'AND password = '$password' LIMIT 1");// QUERY THE PERSON

//------MAKE SURE PERSON EXISTS IN THE DATABASE ---

$existCount = mysqli_num_rows($sql); // count the rows
if($existCount==0){//evaluate the count
	echo "Your login session is not in the records";
	exit();
}
 // Get Voters out of the database
 $voterRow = "";
 $sql = mysqli_query($conn,"SELECT * FROM voter ");
 $voterCount = mysqli_num_rows($sql);
 if ($voterCount > 0) {

     while($row = mysqli_fetch_array($sql)){

     	$name = $row['firstname'].' '.$row['lastname'];
        $studentNo = $row['id'];
        $voting_status = $row['voter_status'];

        $voter_status = 'No';
        if($voting_status == 'yes'){
                
             $voter_status = 'Yes';
        }

        $voterRow .= "<tr> 
                      <td>$name</td> 
                      <td>$studentNo</td> 
                      <td>$voter_status</td> 
                      </tr>

                      ";


     }
              
    



 } else

 {
     $voterRow = "There are no registered voters in the system";
 }

?>



<!DOCTYPE html>
<html>
<head>
	<title>View Registered Voters</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css?lidgafyuhgfbhegdfuhkgkefhguydkluiwfolafhdl">
    <link rel="stylesheet" type="text/css" href="../css/animate.css">
      <link href="../css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1,     user-scalable=0">
    <script src="js/jquery-1.11.0.min.js"></script>
</head>
<body>
	<div class="container">
		<a href="index.php"><button class="btn btn-lg btn-success">Back to the landing Page</button></a>
		<center><h1>View Registered Voters</h1></center>
        <center>
        	<table class="table table-striped table-hover" style="font-size: 20px;">
        		<tr style="font-weight: bold;">
        			<td>Name</td>
        			<td>Student Number</td>
        			<td>Voting Status</td>
        		</tr>
        		<?php echo $voterRow; ?>
        	</table>
        </center>

		
	</div>

</body>
<script src="js/bootstrap.js"></script>
</html>
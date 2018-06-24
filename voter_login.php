<?php 
// This ensures that if the voter access the page  without
// loging as the voter the program will redirect the to the manager login page
session_start();
if(isset($_SESSION["voter"])){
  header("location:index.php");
  exit();
}

$warn = '';
$username = '';

if(isset($_POST['id']) && isset($_POST ['password']) )
{
  $id = preg_replace('#[^A-Za-z0-9]#i','', $_POST['id']);//filter everything but numbers and letters
    $password = preg_replace('#[^A-Za-z0-9]#i','', $_POST['password']);//filter everything but numbers and letters
    //Run mySQL query to be sure that this person is an admin and that their tokens are qual to the database information
//connect to the database
include 'connect/connect_to_mysql.php';
$sql = mysqli_query($conn,"SELECT * FROM voter WHERE id = '$id' AND password = '$password' LIMIT 1");// QUERY THE PERSON//GAVE TOO MUCH TROUBLE GETTING THE MYSQLQUERY TO WORK mysql_num_rows FUNCTION



//------MAKE SURE PERSON EXISTS IN THE DATABASE ---

$existCount = mysqli_num_rows($sql); // count the rows

if($existCount == 1){//evaluate the count
  while($row=mysqli_fetch_array($sql)){
    $id = $row['id'];
    $username = $row['username'];

  }

  $_SESSION['voter'] = $id;
  
  $_SESSION['password'] = $password;
  $_SESSION['username'] = $username;

  header('location:index.php');
  exit();
}


  else  {
    
    $warn = '<div class="alert" style="position:absolute;
    width:40%; height: 0 auto; left:30%; top:20%; background:#fff; z-index:1;
       box-shadow: 5px 10px 5px 10px rgba(0,0,0,0.5);">
    <h1 style="font-size:4em">:( </h1>
    <h4 style="text-align:center"> Wrong password or Student Number !!</h4>
    <center><a href="voter_login.php"><button class="btn btn-outline-success " >Try again</button></a></center>
    </div>';     
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Voter login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css?Group-18projectinphp">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
  <meta name="viewport" content="width=device-width, initial-scale=1,     user-scalable=0">
	<script src="js/jquery-1.11.0.min.js"></script>

</head>
<body style="">
<div class='main-wrapper'>
  <div class="overlay animated fadeIn" style="position: absolute; height: 100vh; width:100vw; left: 0; top:0; 
  background:url(images/overlays/6.png) repeat;"></div>
<div class="wrapper animated flipInY">
<h1 style="font-family:'Times New Roman'; font-size: 35px; background: #fff">RVSUDC MAKERERE UNIVERSITY</h1>
<hr>
<h2 style="font-size: 20px;">Voter Login</h2>
<div >
<form method="POST"  action="voter_login.php" role="form"   class="form-horizontal" style=" float: left"> 

<div class="form-group"> 
  <label for="name">Student Number</label>
 <input type="text" class="form-control" name="id" placeholder="Enter student number" >
 
  </div> 

  <div class="form-group"> 
  <label for="name">Password</label>
 <input type="Password" class="form-control" name="password" placeholder="Enter Password">
 
  </div> 
 
  <button type="submit" class="btn btn-success">Login</button> 
</form>

<div class="more-info">
  <img src="images/Mak_logo.png" style="margin-left:auto; margin-right: auto; width: 60%; display: block;">
<h3 style="width:100%; text-align: center">You dont have an account,</h3> 
<a href="voter_reg.php"><center><button class="btn btn-danger">Register</button></center></a>
</div>

<?php 
echo $warn; 

?>

</div>
</div>
</body>
</html>
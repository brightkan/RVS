<?php 
// This ensures that if the voter access the page  without
// loging as the voter the program will redirect the to the manager login page
session_start();
if(isset($_SESSION["admin"])){
  header("location:index.php");
  exit();
}

$warn = '';

if(isset($_POST['username']) && isset($_POST ['password']) )
{
  $username = preg_replace('#[^A-Za-z0-9]#i','', $_POST['username']);//filter everything but numbers and letters
    $password = preg_replace('#[^A-Za-z0-9]#i','', $_POST['password']);//filter everything but numbers and letters
    //Run mySQL query to be sure that this person is an admin and that their tokens are qual to the database information
//connect to the database
include '../connect/connect_to_mysql.php';
$sql = mysqli_query($conn,"SELECT * FROM admin WHERE username = '$username' AND password = '$password' LIMIT 1");// QUERY THE PERSON//GAVE TOO MUCH TROUBLE GETTING THE MYSQLQUERY TO WORK mysql_num_rows FUNCTION



//------MAKE SURE PERSON EXISTS IN THE DATABASE ---

$existCount = mysqli_num_rows($sql); // count the rows

if($existCount == 1){//evaluate the count
  while($row=mysqli_fetch_array($sql)){
    $username = $row['username'];
    $password = $row['password'];


  }

  $_SESSION['admin'] = $username;
  
  $_SESSION['password'] = $password;

  header('location:index.php');
  exit();
}


  else  {
    
    $warn = '<div class="alert" style="position:absolute;
    width:40%; height: 0 auto; left:30%; top:20%; background:#fff; z-index:1">
    <h1 style="font-size:4em">:(</h1>
    <h4 style="text-align:center"> Wrong password or username </h4>
    <center><a href="admin_login.php"><button >Try again</button></a></center>
    </div>';     
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrator login</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/animate.css">
  <meta name="viewport" content="width=device-width, initial-scale=1,     user-scalable=0">
	<script src="js/jquery-1.11.0.min.js"></script>
</head>
<body>
<div class='main-wrapper'>
<div class="wrapper">
<h1 style="font-family:'Times New Roman'; font-size: 35px">RVSUDC MAKERERE UNIVERSITY</h1>
<hr>
<h2>Adminstrator Login</h2>
<div >
<form method="POST"  action="admin_login.php" role="form"   class="form-horizontal" style=" float: left; width:100%"> 

<div class="form-group"> 
  <label for="name">User name</label>
 <input type="text" class="form-control" name="username" placeholder="Enter your username" >
 
  </div> 

  <div class="form-group"> 
  <label for="name">Password</label>
 <input type="Password" class="form-control" name="password" placeholder="Enter Password">
 
  </div> 
 
  <button type="submit" class="btn btn-success">Login</button> 
</form>



<?php 
echo $warn; 

?>

</div>
</div>
</body>
</html>
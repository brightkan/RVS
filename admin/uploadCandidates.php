<?php 
// This ensures that if the user access the page  without
// loging as the manager the program will redirect the to the manager login page
ob_start();
session_start();
if(!isset($_SESSION["admin"])){
	header("location:admin_login.php");
	exit();
}

 include '../connect/connect_to_mysql.php';

if(isset($_POST['name'])){

$name = mysqli_real_escape_string($conn,$_POST['name']);
$nomination = $_POST['nomination'];
$position = mysqli_real_escape_string($conn,$_POST['position']);

// see if the product name is an identical match with any product in the database
$sql = mysqli_query($conn,"SELECT * from candidate WHERE nomination_form_no = '$nomination' LIMIT 1");
$product_match =  mysqli_num_rows($sql);
if($product_match > 0){
        echo "<center>
             <div class='alert animated bounceIn' style='position:absolute;
                 width:40%; height: 0 auto; left:30%; top:20%; background:#fff; z-index:2; box-shadow:rgba(0,47,0,0.5) 10px 10px 50px 40px'>
                <h1 style='font-size:2em; text-align:center'>Sorry you entered a duplicate nomination form number. Thank you</h1>
                <br><a href='uploadCandidates.php'><button class='btn btn-success'></button></a>
          </div>
          </center>";

   echo "<div style='z-index:1; position:fixed; top:0; left:0; height:100vh; width:100vw; background-color:rgba(255,255,255,0.7)'></div>";

}


// UPDATE THE DATABASE
$sql = mysqli_query($conn,"INSERT INTO candidate (name,position,nomination_form_no)
     VALUES('$name','$position','$nomination')");
     

     $pid = $nomination;

     // Place image in the folder
     $newname = $pid.'.jpg';

     if($_FILES['fileField']['tmp_name'] != ""){

     move_uploaded_file($_FILES['fileField']['tmp_name'], '../images/candidates/'.$newname);
     // CODE TO STOP BROWSER FROM REDOING THE ABOVE OPERATIONS AFTER THE USER PRESSES REFRESH

       header("location:viewCandidates.php?edit=success");
       exit();
     
 }



 
 

     
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Upload Candidates</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css?lidgafyuhgfbhegdfuhkgkefhguydkluiwfolafhdl">
    <link rel="stylesheet" type="text/css" href="../css/animate.css">
      <link href="../css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1,     user-scalable=0">
    <script src="js/jquery-1.11.0.min.js"></script>
</head>
<style type="text/css">

</style>
<body>
	<div class="container">
		<a href="index.php"><button class="btn btn-lg btn-success">Back to the landing Page</button></a>
		<center><h1>Upload Candidate Details</h1></center>
        <center>
        	<form method="POST" action="uploadCandidates.php" role="form" class="form-horizontal animated slideInLeft"  
        	 enctype="multipart/form-data" >

        		<div class="form-group">
                <label for="name" class="col-md-2 control-label">Name</label>
                <div class="col-md-6 inputGroupContainer">
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" name="name"  required>
                </div>
                </div>
                </div>

                    <div class="form-group">
                <label for="name" class="col-md-2 control-label">Form Nomination Number</label>
                <div class="col-md-6 inputGroupContainer">
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" name="nomination"  required>
                </div>
                </div>
                </div>
               
                 <div class="form-group">
                 <label for="name" class="col-md-2 control-label">Position</label>
                 <div class="col-md-6 inputGroupContainer">
                 <div class="input-group">
                 <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                 <select size="1" class="form-control dropdown" name="position" >
                 <option value="grc">GRC</option>
                 <option value="president">PRESIDENT</option>
                 <option value="secretary">SECRETARY</option>
                 <option value="Constitutional_affairs">CONSTITUTIONAL AFFAIRS</option>
                 </select>
              </div>
            </div>
          </div>
   
              	<div class="form-group">
                <label for="name" class="col-md-2 control-label">Upload candidate Picture</label>
                <div class="col-md-6 inputGroupContainer">
                <div class="input-group">
                <input type="file" name="fileField" id="fileField" class="form-control" value="upload" required>
                </div>
                </div>
                </div>
                <em>Picture to be uploaded should be 200px by 200px</em>
                <br>
          
               

             <button type="submit" class="btn btn-lg btn-primary">Upload</button>
        		
        	</form>
        </center>

		
	</div>

</body>
<script src="js/bootstrap.js"></script>
</html>
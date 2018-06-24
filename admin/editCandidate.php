<?php 
// This ensures that if the user access the page  without
// loging as the manager the program will redirect the to the manager login page
session_start();
if(!isset($_SESSION["admin"])){
	header("location:admin_login.php");
	exit();
}

 include '../connect/connect_to_mysql.php';
$targetID = '';

if(isset($_GET['editID'])){

   $targetID = $_GET['editID'];

    $sql = mysqli_query($conn,"SELECT * FROM candidate WHERE nomination_form_no = '$targetID' LIMIT 1"); 

    $candidateCount = mysqli_num_rows($sql);

         if($candidateCount > 0){
	while($row = mysqli_fetch_array($sql)){
		$targetID = $row["nomination_form_no"];
		$name = $row["name"];
		$pos = $row['position'];
	
			
	}
}


} 


if(isset($_POST['name'])){


$thisID = $_POST['thisID'];
$name = mysqli_real_escape_string($conn,$_POST['name']);
$position = mysqli_real_escape_string($conn,$_POST['position']);


// UPDATE THE DATABASE
$sql = mysqli_query($conn,"UPDATE candidate SET  name= '$name', position = '$position' WHERE nomination_form_no = '$thisID' ") or die(mysql_error());
   

	 // Place image in the folder
     $newname = $thisID.'.jpg';

     if($_FILES['fileField']['tmp_name'] != ""){

     move_uploaded_file($_FILES['fileField']['tmp_name'], '../images/candidates/'.$newname);
     // CODE TO STOP BROWSER FROM REDOING THE ABOVE OPERATIONS AFTER THE USER PRESSES REFRESH
     
 }

  header("location:viewCandidates.php?edit=success");
  exit();

 
 

     
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Candidate</title>
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
		<center><h1>Edit Candidate Details</h1></center>
        <center>
        	<form method="POST" action="editCandidate.php" role="form" class="form-horizontal animated slideInLeft"  
        	 enctype="multipart/form-data" >

        		<div class="form-group">
                <label for="name" class="col-md-2 control-label">Name</label>
                <div class="col-md-6 inputGroupContainer">
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" name="name" value='<?php echo $name ?>' required>
                </div>
                </div>
                </div>
               
                 <div class="form-group">
                 <label for="name" class="col-md-2 control-label">Position</label>
                 <div class="col-md-6 inputGroupContainer">
                 <div class="input-group">
                 <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                 <select size="1" class="form-control dropdown" name="position" value='<?php echo $pos ?>' >
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
          
                <input type="file" name="fileField" id="fileField" class="form-control" value="upload">
                </div>
                </div>
                </div>
                <em>Picture to be uploaded should be 200px by 200px</em>
                <br>
          
               <input type="hidden" name="thisID" value='<?php echo $targetID ?>' >

             <button type="submit" class="btn btn-lg btn-primary">Save Changes</button>
        		
        	</form>
        </center>

		
	</div>

</body>
<script src="js/bootstrap.js"></script>
</html>
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

  $alert ='';
  if(isset($_GET['edit'])){
    $alert = '<div class="alert alert-success animated slideInleft" style="position:absolute; top:100px; margin-right:auto; margin-left:auto;">Success! Candidate details successfully updated.<a href="viewCandidates.php"><button>OK</button></a></div>';
  }
  
  if(isset($_GET['deleteid'])){

  echo "<center><div class='alert animated bounceIn' style='position:absolute;
    width:40%; height: 0 auto; left:30%; top:10%; background:#fff; z-index:2; box-shadow:rgba(0,47,0,0.5) 10px 10px 50px 40px'>
    <h1 style='font-size:2em'><b>Do you really want to delete <br>".$_GET['name']." as a candidate
  ?</b> <br><br><a href='viewCandidates.php?yesdelete="  .$_GET['deleteid']. "'><button class='btn btn-danger'>Yes</button></a> or 
  <a href='viewCandidates.php'><button class='btn btn-success'> No </button></a> </div></center>";

   echo "<div style='z-index:1; position:fixed; top:0; left:0; height:100vh; width:100vw; background-color:rgba(255,255,255,0.7)'></div>";
 

  //EXIST IS PUT SUCH THAT THE SCRIPT DOES NOT RENDER OUT THE WHOLE PAGE


}


  if (isset($_GET['yesdelete'])) {
  // REMOVE ITEM FROM SYSTEM
  //DELETE FROM DATABASE FIRST

  
  echo "<div style='z-index:1; position:fixed; top:0; left:0; height:100vh; width:100vw; background-color:rgba(255,255,255,0.7)'></div>";

  echo "<center>
          <div class='alert animated bounceIn' style='position:absolute;
             width:40%; height: 0 auto; left:30%; top:20%; background:#fff; z-index:2; box-shadow:rgba(0,47,0,0.5) 10px 10px 50px 40px'>
    
             <h1 style='font-size:2em'><b style='color:red'>Candidate Deleted <br></h1>
               </br><a href='viewCandidates.php'><button class='btn btn-success'>Back</button></a>
          </div>
        </center>";

  $id_to_delete = $_GET['yesdelete'];
  $sql = mysqli_query($conn,"DELETE FROM candidate WHERE nomination_form_no = '$id_to_delete' LIMIT 1") or die(mysql_error());
  //UNLINK IMAGE FROM SERVER

  $pictodelete = ("../images/candidates/".$id_to_delete.".jpg");
  if (file_exists($pictodelete)) {

    unlink($pictodelete);

  }


}

   


  function viewCandidates($conn,$position){
  $candidate = "";
  $sql = mysqli_query($conn,"SELECT * FROM candidate WHERE position = '$position'");
  $candidateCount = mysqli_num_rows($sql);

  if ($candidateCount > 0) {
      while($row = mysqli_fetch_array($sql)){
        

        $candidate_name = $row["name"];
        $candidate_position = $row["position"];
        $nomination_form_no = $row["nomination_form_no"];
       

        $candidate .= "<tr>
            <td width='50%'>
           
            <img class='img-responsive img-thumbnail' src='../images/candidates/".$nomination_form_no.".jpg' style=' margin-left:auto; margin-right:auto; display:block; padding:10px' alt='Candidate Image'/><center>

           
            </center>
            </td>
            
            <td style='font-size:25px; padding:5px;'>
            Name:  $candidate_name </br>
            Nomination Number:  $nomination_form_no </br>

            <a href='editCandidate.php?editID=$nomination_form_no'><button class='btn btn-primary'>Edit</button></a>  
            <a href='viewCandidates.php?deleteid=$nomination_form_no&&name=$candidate_name'><button class='btn btn-primary'>Delete</button></a> 
           
         
            </td>
        </tr><br>";

        
} 
  }

  else {

    $candidate = "No candidates for $position";
  }

  echo $candidate;
  

}

?>



<!DOCTYPE html>
<html>
<head>
	<title>View Candidates</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css?lidgafyuhgfbhegdfuhkgkefhguydkluiwfolafhdl">
    <link rel="stylesheet" type="text/css" href="../css/animate.css">
      <link href="../css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1,     user-scalable=0">
    <script src="js/jquery-1.11.0.min.js"></script>
</head>
<style>
    table {
  border-collapse: collapse;
}
tr { 
  border: solid;
  border-width: 1px 0;
  margin-top:2px;
}
</style>
<body>
	<div class="container">


  <a href="index.php"><button class="btn btn-lg btn-success">Back to the landing Page</button></a>
    <center><h1>View Candidates</h1></center>
     <div class="row">
        <center>
          <h2>GRC</h2>
            <table>
              <?php viewCandidates($conn,'grc'); ?>
            </table>
            <br>
        </center>
     </div>

       <div class="row">
        <center>
          <h2>PRESIDENT</h2>
            <table>
              <?php viewCandidates($conn,'president'); ?>
              
            </table>
            <br>
        </center>
     </div>
  </div>
  
      <div class="row">
        <center>
          <h2>SECRETARY</h2>
            <table>
              <?php viewCandidates($conn,'secretary'); ?>
            </table>
            <br>
        </center>
     </div>
   </div>
    


    <div class="row">
        <center>
          <h2>CONSTITUTIONAL AFFAIRS</h2>
            <table>
              <?php viewCandidates($conn,'constitutional_affairs'); ?>
            </table>
            <br>
        </center>
     </div>
   </div>




 <?php echo $alert;  ?>

</body>
<script src="js/bootstrap.js"></script>
</html>
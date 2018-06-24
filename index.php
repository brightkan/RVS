<?php 
// This ensures that if the user access the page  without
// loging as the manager the program will redirect the to the manager login page
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

include 'functions/functions.php';

include 'connect/connect_to_mysql.php';

check_if_voted($conn);

//Run mySQL query to be sure that this person is voter and that their tokens are qual to the database information

voter_tokens_match($conn,$voterID,$password);
  
  // process user input
  $confirm = "";
   
  //////////////////////////////////////////////////////////////////////////
  // CODE THAT IS FIRED WHEN THE USER PRESSES THE SUBMIT VOTE BUTTON
  //////////////////////////////////////////////////////////////////////
  
  if(isset($_POST["grc"])){

    $grc = $_POST["grc"];
     $pres = $_POST["president"];
     $sec = $_POST["secretary"];
     $const = $_POST["constitutional_affairs"];
    $warn = "";
     
     $ballot['grc'] = $grc;
     $ballot['pres'] = $pres;
     $ballot['sec'] = $sec;
     $ballot ['const'] =$const;

     $_SESSION['ballot'] = $ballot;


  /////////////////////////////////////////////////////////////////////////
  //   CODE THAT RENDERS CANDIDATES FOR THE SELECTED CANDIDATE
  /////////////////////////////////////////////////////////////////////////
        render_warning($conn,$grc);
        render_warning($conn,$pres);
        render_warning($conn,$sec);
        render_warning($conn,$const);


       $confirm = "<div class=\"confirm_candidate animated bounceIn \" style='z-index:100000000000'>
        $warn </br>
        <div>
        <!-- WHEN THE YES BUTTON IS PRESSED ANOTHER SET OF CODE IS FIRED -->
        <a href='index.php?voted=yes&&ballot=$grc'><button class= 'btn btn-success' value='yes'>Yes</button>
        <a href='index.php'><button class='btn btn-warning' value='No'>No</button></a>
        </div>
        </div>";

        echo "<div style='z-index:5; position:fixed; top:0; left:0; height:100vh; width:100vw; background-color:rgba(255,255,255,0.7)'></div>";
  } 
   
   //////////////////////////////////////////////////////////////////////////
  // END OF CODE THAT IS FIRED WHEN THE USER PRESSES THE SUBMIT VOTE BUTTON 
  //////////////////////////////////////////////////////////////////////
  
   //WHEN THE VOTE DECIDES TO VOTE   

   if(isset($_GET['voted'])){
   
    $voted = "voted";
    
   }

    $voting_status = "";

    // update the ballot
    if (isset($voted)) {
       
        $grc = $_SESSION['ballot']['grc'];
        $pres = $_SESSION['ballot']['pres'];
        $sec  = $_SESSION['ballot']['sec'];
        $const = $_SESSION['ballot']['const'];    
        include 'connect/connect_to_mysql.php';
        
        $sql = mysqli_query($conn,"INSERT INTO ballot 
          (grc,president,secretary,constitutional_affairs)
     VALUES('$grc','$pres','$sec','$const')")  or die(mysql_error());


        $voting_status = "yes";
      
    }



    //Update the voting status
    if($voting_status == "yes"){
           
           $id = $_SESSION['voter'];

           $sql = mysqli_query($conn,"UPDATE voter SET voter_status = 'yes' WHERE id = '$id'") or die(mysql_error());

           $confirm = "<div class=\"confirm_candidate animated bounceIn\" style='margin-left:auto; margin-right:auto; display:block;z-index:100000'>
   
    
    
    <div class='alert alert-success'>You have successfully voted</div></br>
   
    <div>
   
    <a href='index.php'><button class='btn btn-warning' value='Back'>Back</button></a>
    </div>
    
</div>";

 echo "<div style='z-index:5; position:fixed; top:0; left:0; height:100vh; width:100vw; background-color:rgba(255,255,255,0.7)'></div>";

;


    }

    //END OF CODE OF WHEN THE VOTE DECIDES TO VOTE 
   


   $list_item = "";

  
   if(isset($_GET['update'])){
    $confirm = "<div class=\"confirm_candidate\">
   
    
    
    <h1>You have successfully updated your profile details</h1> </br>
   
    <div>
   
    <a href='index.php'><button class='btn btn-warning' value='Back'>Back</button></a>
    </div>
    
</div>";
   }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Vote</title>
  <link rel="stylesheet" type="text/css" href="css/style.css?lidgafyuhgfbhegdfuhkgkefhguydkluiwfolafhdl">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
      <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1,     user-scalable=0">
    <script src="js/jquery-1.11.0.min.js"></script>
</head>


<body style="background: url(images/vote.jpg) no-repeat center center fixed; background-size: cover;">
<div class="overlay animated fadeIn" style="position: fixed; height: 100vh; width:100vw; left: 0; top:0; 
  background:url(images/overlays/11.png) repeat; z-index: -1"></div>

<?php include_once("template_nav.php"); ?>
<div class="container wrap" >
  <div class="panel panel-default animated slideInDown" style="background:rgba(255,255,255,1);">
    <div class="panel-heading">
      <h3 class="panel-title"><h2>Ballot Form</h2></h3>
    </div>
    <div class="panel-body" >
<h1>You can now VOTE for your leaders</h1>


<form action="index.php" method="post">
  <h2><span class="label label-default n">GRC</span></h2>
<table class='table table-hover table-bordered' style="font-size: 25px; font-weight: bold">
    <thead>
       <tr>
       <th><center>NAME</center></th>
       <th><center>VOTE</td></center></th>
       </tr>
    </thead>
    <tbody>
        <?php render_candidate_table($conn,'grc'); ?>
    </tbody>
</table>



<h2><span class="label label-default">PRESIDENT</span></h2>
<table class='table table-hover table-bordered' style="font-size: 25px; font-weight: bold">
    <thead>
       <tr>
       <th><center>NAME</center></th>
       <th><center>VOTE</td></center></th>
       </tr>
    </thead>
    <tbody>
        <?php render_candidate_table($conn,'president'); ?>
    </tbody>
</table>

  <h2><span class="label label-default">SECRETARY</span></h2>
<table class='table table-hover table-bordered' style="font-size: 25px; font-weight: bold">
    <thead>
       <tr>
       <th><center>NAME</center></th>
       <th><center>VOTE</td></center></th>
       </tr>
    </thead>
    <tbody>
        <?php render_candidate_table($conn,'secretary'); ?>
    </tbody>
</table>

  <h2><span class="label label-default">CONSTITUTIONAL AFFAIRS</span></h2>
<table class='table table-hover table-bordered' style="font-size: 25px; font-weight: bold">
    <thead>
       <tr>
       <th><center>NAME</center></th>
       <th><center>VOTE</td></center></th>
       </tr>
    </thead>
    <tbody>
        <?php render_candidate_table($conn,'constitutional_affairs'); ?>
    </tbody>
</table>



<button class="btn btn-primary btn-lg" type="submit">Submit</button>

</form>
</div></div></div>



<?php echo $confirm; ?>                       

</div>
</body>

<script src="js/bootstrap.js"></script>
</html>

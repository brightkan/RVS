<?php
// This ensures that if the voter access the page  without
// loging as the voter the program will redirect the to the manager login page
session_start();
if(isset($_SESSION["voter"])){
  header("location:index.php");
  exit();
}

$fname = "";

require_once 'connect/connect_to_mysql.php';

 $_SESSION['success_msg'] = "";

if(isset($_GET['register'])){
if(isset($_POST['id'])){
$_SESSION['success_msg'] = '';
$firstname =  preg_replace('#[^ a-zA-Z0-9!?.]#i','',$_POST['firstname']);
$lastname =  preg_replace('#[^ a-zA-Z0-9!?.]#i','',$_POST['lastname']);
$id        =  preg_replace('#[^ a-zA-Z0-9!?.]#i','',$_POST['id']);
$username  =  preg_replace('#[^ a-zA-Z0-9!?.]#i','',$_POST['username']);
$pos       =  preg_replace('#[^ a-zA-Z0-9!?.]#i','',$_POST['programofstudy']);
$college   =  preg_replace('#[^ a-zA-Z0-9!?.]#i','',$_POST['college']);
$password  =  preg_replace('#[^ a-zA-Z0-9!?.]#i','',$_POST['password']);

$sql_check = "SELECT * FROM voter WHERE id = '$id'" or mysql_error();

$check_query = mysqli_query($conn,$sql_check);

$count = mysqli_num_rows($check_query);



if($count > 0){
  
  $_SESSION['success_msg'] = "You have already registered";

} else 
  // Add this voter to the database
 
  $_SESSION['success_msg'] = "You have successfully registered";
  
  $sql_query = "INSERT INTO voter (firstname,lastname,id,username,programofstudy,college,password) VALUES('$firstname','$lastname','$id','$username','$pos','$college',
  '$password')";
  
 $sql_run=mysqli_query($conn,"INSERT INTO voter (firstname,lastname,id,username,programofstudy,college,password) VALUES('$firstname','$lastname','$id','$username','$pos','$college',
  '$password')");
 
}



$success_msg = $_SESSION['success_msg'];

}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Voter Registration</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" href="css/bootstrapValidator.min.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1,     user-scalable=0">
	<script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/bootstrapValidator.min.js"></script>
	<script  type="text/javascript">
		$(document).ready(function(){
			var validator = $("#registrationForm").bootstrapValidator({
        feedbackIcons: {
          valid: "glyphicon glyphicon-ok",
          invalid: "glyphicon glyphicon-remove",
          validating: "glyphicon glyphicon-refresh"
        },
				fields : {
					firstname: {
						message:"Please provide your firstname",
						validators:{
							notEmpty: {
								message: "Please provide your Firstname"
							}
						}
					},
					lastname: {
                  message:"Please provide your Lastname",
            validators:{
              notEmpty: {
                message: "Please provide your Lastname"
              }
            }


					},
            username: {
                  message:"Please provide your username",
            validators:{
              notEmpty: {
                message: "Please provide your username like brighk"
              }
            }


          },







					id: {
						message: "Please your student number",
						validators:{
							notEmpty: {
								message: "Please your student number"
								},
							stringLength:{
								min: 9,
								max: 9,
								message:"Student number provided is invalid"
								}
							}
					},
					password: {
						message: "Please enter a password",
						validators:{
							notEmpty: {
								message: "Please enter a password"
								},
							stringLength:{
								min: 6,
								message:"Password can not be less than 8 characters."
								}
							}
					},
					confirm_pass: {
						message:"Please enter a password",
						validators:{
							notEmpty: {
								message: "Please enter a password"
							},
							identical: {
								field:"password",
								message: "Password and confirmation do not match."
							}
							}
					}
				}
			});
      validator.on("success.form.bv",function(e){
        //e.preventDefault();
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');
        $.post($form.attr('action'),$form.serialize(),function(result){
          console.log(result);
        },'json');
       // $("#registrationForm").addClass("hidden");
       // $('#confirmation_message').removeClass("hidden");
      });
		});
	</script>
</head>
<body>
<div class='container'>
  
<div class="row">
<h1 style="font-family:'Times New Roman'"><b>RVSUDC MAKERERE UNIVERSITY</b></h1>
<?php if(!isset($_GET['register'])) echo '
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><h2>Voter Registration</h2></h3>
  </div>
  <div class="panel-body">
    <div class="col-md-8">
<form method="POST"  id ="registrationForm" action="voter_reg.php?register=1" role="form"   class="form-horizontal animated slideInLeft">

<div class="form-group">
  <label for="name" class="col-md-2 control-label">First Name</label>
  <div class="col-md-6 inputGroupContainer">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="text" class="form-control" name="firstname" placeholder="Enter first name like John" required>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="name" class="col-md-2 control-label">Last Name</label>
    <div class="col-md-6 inputGroupContainer">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input type="text" class="form-control" name="lastname" placeholder="Enter last name like Kateeba" required>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="name" class="col-md-2 control-label">Student Number</label>
      <div class="col-md-6 inputGroupContainer">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
            <input type="number" class="form-control" name="id" placeholder="Enter your student number" data-minLength="9" data-error="Some error"
             required>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="name" class="col-md-2 control-label">username</label>
        <div class="col-md-6 inputGroupContainer">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-magnet"></i></span>
              <input type="text" class="form-control" name="username" placeholder="Enter your username" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-md-2 control-label">Program of study</label>
          <div class="col-md-6 inputGroupContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
              <select size="1" class="form-control dropdown" name="programofstudy" placeholder="Enter your program of study like BIS" tabindex="9">
                <option value="BIS">BIS</option>
                <option value="BIT">BIT</option>
                <option value="BIST">BIST</option>
                <option value="BSSE">BSSE</option>
                <option value="BSCS">BSCS</option>
              </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="college" class="col-md-2 control-label">College</label>
            <div class="col-md-6 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                <select size="1" class="form-control dropdown" name="college" placeholder="Enter your program of study like BIS" tabindex="9">
                  <option value="COCIS">COCIS</option>
                </select>
                </div>
              </div>
            </div>
            <div class="form-group has-feedback">
              <label for="password" class="col-md-2 control-label">Password</label>
              <div class="col-md-6 inputGroupContainer">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                     <input type="Password" class="form-control" name="password" id="pass"
                     data-minLength="5" data-error="Some error" placeholder="Enter your chosen password" required>
                     <span class="glyphicon form-control-feedback"></span>
                     <span class="help-block with-errors"></span>
                  </div>
                </div>
              </div>
              <div class="form-group has-feedback">
                <label for="confirm_pass" class="col-md-2 control-label">Confirm Password</label>
                <div class="col-md-6 inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                       <input type="Password" class="form-control {$borderColor}" id="confirm_pass" name="confirm_pass"
                       data-match="#confirm_pass" data-minLength="5" data-match-error="some error 2" placeholder="Confirm password please"
                       required>
                       <span class="glyphicon form-control-feedback"></span>
                       <span class="help-block with-errors"></span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label"></label>
                  <div class="col-md-4">
                    <button type="submit" class="btn btn-warning">Submit</button>
                  </div>
                </div>
</form>
</div>
'; ?>
<div class="col-md-4 animated slideInLeft">
  <img src="images/Mak_logo.png" style="margin-left:auto; margin-right: auto; width: 60%; display: block;">
<div>
<h3>Already have an account,</h3>
<center>
<a href="voter_login.php"> <button class="btn btn-danger btn-lg btn_register">Login</button></a>
</center>
</div>
</div>
<?php if(isset($_GET['register'])) echo '
<div class="alert alert-success" id="confirmation_message">
  <span class="glyphicon glyphicon-star"></span> ' .$success_msg. '
</div>
'; ?>
  </div>
</div>
</div>
</div>
</body>

</html>

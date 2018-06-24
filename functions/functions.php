<?php

function check_if_voted($conn){
	global $voterID;


	$sql = mysqli_query($conn,"SELECT * FROM voter WHERE id = '$voterID'AND voter_status = 'yes' LIMIT 1");// QUERY THE PERSON
$votedCount = mysqli_num_rows($sql);
if($votedCount==1){//evaluate the count
   header("location:already_voted.php");
   exit();
}

}

function voter_tokens_match($conn,$voterID,$password){
	$sql = mysqli_query($conn,"SELECT * FROM voter WHERE id = '$voterID'AND password = '$password' LIMIT 1");// QUERY THE PERSON

//------MAKE SURE PERSON EXISTS IN THE DATABASE ---

$existCount = mysqli_num_rows($sql); // count the rows
if($existCount==0){//evaluate the count
	echo "Your login session is not in the records";
	exit();
}




}

     ////////////////////////////////////////////////////////////////
  // START OF CODE THAT RENDERS THE CANDIDATES FOR A SELECTED POSITION
  ////////////////////////////////////////////////////////////////
  // Output candidate row
  function render_candidate_table($conn,$position){
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
           
            <img class='img-responsive img-thumbnail' src='images/candidates/".$nomination_form_no.".jpg' style=' margin-left:auto; margin-right:auto; display:block; padding:10px' alt='Candidate Image'/><center>

            $candidate_name
            </center>
            </td>
            
            <td>
            <div style='width:20%; height:20%;  border: 1px solid #000; margin-left:auto; margin-top:auto; margin-bottom:auto; margin-right:auto; display:block'>
            <center>
            <input type=\"radio\" name=\"$position\" value=\"$nomination_form_no\" style='font-size:20em; text-align:center' required>
            </center>
            </div>
            </td>
        </tr>";

        
} 
  }

  else {

    $candidate = "No candidates for $position";
  }

  echo $candidate;
  

}

   ////////////////////////////////////////////////////////////////
  // END OF CODE THAT RENDERS THE CANDIDATES FOR FOR A SECLECTED POSITION
  ////////////////////////////////////////////////////////////////


  function render_warning($conn,$pos_variable) {
  	global $warn;
    $sql = mysqli_query($conn,"SELECT * FROM candidate WHERE nomination_form_no = '$pos_variable'");
    while($row = mysqli_fetch_array($sql)){
    
        $candidate_name = $row["name"];
        $candidate_position = $row["position"];
        $nomination_form_no = $row["nomination_form_no"];
        
        $warn .= "<div class=\"alert alert-warning\">Are you sure you want to vote $candidate_name for ".strtoupper($candidate_position)."?</div>";
     

        
    }
    
    }



   //////////////////////////////////////////////////////////////////////////////////////////////////////
//  CODE TO COUNT VOTES FOR CANDIDATES' RESULTS 
/////////////////////////////////////////////////////////////////////////////////////////////////////


function count_votes_and_render_results($conn,$pos_from_db){
 # pos_from_db is the name of the position as elisted in the candidate table of the database
  $ftd = ""; // first table data
  $std = ""; // second table data
$sql = mysqli_query($conn,"SELECT * FROM candidate WHERE position = '$pos_from_db'"); 
 $candidateCount = mysqli_num_rows($sql);
  
 if($candidateCount > 0){
	while($row = mysqli_fetch_array($sql)){
		$candName= $row["name"];
		$position = $row["position"];
		$nomination_no = $row['nomination_form_no'];
		// first table data stored in variable $ftd
		$ftd .= "<td width='30%'><img class='img-responsive' src='images/candidates/".$nomination_no.".jpg' style=' margin-left:auto; margin-right:auto; display:block; padding:10px' alt='Candidate Image'/><center>" .$candName. "</center></td>";

		// second table data is stored in $std
     //$Csql stores result from the query below
		$Csql = mysqli_query($conn,"SELECT * FROM ballot WHERE $pos_from_db = '$nomination_no'"); 
		 $voteCount = mysqli_num_rows($Csql);
         
         $std .= "<td><center>" .$voteCount. "<center></td>";

     
          
		
	}
   
   $firstrow = "<tr  style='width:5%; font-weight:bold'><td style=''><b>Candidate</b></td>".$ftd."</tr>";
   $secondrow = "<tr style='width:5%; font-weight:bold'><td style=''><b>Results</b></td>".$std."</tr>";

   $table = " <table class=\"table table-hover slideInRight animated\" border = 1>
    $firstrow
    $secondrow
   </table>";
    
    echo $table;

	}

}


function count_votes_and_render_results_admin($conn,$pos_from_db){
 # pos_from_db is the name of the position as elisted in the candidate table of the database
  $ftd = "";
  $std = "";
$sql = mysqli_query($conn,"SELECT * FROM candidate WHERE position = '$pos_from_db'"); 
 $candidateCount = mysqli_num_rows($sql);
  
 if($candidateCount > 0){
  while($row = mysqli_fetch_array($sql)){
    $candName= $row["name"];
    $position = $row["position"];
    $nomination_no = $row['nomination_form_no'];
    // first table data stored in variable $ftd
    $ftd .= "<td width='30%'><img class='img-responsive' src='../images/candidates/".$nomination_no.".jpg' style=' margin-left:auto; margin-right:auto; display:block; padding:10px' alt='Candidate Image'/><center>" .$candName. "</center></td>";

    // second table data is stored in $std

    $Csql = mysqli_query($conn,"SELECT * FROM ballot WHERE $pos_from_db = '$nomination_no'"); 
     $voteCount = mysqli_num_rows($Csql);
         
         $std .= "<td><center>" .$voteCount. "<center></td>";

     
          
    
  }
   
   $firstrow = "<tr  style='font-size:25px; font-weight:bold'><td style='padding:10%'><b>Candidate</b></td>".$ftd."</tr>";
   $secondrow = "<tr style='font-size:25px; font-weight:bold'><td style='padding-left:10%'><b>Results</b></td>".$std."</tr>";

   $table = " <table class=\"table table-hover slideInRight animated\" border = 1>
    $firstrow
    $secondrow
   </table>";
    
    echo $table;

  }

}


   //////////////////////////////////////////////////////////////////////////////////////////////////////
//  END OF CODE TO COUNT VOTES FOR CANDIDATES' RESULTS 
/////////////////////////////////////////////////////////////////////////////////////////////////////

?>
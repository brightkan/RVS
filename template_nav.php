<style type="text/css">
    .navbar-inverse .navbar-nav > li > a {
    color: #fff;
    font-size: 20px;
    line-height: 150px;
} 

.navbar-brand a { 
   color: #fff;
  }



</style>
<nav class="navbar navbar-inverse navbar-fixed-top bounceInRightl animated" role="navigation" style="background-color:rgb(133,198,144);
    border-color: rgb(133,198,144); color:rgb(255,255,255);">
        <div class="container">
            <div class="navbar-header" style="width:40%; height:100%">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand" href="" style="color:#fff; height: 100%;
                font-size: 35px; width: 100%; line-height: 50px; " >

                    <img class="img-responsive" src="images/Mak_logo.png" style="float: left;  
                     padding: 20px;" >
                <div>
                <p class="nav-text" style="font-family:'Times New Roman'">RVSUDC MAKERERE UNIVERSITY</p></div></a>
            </div>
            <!-- Collect the nav links for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse row">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">HOME</a>
                    </li>
                    <li><a href="instruct.php">INSTRUCTIONS</a>
                    </li>

                    <li><a href="view_results.php">VIEW RESULTS</a>
                    </li>

                    <li><a href="contact.php">CONTACT</a>
                    </li>
                    <li><a class="dropdown-toggle" data-toggle="dropdown" href="#profile"><strong><span class="myuser"><i class="fa fa-user"></i></span></strong> <?php  echo $username;  ?> <span class="caret"></a>

                    <ul class="dropdown-menu">
                      <li><a href="<?php echo "viewprofile.php?id=".$voterID; ?>">View Profile</a></li>
                        
                       <li><a href="<?php echo "edit_voter.php?editid=".$voterID; ?>">Edit Profile</a></li>
                       
                        <li class="divider"></li> 
                        <li><a href="logout.php">Log Out</a></li> 
                        </ul>
                        

                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
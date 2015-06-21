<?php
    //start session
    session_start();
    ob_start();
    //register session variables
    //$_SESSION['username'];
    
    //check if logged in
    //  if(!isset($_SESSION['username'])){
    //     //header("Location: voterlogin.php");
    //     echo "<div class='alert alert-success alert-dismissible'>Please Login before Visiting this page!</div>";
    //     echo "<script>
    //         setTimeout(\"location.href = 'index.php';\",2000);
    //       </script>";
    // }    
    // else {
    //     //$_SESSION['user_msg'];
    //     // $_SESSION['VoterName'];
    //     // $_SESSION['VoterHallID'];   
    // }

    //include("includes/connection.php");
    Require_once("includes/connection.php");
?>
<!DOCTYPE HTML>

<html>
    <head>
        <title>Election 2015</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" href="css/business-casual.css" />
        <link rel="stylesheet" href="css/skel.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-wide.css" />
        
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.dropotron.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-layers.min.js"></script>
        <script src="js/init.js"></script>
        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
        
    </head>
    <body>

        <!-- Header -->
            <div id="header">

                <!-- Logo -->
                    <h1><a href="index.php" id="logo">ATECOE SRC ELECTION 2015</a></h1>

                <!-- Nav -->
                    <nav id="nav">
                        
                        <?php
                                               
                            if (isset($_SESSION['username']) && ($_SESSION['usertype'] == $_SESSION['Polling Officer'])){
                                echo '<ul>
                                    <li class="alert alert-warning alert-dismissible">'.strtoupper($_SESSION["usertype"]).': '.strtoupper($_SESSION['username']).'</li>
                                    <li class="current">
                                        <a href="">Voters</a>
                                        <ul>
                                            <!-- <li><a href="voterreg.php">Register Voter</a></li> -->
                                            <li><a href="voterverify.php">Verify Voter</a></li> 
                                            <li><a href="voterlogin.php">Voter Login</a></li> 
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="main_index.php">End Session</a>
                                    </li>
                                </ul>';
                            }
                            else {
                                echo '
                                
                                <ul>
                                    <li class="alert alert-warning alert-dismissible">'.strtoupper($_SESSION["usertype"]).': '.strtoupper($_SESSION['username']).'</li>
                                    <li ><a href="userlogin.php">Home</a></li>
                                    <li>
                                        <a href="">Users</a>
                                        <ul>
                                            <li><a href="userreg.php">Create User</a></li>
                                            <li><a href="userupdate.php">Update User</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="">Candidates</a>
                                        <ul>
                                            <li><a href="candidatereg.php">Create Candidate</a></li>
                                            <li><a href="hallcandidatereg.php">Create Candidate</a></li>
                                            <li><a href="portfolioreg.php">Create Portfolio</a></li>
                                            <li><a href="hallportfolioreg.php">Create Portfolio</a></li>
                                        </ul>
                                    </li>
                                    <li class="current">
                                        <a href="">Voters</a>
                                        <ul>
                                            <li><a href="voterreg.php">Register Voter</a></li>
                                            <li><a href="voterverify.php">Verify Voter</a></li>
                                            <li><a href="voterlogin.php">Voter Login</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="">Others</a>
                                        <ul>
                                            <li><a href="hallreg.php">Hall of Residence</a></li>
                                            <li><a href="voteresults.php">Election Results</a></li>
                                            <li><a href="electionreport.php">Election Reports</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="main_index.php">End Session</a>
                                    </li>
                                </ul> ';
                            }
                        ?>
                    </nav>

            </div>
        
        <!-- Main -->
        <section class="wrapper style1">
                <!-- <div class="container">
                    <div class="row 100%"> -->
            <div class="container">
                <div class="row">
                    <!-- <div class="box">  -->           
                            <div id="content">
                                <?php     
                                    // $_SESSION['VoterName'];
                                    // $_SESSION['VoterIndexNo'];
                                    // $_SESSION['VoterHallID'];

                                    $VerificationStatus = "Verified";
                                    $VoteStatus = "Voted";
                                    $index_prefix = "ATCE/";

                                    if ((isset($_POST['BeginVote'])) && (!empty($_POST['VoterIndex']))) {
                                        
                                        $VoterIndex = $index_prefix.(stripslashes($_POST['VoterIndex']));
                                        
                                        //$query
                                        $query = "SELECT * FROM voters WHERE IndexNo ='$VoterIndex' ";
                                        $result = mysql_query($query,$connect) or die(mysql_error('Voter Not Found!'));
                                        while ($row = mysql_fetch_array($result)) {
                                            $VoterID = $row[0];
                                            $VoterName = $row[1]." ".$row[2];
                                            $VoterIndexNo = $row[3];
                                            $VoterHallID = $row[7];
                                            $_SESSION['VoterName'] = $VoterName;
                                            $_SESSION['VoterID'] = $VoterID;
                                            $_SESSION['VoterIndexNo'] = $VoterIndexNo;
                                            $_SESSION['VoterHallID'] = $VoterHallID;

                                        if ($row[5] !== $VerificationStatus ) {
                                           
                                            echo "<div class='alert alert-danger alert-dismissible' >VOTER NOT VERIFIED! 
                                                    PLEASE GO AND VERIFY BEFORE VOTING!
                                                    </div><br />";
                                            echo "<script>
                                                    setTimeout(\"location.href = 'voterlogin.php';\",4000);
                                                  </script>";
                                            
                                        }
                                        else if ($row[6] == $VoteStatus) {
                                           
                                            echo "<div class='alert alert-danger alert-dismissible' >".$row[1]." ".$row[2]." WITH INDEX NO. ".$row[3]." HAS VOTED ALREADY!
                                                 </div><br />";
                                            echo "<script>
                                                    setTimeout(\"location.href = 'voterlogin.php';\",4000);
                                                  </script>";
                                            
                                        }    
                                        else 
                                        {
                                                echo "<div class='alert alert-success alert-dismissible'>login successful...Please Wait...redirecting page!!</div>";
                                                echo "<script>
                                                        //setTimeout(\"location.href = 'ballot.php?id=".$row[0]."&action=vote';\",1000);
                                                        setTimeout(\"location.href = 'ballot.php';\",1000);
                                                      </script>";
                                            
                                          }
                                        }
                                    } 
                                ?>

                                <form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                    <fieldset>
                                        <div class="form-group input-group">
                                             <div class="row">
                                                <h3 class="intro-text text-center">
                                                    VOTER LOGIN 
                                                </h3>
                                             </div>
                                        </div>

                                        <div class="form-group input-group">
                                             <div class="row">
                                                <h4 class="text-center">
                                                    Please Enter your Index No. in the box and CLICK Begin Voting!!!
                                                </h4>
                                             </div>
                                        </div>

                                         <div class="form-group ">
                                            <div class="row container">
                                                <label for="VoterIndex" class="control-label">Voter Index No.</label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="VoterIndex" placeholder="Enter Index No. eg. 0001/2017" autocomplete="off" autofocus>
                                                </div>
                                            </div>
                                        
                                           
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <button class="btn btn-lg btn-success btn-block" type="submit" name="BeginVote">BEGIN VOTING</button>
                                        </div>

                                    </fieldset>
                                </form>
                            </div>
                        </div>    
                </div>
            </div>

        </section>
        
        <!-- Footer -->
            <div id="footer">

                <!-- Icons -->
                    <ul class="icons">
                        <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                        <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                        <li><a href="#" class="icon fa-github"><span class="label">GitHub</span></a></li>
                        <li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
                    </ul>

                <!-- Copyright -->
                    <div class="copyright">
                        <ul class="menu">
                            <li>Copyright &copy;  All rights reserved</li><li>Design: <a href="http://localhost/fred/opd">Fredlen</a></li>
                        </ul>
                    </div>

            </div>

    </body>
</html>
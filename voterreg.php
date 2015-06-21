<?php
    //start session
    session_start();
    ob_start();
    //register session variables
    //$_SESSION['username'];
    //check if logged in
     if(!isset($_SESSION['username'])){
        //header("Location: voterlogin.php");
        echo "<div class='alert alert-success alert-dismissible'>Please Login before Visiting this page!</div>";
        echo "<script>
            setTimeout(\"location.href = 'index.php';\",3000);
          </script>";
    }    
    else {
        // date_default_timezone_set('UTC');
        //$_SESSION['user_msg'];  
    }

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
        <link rel="stylesheet" href="css/sweetalert.css" />
        
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.dropotron.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-layers.min.js"></script>
        <script src="js/init.js"></script>
        <script src="js/sweetalert.min.js" ></script>
        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
        
        <!-- <script type="text/javascript"> -->
            <!-- function message(mess,type){
                noty({
                    text:'<center>'+mess+'</center>',
                    type:type,
                    theme:'relax',
                    closWidth:['click'],
                    layout:'topRight',
                    timeout:7000,
                     animation   : {
                    open  : 'animated bounceInRight',
                    close : 'animated bounceOutRight',
                    easing: 'swing',
                    speed : 500
                    },
                    maxVisible  : 3,

                });
            } -->
        <!-- </script> -->

    </head>
    <body>

        <!-- Header -->
            <div id="header">

                <!-- Logo -->
                    <h1><a href="#" id="logo">ATECOE SRC ELECTION 2015</a></h1>

                <!-- Nav -->
                    <nav id="nav">
                    <?php
                        if (isset($_SESSION['username']) && ($_SESSION['usertype'] == $_SESSION['Polling Officer'])){
                                echo '<ul>
                                    <li class="current">
                                        <a href="">Voters</a>
                                        <ul>
                                            <!--<li><a href="voterreg.php">Register Voter</a></li> -->
                                            <li><a href="voterverify.php">Verify Voter</a></li> 
                                            <li><a href="voterlogin.php">Voter Login</a></li> 
                                        </ul>
                                    </li>
                                </ul>';
                            }
                            else {
                                echo '
                                
                                <ul>
                                    <li class="current"><a href="userlogin.php">Home</a></li>
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
                                            <li><a href="hallcandidatereg.php">Create Hall Candidate</a></li>
                                            <li><a href="portfolioreg.php">Create Portfolio</a></li>
                                            <li><a href="hallportfolioreg.php">Create Hall Portfolio</a></li>
                                        </ul>
                                    </li>
                                    <li>
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

                                    if (isset($_POST['voterreg'])) {
                                        // if (empty($_POST['hall'])){
                                        //     echo "<p class='alert alert-warning alert-dismissible' >
                                        //             Please Choose Voter's Hall!!!
                                        //         </p><br />";
                                        // }else{
                                        $index_prefix = "ATCE/0";
                                        $index_sufix = "/2017";
                                        $VoterIndex = $index_prefix.(stripslashes($_POST['IndexNo'])).$index_sufix;
                                        // $IndexNo = $_POST['IndexNo'];

                                        $FirstName = $_POST['FirstName'];
                                        $LastName = $_POST['LastName'];
                                        $Hall = $_POST['Hall'];
                                        $Gender = $_POST['Gender'];
                                        $VerificationStatus = "Not Verified";
                                        $VoteStatus = "Not Voted";

                                        $query = "INSERT INTO voters VALUES('', '$FirstName', '$LastName', '$VoterIndex', '$Gender', '$VerificationStatus', '$VoteStatus', '$Hall')";
                                        $result = mysql_query($query,$connect) or die(mysql_error());
                                        
                                        if ($result){

                                           echo "<div class='alert alert-success alert-dismissible' >
                                                    Voter successfully Registered!
                                                </div><br />";
                                            echo "<script>
                                                    setTimeout(\"location.href = 'voterreg.php';\",1000);
                                                  </script>";
                                        }
                                      // }
                                    }
                                
                                ?>
                                <form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                    <fieldset>
                                        <div class="form-group input-group">
                                             <div class="row">
                                                <h3 class="intro-text text-center">
                                                    VOTER REGISTRATION  
                                                </h3>
                                                
                                            </div>
                                        </div>
                                         <div class="form-group ">
                                            <div class="row container">
                                                <label for="LastName" class="control-label">Last Name</label>
                                                <div class="col-md-4">
                                                    <input required type="text" class="form-control" name="LastName" placeholder="Last Name">
                                                </div>

                                                <label for="FirstName" class="control-label">First Name</label>
                                                <div class="col-md-4">
                                                    <input required type="text" class="form-control" name="FirstName" placeholder="First Name" autofocus>
                                                </div>
                                            </div>
                                        
                                            <div class="row container">
                                                <label for="Index No." class="control-label">Index NO. &nbsp</label>
                                                <div class="col-md-4">
                                                    <input required type="text" class="form-control" name="IndexNo" placeholder="Input middle four digits eg. 0001" >
                                                </div>
                                        
                                                <label for="Hall" class="control-label">Hall &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</label>
                                                <div class="col-md-4">
                                                    <!-- <input type="text" class="form-control" name="Hall" placeholder="Hall of Residence"> -->

                                                    <?php
                                                        $query = "SELECT * FROM hall ORDER BY HallName ASC";
                                                        $result = mysql_query($query,$connect) or die(mysql_error());
                                                            
                                                        echo '<select required name="Hall" > <option value=\"\">Select Hall of Residence...</option>
                                                             ';
                                                        
                                                            while ($row = mysql_fetch_row($result))
                                                            {
                                                                echo '<option value='. $row[0] .'> '. $row[1] .'</option>'; 
                                                            }
                                                        echo "</select>";
                                                    ?>

                                                </div>
                                            </div> 
                                        
                                            <div class="row container">
                                                <label for="Gender" class="control-label">Gender</label>
                                                <div class="col-md-4">
                                                    <input required type="radio" name="Gender" value="Male"> Male
                                                    <input required type="radio" name="Gender" value="Female"> Female
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <button class="btn btn-lg btn-success btn-block" type="submit" name="voterreg">Register Voter</button>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-lg btn-danger btn-block" type="reset" >Reset</button>
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
<?php
    //start session
    session_start();
    //register session variables
    //$_SESSION['username'];
    //check if logged in
    // if(!isset($_SESSION['username'])){
    //  header("Location: index.php");
    //  exit;
    // }    
    // else {
    //  $_SESSION['user_msg'];
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
                        <ul>
                            <li class="current"><a href="index.php">Home</a></li>
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
                                    <li><a href="portfolioreg.php">Create Portfolio</a></li>
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
                        </ul>
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
                                
                                <form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                    <fieldset>
                                        <div class="form-group input-group">
                                             <div class="row">
                                                <h3 class="intro-text text-center">
                                                    HALL REGISTRATION
                                                </h3>
                                                
                                            </div>
                                        </div>
                                         <div class="form-group ">
                                            <div class="row container">
                                                <label for="HallName" class="control-label">Hall Name</label>
                                                <div class="col-md-4">
                                                    <input required type="text" class="form-control" name="HallName" placeholder="Name of Hall" autofocus>
                                                </div>
                                            </div>
                                        
                                           
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <button href="index.html" class="btn btn-lg btn-success btn-block" type="submit" name="HallReg">REGISTER HALL</button>
                                        </div>

                                    </fieldset>
                                </form>
                            </div>
                        </div>    
                </div>
            </div>
            <?php

                if (isset($_POST['HallReg'])) {
                    
                    $HallName = $_POST['HallName'];
                                        
                    $query = "INSERT INTO hall VALUES('', '$HallName')";
                    $result = mysql_query($query,$connect) or die(mysql_error());
                    echo "<font color='blue'>Hall successfully Registered!</font>";
                    echo "<script language='javascript'>
                            alert messsage('New user successfully created!','success'); 
                        </script>";
                }
                
            ?>
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
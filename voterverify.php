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
            setTimeout(\"location.href = 'index.php';\",2000);
          </script>";
    }    
    else {
        //$_SESSION['user_msg'];
        // $_SESSION['VoterName'];
        // $_SESSION['VoterHallID'];   
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
        <link rel="stylesheet" href="css/sheet.css">
        <link rel="stylesheet" href="css/sweet-alert.css" />
        
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.dropotron.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-layers.min.js"></script>
        <script src="js/init.js"></script>
        <script src="js/sweet-alert.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript">
            $(function(){
            $(".search").keyup(function() 
            { 
            var searchid = $(this).val();
            var dataString = 'search='+ searchid;
            if(searchid!='')
            {
                $.ajax({
                type: "POST",
                url: "search.php",
                data: dataString,
                cache: false,
                success: function(html)
                {
                $("#result").html(html).show();
                }
                });
            }return false;    
            });

            jQuery("#result").live("click",function(e){ 
                var $clicked = $(e.target);
                var $name = $clicked.find('.name').html();
                var decoded = $("<div/>").html($name).text();
                $('#searchid').val(decoded);
            });
            jQuery(document).live("click", function(e) { 
                var $clicked = $(e.target);
                if (! $clicked.hasClass("search")){
                jQuery("#result").fadeOut(); 
                }
            });
            $('#searchid').click(function(){
                jQuery("#result").fadeIn();
            });
            });

            function message(mess,type){
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
            }
        </script>
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
                            <div id="content" >
                                <!-- <center><div class="row text-center"> -->
                                    <?php

                                        $VerificationStatus = "Verified";
                                        $index_prefix = "ATCE/";

                                        if ((isset($_POST['VoterVerify'])) && (!empty($_POST['VoterIndex']))) {
                                            
                                            $VoterIndex = $index_prefix.(stripslashes($_POST['VoterIndex']));
                                            
                                            //$query
                                            $query = "SELECT VerificationStatus FROM voters WHERE IndexNo ='$VoterIndex' ";
                                            $result = mysql_query($query,$connect) or die(mysql_error('Voter Not Found!'));
                                            while ($row = mysql_fetch_array($result)) {
                                                
                                            if ($row[0] == $VerificationStatus ) {
                                               
                                                echo "<p class='alert alert-warning alert-dismissible'>Voter Already Verified! 
                                                        Please Tell Voter to go and Vote!
                                                        </p><br />";
                                                echo "<script>
                                                        setTimeout(\"location.href = 'voterverify.php';\",3000);
                                                      </script>";
                                            }  
                                            else {
                                                
                                                $query = "UPDATE voters SET VerificationStatus='$VerificationStatus' WHERE IndexNo ='$VoterIndex'";
                                                $result = mysql_query($query,$connect) or die(mysql_error('Voter Not Found!'));
                                               
                                                echo "<div class='alert alert-success alert-dismissible'>Voter successfully Verified!</div>";
                                                echo "<script>
                                                        setTimeout(\"location.href = 'voterverify.php';\",2000);
                                                      </script>";
                                                }
                                                     
                                            //}
                                          }
                                        }   
                                       else 
                                        {
                                            VoterVerify();
                                        }

                                        function VoterVerify(){
                                            $connect = mysql_connect("localhost","root","PASSword1") or die("Couldn't connect to server");
                                            $db = mysql_select_db("election",$connect) or die("Couldn't connect to database");

                                            $VerificationStatus = "Verified";
                                            
                                            if(isset($_GET['id']) && isset($_GET['action'])){
                                            if($_GET['action']=='voterupdate'){
                                                $VoterID=$_GET['id'];
                                                //echo $VoterID;
                                            //}
                                            // Require_once("includes/connection.php");
                                                //$query
                                                $query = "SELECT VoterID, VerificationStatus FROM voters WHERE VoterID ='$VoterID' ";
                                                $result = mysql_query($query,$connect) or die(mysql_error());
                                                $row = mysql_fetch_row($result); 
                                                    
                                                if ($row[1] == $VerificationStatus ) {
                                                   
                                                    echo "<p class='alert alert-warning alert-dismissible'>Voter Already Verified! 
                                                        Please Tell Voter to go and Vote!
                                                        </p><br />";
                                                    echo "<script>
                                                        setTimeout(\"location.href = 'voterverify.php';\",3000);
                                                      </script>";
                                                }  
                                                else {
                                                    $query = "UPDATE voters SET VerificationStatus='$VerificationStatus' WHERE VoterID ='$row[0]'";
                                                    $result = mysql_query($query,$connect) or die(mysql_error());
                                                    
                                                    echo "<div class='alert alert-success alert-dismissible'>Voter successfully Verified!</div>";
                                                    echo "<script>
                                                        setTimeout(\"location.href = 'voterverify.php';\",3000);
                                                      </script>";
                                                    }
                                                    
                                               }
                                            }
                                            
                                          }
                                     ?>
                                <!-- </div></center> -->
                                <form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                    <fieldset>
                                        <div class="form-group input-group">
                                             <div class="row">
                                                <h3 class="intro-text text-center">
                                                    <strong>VOTER VERIFICATION </strong>
                                                </h3>
                                            </div>
                                        </div><br>
                                         <div class="form-group ">
                                            <div class="col-md-4">
                                                <button href="index.html" class="btn btn-lg btn-success btn-block" type="submit" name="VoterVerify">Verify Voter</button>
                                            </div>
                                            <div class="row container">
                                                <label for="VoterIndex" class="control-label">Voter Index No.</label>
                                                <div class="col-md-4">
                                                    
                                                    <div class="content">
                                                        <input required type="text" class="form-control search" id="searchid" name="VoterIndex" placeholder="Enter Index No. eg. 0001/2017" autocomplete="off" autofocus><br />
                                                        <div id="result"></div>
                                                    </div>
                                                    <p style="margin-top: 20px;"> </p>
                                                    
                                                </div>
                                            </div>
                                        
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
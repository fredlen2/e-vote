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
        <link rel="stylesheet" href="css/sweet-alert.css" />
        
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.dropotron.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-layers.min.js"></script>
        <script src="js/init.js"></script>
        <script src="js/sweet-alert.js"></script>
       
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
                            <li class="current"><a href="#">LIVE ELECTION STATISTICS UPDATE</a></li>
                            
                        </ul>
                    </nav>

            </div>
        
        <!-- Main -->
        <section class="wrapper style1">
            <div class="container">
                <div class="row">
                <!-- <div class="container">
                    <div class="row 100%"> -->
                    <!-- <div class="box">  -->           
                            <div id="content">
                                
                                <form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                    <fieldset>
                                        <h3 class="intro-text text-center">
                                            <strong>LIVE ELECTION UPDATE </strong>
                                        </h3>
                                        <?php
                                            
                                            echo "Date: " . date("d-m-Y") . "<br>";

                                            echo '<table class="table table-hover">';
                                            echo '<tr class="info">
                                                        <th>STATISTICS</th>
                                                        <th>VALUE</th>
                                                </tr>';
                                            
                                                $VerificationStatus = "Verified";                                        
                                                $VoteStatus = "Voted";

                                                $query1 = "SELECT count(*) FROM voters WHERE VerificationStatus LIKE '$VerificationStatus' ";
                                                $result1 = mysql_query($query1,$connect) or die(mysql_error());
                                                $Verifiedcount = mysql_fetch_array($result1);

                                                $query2 = "SELECT count(*) FROM voters WHERE VoteStatus LIKE '$VoteStatus' ";
                                                $result2 = mysql_query($query2,$connect) or die(mysql_error());
                                                $TotalVotecount = mysql_fetch_array($result2);

                                                $query3 = "SELECT count(*) FROM voters";
                                                $result3 = mysql_query($query3,$connect) or die(mysql_error());
                                                $Votercount = mysql_fetch_array($result3);
                                               
                                                    if ($Votercount) {
                                                        echo '<tr><td>Total Voters: </td><td>'.$Votercount[0].'</td></tr>';
                                                    }
                                                    if ($Verifiedcount) {
                                                        echo '<tr><td>Total Verified Voters </td><td>'.$Verifiedcount[0].'</td></tr>';
                                                       }   
                                                    if ($TotalVotecount) {
                                                        echo '<tr><td>Total Votes Cast </td><td>'.$TotalVotecount[0].'</td></tr>';
                                                      } 
                                                     echo "<script>
                                                        setTimeout(\"location.href = 'voteresultslive.php';\",2000);
                                                      </script>";
                                             
                                            echo '</table>';
                                            mysql_close($connect);   
                                         ?>

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
                            <li>Copyright &copy;  All rights reserved</li><li>Design: <a href="#">Fredlen</a></li>
                        </ul>
                    </div>

            </div>

    </body>
</html>
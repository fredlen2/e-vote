<?php
    //start session
    session_start();
    ob_start();
    //register session variables
    //$_SESSION['username'];
    //check if logged in
    if(!isset($_SESSION['VoterName'])){
        //header("Location: voterlogin.php");
        echo "<div class='alert alert-success alert-dismissible'>Please Login before Visiting this page!</div>";
        echo "<script>
            setTimeout(\"location.href = 'voterverify.php';\",3000);
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
        <link rel="stylesheet" href="css/sweet-alert.css" />
        
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.dropotron.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-layers.min.js"></script>
        <script src="js/init.js"></script>
        <script src="js/sweet-alert.js"></script>
        <script type="text/javascript">
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
                        <ul>
                            <li class="current"><a href="#">Please Click on Candidate's Picture to Vote For the Candidate!</a></li>
                            
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
                                <h3>
                                    <?php
                                        // echo "<p>$_SESSION['VoterName']</p>";
                                        // echo "<p>$_SESSION['VoterHallID']</p>";
                                    ?>
                                </h3>
                                <form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                    <fieldset>
                                        
                                            <div class="col-md-4">
                                                 <button class="btn btn-lg btn-success btn-block" type="submit" name="Vote">SUBMIT VOTE <img width="45" height="30" src="pics/correcttick.jpg" ></button><br />
                                            </div>
                                        
                                        <?php
                                            //include("votescript.php");

                                            $query1 = "SELECT PortfolioID, Pname FROM portfolios ";
                                            $result1 = mysql_query($query1,$connect) or die(mysql_error());
                                            
                                            echo '<table class="table table-striped">';
                                            while ($row1 = mysql_fetch_array($result1))
                                            {
                                                echo '<tr class="info"><th class="intro-text text-center" ><strong>'.$row1[1].'</strong></th></tr>';
                                                $CandPortfolioID = $row1[0];

                                                $query = "SELECT * FROM candidates WHERE PortfolioID='$CandPortfolioID'";
                                                $result = mysql_query($query,$connect) or die(mysql_error('Voter Not Found!'));
                                            
                                                while ($row = mysql_fetch_array($result))
                                                {

                                                    echo '<tr class="col-xs-6 col-sm-2"><td>
                                                        
                                                        <div class="thumbnail" role="button" onclick="CandidateVote()">
                                                          
                                                            <img class="img-responsive" alt="Responsive image" src="data:image;base64,'.$row[7].'" alt="..." 
                                                            role="button" onclick="CandidateVote()">
                                                          
                                                          <div class="caption">
                                                            <h3>'.$row[1]. ' '.$row[2].'</h3>
                                                            <p style="font-size:12px;">Click on Picture to Vote</p>
                                                            <span class="voted"><img width="45" height="30" src="pics/correcttick.jpg" ></span>
                                                          </div>
                                                        </div>
                                                      </td></tr>
                                                    ';
                                                } 
                                            }
                                            echo '</table>';
                                            mysql_close($connect);   
                                         ?>

                                         <br /><div class="col-md-4">
                                                 <button class="btn btn-lg btn-success btn-block" type="submit" name="Vote">SUBMIT VOTE <img width="45" 
                                                 height="30" src="pics/correcttick.jpg" ></button>
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
                            <li>Copyright &copy;  All rights reserved</li><li>Design: <a href="#">Fredlen</a></li>
                        </ul>
                    </div>

            </div>

    </body>
</html>
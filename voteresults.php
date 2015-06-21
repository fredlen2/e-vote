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
                            <li class="current"><a href="#">PROVISIONAL ELECTION RESULTS</a></li>
                            
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
                                            <strong>PROVISIONAL ELECTION RESULTS </strong>
                                        </h3>
                                        <?php
                                            
                                            echo "Date: " . date("d-m-Y") . "<br>";

                                            $query1 = "SELECT * FROM portfolios ";
                                            $result1 = mysql_query($query1,$connect) or die(mysql_error());
                                            //$row1 = mysql_fetch_array($result1);

                                            echo '<table class="table table-hover">';
                                            echo '<tr class="info">
                                                        <th>CANDIDATE<br />PICTURE</th>
                                                        <th>CANDIDATE <br />NAME</th>
                                                        <th>POSITION /<br />PORTFOLIO</th>
                                                        <th>POSITION TOTAL</th>
                                                        <th>VOTES OBTAINED</th>
                                                        <th>VOTES BY<br />POSITION (%)</th>
                                                        <th>VOTES BY <br />OVERALL VOTES (%)</th>
                                                </tr>';
                                        while ($row1 = mysql_fetch_array($result1))
                                         {
                                                $CandPortfolioID = $row1[0];

                                                $query = "SELECT * FROM candidates WHERE PortfolioID = '{$CandPortfolioID}' ORDER BY PortfolioID ASC";
                                                $result = mysql_query($query,$connect) or die(mysql_error());
                                                // $row = mysql_fetch_array($result);
                                               
                                               

                                                
                                                while ($row = mysql_fetch_array($result))
                                                {   
                                                    $CandidateID = $row[1];
                                                    $query2 = "SELECT VotesObtained, VotesPercentage FROM countercandidates WHERE CandidateID ='$CandidateID' ";
                                                    $result2 = mysql_query($query2,$connect) or die(mysql_error());
                                                    $row2 = mysql_fetch_array($result2);
                                                    
                                                    echo "<tr >";
                                                    echo '<td>
                                                        
                                                        <div class="thumbnail" >
                                                          <img src="data:image;base64,'.$row[7].'" alt="..." >
                                                        </div>
                                                      </td>
                                                    ';
                                                    echo '<td>'.$row[1]. ' '.$row[2].'</td>'; //cadidate name
                                                    echo '<td>'.$row1[1].'</td>';   //Portfolio name
                                                    echo '<td>'.$row1[2].'</td>';   //Portfolio total

                                                    if ($row2) {
                                                        echo '<td>'.$row2[0].'</td>';   //Votes obtained by candidate
                                                        echo '<td>'.$row2[1].'</td>';   //Votes by position total(%)
                                                    }
                                                    echo "</tr>";
                                                }
                                           }
                                            
                                            $query1 = "SELECT * FROM hallportfolios ";
                                            $result1 = mysql_query($query1,$connect) or die(mysql_error());
                                            
                                            while ($row1 = mysql_fetch_array($result1))
                                            {
                                                $CandPortfolioID = $row1[0];

                                                $query = "SELECT * FROM hallcandidates WHERE PortfolioID='$CandPortfolioID' ORDER BY PortfolioID ASC";
                                                $result = mysql_query($query,$connect) or die(mysql_error());
                                                //$row = mysql_fetch_array($result);
                                               
                                               
                                                
                                                while ($row = mysql_fetch_array($result))
                                                {
                                                    
                                                    $CandidateID = $row[0];
                                                    $query2 = "SELECT VotesObtained, VotesPercentage FROM counterhallcandidates WHERE CandidateID= '$CandidateID' ";
                                                    $result2 = mysql_query($query2,$connect) or die(mysql_error());
                                                    $row2 = mysql_fetch_array($result2);

                                                    echo "<tr >";
                                                    echo '<td>
                                                        
                                                        <div class="thumbnail" >
                                                          <img src="data:image;base64,'.$row[7].'" alt="..." >
                                                        </div>
                                                      </td>
                                                    ';
                                                    echo '<td>'.$row[1]. ' '.$row[2].'</td>'; //candidate name
                                                    echo '<td>'.$row1[1].'</td>';   //Portfolio name
                                                    echo '<td>'.$row1[2].'</td>';   //Portfolio total

                                                    if ($row2) {
                                                        echo '<td>'.$row2[0].'</td>';   //Votes obtained by candidate
                                                        echo '<td>'.$row2[1].'</td>';   //Votes by position total(%)
                                                    }
                                                    echo "</tr>";
                                                }
                                                   
                                            }
                                                
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
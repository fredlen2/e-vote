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
        $_SESSION['user_msg'];
        $_SESSION['VoterName'];
        $_SESSION['VoterHallID'];   
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
            $(document).ready(function () {
                    $('#id_radio1').click(function () {
                       $('#div2').hide('fast');
                       $('#div1').show('fast');
                });
                $('#id_radio2').click(function () {
                      $('#div1').hide('fast');
                      $('#div2').show('fast');
                 });
           });

            
            $(document).ready(function() 
            {
                CandidateVote();
            }); 
            
            function CandidateVote(){
                $('#id_radio1').click(function () {
                       $('#div2').hide('fast');
                       $('#div1').show('fast');
                });
                $("#result").html(html).show();
            }

            jQuery('input[type="radio"]').on('click', function() {
                var SelectedValue = jQuery(this).attr("id");
                console.log(SelectedValue);
              });
            });
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
                            <?php 
                                echo "<li class='alert alert-warning alert-dismissible'>Welcome ".$_SESSION['VoterName']."</li>";
                            ?>
                            <li class="current"><a href="#">Please Click on Circle to Vote For the Candidate!</a></li>
                            
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
                                <?php
                                    

                                    // if(isset($_GET['id']) && isset($_GET['action'])){
                                    // if($_GET['action']=='vote'){ 
                                    //     $VoterID=$_GET['id'];
                                        
                                    //     $_SESSION = $VoterID;
                                    //     $_SESSION['VoterID'] = $VoterID;;
                                    //     // echo "this session id: ".$_SESSION['VoterID'];

                                    //     }
                                    // }   
                                            $_SESSION['VoterName'] ;
                                            $_SESSION['VoterID'] ;
                                            $_SESSION['VoterIndexNo'] ;
                                            $_SESSION['VoterHallID'] ;
                                    if (isset($_POST['castvote'])) {
                                              
                                            $VoterID = $_SESSION['VoterID'];
                                            $VoterIndexNo = $_SESSION['VoterIndexNo'];
                                            $VoterName = $_SESSION['VoterName'];
                                            $VoteStatus = "Voted";
                                                               
                                            // $query2 = "SELECT VoterID, Fname, Lname FROM voters WHERE VoterID='{$VoterID}' ";
                                            // $result2 = mysql_query($query2,$connect) or die(mysql_error());
                                            // $rowvoter = mysql_fetch_array($result2);

                                            
                                            $query = "UPDATE voters SET VoteStatus='$VoteStatus' WHERE VoterID ='{$VoterID}'";
                                            $result = mysql_query($query,$connect) or die(mysql_error());

                                            if ($result){

                                                echo "<p class='alert alert-success alert-dismissible'><strong>THANKS ".$VoterName." FOR VOTING!!!</strong>
                                                        </p><br />";
                                                echo "<script>
                                                    setTimeout(\"location.href = 'voterlogin.php';\",3000);
                                                  </script>";
                                             }
                                        }
                                                
                                 ?>
                                <form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                    <fieldset>
                                        
                                            <div class="col-md-4">
                                                 <button class="btn btn-lg btn-success btn-block" type="submit" name="castvote">SUBMIT VOTE <img width="45" height="30" src="pics/correcttick.jpg" ></button><br />
                                            </div>
                                            <div class="col-md-4">
                                                 <button class="btn btn-lg btn-danger btn-block" type="reset" >CANCEL VOTE </button>
                                            </div>
                                        <div id="ballotresults">
                                        <?php
                                           
                                            $query1 = "SELECT PortfolioID, Pname FROM portfolios ";
                                            $result1 = mysql_query($query1,$connect) or die(mysql_error());
                                            
                                            echo '<table class="table table-striped">';
                                            while ($row1 = mysql_fetch_array($result1))
                                            {
                                                echo '<tr class="info"><th class="intro-text text-center" ><strong>'.$row1[1].'</strong></th></tr>';
                                                $CandPortfolioID = $row1[0];

                                                $query = "SELECT * FROM candidates WHERE PortfolioID='$CandPortfolioID'";
                                                $result = mysql_query($query,$connect) or die(mysql_error());
                                            
                                                while ($row = mysql_fetch_array($result))
                                                {

                                                    echo '<tr class="col-xs-8 col-sm-2"><td>
                                                        
                                                        <input width="60" height="40" type="radio" name="candidateradio.'.$row[4].'" value="1"><img width="45" height="30" src="pics/correcttick.jpg" >
                                                        <div class="thumbnail" >
                                                            <img class="img-responsive" alt="Responsive image" src="data:image;base64,'.$row[7].'" alt="..." 
                                                            role="button" onclick="CandidateVote()">
                                                          
                                                          <div class="caption">
                                                            <h6>'.$row[1]. ' '.$row[2].'</h6>
                                                            <p style="font-size:12px;">Click on circle to Vote</p>
                                                            
                                                            
                                                          </div>
                                                        </div>
                                                        </input> 
                                                      </td></tr>
                                                    ';
                                                    //$candidateradio="candidateradio.$row[0]";
                                                    
                                                    // if (isset($_Post['candidateradio.'.$row[4].''])) && (!empty($_Post['candidateradio.'.$row[4].'']))){
                                                    //     $incrementer = $_POST[$_Post['candidateradio.'.$row[4].'']];
                                                    //     //$incrementer = 1;
                                                    //     $query = "UPDATE countercandidates SET VotesObtained= VotesObtained + $incrementer WHERE CandidateID ='{$row[0]}'";
                                                    //     $result = mysql_query($query,$connect) or die(mysql_error());
                                                    // }
                                                } 
                                            }
                                            echo '</table>';                                              
                                            
                                            echo '<table class="table table-striped">';
                                            $VoterHallID = $_SESSION['VoterHallID'];
  
                                            // $query2 = "SELECT HallID FROM voters WHERE VoterID='{$VoterID}' ";
                                            // $result2 = mysql_query($query2,$connect) or die(mysql_error());
                                            
                                            // while ($rowvoter = mysql_fetch_array($result2)){


                                            $query4 = "SELECT PortfolioID FROM hallcandidates WHERE HallID ='{$VoterHallID}' ORDER BY PortfolioID DESC limit 2";
                                            $result4 = mysql_query($query4,$connect) or die(mysql_error());
                                            //$rowcand = mysql_fetch_row($result4);
                                            while ($CandPortfolioID = mysql_fetch_row($result4)){
                                               // $CandPortfolioID = $rowcand[0];
                                             
                                                $query1 = "SELECT PortfolioID, Pname FROM hallportfolios WHERE PortfolioID='{$CandPortfolioID[0]}' ";
                                                $result1 = mysql_query($query1,$connect) or die(mysql_error());
                                                    //$row1 = mysql_fetch_row($result1);
                                            //} 
                                                while ($row1 = mysql_fetch_array($result1)) {
                                                    echo '<tr class="info"><th class="intro-text text-center" ><strong>'.$row1[1].'</strong></th></tr>';

                                                    $query5 = "SELECT * FROM hallcandidates WHERE PortfolioID ='{$row1[0]}' ";
                                                    $result5 = mysql_query($query5,$connect) or die(mysql_error());

                                                    while ($rowcandidate = mysql_fetch_array($result5))
                                                    {
                                                        
                                                        echo '<tr class="col-xs-8 col-sm-2"><td>
                                                            
                                                            <input width="90" height="60" type="radio" name="candidateradio.'.$rowcandidate[4].'" class="voted"><img width="45" height="30" src="pics/correcttick.jpg" ></input> 
                                                                <div class="thumbnail" onclick="CandidateVote()">
                                                                <img class="img-responsive" alt="Responsive image" src="data:image;base64,'.$rowcandidate[7].'" alt="..." 
                                                                role="button" onclick="CandidateVote()">
                                                              
                                                              <div class="caption">
                                                                <h6>'.$rowcandidate[1]. ' '.$rowcandidate[2].'</h6>
                                                                <p style="font-size:12px;">Click on Picture to Vote</p>
                                                                
                                                              </div>
                                                            </div>
                                                          </td></tr>
                                                        ';
                                                        //$candidateradio="candidateradio.$rowcandidate[0]";
                                                        
                                                        if ((isset($_Post['candidateradio.$rowcandidate'])) && (!empty($_Post['candidateradio.$rowcandidate']))){
                                                            $incrementer = 1;
                                                            $query = "UPDATE countercandidates SET VotesObtained= VotesObtained + $incrementer WHERE CandidateID ='{$rowcandidate[0]}'";
                                                            $result = mysql_query($query,$connect) or die(mysql_error());
                                                        }
                                                      } 
                                                    }
                                                }  
                                            //   }
                                            // }        
                                                echo '</table>';
                                                
                                                mysql_close($connect);
                                         ?>


                                        </div>

                                         <br /><div class="col-md-4">
                                                 <button class="btn btn-lg btn-success btn-block" type="submit" name="castvote">SUBMIT VOTE <img width="45" 
                                                 height="30" src="pics/correcttick.jpg" ></button>
                                            </div>
                                            <div class="col-md-4">
                                                 <button class="btn btn-lg btn-danger btn-block" type="reset" >CANCEL VOTE </button>
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
<?php
    //start session
    session_start();
    ob_start();
    
    //register session variables
    // $_SESSION['counter'];
    // $_SESSION['PortfolioTotalVotes'];
    // $_SESSION['CandVotesObtained'];
    // $_SESSION['CandVotesPercentage'];
    // $_SESSION['CandidateID'];

    // $_SESSION['TotalVoters'];
    // $_SESSION['TotalVerifiedVoters'];
    // $_SESSION['TotalVotesCast'];
    // $_SESSION['TotalRejectedVotes'];
    // $_SESSION['RigAttempts'];
    
    //check if logged in
    // if(!isset($_SESSION['username'])){
    //     header("Location: index.php");
    //     exit;
    // }   
    // else {
    //     date_default_timezone_set('UTC');
    //     $_SESSION['user_msg'] = "<p><h5>Welcome, ".strtoupper($_SESSION['username'])."!  You logged in today ". date('j F, Y')." at ".date('h:i:s:a') ." </h5></p>";
    // }

    //include("includes/connection.php");
    Require_once("includes/connection.php");

    $query2 = "SELECT * FROM countercandidates";
    $result2 = mysql_query($query2,$connect) or die(mysql_error());
                                                    
    while ($row2 = mysql_fetch_array($result2)) {
            echo "<tr>";
            echo '<td>'.$row2[2].'</td>';   //Votes obtained by candidate
            echo '<td>'.$row2[3].'</td>';   //Votes by position total(%)
            echo "</tr>";
        }



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
            $(document).ready(function() 
            { 
            //var searchid = $(this).val();
            //var dataString = 'search='+ searchid;
            if(searchid!='')
            {
                $.ajax({
                type: "POST",
                url: "ballot.php",
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

            
            }
        </script>
        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
        
    </head>
    <body>
    
    <form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
     <div class="col-md-4">
         <button class="btn btn-lg btn-success btn-block" type="submit" name="Vote" >
         SUBMIT VOTE <img width="45" height="30" src="pics/correcttick.jpg" ></button><br />
    </div>
        <?php
                                            
            //if (isset($_Post['Vote'])){
              //  $VoteStatus = "Voted";
            //if (isset($_Post['vote'])) {
                //$VoteStatus = "Voted";
            if(isset($_GET['id']) && isset($_GET['action'])){
            if($_GET['action']=='vote'){ 
                $VoterID=$_GET['id'];
                
                $_SESSION = $VoterID;
                $_SESSION['VoterID'] = $VoterID;;
                echo "this is session id: ".$_SESSION['VoterID'];

                }
            }   
                
             if (isset($_POST['castvote'])) {
                echo "this is session id: ".$_SESSION['VoterID'];
                $VoterID = $_SESSION['VoterID'];
                $VoteStatus = "Voted";

                $query2 = "SELECT VoterID, Fname, Lname FROM voters WHERE VoterID='{$VoterID}' ";
                $result2 = mysql_query($query2,$connect) or die(mysql_error());
                $rowvoter = mysql_fetch_array($result2);
                if ($rowvoter){
                    echo "successfully done";
                }
                
                $query = "UPDATE voters SET VoteStatus='$VoteStatus' WHERE VoterID ='$VoterID'";
                $result = mysql_query($query,$connect) or die(mysql_error());

                if ($result){

                    echo "<p class='alert alert-success alert-dismissible'><strong>THANKS ".$rowvoter[1]." ".$rowvoter[2]." FOR VOTING!!!</strong>
                            </p><br />";
                    // echo "<script>
                    //     setTimeout(\"location.href = 'voterlogin.php';\",3000);
                    //   </script>";
                    // }
                }
            }

            $query2 = "SELECT * FROM candidates ";
            $result2 = mysql_query($query2,$connect) or die(mysql_error());
            //$rowvoter = mysql_fetch_array($result2);
            // while ($rowvoter = mysql_fetch_array($result2)){
            //     echo "<p class='alert alert-success alert-dismissible'><strong>From while THANKS ".$rowvoter[1]." ".$rowvoter[2]." FOR VOTING!!!</strong>
            //                 </p><br />";
            // }
            for ($i=0; $i<= count($rowvoter); $i++){
            while ($rowvoter = mysql_fetch_array($result2)){
                echo "<p class='alert alert-success alert-dismissible'><strong>From if THANKS ".$rowvoter[1]." ".$rowvoter[2]." FOR VOTING!!!</strong>
                      </p><br />";
                }
            }


   
         ?>
        </form>
    </body>
</html>
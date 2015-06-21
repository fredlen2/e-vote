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
        <style>
            #imagePreview {
                width: 180px;
                height: 180px;
                background-position: center center;
                background-size: cover;
                -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
                display: inline-block;
            }
        </style>
        <script type="text/javascript">
            $(function() {
                $("#uploadFile").on("change", function()
                {
                    var files = !!this.files ? this.files : [];
                    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
             
                    if (/^image/.test( files[0].type)){ // only image file
                        var reader = new FileReader(); // instance of the FileReader
                        reader.readAsDataURL(files[0]); // read the local file
             
                        reader.onloadend = function(){ // set image data as background of div
                            $("#imagePreview").css("background-image", "url("+this.result+")");
                        }
                    }
                });
            });
        </script>
        
    </head>
    <body>

        <!-- Header -->
            <div id="header">

                <!-- Logo -->
                    <h1><a href="index.php" id="logo">ATECOE SRC ELECTION 2015</a></h1>

                <!-- Nav -->
                    <nav id="nav">
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
                                <?php
                                    if (isset($_POST['candidatereg'])) {
                                        date_default_timezone_set('UTC');
                                        $date = date("Y-m-d");
                                        
                                        $FirstName = $_POST['FirstName'];
                                        $LastName = $_POST['LastName'];
                                        $Portfolio = $_POST['Portfolio'];
                                        $Hall = $_POST['Hall'];
                                        $Gender = $_POST['Gender'];

                                        if(getimagesize($_FILES['image']['tmp_name']) == FALSE)
                                        {
                                            echo "<div class='alert-danger'>Please select an image!</div>";
                                            echo "<script>
                                                    setTimeout(\"location.href = 'hallcandidatereg.php';\",2000);
                                                  </script>";
                                        }
                                        else 
                                        {
                                            $image = addslashes($_FILES['image']['tmp_name']);
                                            $name = addslashes($_FILES['image']['name']);
                                            $image = file_get_contents($image);
                                            $image = base64_encode($image);
                                        
                                            $query = "INSERT INTO hallcandidates VALUES('', '$FirstName', '$LastName', '$Gender', '$Portfolio', '$Hall', '$name', '$image', '$date')";
                                            $result = mysql_query($query,$connect) or die(mysql_error());
                                        }
                                        // echo "<font color='blue'>Candidate successfully Registered!</font>";
                                        if ($result){

                                            echo "<div class='alert-success'>Candidate Successfully Registered!</div>";
                                            echo "<script>
                                                    setTimeout(\"location.href = 'hallcandidatereg.php';\",2000);
                                                  </script>";
                                        }
                                        else
                                        {
                                            echo "<div class='alert-danger'>Registration Error.</div>";
                                            echo "<script>
                                                    setTimeout(\"location.href = 'hallcandidatereg.php';\",2000);
                                                  </script>";
                                        }
                                        mysql_close($connect);
                                    }
                                
                                ?>
                                <form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                                    <fieldset>
                                        <div class="form-group input-group">
                                             <div class="row">
                                                <h3 class="intro-text text-center">
                                                    CANDIDATE REGISTRATION 
                                                </h3>
                                                
                                            </div>
                                        </div>
                                         <div class="form-group ">
                                            <div class="row container">
                                                <label for="FirstName" class="control-label">First Name</label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="FirstName" placeholder="First Name" autofocus>
                                                </div>
                                        
                                                <label for="LastName" class="control-label">Last Name</label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="LastName" placeholder="Last Name">
                                                </div>
                                            </div>
                                        
                                            <div class="row container">
                                                <label for="Portfolio" class="control-label">Portfolio &nbsp&nbsp</label>
                                                <div class="col-md-4">
                                                    <!-- <input type="text" class="form-control" name="Portfolio" placeholder="eg. General Secretary" > -->
                                                    <?php
                                                        
                                                        $query1 = "SELECT PortfolioID, Pname FROM hallportfolios ORDER BY Pname ASC";
                                                        $result1 = mysql_query($query1,$connect) or die(mysql_error());
                                                            
                                                        echo '<select name="Portfolio"> <option value=\"\">Select Portfolio...</option>
                                                             ';
                                                            while ($row1 = mysql_fetch_row($result1))
                                                            {
                                                                echo '<option value='. $row1[0] .'> '. $row1[1] .'</option>'; 
                                                            }
                                                        echo "</select>";
                                                    ?>
                                                </div>
                                        
                                                <label for="Hall" class="control-label">Hall &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</label>
                                                <div class="col-md-4">
                                                    <!-- <input type="text" class="form-control" name="Hall" placeholder="Hall of Residence"> -->
                                                    <?php
                                                        $query = "SELECT * FROM hall ORDER BY HallName ASC";
                                                        $result = mysql_query($query,$connect) or die(mysql_error());
                                                            
                                                        echo '<select name="Hall"> <option value=\"\">Select Hall of Residence...</option>
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
                                                    <input type="radio" name="Gender" value="Male"> Male
                                                    <input type="radio" name="Gender" value="Female"> Female
                                                </div>
                                            </div>
                                        
                                            <label for="CandidatePicture">Candidate Picture</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div id="imagePreview"></div>
                                                    <input id="uploadFile" type="file" name="image" class="img" />
                                                </div>
                                            </div>
                                            
                                            <p class="help-block">Upload Candidate Picture here.</p>
                                        </div>
                                        <div class="col-md-4">
                                            <button href="index.html" class="btn btn-lg btn-success btn-block" type="submit" name="candidatereg">Register Candidate</button>
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
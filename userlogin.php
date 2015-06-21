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
                    <h1><a href="userlogin.php" id="logo">ATECOE SRC ELECTION 2015</a></h1>

                <!-- Nav -->
                    <nav id="nav">
                    	<?php
                    		//echo "$_SESSION['user_msg']";
                    		$_SESSION['Admin'] = "Admin";
							$_SESSION['Polling Officer'] = "Polling Officer";
					
							if (isset($_SESSION['username']) && ($_SESSION['usertype'] == $_SESSION['Polling Officer'])){
								echo '<ul>
									<li class="alert alert-warning alert-dismissible">'.strtoupper($_SESSION["usertype"]).': '.strtoupper($_SESSION['username']).'</li>
									<li class="current">
		                                <a href="">Voters</a>
		                                <ul>
		                                	<!--<li><a href="voterreg.php">Register Voter</a></li> -->
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
		                                    <li><a href="voteresultslive.php">Live Election Results</a></li>
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
		
		
		
		<!-- Footer -->
			<div id="footer">

				<!-- Icons -->
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-github"><span class="label">GitHub</span></a></li>
						<li><a href="#" class="icon fa-linkedin"><span class="label">LinkedIn</span></a></li>
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
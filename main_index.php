<?php
    //start session
    session_start();
    ob_start();
    // //register session variables
    // //$_SESSION['username'];
    // //check if logged in
    if(!isset($_SESSION['username'])){
        //header("Location: voterlogin.php");
        echo "<div class='alert alert-success alert-dismissible'>Please Login before Visiting this page!</div>";
        echo "<script>
            setTimeout(\"location.href = 'index.php';\",3000);
          </script>";
    }    
    else {
    	date_default_timezone_set('UTC');
		$_SESSION['user_msg'] = "<p><h5>Welcome, ".strtoupper($_SESSION['username'])."!  
			You logged in today ". date('j F, Y')." at ".date('h:i:s:a') ." </h5></p>";  
    }

    Require_once("includes/connection.php");
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>SRC ELECTION 2015</title>
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
					<h1><a href="main_index.php" id="logo">ATECOE SRC ELECTION 2015</a></h1>

				<!-- Nav -->
					<nav id="nav">
						<ul>
						<?php
							echo '<li class="alert alert-warning alert-dismissible">'.strtoupper($_SESSION["usertype"]).': '.strtoupper($_SESSION['username']).'</li>';
						?>
							<li class="current"><a href="index.php">Home</a></li>
							<li>
								<a href="userlogin.php" onclick="startsession();" role="button">Start Session</a>
							</li>
							<li>
								<a href="index.php" onclick = logout() role="button">End Session</a>
							</li>
						</ul>
					</nav>

					<?php
						// if (isset($_SESSION['user_msg'])){
						// 	echo "$_SESSION['user_msg']";
						// }
					?>
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
		<?php
			function startsession(){
				//start session
			    session_start();
			    ob_start();

			    date_default_timezone_set('UTC');

			    echo "<div class='alert alert-success alert-dismissible'>Redirecting page ...</div>";
				echo "<script>
						setTimeout(\"location.href = 'userlogin.php';\",1500);
					</script>";
			}

			function timeout(){
				$timeout = 2; //set timeout minutes
				$timeout = $timeout * 60 ;//converts minutes to seconds
				if (isset($_SESSION['start_time'])){
					$elapsed_time = time() - $_SESSION['start_time'];
					if ($elapsed_time >= $timeout) {
						$_SESSION = array();
						session_destroy();
						unset ($_SESSION);
						echo "<script language='javascript'>
								messsage('Your session has expired! Please login again!!','error');
								window.location='main_index.php' 
							</script>";
						exit;
					}
				}
				$_SESSION['start_time'] = time();
			} 
			
			function logout(){	
				
				//$_SESSION['start_time'] = time();					
				// if (isset($_POST['logout'])){ // Log out the user.
					//session_regenerate_id(true);
					$_SESSION = array();
					session_destroy();
					unset($_SESSION);
					//header('Location: index.php');
					echo "<div class='alert alert-success alert-dismissible'>Voter Successfully Verified!</div>";
	                echo "<script>
	                    setTimeout(\"location.href = 'main_index.php';\",3000);
	                  </script>";
				//}
			} 
		?>	

	</body>
</html>
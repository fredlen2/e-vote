<?php
    //start session
    session_start();
    ob_start();
    //register session variables
    //$_SESSION['username'];
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
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-1.10.2.min.js"></script>
        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
        
    </head>
    <body>

        <!-- Header -->
            <div id="header">

                <!-- Logo -->
                    <h1><a href="#" id="logo">ATECOE SRC ELECTION 2015</a></h1>

                <!-- Nav -->
                    <nav id="nav">
                        <ul>
                            <li class="current"><a href="#">Please Login and Let's Begin!</a></li>
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
                                    if(isset($_POST['UserLogin'])){
                                        
                                        $user = $_POST['username'];
                                        $passMD5 = md5($_POST['password']);
                                        $passSHA1 = SHA1($_POST['password']);
                                            
                                        $query = "SELECT * FROM users WHERE username LIKE '{$user}' && passMD5 = '$passMD5' && passSHA1 = '$passSHA1' ";
                                        $result = mysql_query($query, $connect) or die (mysql_error());
                                        
                                        $num = mysql_num_rows($result); 
                                        $row = mysql_fetch_array($result);
                                        
                                        if ($row){
                                            $username = $row[1];
                                            $usertype = $row[4];
                                            $_SESSION['username'] = $username ;
                                            $_SESSION['usertype'] = $usertype ;
                                        }
                                            if ($num != 0) {
                                                echo "<div class='alert alert-success alert-dismissible'>login successful...</div>";
                                                header("location: main_index.php");
                                                exit;
                                                }
                                            else {
                                                echo "<div class='alert alert-danger alert-dismissible'>Sorry, username or password incorrect!</div>";
                                            }
                                        }
                                        //}
                                    ?>
                                <form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                    <fieldset>
                                        <div class="form-group input-group">
                                             <div class="row">
                                                <h3 class="intro-text text-center">
                                                    USER LOGIN 
                                                </h3>
                                                
                                            </div>
                                        </div>
                                         <div class="form-group ">
                                            <div class="row container">
                                                <label for="Username" class="control-label">Username</label>
                                                <div class="col-md-4">
                                                    <!-- <span class="glyphicon glyphicon-user"></span> -->
                                                <input class="form-control" type="text" name='username' placeholder="username" autofocus/>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <div class="row container">
                                            <label for="Password" class="control-label">Password</label>
                                            <div class="col-md-4">
                                                <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span> -->
                                                <input class="form-control" type="password" name='password' placeholder="password"/>
                                            </div>
                                        </div>
                                        
                                           
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <button class="btn btn-lg btn-success btn-block" type="submit" name="UserLogin">LOGIN</button>
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
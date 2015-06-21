<?php
	session_start();
	ob_start();
	//include("includes/connection.php");
	if(!isset($_SESSION['username'])){
		header("Location: ../index.php");
		exit;
	}	
	else {
		$_SESSION['user_msg'];
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>OUT-PATIENT DEPARTMENT Database Hub</title>
	<!-- <link rel="stylesheet" href="sheet1.css"> -->
	<link rel="stylesheet" href="webkit.css">
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="sheet.css">

	<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
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
	</script>
	
</head>

<body>
	<div id="big_wrapper">
		<header id="top_header">
			<!-- <img src="pics/head.jpg" id="header_picture"> -->
		</header>
		
		<nav id="top_menu" class="navbar navbar-inverse" role="navigation">
			<ul class="nav nav-pills">
				<?php 
					if (isset($_SESSION['username']) && (strtolower($_SESSION['usertype']) == $_SESSION['admin'])){
						echo '<li><a href = "../login.php" class="hover_menu">Home</a></li>';
						echo '<li><a href = "../regis.php" class="hover_menu">Register Patient</a></li>';
						echo '<li><a href = "../auto-search/" class="hover_menu">Patient Finder</a></li>';
						echo '<li><a href = "../data.php" class="hover_menu">Patients Database</a></li>';
						echo '<li><a href = "../newuser.php" class="hover_menu">Create User</a></li>';
						echo '<li><a href = "../dispensary.php" class="hover_menu">Dispensary</a></li>';
					}
					else if (isset($_SESSION['username']) && (strtolower($_SESSION['usertype']) == $_SESSION['normal'])){
						echo '<li><a href = "../login.php" class="hover_menu">Home</a></li>';
						echo '<li><a href = "../regis.php" class="hover_menu">Register Patient</a></li>';
						echo '<li><a href = "../auto-search/" class="hover_menu">Patient Finder</a></li>';
						//echo '<li><a href = "../data.php" class="hover_menu">Patients Database</a></li>';
					}
					?>
			</ul>
		</nav>
		
		<?php echo "<font style='color:red; margin-top:2px;'>".$_SESSION['user_msg']."</font>"; ?>
			<section >
			
				<div id="logout_div">
					<!-- <a href="../index.php" ><input type="submit" name="logout" value="LOGOUT" style="width:85px; height:40px; padding:5px; background-color:red; color: #fff;"></a> -->
					<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
						<input type="submit" name="logout" id="logout" value="LOGOUT" style="width:85px; height:40px; padding:5px; background-color:red; color: #fff;"> 
					</form>
				</div><br /><br />
				
				<center>
					<div class="content">
						<input type="text" class="search" id="searchid" placeholder="Search patient by FOLDER NUMBER or NAME or NHIS_ID or GENDER or DATE" autofocus/> <br /> 
						<div id="result">
						</div>
					</div>
					<p style="margin-top: 30px;"> </p>
				</center>
			</section>
		
		<footer id="the_footer">
			Copyright &copy FRED SITE2014 - 0548579168
		</footer>
		
		<?php
			$timeout = 5; //set timeout minutes
			$timeout = $timeout * 60 ;//converts minutes to seconds
			if (isset($_SESSION['start_time'])){
				$elapsed_time = time() - $_SESSION['start_time'];
				if ($elapsed_time >= $timeout) {
					$_SESSION = array();
					session_destroy();
					unset ($_SESSION);
					echo "<script language='javascript'>
							alert('Your session has expired! Please login again!!');
							//window.location='../index.php' 
						</script>";
							header('Location: index.php');
							exit;
				}
			}
			$_SESSION['start_time'] = time();
								
			if (isset($_POST['logout'])){ // Log out the user.
				//session_regenerate_id(true);
				$_SESSION = array();
				session_destroy();
				unset($_SESSION);
				header('Location: index.php');
				exit;
				/* echo "<script language='javascript'>
						window.location='../index.php' 
					</script>";
				exit; */
			} 
		?>	
	</div>
</body>
</html>

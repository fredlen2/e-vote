<?php
	include('../includes/connection.php');

if($_POST)
{
	$search = $_POST['search'];
	$sql_res=mysql_query("SELECT * FROM opd_record WHERE folder LIKE '%$search%' || name LIKE '%$search%' 
	|| nhis LIKE '%$search%' || date LIKE '{$search}' || gender LIKE '{$search}' || phone LIKE '%$search%' || address LIKE '%$search%' ORDER BY name ASC LIMIT 100");
	
	while($row=mysql_fetch_array($sql_res))
	{
		$folder = $row['folder'];
		$name = $row['name'];
		$nhis = $row['nhis'];
		$gender = $row['gender'];
		$age = $row['age'];
		$phone = $row['phone'];
		$address = $row['address'];
		$date = $row['date'];
		$comment = $row['comment'];
		
		$b_folder = '<strong>'.$search.'</strong>';
		$b_name='<strong>'.$search.'</strong>';
		$b_nhis='<strong>'.$search.'</strong>';
		$b_gender='<strong>'.$search.'</strong>';
		$b_age='<strong>'.$search.'</strong>';
		$b_phone='<strong>'.$search.'</strong>';
		$b_address='<strong>'.$search.'</strong>';
		$b_date='<strong>'.$search.'</strong>';
		$b_comment='<strong>'.$search.'</strong>';
		
		$final_folder = str_ireplace($search, $b_folder, $folder);
		$final_name = str_ireplace($search, $b_name, $name);
		$final_nhis = str_ireplace($search, $b_nhis, $nhis);
		$final_gender = str_ireplace($search, $b_gender, $gender);
		$final_age = str_ireplace($search, $b_age, $age);
		$final_phone = str_ireplace($search, $b_phone, $phone);
		$final_address = str_ireplace($search, $b_address, $address);
		$final_date = str_ireplace($search, $b_date, $date);
		$final_comment = str_ireplace($search, $b_comment, $comment);
		?>
		<div class="show" align="left">
			<a href="../regis.php">
				<img src="../pics/search_gallery.PNG" style="width:50px; height:50px; float:left; margin-right:6px;" />
				<span class="name"><?php echo "<font style='color:blue;'>".$final_folder ."</font>\t"; ?></span>&nbsp;<br/>
				<?php echo "<font style='color:green;'>".$final_name."</font>\t&nbsp;"; ?>
				<?php echo "<font style='color:blue;'>".$final_nhis."</font>\t&nbsp;" ?>
				<?php echo "<font style='color:green;'>".$final_gender."</font>\t&nbsp;" ?>
				<?php echo "<font style='color:blue;'>".$final_age."</font>\t&nbsp;" ?>
				<?php echo "<font style='color:green;'>".$final_phone."</font>\t&nbsp;" ?>
				<?php echo "<font style='color:blue;'>".$final_address."</font>\t&nbsp;" ?>
				<?php echo "<font style='color:green;'>".$final_date."</font>\t&nbsp;" ?>
				<?php echo "<font style='color:blue;'>".$final_comment."</font>\t&nbsp;" ?>
			</a>
			<br/>
		</div>
		<?php
	}
}
?>

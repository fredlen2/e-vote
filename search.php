<?php
	require_once('includes/connection.php');

if($_POST)
{
	$search = $_POST['search'];
	$sql_res=mysql_query("SELECT * FROM voters WHERE IndexNo LIKE '%$search%' ORDER BY Fname ASC LIMIT 20");
	
	while($row=mysql_fetch_array($sql_res))
	{
		$VoterID = $row['VoterID'];
		$Fname = $row['Fname'];
		$Lname = $row['Lname'];
		$IndexNo = $row['IndexNo'];
		$Gender = $row['Gender'];
		$VerificationStatus = $row['VerificationStatus'];
		
		$b_Fname = '<strong>'.$search.'</strong>';
		$b_Lname='<strong>'.$search.'</strong>';
		$b_IndexNo='<strong>'.$search.'</strong>';
		$b_Gender='<strong>'.$search.'</strong>';
		$b_VerificationStatus='<strong>'.$search.'</strong>';
				
		$final_Fname = str_ireplace($search, $b_Fname, $Fname);
		$final_Lname = str_ireplace($search, $b_Lname, $Lname);
		$final_IndexNo = str_ireplace($search, $b_IndexNo, $IndexNo);
		$final_Gender = str_ireplace($search, $b_Gender, $Gender);
		$final_VerificationStatus = str_ireplace($search, $b_VerificationStatus, $VerificationStatus);
		
		?>
		<div class="show" >
			<?php echo '<a href="voterverify.php?id='.$VoterID.'&action=voterupdate" type="submit" onclick=VoterVerify() role="button">'; ?>
				<img src="pics/search_gallery.PNG" style="width:50px; height:50px; float:left; margin-right:6px;" />
				<span class="name"><?php echo "<font style='color:blue;'>".$final_Fname." ".$final_Lname ."</font>\t"; ?></span>&nbsp;
				<?php echo "<font style='color:green;'>".$final_IndexNo."</font>\t&nbsp;"; ?>
				<?php echo "<font style='color:blue;'>".$final_Gender."</font>\t&nbsp;" ?>
				<?php echo "<font style='color:green;'>".$final_VerificationStatus."</font>\t&nbsp;" ?>
			</a>	
			<br/>
		</div>
		<?php


	}
}
?>
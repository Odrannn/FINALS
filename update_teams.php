<?php
	$hostName = "localhost";
	$userName = "root";
	$password = "";
	$dbName = "pba";
	$connection = mysqli_connect($hostName, $userName, $password, $dbName);
	
	if(isset($_POST['updatedata']))
	{
		$id = $_POST['update_id'];
		
		$tname = $_POST['team_name'];
		$tmoniker = $_POST['team_moniker'];
		$tstatus = $_POST['team_status'];
		
		$query = "UPDATE teams SET team_name='$tname', team_moniker='$tmoniker', team_status ='$tstatus' WHERE team_id = '$id'";
		$query_run = mysqli_query($connection, $query);
		
		if($query_run)
		{
			echo "<script> alert('Team Updated'); </script>";
			header ("location:teams_profile1.php");
		}
		else
		{
			echo "<script> alert('Team Not Updated'); </script>";
		}
	}
?>
	
	
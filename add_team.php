<?php
	$hostName = "localhost";
	$userName = "root";
	$password = "";
	$dbName = "pba";
	$connection = mysqli_connect($hostName, $userName, $password, $dbName);
	
	if(isset($_POST['adddata']))
	{
		$tname = $_POST['teamName'];
		$tmoniker = $_POST['teamMoniker'];
		
		$sql = "INSERT INTO teams (team_name, team_moniker, team_status) VALUES ('" . $tname . "', '" . $tmoniker . "', 1)";
		$query_run = mysqli_query($connection, $sql);
		
		if($query_run)
		{
			echo "<script> alert('Team Added'); </script>";
			header ("location:teams_profile.php");
		}
		else
		{
			echo "<script> alert('Team Not Added'); </script>";
		}
	}
?>
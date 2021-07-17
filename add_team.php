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
		
		$check_duplicate_name = "SELECT team_name FROM teams WHERE team_name = '$tname'";
		$result = mysqli_query($connection,$check_duplicate_name);
		$count = mysqli_num_rows($result);
		
		if($count > 0) {
			header ("location:teams_profile.php");
			return false;
		}
		$check_duplicate_moniker = "SELECT team_moniker FROM teams WHERE team_moniker = '$tmoniker'";
		$result = mysqli_query($connection,$check_duplicate_moniker);
		$count = mysqli_num_rows($result);
		
		if($count > 0) {
			header ("location:teams_profile.php");
			return false;
		}
		
		$query_run = mysqli_query($connection, $sql);
		header ("location:teams_profile.php");
	}
?>
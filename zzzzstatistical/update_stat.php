<?php
	$hostName = "localhost";
	$userName = "root";
	$password = "";
	$dbName = "pba";
	$connection = mysqli_connect($hostName, $userName, $password, $dbName);
	
	if(isset($_POST['updatedata']))
	{
		$id = $_POST['update_id'];
		
		$gameid = $_POST['game_id'];
		$playerid = $_POST['player_id'];
		$playerid = $playerid[0];
		
		$sql = "SELECT * FROM players WHERE player_id = '$playerid'";
		$result = mysqli_query($connection,$sql);
		$row = mysqli_fetch_assoc($result);
		
		$teamid = $row['team_id'];
		$jerseynumber = $row['jersey_number'];
		
		$points = $_POST['player_points'];
		$rebounds = $_POST['player_rebounds'];
		$assists = $_POST['player_assists'];
		$steals = $_POST['player_steals'];
		$blocks = $_POST['player_blocks'];
		
		$query = "UPDATE stats SET game_id='$gameid', player_id='$playerid', team_id ='$teamid', jersey_number='$jerseynumber',
		points ='$points',rebounds ='$rebounds',assists ='$assists',steals ='$steals',blocks ='$blocks' WHERE player_stat_id = '$id'";
		$query_run = mysqli_query($connection, $query);
		
		header ("location:statistical_maintenance.php");
	}
?>
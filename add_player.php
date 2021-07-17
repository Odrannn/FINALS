<?php
	$hostName = "localhost";
	$userName = "root";
	$password = "";
	$dbName = "pba";
	$connection = mysqli_connect($hostName, $userName, $password, $dbName);
	if(isset($_POST['adddata']))
	{
		echo "1";
		$playername = $_POST['playerName'];
		$jerseynumber = $_POST['jerseyNumber'];
		$playerposition = $_POST['primaryPlayingPosition'];
		$playerheight = $_POST['height'];
		$teamid = $_POST['teamID'];
		
		$sql = "INSERT INTO players (player_name, jersey_number, primary_playing_position, height,team_id) VALUES ('" .
		$playername . "', '" . $jerseynumber . "', '" . $playerposition . "', '" . $playerheight . "', '" . $teamid . "')";
		
		$check_duplicate_name = "SELECT player_name FROM players WHERE player_name = '$playername'";
		$result = mysqli_query($connection,$check_duplicate_name);
		$count = mysqli_num_rows($result);
		
		if($count > 0) {
			return false;
		}
		
		$query_run = mysqli_query($connection, $sql);
		header ("location:players_profile.php");
	}
?>
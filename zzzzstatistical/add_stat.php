<?php
	$hostName = "localhost";
	$userName = "root";
	$password = "";
	$dbName = "pba";
	$connection = mysqli_connect($hostName, $userName, $password, $dbName);
	
	if(isset($_POST['adddata']))
	{
		$gameid = $_POST['gameID'];
		$playerid = $_POST['playerID'];
		$playerid = $playerid[0];
		
		$sql = "SELECT * FROM players WHERE player_id = '$playerid'";
		$result = mysqli_query($connection,$sql);
		$row = mysqli_fetch_assoc($result);
		
		$teamid = $row['team_id'];
		$jerseynumber = $row['jersey_number'];
		
		$points = $_POST['playerPoints'];
		$rebounds = $_POST['playerRebounds'];
		$assists = $_POST['playerAssists'];
		$steals = $_POST['playerSteals'];
		$blocks = $_POST['playerBlocks'];
		
		$sql = "INSERT INTO stats (game_id, player_id, team_id, jersey_number, points, rebounds, assists, steals, blocks) VALUES ('" .
		$gameid . "', '" . $playerid . "', '" . $teamid . "', '" . $jerseynumber . "', '" . $points . "', '" . $rebounds
		. "', '" . $assists . "', '" . $steals . "', '" . $blocks . "')";
		
	
		$query_run = mysqli_query($connection, $sql);
		header ("location:statistical_maintenance.php");
	}
?>
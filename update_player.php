<?php
	$hostName = "localhost";
	$userName = "root";
	$password = "";
	$dbName = "pba";
	$connection = mysqli_connect($hostName, $userName, $password, $dbName);
	
	if(isset($_POST['updatedata']))
	{
		$id = $_POST['update_id'];
		
		$playername = $_POST['player_name'];
		$jerseynumber = $_POST['jersey_number'];
		$playerposition = $_POST['position'];
		$playerheight = $_POST['player_height'];
		$teamid = $_POST['team_id'];
		
		$query = "UPDATE players SET player_name='$playername', jersey_number='$jerseynumber', primary_playing_position ='$playerposition',height='$playerheight', team_id ='$teamid' WHERE player_id = '$id'";
		$query_run = mysqli_query($connection, $query);
		
		if($query_run)
		{
			echo "<script> alert('Team Updated'); </script>";
			header ("location:players_profile.php");
		}
		else
		{
			echo "<script> alert('Team Not Updated'); </script>";
		}
	}
?>
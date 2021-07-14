<?php

session_start();

$mysqli = new mysqli('localhost','root','','pba') or die(mysqli_error($mysqli));

$update = false;
$team_name="";
$team_moniker="";
$team_status="";
$id=0;

if (isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update = true;
	$result = mysql-> query("SELECT * FROM teams id=$id") or die($mysqli->error());							
	if (count($result)==1){
		$row = $result->fetch_array();
		$team_name = $row['team_name'];
		$team_moniker = $row['team_moniker'];
		$team_status = $row['team_status'];
	}
}

if (isset($_POST['update'])){
	$id = $POST[id];
	$team_name = $POST['team_name'];
	$team_moniker = $POST['team_moniker'];
	
	$mysqli->query("UPDATE data SET team_name='$team_name', team_moniker='$team_moniker' where id=$id") or die($mysqli->error);
	
	$_SESSION['message'] = "Record has been updated!";
	$_SESSION['msg_type'] = "warning";
	
	header('location: teams_profile.php');
?>	

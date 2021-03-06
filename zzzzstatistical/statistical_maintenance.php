<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PBA Maintenance - Statistical Maintenance</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
	
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color:#242424;" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <img src="img/pbalogo.png" style="width:50px;margin-left:10px;">
                <div class="sidebar-brand-text mx-3">PBA Maintenance</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu:</h6>
                        <a class="collapse-item" href="teams_profile.php">Teams Profile</a>
                        <a class="collapse-item" href="players_profile.php">Players Profile</a>
                        <a class="collapse-item" href="">Games Profile</a>
                        <a class="collapse-item" href="statistical_maintenance.php">Statistical Maintenance</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
					<br>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Statistical Maintenance</h1><br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Players Statistics</h6>
                        </div>
						<div>
						<br>
							<form class="form-horizontal" action="" method="post">
								<div class="form-group" style ="width:100%">
									<div class="col-md-5">
										<table>
										<tr>
										<td style="padding:0 10px;"><input style="width:300px;" id="textinput" name="filterKeyword" type="text" placeholder="Type player name keyword..." class="form-control input-md" value="<?php echo isset($_POST['filterKeyword']) ? $_POST['filterKeyword'] : (isset($_SESSION['filterKeyword']) ? $_SESSION['filterKeyword'] : ''); ?>"></td>
										<td><button id="search" name="search" class="btn btn-outline-dark">Search</button></td>
										<td><button style='background-color:#242424;' type='button' name="addbtn" class="btn btn-dark addbtn">Add Stat</button></td>
										</tr>
										</table>
									</div>
								</div>
								<div style="margin:0 20px;display:inline-block">
									<div class="form-group">
										<label>Type:</label>
										<select name = "type" style="margin:0 20px;padding:0 10px;" class="form-select">
											<option>Total</option>
											<option>Average</option>
										</select>
										<label>Scope:</label>
										<select name = "scope" style="padding:0 10px;margin:0 20px;" class="form-select">
											<option>Teams</option>
											<option>All-Time</option>
											<option>Year</option>
										</select>
										<label>Categories:</label>
										<select name = "category" style="padding:0 0 0 10px ;margin:0 20px;" class="form-select">
											<option>Points</option>
											<option>Rebounds</option>
											<option>Assists</option>
											<option>Steals</option>
											<option>Blocks</option>
										</select>
									</div>
								</div>
								<button type='submit' name="filterbtn" class="btn btn-success filterbtn">Filter</button>
							</form>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th scope="col">Player Stat ID</th>
											<th scope="col">Game ID</th>
											<th scope="col">Player ID</th>
											<th scope="col">Team ID</th>
											<th scope="col">Jersey Number</th>
											<th scope="col">Points</th>
											<th scope="col">Rebounds</th>
											<th scope="col">Assist</th>
											<th scope="col">Steals</th>
											<th scope="col">Blocks</th>
											<th scope="col">Operation</th>
										</tr>
									</thead>
									<tbody>
										
										<?php
											$hostName = "localhost";
											$userName = "root";
											$password = "";
											$dbName = "pba";

											$connection = mysqli_connect($hostName, $userName, $password, $dbName);
							
											if (!$connection) 
											{
												die("Connection failed: " . mysqli_connect_error());
											}
											
											if (isset($_POST['filterKeyword']) && $_POST['filterKeyword'] != "")
											{
												$sql = "SELECT player_id FROM players WHERE player_name LIKE '%" . $_POST['filterKeyword'] . "%'";
												
												$result = mysqli_query($connection, $sql);
												$row = mysqli_fetch_assoc($result);
												$playerID = $row["player_id"];
												
												$sql = "SELECT * FROM stats WHERE player_id = '$playerID'";
												$result = mysqli_query($connection, $sql);
												if (!$result || mysqli_num_rows($result) == 0)
												{	
													echo "<tr>";
													echo "<td colspan='7'><center><h2>Record not found!...</center></h2></td>";
													echo "</tr>";
												} 
												else 
												{
													$counter = 0;
													while ($row = mysqli_fetch_assoc($result)) 
													{
														echo "<tr class='" . ($counter == 1 ? "" : "success") . "'>";
														echo "<td scope='row'>", $row["player_stat_id"], "</ts>";
														echo "<td>", $row["game_id"], "</td>";
														echo "<td>", $row["player_id"],"</td>";
														echo "<td>", $row["team_id"], "</td>";
														echo "<td>", $row["jersey_number"], "</td>";
														echo "<td>", $row["points"], "</td>";
														echo "<td>", $row["rebounds"], "</td>";
														echo "<td>", $row["assists"], "</td>";
														echo "<td>", $row["steals"], "</td>";
														echo "<td>", $row["blocks"], "</td>";
														echo "<td><center><button type='button' class='btn btn-primary editbtn'>Edit </button></center></td>";
														echo "</tr>";
														$counter = $counter == 0 ? 1 : 0;
													}
												}
												mysqli_close($connection);
											}
											else{
												$sql = "SELECT * FROM stats";
												
												$result = mysqli_query($connection, $sql);
												
												$counter = 0;
												while ($row = mysqli_fetch_assoc($result)) 
												{
													echo "<tr class='" . ($counter == 1 ? "" : "success") . "'>";
													echo "<td scope='row'>", $row["player_stat_id"], "</ts>";
													echo "<td>", $row["game_id"], "</td>";
													echo "<td>", $row["player_id"],"</td>";
													echo "<td>", $row["team_id"], "</td>";
													echo "<td>", $row["jersey_number"], "</td>";
													echo "<td>", $row["points"], "</td>";
													echo "<td>", $row["rebounds"], "</td>";
													echo "<td>", $row["assists"], "</td>";
													echo "<td>", $row["steals"], "</td>";
													echo "<td>", $row["blocks"], "</td>";
													echo "<td><center><button  type='button' class='btn btn-primary editbtn'>Edit </button></center></td>";
													echo "</tr>";
													$counter = $counter == 0 ? 1 : 0;
												}
												mysqli_close($connection);
											}
										?>

										<!-- Edit Modal -->
										<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">EDIT STAT</h5>
													</div>
											  
													<form action="update_stat.php" method="POST">
						  
													<div class="modal-body">
														<input type="hidden" name="update_id" id="update_id">
														<div class="form-group">
															<label>Game ID</label>
															<input type="number" name="game_id" id="game_id" class="form-control" placeholder="Enter Game ID" required >
														</div>
												
														<div class="form-group">
															<label>Player ID</label>
															<input type="number" name="player_id" id="player_id" class="form-control" placeholder="Enter Player ID" required>
														</div>
														
														<div class="form-group">
															<label>Points</label>
															<input type="number" name="player_points" id="player_points" class="form-control" placeholder="Enter Player Points" required>
														</div>
														
														<div class="form-group">
															<label>Rebounds</label>
															<input type="number" name="player_rebounds" id="player_rebounds" class="form-control" placeholder="Enter Player Rebounds" required>
														</div>
														
														<div class="form-group">
															<label>Assists</label>
															<input type="number" name="player_assists" id="player_assists" class="form-control" placeholder="Enter Player Assists" required>
														</div>
														
														<div class="form-group">
															<label>Steals</label>
															<input type="number" name="player_steals" id="player_steals" class="form-control" placeholder="Enter Player Steals" required>
														</div>
														
														<div class="form-group">
															<label>Blocks</label>
															<input type="number" name="player_blocks" id="player_blocks" class="form-control" placeholder="Enter Player Blocks" required>
														</div>
														
													</div>
													
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
														<button type="submit" name="updatedata" class="btn btn-primary">Update Stat</button>
													</div>
													</form>
													
												</div>
											</div>
										</div>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- Add Modal -->
					<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">ADD STAT</h5>
								</div>
						  
								<form action="add_stat.php" method="POST">
						  
								<div class="modal-body">
									<div class="form-group">
										<label>Game ID</label>
										<input type="number" name="gameID" id="gameID" class="form-control" placeholder="Enter Game ID" required >
									</div>
							
									<div class="form-group">
										<label>Player ID</label>
										<?php
										$hostName = "localhost";
										$userName = "root";
										$password = "";
										$dbName = "pba";

										$connection = mysqli_connect($hostName, $userName, $password, $dbName);
										$sql = "SELECT * FROM players";
												
										$result = mysqli_query($connection, $sql);
										echo "<select name='playerID'>";
										while ($row = mysqli_fetch_assoc($result)) 
										{
											echo "<option>", $row["player_id"]." - " . $row["player_name"], "</option>";
										}
										echo "</select>";
										mysqli_close($connection);
										?>
									</div>
									
									<div class="form-group">
										<label>Points</label>
										<input type="number" name="playerPoints" id="playerPoints" class="form-control" placeholder="Enter Player Points" required>
									</div>
									
									<div class="form-group">
										<label>Rebounds</label>
										<input type="number" name="playerRebounds" id="playerRebounds" class="form-control" placeholder="Enter Player Rebounds" required>
									</div>
									
									<div class="form-group">
										<label>Assists</label>
										<input type="number" name="playerAssists" id="playerAssists" class="form-control" placeholder="Enter Player Assists" required>
									</div>
									
									<div class="form-group">
										<label>Steals</label>
										<input type="number" name="playerSteals" id="playerSteals" class="form-control" placeholder="Enter Player Steals" required>
									</div>
									
									<div class="form-group">
										<label>Blocks</label>
										<input type="number" name="playerBlocks" id="playerBlocks" class="form-control" placeholder="Enter Player Blocks" required>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
									<button style='background-color:#242424;' type="submit" name="adddata" class="btn btn-dark">Add Stat</button>
								</div>
								</form>
							</div>
						</div>
					</div>
					<div class="card shadow mb-4">
                        <div class="card-header py-3">
							<?php
								if (isset($_POST['category'])){
									if (isset($_POST['scope'])){
										echo "<h6 class='m-0 font-weight-bold text-primary'>Top 10 Leaderboards (". $_POST['scope']." - ".$_POST['category'].")</h6>";
									}	
								}
							?>
                        </div>
						<div class="card-body">
							<div class="table-responsive">
								<?php
								$hostName = "localhost";
								$userName = "root";
								$password = "";
								$dbName = "pba";

								$connection = mysqli_connect($hostName, $userName, $password, $dbName);
							
								if ($_POST['scope'] !== "Year"){
									echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
									echo "<thead>";
										echo "<tr>";
											echo "<th scope='col'>TOP #</th>";
												if (isset($_POST['scope'])){
													if ($_POST['scope'] == "Teams"){
														echo "<th scope='col'>". $_POST['scope'] ."</th>";
													}
													else{
														echo "<th scope='col'>Player Name</th>";
													}
												}
												
												if (isset($_POST['category'])){
													echo "<th scope='col'>". $_POST['type']." ". $_POST['category'] ."</th>";
												}
										echo "</tr>";
										echo "<thead>";
										echo "<tbody>";
											
											if (!$connection) 
											{
												die("Connection failed: " . mysqli_connect_error());
											}
											
											if (isset($_POST['filterbtn']))
											{
												$type = $_POST['type'];
												$scope = $_POST['scope'];
												$category = $_POST['category'];
												
												if ($scope == "Teams") {
													if ($type == "Total")
													{
														if ($category == "Points"){
															$sql = "SELECT team_id, sum(points) as stat FROM stats GROUP BY team_id ORDER BY stat DESC";
														} else if ($category == "Rebounds"){
															$sql = "SELECT team_id, sum(rebounds) as stat FROM stats GROUP BY team_id ORDER BY stat DESC";
														} else if ($category == "Assists"){
															$sql = "SELECT team_id, sum(assists) as stat FROM stats GROUP BY team_id ORDER BY stat DESC";
														} else if ($category == "Steals"){
															$sql = "SELECT team_id, sum(steals) as stat FROM stats GROUP BY team_id ORDER BY stat DESC";
														} else {
															$sql = "SELECT team_id, sum(blocks) as stat FROM stats GROUP BY pteam_id ORDER BY stat DESC";
														}
													} else 
													{
														if ($category == "Points"){
															$sql = "SELECT team_id, avg(points) as stat FROM stats GROUP BY team_id ORDER BY stat DESC";
														} else if ($category == "Rebounds"){
															$sql = "SELECT team_id, avg(rebounds) as stat FROM stats GROUP BY team_id ORDER BY stat DESC";
														} else if ($category == "Assists"){
															$sql = "SELECT team_id, avg(assists) as stat FROM stats GROUP BY team_id ORDER BY stat DESC";
														} else if ($category == "Steals"){
															$sql = "SELECT team_id, avg(steals) as stat FROM stats GROUP BY team_id ORDER BY stat DESC";
														} else {
															$sql = "SELECT team_id, avg(blocks) as stat FROM stats GROUP BY team_id ORDER BY stat DESC";
														}
													}
												}
												else if($scope == "All-Time"){ 
													if ($type == "Total")
													{
														if ($category == "Points"){
															$sql = "SELECT player_id, sum(points) as stat FROM stats GROUP BY player_id ORDER BY stat DESC";
														} else if ($category == "Rebounds"){
															$sql = "SELECT player_id, sum(rebounds) as stat FROM stats GROUP BY player_id ORDER BY stat DESC";
														} else if ($category == "Assists"){
															$sql = "SELECT player_id, sum(assists) as stat FROM stats GROUP BY player_id ORDER BY stat DESC";
														} else if ($category == "Steals"){
															$sql = "SELECT player_id, sum(steals) as stat FROM stats GROUP BY player_id ORDER BY stat DESC";
														} else {
															$sql = "SELECT player_id, sum(blocks) as stat FROM stats GROUP BY player_id ORDER BY stat DESC";
														}
													} else 
													{
														if ($category == "Points"){
															$sql = "SELECT player_id, avg(points) as stat FROM stats GROUP BY player_id ORDER BY stat DESC";
														} else if ($category == "Rebounds"){
															$sql = "SELECT player_id, avg(rebounds) as stat FROM stats GROUP BY player_id ORDER BY stat DESC";
														} else if ($category == "Assists"){
															$sql = "SELECT player_id, avg(assists) as stat FROM stats GROUP BY player_id ORDER BY stat DESC";
														} else if ($category == "Steals"){
															$sql = "SELECT player_id, avg(steals) as stat FROM stats GROUP BY player_id ORDER BY stat DESC";
														} else {
															$sql = "SELECT player_id, avg(blocks) as stat FROM stats GROUP BY player_id ORDER BY stat DESC";
														}
													}
												}
												else {
													return false;
												}
												
												$result = mysqli_query($connection, $sql);
												$count = 1;
												
												while ($row = mysqli_fetch_assoc($result) and $count <= 10) 
												{
													
													echo "<tr class='" . ($counter == 1 ? "" : "success") . "'>";
													echo "<td scope='row'>", $count, "</td>";
													if ($scope == "Teams"){
														$slqplayer = "SELECT * FROM teams WHERE team_id =". $row['team_id'];
														$resultplayer = mysqli_query($connection, $slqplayer);
														$rowplayer = mysqli_fetch_assoc($resultplayer);
														echo "<td>", $rowplayer["team_name"],"</td>";
													}
													else {
														$slqplayer = "SELECT * FROM players WHERE player_id =". $row['player_id'];
														$resultplayer = mysqli_query($connection, $slqplayer);
														$rowplayer = mysqli_fetch_assoc($resultplayer);
														echo "<td>", $rowplayer["player_name"],"</td>";
													}
													echo "<td>", $row["stat"],"</td>";
													$count++;
												}
												mysqli_close($connection);
											}
										
										echo "</tbody>";
									echo "</table>";
								}
								else if ($_POST['scope'] == "Year"){
									$type = $_POST['type'];
									$scope = $_POST['scope'];
									$category = $_POST['category'];
									$sql = "SELECT YEAR(game_year) as year FROM game_profile";
									$result = mysqli_query($connection, $sql);
									$years = [];
									while ($row = mysqli_fetch_assoc($result)) 
									{
										if (in_array($row['year'], $years)){
											
										}
										else {
											array_push($years, $row['year']);
										}
									}
									foreach ($years as $value) {
										echo "<h1 align='center'>" . $value . "</h1><br>";
										echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
											echo "<thead>";
												echo "<tr>";
													echo "<th scope='col'>TOP #</th>";
														if (isset($_POST['scope'])){
															echo "<th scope='col'>Player Name</th>";
														}
														
														if (isset($_POST['category'])){
															echo "<th scope='col'>". $_POST['type']." ". $_POST['category'] ."</th>";
														}
												echo "</tr>";
											echo "</thead>";
											echo "<tbody>";
											if ($type == "Total")
											{
												if ($category == "Points"){
													$sqlyear = "SELECT player_id, sum(points) as stat FROM stats WHERE game_id in (SELECT game_id
													FROM game_profile WHERE game_year LIKE '" . $value . "%') GROUP BY player_id ORDER BY stat DESC";
												} else if ($category == "Rebounds"){
													$sqlyear = "SELECT player_id, sum(rebounds) as stat FROM stats WHERE game_id in (SELECT game_id
													FROM game_profile WHERE game_year LIKE '" . $value . "%') GROUP BY player_id ORDER BY stat DESC";
												} else if ($category == "Assists"){
													$sqlyear = "SELECT player_id, sum(assists) as stat FROM stats WHERE game_id in (SELECT game_id
													FROM game_profile WHERE game_year LIKE '" . $value . "%') GROUP BY player_id ORDER BY stat DESC";
												} else if ($category == "Steals"){
													$sqlyear = "SELECT player_id, sum(steals) as stat FROM stats WHERE game_id in (SELECT game_id
													FROM game_profile WHERE game_year LIKE '" . $value . "%') GROUP BY player_id ORDER BY stat DESC";
												} else {
													$sqlyear = "SELECT player_id, sum(blocks) as stat FROM stats WHERE game_id in (SELECT game_id
													FROM game_profile WHERE game_year LIKE '" . $value . "%') GROUP BY player_id ORDER BY stat DESC";
												}
											} else 
											{
												if ($category == "Points"){
													$sqlyear = "SELECT player_id, avg(points) as stat FROM stats WHERE game_id in (SELECT game_id
													FROM game_profile WHERE game_year LIKE '" . $value . "%') GROUP BY player_id ORDER BY stat DESC";
												} else if ($category == "Rebounds"){
													$sqlyear = "SELECT player_id, avg(rebounds) as stat FROM stats WHERE game_id in (SELECT game_id
													FROM game_profile WHERE game_year LIKE '" . $value . "%') GROUP BY player_id ORDER BY stat DESC";
												} else if ($category == "Assists"){
													$sqlyear = "SELECT player_id, avg(assists) as stat FROM stats WHERE game_id in (SELECT game_id
													FROM game_profile WHERE game_year LIKE '" . $value . "%') GROUP BY player_id ORDER BY stat DESC";
												} else if ($category == "Steals"){
													$sqlyear = "SELECT player_id, avg(steals) as stat FROM stats WHERE game_id in (SELECT game_id
													FROM game_profile WHERE game_year LIKE '" . $value . "%') GROUP BY player_id ORDER BY stat DESC";
												} else {
													$sqlyear = "SELECT player_id, avg(blocks) as stat FROM stats WHERE game_id in (SELECT game_id
													FROM game_profile WHERE game_year LIKE '" . $value . "%') GROUP BY player_id ORDER BY stat DESC";
												}
											}
											$result = mysqli_query($connection, $sqlyear);
											
											$count=1;
											while ($row = mysqli_fetch_assoc($result) and $count <= 10) 
											{
												echo "<tr class='" . ($counter == 1 ? "" : "success") . "'>";
												echo "<td scope='row'>", $count, "</td>";
												$slqplayer = "SELECT * FROM players WHERE player_id =". $row['player_id'];
												$resultplayer = mysqli_query($connection, $slqplayer);
												$rowplayer = mysqli_fetch_assoc($resultplayer);
												echo "<td>", $rowplayer["player_name"],"</td>";
												if ($type == "Total"){
													echo "<td>", $row["stat"],"</td>";
												} else {
													echo "<td>", round($row["stat"], 2), "</td>";
												}
												$count++;
											}
												echo "</tr>";
											echo "</tbody>";
											echo "</table>";
									}
								}
								?>
							</div>
						</div>
					</div>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; CIP1102-1D 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

			</div>
        <!-- End of Content Wrapper -->

		</div>
	</div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
	
	<!-- MODAL -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha512-U6K1YLIFUWcvuw5ucmMtT9HH4t0uz3M366qrF5y4vnyH6dgDzndlcGvH/Lz5k8NFh80SN95aJ5rqGZEdaQZ7ZQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

	<script>
	
	$(document).ready(function(){
		$('.editbtn').on('click', function() {
			$('#editmodal').modal('show');
		
				$tr = $(this).closest('tr');
				
				var data = $tr.children("td").map(function(){
					return $(this).text();
				}).get();
				
				console.log(data);
				$('#update_id').val(data[0]);
				$('#game_id').val(data[1]);
				$('#player_id').val(data[2]);
				$('#player_points').val(data[5]);
				$('#player_rebounds').val(data[6]);
				$('#player_assists').val(data[7]);
				$('#player_steals').val(data[8]);
				$('#player_blocks').val(data[9]);
		});
	});
	$(document).ready(function(){
		$('.addbtn').on('click', function() {
			$('#addmodal').modal('show');
		});
	});
	$(document).ready(function(){
		$('.filterbtn').on('click', function() {
			$('#filtermodal').modal('show');
		});
	});
	</script>
</body>
</html>

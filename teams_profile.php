<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PBA Teams Maintenance - Teams Profile</title>

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
                        <a class="collapse-item" href="">Statistical Maintenance</a>
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
                    <h1 class="h3 mb-2 text-gray-800">Teams Profile</h1><br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Teams</h6>
                        </div>
						<div>
						<br>
							<form class="form-horizontal" action="" method="post">
								<div class="form-group" style ="width:100%">
									<div class="col-md-5">
										<table>
										<tr>
										<td style="padding:0 10px;"><input style="width:300px;" id="textinput" name="filterKeyword" type="text" placeholder="Type team name keyword..." class="form-control input-md" value="<?php echo isset($_POST['filterKeyword']) ? $_POST['filterKeyword'] : (isset($_SESSION['filterKeyword']) ? $_SESSION['filterKeyword'] : ''); ?>"></td>
										<td><button id="search" name="search" class="btn btn-outline-dark">Search</button></td>
										<td><button style='background-color:#242424;' type='button' name="addbtn" class="btn btn-dark addbtn">Add Team</button></td>
										</tr>
										</table>
									</div>
								</div>
							</form>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th scope="col">Team ID</th>
											<th scope="col">Team Name</th>
											<th scope="col">Team Moniker</th>
											<th scope="col">Status</th>
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
											
											if (isset($_POST['filterKeyword']) )
											{
												$sql = "SELECT * FROM teams WHERE team_name LIKE '%" . $_POST['filterKeyword'] . "%'";
												
												$result = mysqli_query($connection, $sql);
												
												if (!$result || mysqli_num_rows($result) == 0)
												{	
													echo "<tr>";
													echo "<td colspan='5'><center><h2>Record not found!...</center></h2></td>";
													echo "</tr>";
												} 
												else 
												{
													$counter = 0;
													while ($row = mysqli_fetch_assoc($result)) 
													{
														echo "<tr class='" . ($counter == 1 ? "" : "success") . "'>";
														echo "<td scope='row'>", $row["team_id"], "</ts>";
														echo "<td>", $row["team_name"], "</td>";
														echo "<td>", $row["team_moniker"], "</td>";
														echo "<td>", $row["team_status"] ? "Active" : "Inactive", "</td>";
														echo "<td><center><button style='background-color:#242424;' type='button' class='btn btn-dark editbtn'>Edit </button></center></td>";
														echo "</tr>";
														$counter = $counter == 0 ? 1 : 0;
													}	
												}
												mysqli_close($connection);
											}
											else{
												$sql = "SELECT * FROM teams";
												
												$result = mysqli_query($connection, $sql);
												
												if (!$result || mysqli_num_rows($result) == 0)
												{	
													echo "<tr>";
													echo "<td colspan='5'><center><h2>Record not found!...</center></h2></td>";
													echo "</tr>";
												} 
												else 
												{
													$counter = 0;
													while ($row = mysqli_fetch_assoc($result)) 
													{
														echo "<tr class='" . ($counter == 1 ? "" : "success") . "'>";
														echo "<td scope='row'>", $row["team_id"], "</ts>";
														echo "<td>", $row["team_name"], "</td>";
														echo "<td>", $row["team_moniker"], "</td>";
														echo "<td>", $row["team_status"] ? "Active" : "Inactive", "</td>";
														echo "<td><center><button style='background-color:#242424;' type='button' class='btn btn-dark editbtn'>Edit </button></center></td>";
														echo "</tr>";
														$counter = $counter == 0 ? 1 : 0;
													}	
												}
												mysqli_close($connection);
											}
										?>

										<!-- Edit Modal -->
										<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">EDIT TEAM</h5>
													</div>
											  
													<form action="update_teams.php" method="POST">
											  
													<div class="modal-body">
														<input type="hidden" name="update_id" id="update_id">
														<div class="form-group">
															<label>Team Name</label>
															<input type="text" name="team_name" id="team_name" class="form-control" placeholder="Enter Team Name">
														</div>
												
														<div class="form-group">
															<label>Team Moniker</label>
															<input type="text" name="team_moniker" id="team_moniker" class="form-control" placeholder="Enter Team Moniker">
														</div>
														
														<div class="form-group">
															<label>Team Status (1-Active  0-Inactive)</label>
															<input type="text" name="team_status" id="team_status"class="form-control" placeholder="Enter Team Status">
														</div>
													</div>
													<div class="modal-footer">
														<button style='background-color:#242424;' type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
														<button type="submit" name="updatedata" class="btn btn-outline-dark">Update Team</button>
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
									<h5 class="modal-title" id="exampleModalLabel">ADD TEAM</h5>
								</div>
						  
								<form action="add_team.php" method="POST">
						  
								<div class="modal-body">
									<input type="hidden" name="add_id" id="add_id">
									<div class="form-group">
										<label>Team Name</label>
										<input type="text" name="teamName" id="teamName" class="form-control" placeholder="Enter Team Name" required >
									</div>
							
									<div class="form-group">
										<label>Team Moniker</label>
										<input type="text" name="teamMoniker" id="teamMoniker" class="form-control" placeholder="Enter Team Moniker" required>
									</div>
								</div>
								<div class="modal-footer">
									<button style='background-color:#242424;' type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" name="adddata" class="btn btn-outline-dark">Add Team</button>
								</div>
								</form>
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
				$('#team_name').val(data[1]);
				$('#team_moniker').val(data[2]);
				if(data[3]=="Active"){
					$('#team_status').val(1);
				}
				else{
					$('#team_status').val(0);
				}
				
		});
	});
	$(document).ready(function(){
		$('.addbtn').on('click', function() {
			$('#addmodal').modal('show');
		});
	});
	</script>
</body>
</html>

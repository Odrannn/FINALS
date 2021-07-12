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
	
	<!--ANAB
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	-->

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PBA Teams Maintenance</div>
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
                        <a class="collapse-item" href="">Players Profile</a>
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
                    <h1 class="h3 mb-2 text-gray-800">Team Profile</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Teams</h6>
                        </div>
						<div class="container search-table"> 
							<div class="search-box">
								<div class="row">
									<div class="col-md-12">
										<input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Search all fields..." name="search">
										<script>
											$(document).ready(function () {
												$("#myInput").on("keyup", function () {
													var value = $(this).val().toLowerCase();
													$("#myTable tr").filter(function () {
														$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
													});
												});
											});
										</script>
									</div> 
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Team ID</th>
											<th>Team Name</th>
											<th>Team Moniker</th>
											<th>Team Status</th>
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
													echo "<th scope='row'>", $row["team_id"], "</th>";
													echo "<td>", $row["team_name"], "</td>";
													echo "<td>", $row["team_moniker"], "</td>";
													echo "<td>", $row["team_status"] ? "Active" : "Inactive", "</td></tr>";
													$counter = $counter == 0 ? 1 : 0;
												}	
											}
											mysqli_close($connection);
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<form class="form-horizontal" action="" method="post">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Team Registration</h6>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Team Name</th>
												<th>Team Moniker</th>
												<th>Operation</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<div class="form-group">
														<div class="col-md-5">
															<input id="textinput" name="teamName" type="text" placeholder="Team Name" class="form-control input-md" required="" value="<?php if (isset($_POST['teamName'])) {echo $_POST['teamName'];} ?>">
														</div>
													</div>
												</td>
												<td>
													<div class="form-group">
														<div class="col-md-5">
															<input id="textinput" name="teamMoniker" type="text" placeholder="Team Moniker" class="form-control input-md" required="" value="<?php if (isset($_POST['teamMoniker'])) {echo $_POST['teamMoniker'];} ?>">
														</div>
													</div>
												</td>
												<td>
													<div class="form-group">
														<div class="col-md-6">
															<button id="add" name="add" class="btn btn-primary">Add Team</button>
														</div>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<?php
										if (isset($_POST['add']))
										{
											if (isset($_POST['teamName']) and isset($_POST['teamMoniker']))
											{
												$hostName = "localhost";
												$userName = "root";
												$password = "";
												$dbName = "pba";

												$connection = mysqli_connect($hostName, $userName, $password, $dbName);
										
												if (!$connection) 
												{
													die("Connection failed: " . mysqli_connect_error());
												}
											
												$sql = "SELECT * FROM teams WHERE team_name = '" . $_POST['teamName'] . "'";
												$result = mysqli_query($connection, $sql);
											
												if(!$result || mysqli_num_rows($result) == 0)
												{	
													$sql = "INSERT INTO teams (team_name, team_moniker, team_status) VALUES ('" . $_POST['teamName'] . "', '" . $_POST['teamMoniker'] . "', 1)";
											
													if (mysqli_query($connection, $sql)) 
													{
														echo "<div class='alert alert-success' role='alert'><strong>Sucess:</strong> New team successfully created!</div>";
													}
													else
													{
														echo "<h1>Error: " . $sql . "<br>" . mysqli_error($connection) . "</h1>";
													}
												} 
												else 
												{
													echo "<div class='alert alert-danger' role='alert'><strong>Error:</strong> Team Name already existing!...</div>";	
												}
											}
										}
									?>
								</div>
							</div>
						</div>
					</form>
					<!-- /.container-fluid -->	
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Edit Team</h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Team Name</th>
											<th>Team Moniker</th>
											<th>Operation</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="form-group">
													<div class="col-md-5">
														<input id="textinput" name="teamName" type="text" placeholder="Team Name" class="form-control input-md" required="" value="<?php if (isset($_POST['teamName'])) {echo $_POST['teamName'];} ?>">
													</div>
												</div>
											</td>
											<td>
												<div class="form-group">
													<div class="col-md-5">
														<input id="textinput" name="teamMoniker" type="text" placeholder="Team Moniker" class="form-control input-md" required="" value="<?php if (isset($_POST['teamMoniker'])) {echo $_POST['teamMoniker'];} ?>">
													</div>
												</div>
											</td>
											<td>
												<div class="form-group">
													<div class="col-md-6">
														<button id="add" name="add" class="btn btn-primary">EDIT</button>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
									
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
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

</body>

</html>

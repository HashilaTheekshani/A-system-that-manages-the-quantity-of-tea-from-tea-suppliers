<?php require_once "controllerUserData.php"; 


// Check if user is logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
    header('Location: login-user.php'); // Redirect to login page if not logged in
    exit();
}

// Retrieve user data from session variables
$email = $_SESSION['email'];
$password = $_SESSION['password'];

// Database connection setup
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "teafact";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $fetch_info['name'] ?> | Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="userdashboard.css">


    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    nav{
        padding-left: 50px!important;
        padding-right: 100px!important;
        background: #6665ee;
        font-family: 'Poppins', sans-serif;
    } 
    nav a.navbar-brand{
        color: #fff;
        font-size: 30px!important;
        font-weight: 500;
    }
    button a{
        color: #6665ee;
        font-weight: 500;
    }
    button a:hover{
        text-decoration: none;
    }
    h1{
        position: absolute;
        top: 15%;
        left: 50%;
        width: 100%;
        text-align: center;
        transform: translate(-50%, -50%);
        font-size: 20px;
        font-weight: 600;
    }
    </style>
</head>
<body>
    <


    <section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bx-user'></i>
			<span class="text">User Dashboard</span>
		</a>

        <h1>Welcome <?php echo $fetch_info['name'] ?></h1>

		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
					
				</a>
			</li>

			<li>
				<a href="message/hasila.php">
					<i class='bx bxs-offer'></i>
					<span class="text">Message</span>
				</a>
			</li>


			<li>
				<a href="#">
					<i class='bx bxs-offer'></i>
					<span class="text">News</span>
				</a>
			</li>

            <li>
				<a href="dashboard.php">
					<i class='bx bxs-offer'></i>
					<span class="text">Request</span>
				</a>
			</li>


			<li>
				<a href="New folder/index.html">
					<i class='bx bxs-offer'></i>
					<span class="text">Weather</span>
				</a>
			</li>

			<li>
				<a href="#">
					<i class='bx bx-cog'></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bx-comment-error'></i>
					<span class="text">About US</span>
				</a>
			</li>
			
			


		</ul>
		<ul class="side-menu">
			
			<li>
				<a href="logout-user.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>

        <a class="navbar-brand" href="#">Uruwala Tea Factory</a>

			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">0</span>
			</a>
			<a href="profile.php" class="profile">
			<i class='bx bxs-user'></i>
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1></h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-car-mechanic'></i>
					<span class="text">
						
						<a href="useraccessories.php">Tea Leaves Price</a></li>
					</span>
				</li>
				<li>
					<i class='bx bxs-car-garage' ></i>
					<span class="text">
						
						<a href="Supplier_msg.php">Daily tea quantity</a>
					</span>
				</li>
				<li>
					<i class='bx bx-run'></i>
					<span class="text">
						
						<a href="#">Order</a>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Vehicle Sales</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Brand</th>
								<th>Version</th>
								<th>Year</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<img src="">
									<p></p>
								</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>
									<img src="">
									<p></p>
								</td>
								<td></td>
								<td></td>
							</tr>
							
						</tbody>
					</table>
				</div>

				<!--<div class="table-data">
					<div class="order">
						<div class="head">
							<h3>Vehicles</h3>
							
						</div>
					</div>-->
			
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	<script src="userdashboard.js"></script>




    
    
    
</body>
</html>
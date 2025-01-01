<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login-user.php');
    exit();
}
$email = $_SESSION['email'];

// Fetch user data from the database
require "connection.php";
$query = "SELECT * FROM usertable WHERE email='$email'";
$result = mysqli_query($con, $query);
$userData = mysqli_fetch_assoc($result);

// Display user profile information
$name = $userData['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="profile.css">

    

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <br>
                <h2 class="text-center">User Profile</h2>
               <br><br>
                <p class="text-center">Welcome, <?php echo $name; ?>!</p>
                <p class="text-center">Email: <?php echo $email; ?></p>
                <div class="form-group">
                    <a href="logout-user.php" class="btn btn-danger btn-block">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <button onclick="goBack()" class="btn btn-primary back-button">Back</button>

<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>

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


// Fetch messages for this supplier from the database
$fetch_messages_query = "SELECT * FROM messages WHERE user_id = '$user_id'";
$messages_result = mysqli_query($conn, $fetch_messages_query);

// Handle response to messages
if (isset($_POST['response'])) {
    $message_id = $_POST['message_id'];
    $response = $_POST['response_message'];

    // Update the message in the database with the supplier's response
    $update_query = "UPDATE messages SET response = '$response' WHERE id = '$message_id'";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Response sent successfully');</script>";
    } else {
        echo "<script>alert('Failed to send response');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include necessary meta tags, CSS files, and other dependencies -->
</head>
<body>

<!-- Supplier Messages Section -->
<h2>Supplier Messages</h2>
<ul>
    <?php
    while ($row = mysqli_fetch_assoc($messages_result)) {
        echo "<li>{$row['message']}</li>";
        // Display response form if the message has not been responded to yet
        if (empty($row['response'])) {
            echo "<form method='post' action=''>
                    <input type='hidden' name='message_id' value={$row['id']}'>
                    <textarea name='response_message' placeholder='Enter your response...' required></textarea><br>
                    <input type='submit' name='response' value='Send Response'>
                  </form>";
        } else {
            echo "<p>Response: {$row['response']}</p>";
        }
    }
    ?>
</ul>

</body>
</html>

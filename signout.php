<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "gaming_library");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Delete user entry from the signup table
$sql = "DELETE FROM signup";
mysqli_query($conn, $sql);

// Redirect to the signup page
header("Location: signup.php");
exit;
?>

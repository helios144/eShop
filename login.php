<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$servername = "localhost";
$susername = "root";
$spassword = "";
$dbname = "prekes";
$conn = new mysqli($servername, $susername, $spassword, $dbname);
// To protect MySQL injection for Security purpose
// Selecting Database
// SQL query to fetch information of registerd users and finds user match.
$sql="select ID,Privileges from users where Password='$password' AND User_name='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$_SESSION['login_user']=$username; // Initializing Session
$_SESSION['Privileges']=$row['Privileges'];
$_SESSION['user_id']=$row['ID'];
//echo $_SESSION['Privileges'];
header("location: indexmain.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
$conn->close(); // Closing Connection
}
}
?>
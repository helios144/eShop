<?php // Starting Session
session_start();
$error=''; // Variable To Store Error Message
if (isset($_POST['submitreg'])) {
		// Define $username and $password
	$username=$_POST['register-username'];
	$password=$_POST['register-password'];
	$password2=$_POST['register-password2'];
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$servername = "localhost";
	$susername = "root";
	$spassword = "";
	$dbname = "prekes";
	$conn = new mysqli($servername, $susername, $spassword, $dbname);
	// To protect MySQL injection for Security purpose
	// Selecting Database
	// SQL query to fetch information of registerd users and finds user match.
	if (empty($_POST['register-username']) || empty($_POST['register-password'])|| empty($_POST['register-password2'])) {
		$error = "Some fields were left empty";
	}
		else{
		$sql="select User_name from users where User_name='".$username."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$error = "Username is taken";
		} 
	else {		
		if($password==$password2){
				$sql = "INSERT INTO users (User_name,Password,Privileges) VALUES ('".$username."','".$password."',0)";	
				$conn->query($sql);	
				$_SESSION['succes']="Registration succesfull now login!";
				$_SESSION['reguser']=$username;
				$_SESSION['regpass']=$password;
				header("location: page-login.php"); // Redirecting To Other Page	
			}
			else{
				$error = "Password did not match";	
			}
	}
	}
	$conn->close(); // Closing Connection
}
function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
?>

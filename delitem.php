<!DOCTYPE html>
<html>
<head>
	<title>Status</title>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prekes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 	
    if (isset($_POST['del'])){
    	$dell=$_POST['del'];
		$sql = "DELETE FROM prekes WHERE ID=".$_POST['del'];
		if ($conn->query($sql) === TRUE) {
		    echo "Preke su ID " . $_POST['del'] . " deleted successfully";
		    $sql = "DELETE FROM kategorijos WHERE preke_id=".$_POST['del'];
		    if ($conn->query($sql) === TRUE) {
		    	$sql="DELETE FROM atributai_kategorijai WHERE preke_id=".$_POST['del'];
		    	$conn->query($sql);
		   	 echo "Preke su ID " . $_POST['del'] . " deleted successfully";
			}
			else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
		} 
		else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
    }

$conn->close();
 ?>
 </body>
 <script>setTimeout(function(){window.location = "page-products.php";},3000)</script>
</html>
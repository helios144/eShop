<!DOCTYPE html>
<html>
<head>
	<title>Preke</title>
</head>
<body>
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
if(isset($_POST['newcat'])){
	/*$sql="SELECT kategorija FROM kategoriju_sarasa WHERE ID=".$_POST['category'];*/
	$sql = "INSERT INTO kategoriju_sarasas (kategorija) VALUES ('".$_POST['category']."')";
	if ($conn->query($sql) === TRUE) {
			    echo "New category created successfully<br>";
			
	}
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

//-------------------redaguoti
if(isset($_POST['catedit'])){
	$sql="SELECT kategorija FROM kategoriju_sarasas WHERE ID='".$_POST['catedit']."'";
	$result=$conn->query($sql);
	$oldcat= $result->fetch_assoc();
	$sql = "UPDATE kategoriju_sarasas SET  kategorija='".$_POST['newname']."' WHERE ID='".$_POST['catedit']."'";
		if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		    $sql = "UPDATE kategorijos SET  Kategorija='".$_POST['newname']."' WHERE Kategorija='".$oldcat['kategorija']."'";
			if ($conn->query($sql) === TRUE) {
			}
			else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		} 
		else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
}
if (isset($_POST['delcat'])){
		$sql='SELECT kategorija FROM kategoriju_sarasas WHERE ID="'.$_POST['delcat'].'"';
		$result=$conn->query($sql);
    	$oldcatdel=$result->fetch_assoc();
		$sql = "DELETE FROM kategorijos WHERE Kategorija='".$oldcatdel['kategorija']."'";
		if ($conn->query($sql) === TRUE) {
		    echo "Preke su ID " . $_POST['delcat'].$oldcatdel['kategorija']." from Kategorijos deleted successfully<br>";
		    $sql = 'DELETE FROM kategoriju_sarasas WHERE kategorija="'.$oldcatdel['kategorija'].'"';
		    if ($conn->query($sql) === TRUE) {
		    	 echo "Preke su ID " . $_POST['delcat'].$oldcatdel['kategorija']." from Kategoriju_sarasas deleted successfully";
			}
			else {
		    	echo "Error: " . $sql . "<br>" . $conn->error;
			}
		} 
		else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
    }
?>
</body>
<script>setTimeout(function(){window.location = "category-edit.php";},3000)</script>
</html>
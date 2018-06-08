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
if(isset($_POST['newatt'])){
	/*$sql="SELECT kategorija FROM kategoriju_sarasa WHERE ID=".$_POST['category'];*/
	$sql = "INSERT INTO atributu_sarasas (atributas,kategorijos_ID) VALUES ('".$_POST['newattname']."','".$_POST['cat']."')";
	if ($conn->query($sql) === TRUE) {
			    echo "New attribute created successfully<br>";
			
	}
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

//-------------------redaguoti
if(isset($_POST['attedit'])){
	$sql="SELECT ID FROM atributu_sarasas WHERE ID='".$_POST['attedit']."'";
	$result=$conn->query($sql);
	$oldcat= $result->fetch_assoc();
	$sql = "UPDATE atributu_sarasas SET  atributas='".$_POST['newname']."',kategorijos_ID='".$_POST['cat']."'  WHERE ID='".$_POST['attedit']."'";
		if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		    $sql = "UPDATE atributai_kategorijai SET  kategorijos_id='".$_POST['cat']."' WHERE atributas_id='".$oldcat['attedit']."'";
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
if (isset($_POST['delatt'])){
		$sql='SELECT ID FROM atributu_sarasas WHERE ID="'.$_POST['delatt'].'"';
		$result=$conn->query($sql);
    	$oldcatdel=$result->fetch_assoc();
		$sql = "DELETE FROM atributu_sarasas WHERE ID='".$oldcatdel['ID']."'";
		if ($conn->query($sql) === TRUE) {
		    echo "Preke su ID " . $_POST['delatt'].$oldcatdel['ID']." from Kategorijos deleted successfully<br>";
		    $sql = "UPDATE atributai_kategorijai SET  atributas_id=10 WHERE kategorijos_id='".$oldcat['kategorijos_ID']."'";
		    if ($conn->query($sql) === TRUE) {
		    	 echo "Preke su ID " . $_POST['delatt'].$oldcatdel['ID']." from Kategoriju_sarasas deleted successfully";
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
<script>setTimeout(function(){window.location = "attribute-edit.php";},3000)</script>
</html>
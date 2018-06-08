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
		if (isset($_POST['add'])) {
			$target_dir = "imgg/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    if($check !== false) {
			        echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}
			// Check if file already exists
			if (file_exists($target_file)) {
			    echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}			
			if($uploadOk==1){
			$sql = "INSERT INTO prekes (name, description, kaina, nuotrauka) VALUES ('".$_POST['name']."','".$_POST['description']."','".$_POST['kaina']."','".$_POST['nuotrauka']."')";
			//
			if ($conn->query($sql) === TRUE) {
			    echo "New product record created successfully<br>";
			    $sqll="SELECT ID FROM prekes ORDER BY ID DESC LIMIT 1";
				$resultt=$conn->query($sqll);
				$row = $resultt->fetch_assoc();
				//
				$sqll = "INSERT INTO kategorijos (Kategorija,preke_id) VALUES ('".$_POST['cat']."','".$row['ID']."')";
				if ($conn->query($sqll) === TRUE) {
			    	echo "New category record created successfully<br>";
			    	$sqllll="SELECT kategoriju_sarasas.ID FROM kategoriju_sarasas INNER JOIN kategorijos ON kategorijos.Kategorija=kategoriju_sarasas.kategorija WHERE kategoriju_sarasas.kategorija='".$_POST['cat']."' LIMIT 1";
			    	$resulltt=$conn->query($sqllll);
			    	$roow = $resulltt->fetch_assoc();
			    	$sqlll="INSERT INTO atributai_kategorijai (kategorijos_id,preke_id,atributas_id) VALUES (,'".$roow['ID']."','".$row['ID']."','10')";
			    	$conn->query($sqlll);
				} 
								else {
			    	echo "Error: " . $sql . "<br>" . $conn->error;
				}
			} 
			else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
    } 
$conn->close();
 ?>
 </body>
 <script>setTimeout(function(){window.location = "product-details-admin-new.php";},3000)</script>
</html>
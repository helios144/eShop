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
    if (isset($_POST['change'])){
    if(!empty($_FILES['fileToUpload']['name'])){
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
 // Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
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
}
        
		$sql = "UPDATE prekes SET  name='".$_POST['name']."',description='".$_POST['description']."',kaina='".$_POST['kaina']."',nuotrauka='".$_POST['nuotrauka']."' WHERE ID='".$_POST['change']."'";
		if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		    $sqll = "UPDATE kategorijos SET Kategorija='".$_POST['cat']."' WHERE preke_id='".$_POST['change']."'";
				if ($conn->query($sqll) === TRUE) {
                    $sql="SELECT kategoriju_sarasas.ID FROM kategoriju_sarasas INNER JOIN  kategorijos ON kategorijos.Kategorija=kategoriju_sarasas.kategorija  WHERE kategorijos.preke_id='".$_POST['change']."'";
                    $resulttt=$conn->query($sql);
                    $roow=$resulttt->fetch_assoc();
                    $sqll = "UPDATE atributai_kategorijai SET kategorijos_id='".$roow['ID']."', atributas_id='".$_POST['att']."' WHERE preke_id='".$_POST['change']."'";
                    $conn->query($sqll);
			    	echo "UPDATE: Category id=".$roow['ID']." atributas_id=".$_POST['att']." preke_ID=".$_POST['change']."<br>";
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
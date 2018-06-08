<?php
include("cart.php");
$listrez='visos';
$listrez2='visos';
$listrez3='visos';
if(isset($_GET['listas']))
{
$listrez=$_GET['listas'];
$listrez2=$_GET['kaina'];

}
if(isset($_GET['atributas'])){
	$listrez3=$_GET['atributas'];
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    	<link rel="icon" type="image/x-icon" href="favicon.ico" />
    	<link rel="icon" type="image/x-icon" href="favicon.ico" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="This is a simple  online Poker shop for where you can buy poker related items like playing card, chips and poker tables">
        <title><?php if($listrez!='visos'){
        	echo $listrez;
        }
        else{
        	echo 'All products';
        }
        ?></title>
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/icomoon-social.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="css/leaflet.css" />
		<!--[if lte IE 8]>
		    <link rel="stylesheet" href="css/leaflet.ie.css" />
		<![endif]-->
		<link rel="stylesheet" href="css/main.css">

        <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        

               <!-- Navigation & Logo-->
        <div class="mainmenu-wrapper">
	        <div class="container">
	        	<div class="menuextras">
					<div class="extras">
						<ul>
							<li class="shopping-cart-items"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> <a href="page-shopping-cart.php"><b><?php if(isset($_SESSION['all_in_cart'])){
								echo $_SESSION['all_in_cart'];
							}
							else{
								echo '0';
							}
							?>  items</b></a></li>
							
			        		<li><?php 
			        		
			        		if(isset($_SESSION['login_user'])){
							echo $_SESSION['login_user'];
							echo '<a href="page-logoff.php">&nbspLogoff</a>';
							}
							else{
							echo '<a href="page-login.php">Login</a>';	
							}
			        		?></li>
			        	</ul>
					</div>
		        </div>
		        <!--Navbar-->
		        <nav id="mainmenu" class="mainmenu">
					<ul>
						<li class="logo-wrapper"><a href="index.php"><img src="img/logo.png" alt="Multipurpose Twitter Bootstrap Template"></a></li>
						<li class="active">
							<a href="index.php">Home</a>
						</li>
						<li>
							<a href="page-products.php">Products</a>
						</li>

						<?php include("admin_tools.php");?>
						<!--paieska-->
						<li class="pull-right">          
                   			<form  method="get" action="page-shopping-search-results.php">
                      			<input type="text" name="searchfield" placeholder="Search">
                      			<button type="submit" class=" btn-circle"><i class="glyphicon glyphicon-search"></i></button>
                   			</form>
            			</li>
            			<!--paieska end-->
					</ul>
				</nav>
				<!--Navbar end-->
			</div>
		</div>
        <!-- Page Title -->
		<div class="section section-breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>Products</h1>
						<?php
							if($listrez!='visos'){
								echo '<div class="col-md-12"><h3 style="color:white">Category: '.$listrez.'</h3></div>';
							}
						?>
					</div>
				</div>
			</div>
		</div>
    <div class="container" >
		<div class="row">
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
//kategoriju saras----------------------

echo '<div class="col-md-12 col-sm-6 col-xs-6 col-lg-6">
		<form  action="page-products.php" method="get">
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
					<h3 >Category</h3>
					<select onchange="this.form.submit()" name="listas" id="selectascat">
						<option value="visos">All</option>';
						$sqll = "SELECT kategorija,ID FROM kategoriju_sarasas";
						$resultt = $conn->query($sqll);
						if ($resultt->num_rows > 0) {
			    			// output data of each row
			   				 while($row = $resultt->fetch_assoc()) {
			    
			   			 echo '<option value="'.$row['kategorija'].'">'.$row['kategorija'].'</option>';
			   				}
						}
				echo '</select>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
					<h3 >Price</h3>
					<select onchange="this.form.submit()" name="kaina" id="selectaskaina">
						<option value="visos">All</option>
						<option value="0">€0-50</option>
						<option value="51">€51-100</option>
						<option value="101">€101-150</option>
						<option value="151">€151-200</option>
						<option value="201">€201-250</option>
						<option value="251">€251-300</option>
						<option value="301">€300+</option>
					</select>
				</div>';
//attributas
if($listrez!='visos'){
		echo '<div class="col-md-4 col-sm-4 col-xs-12 col-lg-4">
				<h3 >Attribute</h3>
				<select onchange="this.form.submit()" name="atributas" id="selectasattribute">
					<option value="visos">All</option>';
					$sqll = "SELECT atributas,atributu_sarasas.ID FROM atributu_sarasas INNER JOIN kategoriju_sarasas ON atributu_sarasas.kategorijos_ID=kategoriju_sarasas.ID  WHERE kategorija='".$listrez."'";
					$resultt = $conn->query($sqll);
					if ($resultt->num_rows > 0) {
					    while($row = $resultt->fetch_assoc()) {
					    	echo '<option value="'.$row['ID'].'">'.$row['atributas'].'</option>';
					   }
					}
			echo '</select>
				</div>';
//atributas end
echo '<script>document.getElementById("selectasattribute").value = "'.$listrez3.'";</script>';
}
echo'
	</div>		
	</div>
	</div>
	</form>
	</div>
	';
echo '<script>document.getElementById("selectascat").value = "'.$listrez.'";</script>';
echo '<script>document.getElementById("selectaskaina").value = "'.$listrez2.'";</script>';
	echo '<div class="eshop-section section">
		    	<div class="container">
					<div class="row">';

if($listrez!='visos'){
	if($listrez2=='visos'){
		if($listrez3=='visos'){
			$sql = "SELECT name, description, kaina,nuotrauka,prekes.ID,kategorijos.kategorija FROM prekes INNER JOIN kategorijos ON prekes.ID=kategorijos.preke_id WHERE kategorijos.kategorija='".$listrez."'  order by Kategorija";
		}
		else{
			$sql = "SELECT name, description, kaina,nuotrauka,prekes.ID,kategorijos.kategorija FROM prekes INNER JOIN kategorijos ON prekes.ID=kategorijos.preke_id INNER JOIN atributai_kategorijai ON prekes.ID=atributai_kategorijai.	preke_id WHERE kategorijos.kategorija='".$listrez."' AND atributas_id='".$listrez3."' order by Kategorija";
		}
	}
	else{
		if($listrez2!='301'){
			if($listrez3=='visos'){
				$sql = "SELECT name, description, kaina,nuotrauka,prekes.ID,kategorijos.kategorija FROM prekes INNER JOIN kategorijos ON prekes.ID=kategorijos.preke_id WHERE kategorijos.kategorija='".$listrez."' AND prekes.kaina >= ".$listrez2." AND prekes.kaina <=".($listrez2+50)." order by Kategorija";
			}
			else{
				$sql = "SELECT name, description, kaina,nuotrauka,prekes.ID,kategorijos.kategorija FROM prekes INNER JOIN kategorijos ON prekes.ID=kategorijos.preke_id INNER JOIN atributai_kategorijai ON prekes.ID=atributai_kategorijai.	preke_id WHERE kategorijos.kategorija='".$listrez."' AND prekes.kaina >= ".$listrez2." AND prekes.kaina <=".($listrez2+50)." AND atributas_id='".$listrez3."' order by Kategorija";
			}
		}
		else{
			$sql = "SELECT name, description, kaina,nuotrauka,prekes.ID,kategorijos.kategorija FROM prekes INNER JOIN kategorijos ON prekes.ID=kategorijos.preke_id INNER JOIN atributai_kategorijai ON prekes.ID=atributai_kategorijai.	preke_id WHERE kategorijos.kategorija='".$listrez."' AND atributas_id='".$listrez3."' AND prekes.kaina >= ".$listrez2." order by Kategorija";
		}
	}
}
else{
	if($listrez2=='visos'){
		$sql = "SELECT name, description, kaina,nuotrauka,prekes.ID,kategorijos.kategorija FROM prekes INNER JOIN kategorijos ON prekes.ID=kategorijos.preke_id order by Kategorija";
	}
	else{
		if($listrez2!='301'){
			$sql = "SELECT name, description, kaina,nuotrauka,prekes.ID,kategorijos.kategorija FROM prekes INNER JOIN kategorijos ON prekes.ID=kategorijos.preke_id WHERE kaina >=".$listrez2." AND kaina <=".($listrez2+50)." ORDER BY Kategorija";
		}
		else{
			$sql = "SELECT name, description, kaina,nuotrauka,prekes.ID,kategorijos.kategorija FROM prekes INNER JOIN kategorijos ON prekes.ID=kategorijos.preke_id WHERE kaina >=".$listrez2." AND kaina >=".$listrez2." ORDER BY Kategorija";
		}
	}
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        preke($row["name"],$row["kaina"],$row['nuotrauka'],$row['ID'],$row['kategorija']);
    }
} else {
    echo '<div class="col-md-4 col-sm-6 col-xs-12 col-lg-2">
						<h1>0 rezults</h1>
					</div>';
}
//------------------------------------

function preke($pavadinimas, $kaina, $paveiksliukas,$id,$cat){
	echo '<div class="col-md-4 col-sm-6 col-xs-12 col-lg-4">
						<div class="shop-item">
							<div class="shop-item-image text-center">
								<a href="page-product-details.php?ID='.$id.'&category='.$cat.'"><img src="'.$paveiksliukas.'" alt="Item Name"></a>
							</div>
							<div class="title">
								<h3><a href="page-product-details.php?ID='.$id.'&category='.$cat.'">'.$pavadinimas.'</a></h3>
							</div>
							<div class="price">
								'.$kaina.'&euro;
							</div>
							<div class="actions">';
							if(isset($_SESSION['Privileges'])){
							if($_SESSION['Privileges']==1){
								echo 'ID:'.$id;
								echo '<form  action="delitem.php" method="post"><a href="product-details-admin-edit.php?ID='.$id.'" class="btn btn-small text-center">Edit<i class="glyphicon glyphicon-pencil"></i></a>or<button class="btn btn-small" type="submit" name="del" value="'.$id.'">Delete<i class="glyphicon glyphicon-trash"></i></button></form><br>';
								echo '<form method="post" action=""><button type ="submit" name="add_from_list" value="'.$id.'" class="btn btn-small"><i class="glyphicon glyphicon-shopping-cart"></i> Add to Cart</button> <span>or <a href="page-product-details.php?ID='.$id.'&category='.$cat.'">Read more</a></span></form>';
    						}
							else{
								echo '<form method="post" action=""><button type ="submit" name="add_from_list" value="'.$id.'" class="btn btn-small"><i class="glyphicon glyphicon-shopping-cart"></i> Add to Cart</button> <span>or <a href="page-product-details.php?ID='.$id.'&category='.$cat.'">Read more</a></span></form>';
							}
						}
						else{
							echo '<a href="page-product-details.php?ID='.$id.'">Read more</a>';
						}
							echo '
							</div>
						</div>
					</div>';
}
					$conn->close();
?>
			</div>
		</div>
	</div>
	    <!-- Footer -->
	    <div class="footer">
	    	<div class="container">
		    	<div class="row">
		    		
		    		<div class="col-footer col-md-3 col-xs-6">
		    			<h3>Navigate</h3>
		    			<ul class="no-list-style footer-navigate-section">
		    				<li><a href="page-blog-posts.html">Blog</a></li>
		    				<li><a href="page-portfolio-3-columns-2.html">Portfolio</a></li>
		    				<li><a href="page-products-3-columns.html">eShop</a></li>
		    				<li><a href="page-services-3-columns.html">Services</a></li>
		    				<li><a href="page-pricing.html">Pricing</a></li>
		    				<li><a href="page-faq.html">FAQ</a></li>
		    			</ul>
		    		</div>
		    		
		    		<div class="col-footer col-md-4 col-xs-6">
		    			<h3>Contacts</h3>
		    			<p class="contact-us-details">
	        				<b>Address:</b> 123 Fake Street, LN1 2ST, London, United Kingdom<br/>
	        				<b>Phone:</b> +44 123 654321<br/>
	        				<b>Fax:</b> +44 123 654321<br/>
	        				<b>Email:</b> <a href="mailto:getintoutch@yourcompanydomain.com">getintoutch@yourcompanydomain.com</a>
	        			</p>
		    		</div>
		    		
		    	</div>
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="footer-copyright">&copy; 2013 ePokerShop. All rights reserved.</div>
		    		</div>
		    	</div>
		    </div>
	    </div>

        <!-- Javascripts -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
        <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
        <script src="js/jquery.fitvids.js"></script>
        <script src="js/jquery.sequence-min.js"></script>
        <script src="js/jquery.bxslider.js"></script>
        <script src="js/main-menu.js"></script>
        <script src="js/template.js"></script>

    </body>
</html>
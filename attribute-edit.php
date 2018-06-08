<?php
session_start();
if(!isset($_SESSION['Privileges']) ||$_SESSION['Privileges']==0)
{
header("location: denied.php");
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    	<link rel="icon" type="image/x-icon" href="favicon.ico" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="This is a simple  online Poker shop for where you can buy poker related items like playing card, chips and poker tables">
        <meta name="keywords" content="Chips,Playing Cards,Poker Tables">
        <title>ePokerShop Admin attributes</title>

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
						<h1>Attributes Edit</h1>
					</div>
				</div>
			</div>
		</div>
        
        <div class="section">
	    	<div class="container">
			
				</div>
				<div class="row">
					<div class="col-md-12">
						<!-- Shopping Cart Items -->
						<table class="shopping-cart">
						<?php
						$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "prekes";
						$categories=array();
						// Create connection
						$conn = new mysqli($servername, $username, $password, $dbname);
						// Check connection
						if ($conn->connect_error) {
						    die("Connection failed: " . $conn->connect_error);
						}
						$sqll="SELECT kategorija,ID from kategoriju_sarasas";
						$resultt = $conn->query($sqll);
						if ($resultt->num_rows > 0) {
							while($rrow = $resultt->fetch_assoc()) {
							echo '<tr><td><h2>'.$rrow['kategorija'].'</h2></td><td></td><td></td></tr>';
						$sql = "SELECT kategorija,atributu_sarasas.ID,atributas FROM atributu_sarasas
						INNER JOIN kategoriju_sarasas ON atributu_sarasas.kategorijos_ID=kategoriju_sarasas.ID WHERE kategorijos_ID=".$rrow['ID'];
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {		
						    // output data of each row
						    while($row = $result->fetch_assoc()) {
						   // $categories[]=$row['kategorija'],$row['ID'];
						    echo '
						 
							<tr>
								<td>
									<div class="cart-item-title">'.$row["atributas"].' Kategorija ID:'.$rrow['ID'].'</div>
								</td>								
								<!-- Shopping Cart Item Price -->
								<form action="attribute.php" method="post">
								<td class="price "><span id="optioninput'.$row["ID"].'" style="display:none;">';
								//-kategorijos pasirinkimas
									echo '<select  name="cat" value="'.$rrow['kategorija'].'">';
									$sqlll = "SELECT kategorija,ID FROM kategoriju_sarasas";
											$resulttt = $conn->query($sqll);
											if ($resulttt->num_rows > 0){
											    // output data of each row
											    while($rrrow = $resulttt->fetch_assoc()) {
											    	if($rrow['kategorija']==$rrrow['kategorija']){
											    		echo '<option value="'.$rrrow['ID'].'" selected>'.$rrrow['kategorija'].'</option>';
											    		
											    	}
											    	else{
											    	echo '<option value="'.$rrrow['ID'].'">'.$rrrow['kategorija'].'</option>';
											    }
											   }
											}
									echo '</select>';
								//kategorijos pasirinkimas end
								echo '</span></td>		
								<td class="price "><span id="textinput'.$row["ID"].'" style="display:none;"><input  type="text" name="newname" class=" cart-item-title pull-right " value="'.$row['atributas'].'"></input>
									<button type="submit" class="btn btn-xs btn-grey pull-left" name="attedit" value="'.$row["ID"].'"><i class="glyphicon glyphicon-ok "></i></button>
								</span></td>
								<!-- Shopping Cart Item Actions -->
								<td class="actions">
									<button type="button" id="editbt'.$row["ID"].'" class="btn btn-xs btn-grey" onClick="showedit(this.id); showeditopt(this.id);"><i class="glyphicon glyphicon-pencil"></i></button>
									<button type="submit" class="btn btn-xs btn-grey" name="delatt" value="'.$row["ID"].'"><i class="glyphicon glyphicon-trash"></i></button>
								</td>
							</tr>
							</form>
						';
						   }
						}
						else{
							echo '<tr><td> No attributes for this category</td></tr>';
						}
					}
				}
						
						?>	
						<tr><td><h2></h2></td></td><td></td><td></td></tr>			
							<tr>
								<td>
									<div class="cart-item-title">Create new attribute</div>
								</td>								
								<!-- Shopping Cart Item Price -->	
								<?php
										//-kategorijos pasirinkimas
								echo '<td class="price "><span id="optioninput0" style="display:none;"><form action="attribute.php" method="post">';
									echo '<select  name="cat" >';
									$sqlll = "SELECT kategorija FROM kategoriju_sarasas";
											$resulttt = $conn->query($sqll);
											if ($resulttt->num_rows > 0){
											    // output data of each row
											    while($rrrow = $resulttt->fetch_assoc()) {
											    	echo '<option value="'.$rrrow['ID'].'">'.$rrrow['kategorija'].'</option>';
											    
											   }
											}
									echo '</select>';
								//kategorijos pasirinkimas end
									$conn->close();
										?>
								<td class="price ">
									<span  class="" id="textinput0" style="display:none;">
									<input  type="text" name="newattname" class=" cart-item-title pull-right"></input><button class="btn btn-xs btn-grey pull-left" type="submit" name="newatt" class="btn btn-xs btn-grey"><i class="glyphicon glyphicon-ok "></i></button></td>
									</span>
								</td>
								<!-- Shopping Cart Item Actions -->
								<td class="actions">		
									<button class="pull-right" type="button" id="editbt0" class="btn btn-xs btn-grey " onClick="showedit(this.id);showeditopt(this.id);"><i class="glyphicon glyphicon-pushpin"></i></button>
								</td>
							</tr>
						</form>
						</table>
						<!-- End Shopping Cart Items -->
					</div>
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
		    			<div class="footer-copyright">&copy; 2017 ePokerShop. All rights reserved.</div>
		    		</div>
		    	</div>
		    </div>
	    </div>

        <!-- Javascripts -->
        <script>
        function showedit(butt_id){
        	var textfield_id=butt_id.slice(6,butt_id.length);
        	console.log(textfield_id);
        	var state=document.getElementById("textinput"+textfield_id).style.display;
        	if(state=="none")document.getElementById("textinput"+textfield_id).style.display="block";
        	else document.getElementById("textinput"+textfield_id).style.display="none";
        }
        function showeditopt(butt_id){
        	var textfield_id=butt_id.slice(6,butt_id.length);
        	console.log(textfield_id);
        	var state=document.getElementById("optioninput"+textfield_id).style.display;
        	if(state=="none")document.getElementById("optioninput"+textfield_id).style.display="block";
        	else document.getElementById("optioninput"+textfield_id).style.display="none";
        }
        </script>
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
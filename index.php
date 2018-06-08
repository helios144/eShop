<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    	<link rel="icon" type="image/x-icon" href="favicon.ico" />
        <meta charset="utf-8">
        <meta name="description" content="This is a simple  online Poker shop for where you can buy poker related items like playing card, chips and poker tables">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>ePokerShop Home Page</title>
        <meta name="viewport" content="width=device-width">
        <meta name="keywords" content="Chips,Playing Cards,Poker Tables">
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
							<li class="shopping-cart-items"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> <a href="page-shopping-cart.php"><b><?php session_start(); if(isset($_SESSION['all_in_cart'])){
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
		<div class="section section-breadcrumbs" style="margin-bottom: 0px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>Featured Items</h1>
					</div>
				</div>
			</div>
		</div>
<?php
						$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "prekes";
						$featured=[0=>47, 1=>52, 2=>51];
						$featuredcontent=array();
						// Create connection
						$conn = new mysqli($servername, $username, $password, $dbname);
						// Check connection
						if ($conn->connect_error) {
						    die("Connection failed: " . $conn->connect_error);
						}
						for($i=0;$i<3;$i++){

						$sql = "SELECT name, description, kaina,nuotrauka,ID FROM prekes WHERE ID=".$featured[$i];
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
						    // output data of each row
						    while($row = $result->fetch_assoc()) {
						    	$featuredcontent[$i]=array();
						    	$featuredcontent[$i][0]=$row['name'];
						    	$featuredcontent[$i][1]=$row['description'];
						    	$featuredcontent[$i][2]=$row['kaina'];
						    	$featuredcontent[$i][3]=$row['nuotrauka'];
						    }
						}	
					}
						$conn->close();
						?>
        <!-- Homepage Slider -->
        <div class="homepage-slider">
        	<div id="sequence">
				<ul class="sequence-canvas">
					<!-- Slide 1 -->
					<li class="bg4">
						<!-- Slide Title -->
						<h3 class="title"><?php  echo $featuredcontent[0][0] ?></h3>
						<!-- Slide Text -->
						<h3 class="subtitle"><?php  echo "Price: ".$featuredcontent[0][2] ?>€</h3>
						<!-- Slide Image src="img/homepage-slider/slide1.png" -->
						<img class="slide-img" style="vertical-align:center"<?php  echo 'src="'.$featuredcontent[0][3].'"' ?> alt="Slide 1" />
					</li>
					<!-- End Slide 1 -->
					<!-- Slide 2 -->
					<li class="bg3">
						<!-- Slide Title -->
						<h3 class="title"><?php  echo $featuredcontent[1][0] ?></h3>
						<!-- Slide Text -->
						<h3 class="subtitle"><?php  echo "Price: ".$featuredcontent[1][2] ?>€</h3>
						<!-- Slide Image src="img/homepage-slider/slide2.png"-->
						<img class="slide-img" <?php  echo 'src="'.$featuredcontent[1][3].'"' ?> alt="Slide 2" />
					</li>
					<!-- End Slide 2 -->
					<!-- Slide 3 -->
					<li class="bg1">
						<!-- Slide Title -->
						<h3 class="title"><?php  echo $featuredcontent[2][0] ?></h3>
						<!-- Slide Text -->
						<h3 class="subtitle"><?php  echo "Price: ".$featuredcontent[2][2] ?>€</h3>
						<!-- Slide Image src="img/homepage-slider/slide3.png"-->
						<img class="slide-img" <?php  echo 'src="'.$featuredcontent[2][3].'"' ?> alt="Slide 3" />
					</li>
					<!-- End Slide 3 -->
				</ul>
				<div class="sequence-pagination-wrapper">
					<ul class="sequence-pagination">
						<li>1</li>
						<li>2</li>
						<li>3</li>
					</ul>
				</div>
			</div>
        </div>
        <!-- End Homepage Slider -->
		<!-- Services -->
        <div class="section">
	        <div class="container">
	        	<div class="row">
	        		<div class="col-md-4 col-sm-6 shop-item">
	        			<div class=" shop-item-image text-center">
		        			<a href="page-products.php?listas=Chips&kaina=visos"><img src="imgg/20160817_105840b.jpg" alt="Service 3"></a>
		        			<h1>Chips</h1>
		        			<a href="page-products.php?listas=Chips&kaina=visos" class="btn">See more</a>
		        		</div>
	        		</div>
	        		<div class="col-md-4 col-sm-6 shop-item">
	        			<div class="shop-item-image text-center">
		        			<a href="page-products.php?listas=Playing+Cards&kaina=visos"><img src="imgg/img_0205_1b.jpg" alt="Service 2"></a>
		        			<h1>Playing Cards</h1>
		        			<a href="page-products.php?listas=Playing+Cards&kaina=visos" class="btn">See more</a>
		        		</div>
	        		</div>
	        		<div class="col-md-4 col-sm-6 shop-item">
	        			<div class=" shop-item-image text-center">
		        			<a href="page-products.php?listas=Poker+Tables&kaina=visos"><img src="imgg/x2mini1250ls4.jpg" alt="Service 3"></a>
		        			<h1>Poker Tables</h1>
		        			<a href="page-products.php?listas=Poker+Tables&kaina=visos" class="btn">See more</a>
		        		</div>
	        		</div>
	        	</div>
	        </div>
	    </div>

	    <!-- End Services -->
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
		    			<div class="footer-copyright">&copy; 2017 My ePokerShop. All rights reserved.</div>
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
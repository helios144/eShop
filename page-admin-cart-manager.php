<?php
session_start();
if(!isset($_SESSION['Privileges']) || $_SESSION['Privileges']==0)
{
header("location: denied.php");
}

if(isset($_POST['approve'])){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "prekes";
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
  }
  $sql = "UPDATE cart SET  Status='Approved' WHERE user_id='".$_POST['approve']."'";
  $conn->query($sql);
     // the message
$to      = 'helios@localhost';
$subject = 'Order Status';
$message = 'Your order has been Approved';
$headers = 'From: epokershop@localhost.com';
mail($to, $subject, $message,$headers);
  $conn->close();
}
if(isset($_POST['reject'])){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "prekes";
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
  }
  $sql = "UPDATE cart SET  Status='Rejected' WHERE user_id='".$_POST['reject']."'";
  //$sql = "DELETE FROM cart WHERE user_id='".$_POST['reject']."'";
  $conn->query($sql);
   // the message
//$to      = 'Helios@localhost';
  $to='helios@localhost';
$subject = 'Order Status';
$message = 'Your order has been Rejected';
/*$headers = 'From: postmaster@localhost' . "\r\n" .
    'Reply-To: Helios@localhost' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
*/
    $headers = 'From: epokershop@localhost.com';
mail($to, $subject, $message,$headers);
  $conn->close();
}
//reject
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
        <title>ePokerShop Admin</title>
        <meta name="description" content="This is a simple  online Poker shop for where you can buy poker related items like playing card, chips and poker tables">
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
    <style>
    	.cards{
    padding-left:0;
}
.cards li {
  -webkit-transition: all .2s;
  -moz-transition: all .2s;
  -ms-transition: all .2s;
  -o-transition: all .2s;
  transition: all .2s;
  background-image: url('//c2.staticflickr.com/4/3713/20116660060_f1e51a5248_m.jpg');
  background-position: 0 0;
  float: left;
  height: 32px;
  margin-right: 8px;
  text-indent: -9999px;
  width: 51px;
}
.cards .mastercard {
  background-position: -51px 0;
}
.cards li {
  -webkit-transition: all .2s;
  -moz-transition: all .2s;
  -ms-transition: all .2s;
  -o-transition: all .2s;
  transition: all .2s;
  background-image: url('//c2.staticflickr.com/4/3713/20116660060_f1e51a5248_m.jpg');
  background-position: 0 0;
  float: left;
  height: 32px;
  margin-right: 8px;
  text-indent: -9999px;
  width: 51px;
}
.cards .amex {
  background-position: -102px 0;
}
.cards li {
  -webkit-transition: all .2s;
  -moz-transition: all .2s;
  -ms-transition: all .2s;
  -o-transition: all .2s;
  transition: all .2s;
  background-image: url('//c2.staticflickr.com/4/3713/20116660060_f1e51a5248_m.jpg');
  background-position: 0 0;
  float: left;
  height: 32px;
  margin-right: 8px;
  text-indent: -9999px;
  width: 51px;
}
.cards li:last-child {
  margin-right: 0;
}
    </style>
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
						<h1>Shopping Cart</h1>
					</div>
				</div>
			</div>
		</div>
        
        <div class="section">
	    	<div class="container">
				<div class="row">
				</div>
				<div class="row">
					<div class="col-md-12">
						<!-- Shopping Cart Items -->
						<table class="shopping-cart">
							<!-- Shopping Cart Item -->
							<?php
								$servername = "localhost";
								$username = "root";
								$password = "";
								$dbname = "prekes";
								$user_carts=array();
								$price=0;
								$thecart=' ';
								// Create connection
								$conn = new mysqli($servername, $username, $password, $dbname);
								// Check connection
								if ($conn->connect_error) {
								    die("Connection failed: " . $conn->connect_error);
								}
								//if(isset($_POST['update'])){
									//udateina prekes
                $sqllll="SELECT user_id,cart FROM cart";
                $resultttt = $conn->query($sqllll);
                if ($resultttt->num_rows > 0) {
                    while($rrrrow = $resultttt->fetch_assoc()){
									$sqlll = "SELECT user_id,cart,Status FROM cart WHERE user_id='".$rrrrow['user_id']."'";
									$resulttt = $conn->query($sqlll);	
									if ($resulttt->num_rows > 0) {
										while($rrrow = $resulttt->fetch_assoc()){
											$sqll=$rrrow['cart'];
                      $status=$rrrow['Status'];
											$resultt = $conn->query($sqll);
											//$_SESSION['all_in_cart']=0;
											if($rrrow['cart']!=' '){
												if ($resultt->num_rows > 0) {
                          $user_carts['all_in_cart']=0;
													while($rrow = $resultt->fetch_assoc()) {
														if(isset($user_carts['all_in_cart'])){
															$user_carts['all_in_cart']+=$rrow['quant'];
														}
														else {
															$user_carts['all_in_cart']=$rrow['quant'];

														}
														$user_carts['cart'][$rrow['id']]['quantity']=$rrow['quant'];
														//end saugom is sesijos is krepselio is db
													}
												}
											}
											else{
												echo '<tr><td>No cart saved<td></tr>';
											}
										}
									}
                  if(isset($user_carts['cart'])){
                    $sqlusr="SELECT User_name,ID,Country,FirstName,LastName,Address,City,Zip,Phone,Email FROM users WHERE ID='".$rrrrow['user_id']."'";
                  $resultusr=$conn->query($sqlusr);
                  $rowusr=$resultusr->fetch_assoc();
                  //echo '<tr><td><h3>'.$rowusr['User_name'].'</h3></td></tr>'; 
                  //show user
                  echo '
                  <tr>
                            <!-- Shopping Cart Item Image -->
                            <td>
                            <h2><div class="cart-item-title">'.$rowusr['User_name'].'</div></h2>
                            </td>
                            <td>Cart status:'.$status.'</td>
                            <td class="actions">
                            <form method="post" action="">
                             <button type="submit"  class="btn btn-xs btn-grey" name="approve" value="'.$rowusr['ID'].'"><i class="glyphicon glyphicon-ok"></i></button>
                              <button type="submit" class="btn btn-xs btn-grey" name="reject" value="'.$rowusr['ID'].'"><i class="glyphicon glyphicon-trash"></i></button>
                              <button type="button" class="btn btn-xs btn-grey" id=".'.$rowusr['User_name'].'" onClick="showCart(this.id)">Show cart<i class="glyphicon glyphicon-shopping-cart"></i></button>
                            </td>
                            </form>
                          </tr>
                          <tr class="carts '.$rowusr['User_name'].'"><td>
                            <div class="modal-body">
                         <!--SHIPPING METHOD-->
                        <div class="panel panel-info">
                        <div class="panel-heading">Address</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>Contact Information</h4>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Country:</strong></div>
                                <div class="col-md-12">
                                    '.$rowusr['Country'].'
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 "><strong>First Name:</strong></div>
                                <div class="col-md-12">
                                    '.$rowusr['FirstName'].'
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 "><strong>Last Name:</strong></div>
                                <div class="col-md-12">
                                    '.$rowusr['LastName'].'
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-12"><strong>Address:</strong></div>
                                <div class="col-md-12">
                                    '.$rowusr['Address'].'
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>City:</strong></div>
                                <div class="col-md-12">
                                    '.$rowusr['City'].'
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Zip / Postal Code:</strong></div>
                                <div class="col-md-12">
                                    '.$rowusr['Zip'].'
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Phone Number:</strong></div>
                                <div class="col-md-12">'.$rowusr['Phone'].'</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Email Address:</strong></div>
                                <div class="col-md-12">'.$rowusr['Email'].'</div>
                            </div>
                        </div>
                    </div>
                    <!--SHIPPING METHOD END-->
                          </td></tr>
                          ';
                  //show user  
                  foreach($user_carts['cart'] as $roww => $row){ 
                    $sql = "SELECT * FROM prekes WHERE ID='".$roww."'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                       // output data of each row
                      while($row = $result->fetch_assoc()) {
                          echo '
                          <tr class="carts '.$rowusr['User_name'].'">
                            <!-- Shopping Cart Item Image -->
                            <td class="image"><a href="page-product-details.html"><img src="'.$row['nuotrauka'].'" alt="Item Name"></a></td>
                            <!-- Shopping Cart Item Description & Features -->
                            <td>
                            <div class="cart-item-title"><a href="page-product-details.html">'.$row['name'].'</a></div>
                            </td>
                            <!-- Shopping Cart Item Quantity -->
                            <td class="quantity">
                                <input class="form-control input-sm input-micro" type="text" name="itemquant" value="'.$user_carts['cart'][$roww]['quantity'].'" readonly/>
                            </td>
                            <!-- Shopping Cart Item Price -->
                            <td class="price">'.$row['kaina'].' €</td>
                            <!-- Shopping Cart Item Actions -->   
                          </tr>
                        ';                        
                         }
                      }
                  }
                }
                else{
                  echo '<tr><td>No items in cart<td></tr>';
                }
                }

              }
									/*else{
										echo '<tr><td>No cart saved<td></tr>';
									}
								}*/
								
							
							//$conn->close();
							?>
						</table>
						<!-- End Shopping Cart Items -->
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
		    		
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="footer-copyright">&copy; 2013 mPurpose. All rights reserved.</div>
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
           <script>
          $(document).ready(function() {
            $(".carts").hide();
            });
         function showCart(id){
            $(id).toggle();
         }
        </script>
    </body>
</html>
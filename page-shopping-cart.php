<?php
session_start();
if(!isset($_SESSION['login_user'])){
  header("Location: page-login.php");
}

$show=' ';
if(isset($_POST['deletecartitem'])){
  $_SESSION['all_in_cart']-=$_SESSION['cart'][$_POST['deletecartitem']]['quantity'];
  unset($_SESSION['cart'][$_POST['deletecartitem']]);

}
if(isset($_POST['savequantchange'])){
  $_SESSION['all_in_cart']-=$_SESSION['cart'][$_POST['savequantchange']]['quantity'];
  $_SESSION['cart'][$_POST['savequantchange']]['quantity']=$_POST['itemquant'];
  $_SESSION['all_in_cart']+=$_SESSION['cart'][$_POST['savequantchange']]['quantity'];
}
if(isset($_POST['checkout'])){
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
 //$sql = "INSERT INTO users (Country,FirstName,LastName,Address,City,Zip,Phone,Email) VALUES ('".$_POST['country']."','".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['address']."','".$_POST['city']."','".$_POST['zip_code']."','".$_POST['phone_number']."','".$_POST['email_address']."')";
 $sql="UPDATE users SET Country='".$_POST['country']."', FirstName='".$_POST['first_name']."',LastName='".$_POST['last_name']."',Address='".$_POST['address']."',City='".$_POST['city']."',Zip='".$_POST['zip_code']."',Phone='".$_POST['phone_number']."',Email='".$_POST['email_address']."'";
 $conn->query($sql);
 // the message
/*$to      = 'saulius.gaizutis@gmail.com';
$subject = 'test';
$message = 'hello world';
$headers = 'From: saulius.gaizutis@gmail.com' . "\r\n" .
    'Reply-To: saulius.gaizutis@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);*/
$show="<script>$('#myModal2').modal('show');</script>";
 unset($_SESSION['cart']);
 unset($_SESSION['all_in_cart']);
 $conn->close(); 
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
        <title>Shoping cart</title>
        <meta name="description" content="This is a simple  online Poker shop for where you can buy poker related items like playing card, chips and poker tables">
        <meta name="keywords" content="Chips,Playing Cards,Poker Tables">
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
<!-- Modal -->
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order info</h4>
      </div>
      <div class="modal-body">
        <p style="color: green;">Order was succesfully placed</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?echo $show;?>
        <!-- Modal -->
<?php
if(isset($_SESSION['user_id'])){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "prekes";
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
  }
    $sql = "SELECT Country,FirstName,LastName,Address,City,Zip,Phone,Email FROM users WHERE ID='".$_SESSION['user_id']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          /*echo $row['Country'].' '.$row['FirstName'].' '.$row['LastName'].' '.$row['Address'].' '.$row['City'].' '.$row['Zip'].' '.$row['Phone'].' '.$row['Email'];*/
          echo '<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Check out</h4>
      </div>
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
                            <form method="post" action="">

                            <div class="form-group">
                                <div class="col-md-12"><strong>Country:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="country" value="'.$row['Country'].'" />
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-12 "><strong>First Name:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="first_name" class="form-control" value="'.$row['FirstName'].'" />
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 "><strong>Last Name:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="last_name" class="form-control" value="'.$row['LastName'].'" />
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-12"><strong>Address:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address" class="form-control" value="'.$row['Address'].'" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>City:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="city" class="form-control" value="'.$row['City'].'" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Zip / Postal Code:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="zip_code" class="form-control" value="'.$row['Zip'].'" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Phone Number:</strong></div>
                                <div class="col-md-12"><input type="text" name="phone_number" class="form-control" value="'.$row['Phone'].'" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Email Address:</strong></div>
                                <div class="col-md-12"><input type="text" name="email_address" class="form-control" value="'.$row['Email'].'" /></div>
                            </div>
                        </div>
                    </div>
                    <!--SHIPPING METHOD END-->
                    <!--CREDIT CART PAYMENT-->
                    <div class="panel panel-info">
                        <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Secure Payment</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12"><strong>Card Type:</strong></div>
                                <div class="col-md-12">
                                    <select id="CreditCardType" name="CreditCardType" class="form-control">
                                        <option value="5">Visa</option>
                                        <option value="6">MasterCard</option>
                                        <option value="7">American Express</option>
                                        <option value="8">Discover</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Credit Card Number:</strong></div>
                                <div class="col-md-12"><input type="text" class="form-control" name="car_number" value="" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Card CVV:</strong></div>
                                <div class="col-md-12"><input type="text" class="form-control" name="car_code" value="" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <strong>Expiration Date</strong>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="">
                                        <option value="">Month</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="">
                                        <option value="">Year</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <span>Pay secure using your credit card.</span>
                                </div>
                                <div class="col-md-12">
                                    <ul class="cards">
                                        <li class="visa hand">Visa</li>
                                        <li class="mastercard hand">MasterCard</li>
                                        <li class="amex hand">Amex</li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <br>
                                    <button type="submit" name="checkout" class="btn btn-primary btn-submit-fix" data-toggle="modal" data-target="#myModal2">Place Order</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <!--CREDIT CART PAYMENT END-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--END MODAL-->';
      }
    }
  }
  else{
    echo '<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Check out</h4>
      </div>
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
                            <form method="post" action="">

                            <div class="form-group">
                                <div class="col-md-12"><strong>Country:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="country" value="" />
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-12 "><strong>First Name:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="first_name" class="form-control" value="" />
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 "><strong>Last Name:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="last_name" class="form-control" value="" />
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-12"><strong>Address:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>City:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="city" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Zip / Postal Code:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="zip_code" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Phone Number:</strong></div>
                                <div class="col-md-12"><input type="text" name="phone_number" class="form-control" value="" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Email Address:</strong></div>
                                <div class="col-md-12"><input type="text" name="email_address" class="form-control" value="" /></div>
                            </div>
                        </div>
                    </div>
                    <!--SHIPPING METHOD END-->
                    <!--CREDIT CART PAYMENT-->
                    <div class="panel panel-info">
                        <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Secure Payment</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12"><strong>Card Type:</strong></div>
                                <div class="col-md-12">
                                    <select id="CreditCardType" name="CreditCardType" class="form-control">
                                        <option value="5">Visa</option>
                                        <option value="6">MasterCard</option>
                                        <option value="7">American Express</option>
                                        <option value="8">Discover</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Credit Card Number:</strong></div>
                                <div class="col-md-12"><input type="text" class="form-control" name="car_number" value="" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Card CVV:</strong></div>
                                <div class="col-md-12"><input type="text" class="form-control" name="car_code" value="" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <strong>Expiration Date</strong>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="">
                                        <option value="">Month</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="">
                                        <option value="">Year</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <span>Pay secure using your credit card.</span>
                                </div>
                                <div class="col-md-12">
                                    <ul class="cards">
                                        <li class="visa hand">Visa</li>
                                        <li class="mastercard hand">MasterCard</li>
                                        <li class="amex hand">Amex</li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <br>
                                    <button type="submit" name="checkout" class="btn btn-primary btn-submit-fix">Place Order</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <!--CREDIT CART PAYMENT END-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--END MODAL-->';
  }
?>


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
						<li class="logo-wrapper"><a href="index.html"><img src="img/logo.png" alt="Multipurpose Twitter Bootstrap Template"></a></li>
						<li class="active">
							<a href="indexmain.php">Home</a>
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
        
        <div class="section" >
	    	<div class="container">
				<div class="row">
					<div class="col-md-12">
						<!-- Action Buttons -->
						<div class="pull-right">
							
							<form method="post" action=""><button type="submit" name="checkout" class="btn"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> CHECK OUT</button></form><br>
						</div>
						<div class="pull-right">
						<form method="post" action=""><button type="submit" name="update" class="btn btn-grey"><i class="glyphicon glyphicon-refresh"></i> UPDATE</a></button></form>
							
						</div>
						
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<!-- Shopping Cart Items -->
						<table class="shopping-cart">
							<!-- Shopping Cart Item -->
							
							<?php
								/*$servername = "localhost";
								$username = "root";
								$password = "";
								$dbname = "prekes";*/
								$categories=array();
								$price=0;
								$thecart=' ';
								// Create connection
								/*$conn = new mysqli($servername, $username, $password, $dbname);
								// Check connection
								if ($conn->connect_error) {
								    die("Connection failed: " . $conn->connect_error);
								}*/
								if(isset($_POST['update'])){
									//udateina prekes
									$sqlll = "SELECT user_id,cart FROM cart WHERE user_id='".$_SESSION['user_id']."' AND Status='Saved'";
									$resulttt = $conn->query($sqlll);	
									if ($resulttt->num_rows > 0) {
										while($rrrow = $resulttt->fetch_assoc()){
											$sqll=$rrrow['cart'];
											$resultt = $conn->query($sqll);
											//$_SESSION['all_in_cart']=0;
											if($rrrow['cart']!=' '){
												if ($resultt->num_rows > 0) {
                          $_SESSION['all_in_cart']=0;
													while($rrow = $resultt->fetch_assoc()) {
														if(isset($_SESSION['all_in_cart'])){
															$_SESSION['all_in_cart']+=$rrow['quant'];
														}
														else {
															$_SESSION['all_in_cart']=$rrow['quant'];

														}
														$_SESSION['cart'][$rrow['id']]['quantity']=$rrow['quant'];
														//end saugom is sesijos is krepselio is db
														$sql = "SELECT * FROM prekes WHERE ID='".$rrow['id']."'";
														$result = $conn->query($sql);
														if ($result->num_rows > 0) {
														    // output data of each row
														    if($thecart==' '){
														    		$thecart='select id,'.$rrow['quant'].' as quant from prekes where id="'.$rrow['id'].'"';
														    }
														    else{
														    	$thecart=$thecart.' union select id,'.$rrow['quant'].' as quant from prekes where id="'.$rrow['id'].'"';
														    }
														}
													}
												}
											}
											else{
												echo '<tr><td>No cart saved<td></tr>';
											}
										}
									}
									else{
										echo '<tr><td>No cart saved<td></tr>';
									}
								}
								if(isset($_SESSION['cart'])){							
									foreach($_SESSION['cart'] as $roww => $row){
										$sql = "SELECT * FROM prekes WHERE ID='".$roww."'";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {
											 // output data of each row
											if($thecart==' '){
											    $thecart='select id,'.$_SESSION['cart'][$roww]['quantity'].' as quant from prekes where id="'.$roww.'"';
											}
											 else{
											    $thecart=$thecart.' union select id,'.$_SESSION['cart'][$roww]['quantity'].' as quant from prekes where id="'.$roww.'"';
											}
											while($row = $result->fetch_assoc()) {
											    $price=$price+($row['kaina']*$_SESSION['cart'][$roww]['quantity']);
											    echo '
                          <tr>
                            <!-- Shopping Cart Item Image -->
                            <td class="image"><a href="page-product-details.html"><img src="'.$row['nuotrauka'].'" alt="Item Name"></a></td>
                            <!-- Shopping Cart Item Description & Features -->
                            <td>
                            <div class="cart-item-title"><a href="page-product-details.html">'.$row['name'].'</a></div>
                            </td>
                            <!-- Shopping Cart Item Quantity -->
                            <td class="quantity">
                            <form method="post" action="">
                                <input class="form-control input-sm input-micro" type="text" name="itemquant" value="'.$_SESSION['cart'][$roww]['quantity'].'">
                            </td>
                            <!-- Shopping Cart Item Price -->
                            <td class="price">'.$row['kaina'].'€</td>
                            <!-- Shopping Cart Item Actions -->
                             
                            <td class="actions">
                             <button type="submit"  class="btn btn-xs btn-grey" name="savequantchange" value="'.$row["ID"].'"><i class="glyphicon glyphicon-pencil"></i></button>
                              <button type="submit" class="btn btn-xs btn-grey" name="deletecartitem" value="'.$row["ID"].'"><i class="glyphicon glyphicon-trash"></i></button>
                            </td>
                            </form>
                          </tr>
                        ';
													
											   }
											}
									}
								}
								else{
									echo '<tr><td>No items in cart<td></tr>';
								}
							
							//$conn->close();
							?>
						</table>
						<!-- End Shopping Cart Items -->
					</div>
				</div>
				<div class="row">
					<div class="col-xs-0 col-sm-0 col-lg-6 col-md-6">
					</div>
					<!-- Promotion Code -->
					<!-- Shopping Cart Totals -->
					<div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">		    
						<table class="cart-totals">
								
								<tr class="cart-grand-total">
									<td><b>Total</b></td>
									<td><b><?php echo $price; ?>€</b></td>
								</tr>
								<tr class="cart-grand-total"><td><?php
								if(isset($_POST['save'])){
									$sql = "SELECT user_id FROM cart where user_id='".$_SESSION['user_id']."'";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
                    $status="Saved";
									  $sql = "UPDATE cart SET  user_id='".$_SESSION['user_id']."',cart='".$thecart."',Status='".$status."' WHERE user_id='".$_SESSION['user_id']."'";
									    $conn->query($sql);
									    }
									 else{
                    $status="Saved";
										$sql = "INSERT INTO cart (user_id,cart,Status) VALUES ('".$_SESSION['user_id']."','".$thecart."','".$status."')";
										$conn->query($sql);
									}
							}
								?></td></tr>

						</table>
						<div class="pull-right">
						<form  method="post" action=""><button type="submit" name="save" class="btn btn-grey"><i class="glyphicon glyphicon-floppy-save icon-white"></i>SAVE</button></form>
					</div>
						<!-- Action Buttons -->
						<div class="pull-right">
							<form method="post" action=""><button type="submit" name="update" class="btn btn-grey"><i class="glyphicon glyphicon-refresh"></i> UPDATE</a></button></form>
							<br>
							<button class="btn"  data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> CHECK OUT</button>
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
        <?php echo $show;?>
    </body>
</html>
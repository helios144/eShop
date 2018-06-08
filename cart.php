<?php
session_start();
	if (isset($_POST['add_from_list'])) {
    if (isset($_SESSION['cart'][$_POST['add_from_list']]['quantity'])) {
        $_SESSION['cart'][$_POST['add_from_list']]['quantity']++;
         $_SESSION['all_in_cart']++;
        }
        else{
    $_SESSION['cart'][$_POST['add_from_list']]['quantity'] = 1;
    if(isset($_SESSION['all_in_cart'])){
     $_SESSION['all_in_cart']++;
    }
    else{
        $_SESSION['all_in_cart']=1;
    }
 }
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
}
if (isset($_POST['add_from_details'])) {
 "";
    if (isset($_SESSION['cart'][$_POST['add_from_details']]['quantity'])) {
        $_SESSION['cart'][$_POST['add_from_details']]['quantity']+=$_POST['quant'];
        if(isset($_SESSION['all_in_cart'])){
         $_SESSION['all_in_cart']+=$_POST['quant'];
        }
        else{
           $_SESSION['all_in_cart']=$_POST['quant']; 
        }
        }
        else{
    $_SESSION['cart'][$_POST['add_from_details']]['quantity'] = $_POST['quant'];
    if(isset($_SESSION['all_in_cart'])){
         $_SESSION['all_in_cart']+=$_POST['quant'];
        }
        else{
           $_SESSION['all_in_cart']=$_POST['quant']; 
        }
 }
 if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
}
?>

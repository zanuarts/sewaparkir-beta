<?php 
session_start();
require 'config.php';
require 'item.php';

// Save new orders
$sql1 = 'INSERT INTO order (name, datecreation, status, username) VALUES ("New Order","'.date('Y-m-d').'",0,"acc2")';
mysqli_query($mysqli, $sql1);
$ordersid = mysqli_insert_id($mysqli); 
// Save order details for new orders
$cart = unserialize(serialize($_SESSION['cart']));
for($i=0; $i<count($cart);$i++) {
$sql2 = 'INSERT INTO oderdetail (productid, orderid, harga, quantity) VALUES ('.$cart[$i]->id.', '.$ordersid.', '.$cart[$i]->harga.', '.$cart[$i]->quantity.')';
mysqli_query($mysqli, $sql2);
}
// Clear all product in cart
unset($_SESSION['cart']);
 ?>
 Thanks for buying products. Click <a href="index.php">here</a> to continue purchasing products.
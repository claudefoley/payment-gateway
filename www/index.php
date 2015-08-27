<?php

// Start the session
session_start();

// If the shopping cart does not exist
if( !isset($_SESSION['cart']) ) {

	// Create the cart
	$_SESSION['cart'] = [];

}

// Connect to the database
$dbc = new mysqli('localhost', 'root', '', 'payment_gateway');

// If the user has submitted the "add to cart" form
if( isset($_POST['add-to-cart']) ) {

	// Filter the ID
	$productID = $dbc->real_escape_string($_POST['product-id']);

	// Find out info about this product
	$sql = "SELECT name, price FROM products WHERE id = $productID ";

	// Run the SQL
	$result = $dbc->query($sql);

	// Validation

	// Convert into associative array
	$result = $result->fetch_assoc();

	// Add the item to the cart
	$_SESSION['cart'][] = 	[
								'id'		=> $productID,
								'quantity'	=> $_POST['quantity'],
								'name'		=> $result['name'],
								'price'		=> $result['price']
							];


}

// Include the website header
include 'app/templates/header.php';

// Include the products list
include 'app/templates/product-list.php';

// Include the website footer
include 'app/templates/footer.php';
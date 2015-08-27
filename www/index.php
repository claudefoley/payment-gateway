<?php

// Start the session
session_start();

// If the shopping cart does not exist
if( !isset($_SESSION['cart']) || isset($_GET['clearcart']) ) {

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

	// See if the user is adding the same item to their cart
	$found = false;
	for( $i=0; $i<count($_SESSION['cart']); $i++ ) {

		// Is the ID of the product they are adding the same
		// as the ID of this cart item?
		if( $_SESSION['cart'][$i]['id'] == $productID ) {
			$found = true;
			// Yes, they have already added this item to the cart
			// UPDATE the quantity
			$_SESSION['cart'][$i]['quantity'] += $_POST['quantity'];

		}

	}

	// Add the item to the cart only if the product was not found
	if( !$found ) {
		$_SESSION['cart'][] = 	[
								'id'		=> $productID,
								'quantity'	=> $_POST['quantity'],
								'name'		=> $result['name'],
								'price'		=> $result['price']
							];
	}

	// Redirect to prevent form resubmit
	header('Location: index.php');

}

// Include the website header
include 'app/templates/header.php';

// Include the products list
include 'app/templates/product-list.php';

// Include the website footer
include 'app/templates/footer.php';
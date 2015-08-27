<?php
	
	// If the user already has this item in the cart
	// then we want to make sure they can't add more
	// than what's in the database
	// If we subtract their cart quantity against the database quantity,
	// the we can help prevent this issue
	for( $i=0; $i<count($_SESSION['cart']); $i++ ) {

		// If the ID of this product is the same as one in the cart
		if( $row['id'] == $_SESSION['cart'][$i]['id'] ) {
			$newQuantity = $row['quantity'] -= $_SESSION['cart'][$i]['quantity'];
			$inCart = $_SESSION['cart'][$i]['quantity'];
		}

	}

	// If the "$newQuantity" variable does't exist
	// Create it and apply the default database quantity
	if( !isset($newQuantity) ) {
		$newQuantity = $row['quantity'];
	}

?>


<form action="index.php" method="post">
	
	<label for="quantity<?= $row['id']; ?>">Quantity: </label>
	<input id="quantity<?= $row['id']; ?>" type="number" name="quantity" min="1" max="<?= $newQuantity; ?>" value="1">
	
	<input type="hidden" name="product-id" value="<?= $row['id']; ?>">
	<input type="submit" value="Add to Cart" name="add-to-cart">

</form>

<?php
	
	// If the user has this item in their cart, tell them
	if( isset($inCart) ) {
		echo '<ul>';
		echo '<li>Already in cart</li>';
		echo '<li>In cart: '.$inCart.'</li>';
		echo '</ul>';
		unset($inCart);
	}

	unset($newQuantity);







?>
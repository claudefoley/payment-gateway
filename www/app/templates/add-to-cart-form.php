<form action="index.php" method="post">
	
	<label for="quantity<?= $row['id']; ?>">Quantity: </label>
	<input id="quantity<?= $row['id']; ?>" type="number" name="quantity" min="1" max="<?= $row['quantity']; ?>" value="1">
	
	<input type="hidden" name="product-id" value="<?= $row['id']; ?>">
	<input type="submit" value="Add to Cart" name="add-to-cart">

</form>
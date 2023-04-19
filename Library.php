<?php
    include "Database/createTables.php";

		// Get images from the database
		$sql = "SELECT * FROM tbltextbooks";
		$query = mysqli_query($connection,$sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Imperial Bookstore | Library</title>
	<link rel="stylesheet" href="CSS\Style.css">
</head>
<body>
	<div>
	<h1>Our Library</h1>
	</div>
    <table>
							<tr>
							<td><b>Book Title:</b></td>
							<td><b>Front Cover:</b></td>
							<td><b>Book Price:</b></td>
							<td><b>Shop Book :</b></td>
							</tr>
					<tr>
						<?php while($product = mysqli_fetch_object($query)) { ?>
						<tr>
							<td><?php echo $product->book_title; ?></td>
							<td><img src="<?php echo $product->image; ?>" alt="" /></td>
							<td><?php echo "R :".$product->price; ?></td>
							<td><a href="cart\cart.php?bid=<?php echo $product->book_id; ?>"><button type="button">Add to Cart</button></a></td>
						</tr>
					<?php } ?>

				</table>

</body>
</html>
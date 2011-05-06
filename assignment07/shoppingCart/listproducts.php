<?php
require_once 'library/html.php';
require_once 'library/models.php';

$productFactory = new ProductFactory();

// Get the products that the user has selected
if ( isset($_POST['acousticSubmit']) ) {
	$productsTitle = "Acoustic Instruments";
	$products = $productFactory->fetchByCategory(1);
}
else if ( isset($_POST['electricSubmit']) ) {
	$productsTitle = "Electric Instruments";
	$products = $productFactory->fetchByCategory(2);
}
else {
	// Default to selecting all products
	$productsTitle = "All Instruments";
	$products = $productFactory->fetchAll();
}

//$products = $productFactory->fetchAll();
//$productAcoustic = $productFactory->fetchByCategory(1);
//$productElectric = $productFactory->fetchByCategory(2);
//var_dump($productAcuostic);
?>
<!-------form for selecting what to display --------------->
<?php htmlStart("Product List"); ?>
<body>
<?php htmlNav(); ?>
<table>
	<tbody>
			<td>
				<form action ="listproducts.php" method = "post">
					<input type = "submit" name = "listAllProducts" value = "List All Guitars"/>
				</form>
			</td>
			<td>
				<form action ="listproducts.php" method = "post">
					<input type = "submit" name = "acousticSubmit" value = "List All Acoustic"/>
				</form>
			</td>
			<td>
				<form action ="listproducts.php" method = "post">
					<input type = "submit" name = "electricSubmit" value = "List All Electrics"/>
				</form>
			</td>
	</tbody>
</table>




<!-- Display the products in a nice table -->
<?php showtitle( $productsTitle );?>
<?php if ( empty($products) ): ?>
	<div class='error'>
		There are no products to list
	</div>
<?php else: ?>
	<?php displayTable ($products);?>
<?php endif; ?>

<?php htmlEnd(); ?>
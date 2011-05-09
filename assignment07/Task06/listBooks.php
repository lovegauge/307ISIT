<?php
require_once 'library/html.php';
require_once 'library/models.php';

$bookFactory = new BookFactory();

	// Default to selecting all products
	$BooksTitle = "All Books";
	$books = $bookFactory->fetchAll();

//$products = $productFactory->fetchAll();
//$productAcoustic = $productFactory->fetchByCategory(1);
//$productElectric = $productFactory->fetchByCategory(2);
?>
<!-------form for selecting what to display --------------->
<?php htmlStart("Product List"); ?>
<body>
<?php htmlNav(); ?>

<!-- Display the products in a nice table -->
<?php showtitle( $BooksTitle );?>
<?php if ( empty($books) ): ?>
	<div class='error'>
		There are no products to list
	</div>
<?php else: ?>
	<?php displayTable ($books);?>
<?php endif; ?>

<?php htmlEnd(); ?>
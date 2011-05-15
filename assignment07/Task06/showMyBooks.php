<?php
session_start();
require_once 'library/html.php';
require_once 'library/models.php';

$bookFactory = new BookFactory();
	$customerId = $_SESSION['customer_id'];
	// Default to selecting all products
	$BooksTitle = "My Books";
	$books = $bookFactory->fetchByCustomer($customerId )

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
	<?php displayPersonalTable ($books);?>
<?php endif; ?>

<?php htmlEnd(); ?>

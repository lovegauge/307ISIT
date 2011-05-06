<?php
session_start();
require_once 'library/html.php';
require_once 'library/models.php';

$productId = $_REQUEST['id'];

// Grab the shopping cart
$shoppingCart = ShoppingCartFactory::getCart();
$shoppingCart->removeProduct( (int)$productId);
ShoppingCartFactory::saveCart( $shoppingCart );
?>
<?php htmlStart("Product Removed From Cart"); ?>
<body>
<?php htmlNav(); ?>

<div class='info'>
	All products have been removed from your cart.<a href='listproducts.php'>Return to shopping</a>
</div>
<?php htmlEnd(); ?>

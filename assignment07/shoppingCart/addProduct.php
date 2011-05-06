<?php
session_start();
require_once 'library/html.php';
require_once 'library/models.php';

$productId = $_REQUEST['id'];

// Grab the shopping cart
$shoppingCart = ShoppingCartFactory::getCart();
$shoppingCart->addProduct( (int)$productId);
ShoppingCartFactory::saveCart( $shoppingCart );
?>
<?php htmlStart("Product Added to Cart"); ?>
<body>
<?php htmlNav(); ?>

<div class='info'>
	Your product has been successfully added to the cart <a href='listproducts.php'>Return to shopping</a>
</div>
<?php htmlEnd(); ?>

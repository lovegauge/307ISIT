<?php
session_start();
require_once 'library/html.php';
require_once 'library/models.php';

$productId = $_REQUEST['id'];

// Grab the shopping cart
$shoppingCart = ShoppingCartFactory::getCart();
$shoppingCart->removeAllProducts();
ShoppingCartFactory::saveCart( $shoppingCart );
?>
<?php htmlStart("Product Removed From Cart"); ?>
<body onload = "show_alert_empty();">
<?php htmlNav(); ?>

<!--<form action ="removeAllProducts.php" method = "post">
	<input type = "submit" name = "removeAllProducts" value = "List All Guitars"/>
</form>-->

<?php// if (isset($_POST['removeAllProducts'])){
//$shoppingCart = ShoppingCartFactory::getCart();
//$shoppingCart->removeAllProducts();
//ShoppingCartFactory::saveCart( $shoppingCart );
//}
?>
<div class='info'>
	Your product has been successfully been removed from the cart <a href='listproducts.php'>Return to shopping</a>
</div>
<?php htmlEnd(); ?>

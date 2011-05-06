<?php

//------------------------------------------------------------------------------
// List products page ( listproducts.php )

$productFactory = new ProductFactory();
$products = $productFactory->fetchAll();

echo "<ul>\n";
foreach ( $products as $product ) {
	echo "<li>".$product->getName()." - ".$product->getPrice()." - ". $product->getDescription()." <a href='addproduct.php?id=".$product->getId()."'>Buy Now!</a></li>";
	
	foreach ( $product->getPictureFiles as $pictureFile ) {
		echo "<img src='$pictureFile'><br>\n";
	}
	
}
echo "</ul>\n";


//------------------------------------------------------------------------------
// Add product page ( addproduct.php?id=6 )

// Grab the cart from session
$shoppingCart = $_SESSION['cart'];

// Add the new product to the cart
$productId = $_GET['id'];

$shoppingCart->addProduct($productId);

echo "Congratulations, you have added a product to your cart!";


//------------------------------------------------------------------------------
// Checkout page

checkout.php

$shoppingCart = $_SESSION['cart'];
$customer = $_SESSION['customer'];
$myInvoice = $shoppingCart->checkoutCart( $customer );


echo "Congratulations, your invoice id is: ".$myInvoice->getId()."<br>\n";
echo "Your list of invoiced items is:<br>\n";

echo "<ul>\n";
foreach ( $myInvoice->getProducts() as $product ) {
	echo "<li>".$product->getName()." - ".$product->getPrice()."</li>\n";
}
echo "</ul>\n";

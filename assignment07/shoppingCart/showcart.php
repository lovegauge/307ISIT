<?php
session_start();
require_once 'library/html.php';
require_once 'library/models.php';

// Get the existing ( or new ) shopping cart and it's products
$shoppingCart = ShoppingCartFactory::getCart();
$shoppingProducts = $shoppingCart->getProducts();
?>

<?php htmlStart("Shopping Cart"); ?>
<body>
<?php htmlNav(); ?>

<h1>Shopping Cart</h1>

<?php if ( empty($shoppingProducts) ): ?>
	<div class='error'>
		Your shopping cart is empty
	</div>
<?php else: ?>
	<table>
		<thead>
			<tr>
				<th>Product</th>
				<th>Category</th>
				<th>Price</th>
				<th class='action'>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ( $shoppingProducts as $product ) : ?>
			<tr>
				<td><?php echo $product->getName(); ?></td>
				<td><?php echo $product->getCategoryName(); ?></td>
				<td><?php echo "$".$product->getPrice(); ?></td>
				<td class='action'><a href='removeProduct.php?id=<?php echo $product->getId(); ?>'>Remove</a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan='2'>&nbsp;</td>
				<td>Total: $<?php echo $shoppingCart->getTotalPrice(); ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td class='action'><a href='removeAllProducts.php'>Remove All </a></td>
			</tr>
		</tfoot>
	</table>
<?php endif; ?>
<?php htmlEnd(); ?>

<?php

function displayNumberOfItemInShoppingCart(){
	$shoppingCart = $_SESSION['shoppingCart'];
	if (!$shoppingCart){
		return "<p>No contents in shopping cart</p>";
	}
	else{
		$shoppingCartItems = explode(',',$shoppingCart);
		
		return "<p>you have ".count($shoppingCartItems)."in your cart";
	}
}


//Add one(product_id) to the quantity of shoppingcart
function addProductToShoppingCart($product_id){
	$_SESSION['shoppingCart'][$product_id]++;
}

//removes a product ($productid) from shoppingcart
function removeProductFromShoppingCart($product_id){
	$_SESSION['shoppingCart'][$product_id]--;
	
	if ($_SEESION['shoppingCart'][$product_id] === 0){
		
		//remove it completely
		unset ($_SESSION['shoppingCart'][$product_id] );
	}
}

//empty the contents of the shoppingcart
function emptyContentsOfShoppingCart(){
	unset($_SESSION['shoppingCart'] );
}



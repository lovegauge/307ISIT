<?php
require_once 'db.php';

// A customer represents a logged in shopper
class Customer {
	protected $_db = null;
	
	protected $_id = null;
	
	protected $_firstName = null;
	
	protected $_lastName = null;
	
	protected $_address = null;
	
	protected $_postCode = null;
	
	protected $_phoneNo = null;
	
	protected $_password = null;
	
	public function __construct($customerId){
		if ( empty($customerId) or !is_int($customerId) ) {
			throw new Exception("No customer in system");
		}
		// Setup the db connection
		$this->_db = getDbConnection();
		
		
		// Load the customer information
		$this->_loadCustomer( $customerId );
	
	}
	
	
	public function _loadCustomer($customerId){
		$customerId = $this->_db->real_escape_string( $customerId );
		
		$sql = "select * from customer where customer_id = $customerId";
		
		if ( $result = $this->_db->query($sql) ) {
			$row = $result->fetch_assoc();
			
			$this->_id = $row['customer_id'];
			$this->_firstName = $row['customer_first_name'];
			$this->_lastName = $row['customer_last_name'];
			$this->_address = $row['customer_address'];
			$this->_postcode = $row['customer_postcode'];
			$this->phoneNo = $row['customer_phone_no'];
			$this->_password = $row['customer_password']; 			
			$result->close();
		}
	}
	
	
	public function getId(){
		return $this->_id;
	}
	
	public function getName(){
		return $this->_first_name;
	}
	
	public function getLastName(){
		return $this->_last_name;
	}
	public function getAddress(){
		return $this->_address;
	}
	
	public function getPostCode(){
		return $this->_post_code;
	}
	
	public function getPhoneNo (){
		return $this->_phoneNo;
	}
	
	public function getPassword(){
		return $this->_phoneNo;
	}
	
}

class ProductFactory {
	
	protected $_db = null;
	
	public function __construct() {
		$this->_db = getDbConnection();
	}
	
	public function fetchAll() {
		// TODO: Turn me into a proper db query to fetch the list of products
		$sql =  "select product_id from product order by product_name asc";
		//$returnProducts = array();
		
		$results = $this->_db->query($sql);
		
		$returnProducts = array();
		while ( $row = $results->fetch_assoc() ) {
			
			// Convert the result to be a proper integer
			$productId = (int)$row['product_id'];
			
			// Construct a new product object using the id above
			$myProduct = new Product( $productId );
			
			// Add it to the stack of products to return
			$returnProducts[] = $myProduct;
		}
		
		// Return the array of product objects
		return $returnProducts;
	}
	
	public function fetchByCategory( $categoryId ) {
		// TODO: Turn me into a proper db query to fetch the list of products
		$sql =  "select product_id from product where category_id = $categoryId order by product_name desc";
				$results = $this->_db->query($sql);
		
		$returnProducts = array();
		while ( $row = $results->fetch_assoc() ) {
			
			// Convert the result to be a proper integer
			$productId = (int)$row['product_id'];
			
			// Construct a new product object using the id above
			$myProduct = new Product( $productId );
			
			// Add it to the stack of products to return
			$returnProducts[] = $myProduct;
		}
		
		// Return the array of product objects
		return $returnProducts;
		
	}
	
}


// Handles everything to do with products
class Product {
	
	// The product Id
	protected $_id = null;
	
	// The price of this product
	protected $_price = null;
	
	// The name
	protected $_name = null;
	
	// The description
	protected $_description = null;
	
	// The category Id for this product
	protected $_categoryId = null;
	
	// The name for this category
	protected $_categoryName = null;
	
	//The picture file path
	protected $_pictureFile = null;
	
	// The database handle
	protected $_db = null;
	
	public function __construct( $productId ) {
		if ( empty($productId) or !is_int($productId) ) {
			throw new Exception("No product Id supplied, unable to retrieve the product");
		}
		
		// Setup the db connection
		$this->_db = getDbConnection();
		
		// Load the product information
		$this->_loadProduct( $productId );
	}
	
	/**
	* Load the record from the db and fill up the internal variables
	*/
	protected function _loadProduct( $productId ) {
		// Do whatever code necessary to fetch the specific product from the
		// db and set all the internal variables
		
		$productId = $this->_db->real_escape_string( $productId );
		
		$sql = "select * from product where product_id = $productId";
		
		if ( $result = $this->_db->query($sql) ) {
			$row = $result->fetch_assoc();
			
			$this->_id = $row['product_id'];
			$this->_price = $row['product_price'];
			$this->_name = $row['product_name'];
			$this->_description = $row['product_description'];
			$this->_categoryId = $row['category_id'];
			$this->_pictureFile = $row['product_picture_path'];
			
			$result->close();
		}
		
	}
	
	public function getId() {
		return $this->_id;
	}
	
	public function getPrice() {
		return $this->_price;
	}
	
	public function getDescription() {
		return $this->_description;
	}
	
	public function getName() {
		return $this->_name;
	}
	
	public function getPictureFile() {
		return $this->_pictureFile;
	}
	
	public function getCategoryId() {
		return $this->_categoryId;
	}
	
	public function getCategoryName() {
		
		// Lazy load the category if required
		if ( empty($this->_categoryName) ) {
			$sql = "select category_name from category where category_id = ".$this->_categoryId;
			if ( $result = $this->_db->query($sql) ) {
				$record = $result->fetch_assoc();
				$this->_categoryName = $record['category_name'];
				$result->close();
			}
		}
		
		return $this->_categoryName;
	}
}

/**
 * Retrieve shopping carts through a factory class
 */
class ShoppingCartFactory {
	
	// Get the cart from session ( initialize if we need to )
	/**
	 * Retrieve the cart from session if required or create a new one
	 */
	public static function getCart() {
		
		// Create a cart
		$cart = new ShoppingCart();
		
		// If we have saved some products then add to the cart
		if ( isset($_SESSION['cart']) ) {
			$cartItems = $_SESSION['cart'];
			foreach ( $cartItems as $productId ) {
				$cart->addProduct( (int)$productId );
			}
		}
		
		// Return the cart
		return $cart;
	}
	
	/**
	 * Save the cart to session
	 */
	public static function saveCart( ShoppingCart $cart ) {
		
		$cartProducts = $cart->getProducts();
		$productIds = array();
		foreach ( $cartProducts as $product ) {
			$productIds[] = (int)$product->getId();
		}
		
		$_SESSION['cart'] = $productIds;
		return true;
	}
}

// Handles everything to 
class ShoppingCart {
	
	// An array to hold each product in the shopping cart
	protected $_products = array();
	
	//constructor for shoppingCart
	public function __construct(){
	}
	
	// Add a product to this shopping cart
	public function addProduct( $productId ) {

		if ( empty($productId) or !is_int($productId) ) {
			throw new Exception("Invalid product id to add to shopping cart");
		}
		
		$myProduct = new Product( $productId );
		$this->_products[$productId] = $myProduct;
		return true;
	}
	

	// Remove a product from the shopping cart
	public function removeProduct( $productId ) {
		
		if ( empty($productId) or !is_int($productId) ) {
			throw new Exception("Invalid product to remove, must be either instance of Product or a productId");
		}
		
		if ( array_key_exists( $productId, $this->_products ) ) {
			unset($this->_products[$productId]);
		}
		
		return true;
	}
	
	// remove all products 
	public function removeAllProducts(){
	unset($this->_products);
	}
	
	public function getProducts() {
		return $this->_products;
	}
	
	/**
	 * Get the total price of this shopping cart by summing up the products
	 * and returning it
	 */
	public function getTotalPrice() {
		$products = $this->getProducts();
		$totalPrice = 0;
		foreach ( $products as $prod ) {
			$totalPrice += $prod->getPrice();
		}
		
		return $totalPrice;
	}
	
	// Turn the Shopping cart into an invoice and save it
	public function checkoutCart( Customer $customer ) {
		$myInvoice = new Invoice($this, $customer);
		
		return $myInvoice;
	}
	
}

// Handles everything to do with an invoice
class Invoice {
	
	protected $_date = null;
	protected $_products = array();
	
	protected $_customer = null;
	
	// Setup the new invoice with the products and customer info
	public function __construct( ShoppingCart $cart, Customer $customer ) {
		$this->_products = $cart->getProducts();
		$this->_customer = $customer;		
		$this->_date = date('Y-m-d');
	}
	
	public function getProducts() {
		return $this->_products;
	}
	
	public function saveInvoice() {
		// Do code here to save the invoice into the db!
	}
	
}

<?php
require_once 'db.php';

class CustomerFactory {
	
	// Retrive a single customer from the db and return it
	public function fetch( $CustomerId ) {
				
		$sql = "select * from customer where customer_id = $CustomerId";
		$db = getDbConnection();
		
		if ( $result = $db->query($sql) ) {
			$row = $result->fetch_assoc();
			$result->close();
			$customer = new customer( $row );
			return $customer;
		}
		
		throw new Exception("Unable to retrieve customerId $customerId from the db");
	}
	
	// Retrieve an array of customers from the db and return them
	public function fetchAll() {
		
		$sql =  "select * from customer order by name asc";
		
		$db = getDbConnection();
		$results = $db->query($sql);
		
		$returnCustomers = array();
		while ( $row = $results->fetch_assoc() ) {
			
			// Construct a new customer object using the id above
			$myCustomer = new Customer( $row );
			
			// Add it to the stack of customers to return
			$returnCustomers[] = $myCustomer;
		}
		
		// Return the array of customers objects
		return $returnCustomers;
	}
	
	// Store a single customer in session
	public function storeCustomer( Customer $customer ) {
		// FIXME need to implement this
		$_SESSION['customer_id'] = $customer->getId();
		$_SESSION['customer_name'] = $customer->getName();
		$_SESSION['customer_password'] = $customer->getpassword();
		return true;
	}

}



// A customer represents a logged in shopper
class Customer {
	protected $_db = null;
	
	protected $_id = null;
	
	protected $_name = null;
	
	protected $_password = null;
	public function __construct( array $row ) {
		
		$this->_id = $row['customer_id'];
		$this->_name = $row['name'];
		$this->_password = $row['password'];
	}
	public function login($customerPassword){
		if ($customerPassword == $this->_password){
		return true;
		
		}
		else
		return false;
	
	}
	
	
	/* Prior to introducind customerFactory
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
			$this->_name = $row['name'];
			$this->_password = $row['customer_password']; 			
			$result->close();
		}
	}
	*/
	
	
	public function getId(){
		return $this->_id;
	}
	
	public function getName(){
		return $this->_name;
	}

	public function getPassword(){
		return $this->_password;
	}
	
}

class BookFactory {
	
	// Retrive a single book from the db and return it
	public function fetch( $bookId ) {
		
				
		$sql = "select * from book where book_id = $bookId";
		$db = getDbConnection();
		
		if ( $result = $db->query($sql) ) {
			$row = $result->fetch_assoc();
			$result->close();
			
			$book = new Book( $row );
			return $book;
		}
		
		throw new Exception("Unable to retrieve bookId $bookId from the db");
	}
	
	// Retrieve an array of books from the db and return them
	public function fetchAll() {
		
		$sql =  "select * from book order by name asc";
		
		$db = getDbConnection();
		$results = $db->query($sql);
		
		$returnBooks = array();
		while ( $row = $results->fetch_assoc() ) {
			
			// Construct a new Book object using the id above
			$myBook = new Book( $row );
			
			// Add it to the stack of books to return
			$returnBooks[] = $myBook;
		}
		
		// Return the array of books objects
		return $returnBooks;
	}
	
	// Save a single book back to the db
	public function save( Book $myBook ) {
		//pull the values out of a given book and update to a database		
		
		
		$statusType = 'NULL';
		if ( $myBook->getStatusType() !== null ) {
			$statusType = $myBook->getStatusType();
		}
		
		$statusDate = 'NULL';
		if ( $myBook->getStatusDate() !== null ) {
			$statusDate = "'".$myBook->getStatusDate()."'";
		}
		
		$customerId = 'NULL';
		if ( $myBook->getCustomerId() !== null ) {
			$customerId = $myBook->getCustomerId();
		}
		
		$dueDate = 'NULL';
		if ( $myBook->getDueDate() !== null ) {
			$dueDate = "'".$myBook->getDueDate()."'";
		}
		
		$sql = "
			update book set
				status_type_id = '$statusType',
				status_date = $statusDate,
				due_date = $dueDate,
				customer_id = $customerId
			where book_id = ".$myBook->getId()."
		"; 
		
		$db = getDbConnection();
		
		$results = $db->query($sql);
		if ( !$results ) {
			throw new Exception("Unable to save book to the database with sql string: $sql");
		}
		return true;
	}
	
	//return all books for a customer 
	public function fetchByCustomer($customerId ){
		$sql =  "select * from book
			where customer_id = ".$customerId."";
		
		$db = getDbConnection();
		$results = $db->query($sql);
		if ( !$results ) {
			throw new Exception("Unable to save book to the database with sql string: $sql");
		}
		
		$returnBooks = array();
		while ( $row = $results->fetch_assoc() ) {
			
			// Construct a new Book object using the id above
			$myBook = new Book( $row );
			
			// Add it to the stack of books to return
			$returnBooks[] = $myBook;
		}
		
		// Return the array of books objects
		return $returnBooks;
	}
	
}


// Handles everything to do with books
class Book {
	
	// The product Id
	protected $_id = null;
	
	// The name
	protected $_name = null;
	
	// The abstract
	protected $_abstract = null;
	// The isbn
	protected $_isbn = null;
	
	// The author for this book
	protected $_author = null;
	
	//The picture file path
	protected $_pictureFile = null;
	
	// The database handle
	protected $_db = null;
	
	// status type NOT SURE ABOUT THIS
	protected $_status_type = null;
	
	//date the status was set
	protected $_status_date = null;
	
	// the date the book is due back
	protected $_due_date = null;
	
	public function __construct( array $row ) {
		
		$this->_id = $row['book_id'];
		$this->_name = $row['name'];
		$this->_abstract = $row['abstract'];
		$this->_isbn = $row['isbn'];
		$this->_author = $row['author'];
		$this->_status_type = $row['status_type_id'];
		$this->_pictureFile = $row['picture_path'];
		$this->_status_date = $row['status_date'];
		$this->_customer_id = $row['customer_id'];
		$this->_due_date = $row['due_date'];
	}
	
	public function getId() {
		return $this->_id;
	}
	
	public function getName() {
		return $this->_name;
	}
	
	public function getAbstract() {
		return $this->_abstract;
	}
	
	public function getIsbn() {
		return $this->_isbn;
	}
	
	public function getAuthor() {
		return $this->_author;
	}
	
	public function getStatusType() {
		return $this->_status_type;
	}
	
	public function setStatusType( $statusType ) {
		$this->_status_type = $statusType;
	}
	
	public function getPictureFile() {
		return $this->_pictureFile;
	}
	
	public function getStatusDate() {
		return $this->_status_date;
	}
	
	public function setStatusDate( $statusDate ) {
		$this->_status_date = $statusDate;
	}
	
	public function getCustomerId(){
		return $this->_customer_id;
	}
	
	public function getDueDate() {
		return $this->_due_date;
	}
	
	public function setDueDate( $dueDate ) {
		$this->_due_date = $dueDate;
	}
	

	public function setStatusAvailable() {
		// FIXME
		$this->_customer_id = null;
		$this->_status_date = date('Y-m-d');
		//set due date as null
		$this->_status_type = 'Available';
		$this->_due_date = null;
		return true;
	}
	

	public function setStatusBorrowed( $customerId ) {
		// FIXME
		
		$this->_customer_id = $customerId;
		$this->_status_date = date('Y-m-d');
		$this->_due_date = date("Y-m-d", strtotime("+1 months"));
		$this->_status_type = 'Borrowed';
		return true;
	}
	
	/*
		// See above for example, just change the function being called
	*/
	public function setStatusOnHold( $customerId) {
		$this->_customer_id = $customerId;
		$this->_status_date = date('Y-m-d');
		//add borrowed date using php date function + 2 weeks
		$this->_status_type = 'On Hold';
		return true;
	}
}


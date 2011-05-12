<?php
require_once 'db.php';

// A customer represents a logged in shopper
class Customer {
	protected $_db = null;
	
	protected $_id = null;
	
	protected $_name = null;
	
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
			$this->_name = $row['name'];
			$this->_password = $row['customer_password']; 			
			$result->close();
		}
	}
	
	
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
		// FIXME: This needs to be implemented
				
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
		// FIXME need to implement this
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
		$this->_pictureFile = $row['picture_path'];
		$this->_status_date = $row['status_date'];
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
	
	public function getPictureFile() {
		return $this->_pictureFile;
	}
	
	public function getStatusDate() {
		return $this->_status_date;
	}
	
	public function getDueDate() {
		return $this->_due_date;
	}
	
	/*
		// Code to set the status available and save it
		$bf = new BookFactory();
		$mybook = BookFactory->fetch(1);
		$mybook->setStatusAvailable();
		$bf->save( $myBook );
	
	*/
	public function setStatusAvailable() {
		// FIXME
	}
	
	/*
		// Code to set the status as borrowed
		$bf = new BookFactory();
		$mybook = BookFactory->fetch(1);
		$mybook->setStatusBorrowed( $customer );
		$bf->save( $myBook );
	*/
	public function setStatusBorrowed( Customer $customer ) {
		// FIXME
	}
	
	/*
		// See above for example, just change the function being called
	*/
	public function setStatusOnHold( Customer $customer ) {
		// FIXME
	}
}


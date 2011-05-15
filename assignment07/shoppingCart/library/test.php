<?php
//top of every page that needs access to a customer
if ( false == $cf->hasCustomer() ) {
// Do a redirect!
}

// We are good
$customer = $cf->getCustomer();



//list books by customer
$bf = new BookFactory();

$books = $bf->fetchByCustomer( $customer );
foreach ( $books as $book ) {
// Do something with the book data
}




// On the login page!
$customerId = $_POST['customer_id'];
$customerPassword = $_POST['password'];

$cf = new CustomerFactory();
try {
$customer = $cf->fetch( $customerId );

if ( $customer->login($customerPassword) == false ) {
throw new Exception("Password is incorrect");
}

$cf->storeCustomer( $customer );
}
catch ( Exception $e ) {
echo "Failed login: ".$e->getMessage();
}
